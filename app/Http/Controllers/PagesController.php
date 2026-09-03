<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Category;
use App\Models\Package;
use App\Models\Portfolio;
use App\Models\Question;
use Illuminate\Http\Request;

class PagesController extends Controller
{
    public function homePage()
    {
        $img = fn (string $id, int $w, int $h) => "https://images.unsplash.com/photo-{$id}?auto=format&fit=crop&w={$w}&h={$h}&q=80";

        $heroImage = $img('1555252333-9f8e92e65df9', 1920, 1280);

        $sessions = Category::orderBy('id')->get();

        $portfolio = Portfolio::orderBy('id')->get();

        $finalCtaImage = $img('1522771930-78848d9293e8', 1920, 1000);

        return view('main.home', compact('heroImage', 'sessions', 'portfolio', 'finalCtaImage'));
    }

    public function faqPage()
    {
        $faqs = Question::orderBy('id')->get();

        return view('main.faq', compact('faqs'));
    }

    public function catalogPage()
    {
        $categories = Category::with([
            'packages' => function ($query) {
                $query->where('is_active', true)->orderBy('id')->with(['features' => fn ($q) => $q->orderBy('id')]);
            },
            'notes' => fn ($query) => $query->orderBy('id'),
            'images' => fn ($query) => $query->orderBy('id'),
            'themes' => fn ($query) => $query->orderBy('id'),
        ])->orderBy('id')->get();

        return view('main.catalog', [
            'categories' => $categories,
        ]);
    }

    public function loginPage()
    {
        return view('admin.login');
    }

    public function dashboardPage()
    {
        $stats = [
            [
                'label' => 'Pending Bookings',
                'value' => Booking::where('status', 'pending')->count(),
                'icon' => 'bi-hourglass-split',
            ],
            [
                'label' => 'Confirmed This Month',
                'value' => Booking::where('status', 'confirmed')
                    ->whereMonth('date', now()->month)
                    ->whereYear('date', now()->year)
                    ->count(),
                'icon' => 'bi-calendar-check',
            ],
            [
                'label' => 'Categories',
                'value' => Category::count(),
                'icon' => 'bi-collection',
            ],
            [
                'label' => 'Packages',
                'value' => Package::count(),
                'icon' => 'bi-box-seam',
            ],
        ];

        $recentBookings = Booking::with(['category', 'package'])
            ->latest()
            ->take(5)
            ->get();

        return view('admin.dashboard', compact('stats', 'recentBookings'));
    }
    public function categoriesPage()
    {
        $categories = Category::with(['packages' => function ($query) {
            $query->orderBy('id')->with(['features' => fn ($q) => $q->orderBy('id')]);
        }])->orderBy('id')->get();

        return view('admin.categories', compact('categories'));
    }
    public function addCategoryPage()
    {
        return view('admin.add-category');
    }

    public function editCategoryPage(Category $category)
    {
        $category->load('notes');

        return view('admin.edit-category', compact('category'));
    }
    public function editPackagePage(Package $package){
        $package->load(['category', 'features']);

        return view('admin.package-edit',compact('package'));
    }
    public function addPackagePage(Category $category){
        return view('admin.add-package',compact('category'));
    }
    public function galleryPage(){
        $categories=Category::orderBy('id')->with('images')->get();
        return view('admin.gallery', [
            'categories' => $categories
            
        ]);
    }
    public function themesPage(){
        $categories = Category::orderBy('id')->with('themes')->get();

        return view('admin.themes', compact('categories'));
    }
    public function accountPage(){
        return view('admin.account');
    }
    public function contactPage(){
        $categories = Category::orderBy('id')->with([
            'packages' => fn ($q) => $q->where('is_active', true)->orderBy('id')->with(['features' => fn ($q) => $q->orderBy('id')]),
            'themes' => fn ($q) => $q->orderBy('id'),
        ])->get();

        return view('main.contact', compact('categories'));
    }
    public function bookingsPage(Request $request){
        $status = $request->query('status');
        $old = $request->boolean('old');

        $query = Booking::with(['category', 'package', 'themes']);

        if ($old) {
            $query->whereDate('date', '<', now()->toDateString());
        } elseif ($status === 'pending') {
            $query->where('status', 'pending');
        } elseif ($status === 'confirmed') {
            $query->where('status', 'confirmed');
        } elseif ($status === 'declined_cancelled') {
            $query->whereIn('status', ['declined', 'cancelled']);
        }

        $bookings = $query->get();

        // Each status group sorts by a different column, and the closed-off
        // group (declined/cancelled) sorts the opposite direction from the
        // other two — not something a single SQL ORDER BY can express cleanly,
        // so it's sorted here instead. The bookings list for one studio is
        // small enough that this costs nothing in practice.
        $sessionKey = fn (Booking $b) => $b->date->format('Y-m-d') . ' ' . $b->start_time;

        if ($old) {
            $bookings = $bookings->sortByDesc($sessionKey)->values();
        } elseif ($status === 'pending') {
            $bookings = $bookings->sortBy('created_at')->values();
        } elseif ($status === 'confirmed') {
            $bookings = $bookings->sortBy($sessionKey)->values();
        } elseif ($status === 'declined_cancelled') {
            $bookings = $bookings->sortByDesc('updated_at')->values();
        } else {
            $groupRank = fn (Booking $b) => match ($b->status) {
                'pending' => 0,
                'confirmed' => 1,
                default => 2,
            };

            $bookings = $bookings->sort(function (Booking $a, Booking $b) use ($groupRank, $sessionKey) {
                $rankA = $groupRank($a);
                $rankB = $groupRank($b);

                if ($rankA !== $rankB) {
                    return $rankA <=> $rankB;
                }

                return match ($rankA) {
                    0 => $a->created_at <=> $b->created_at,
                    1 => $sessionKey($a) <=> $sessionKey($b),
                    default => $b->updated_at <=> $a->updated_at,
                };
            })->values();
        }

        return view('admin.bookings', [
            'bookings' => $bookings,
            'activeStatus' => $old ? 'old' : ($status ?: null),
            'counts' => [
                'all' => Booking::count(),
                'pending' => Booking::where('status', 'pending')->count(),
                'confirmed' => Booking::where('status', 'confirmed')->count(),
                'declined_cancelled' => Booking::whereIn('status', ['declined', 'cancelled'])->count(),
                'old' => Booking::whereDate('date', '<', now()->toDateString())->count(),
            ],
        ]);
    }
    public function homeImagePage(){
       $images=Portfolio::latest()->get();
       return view('admin.home-images',compact('images'));
    }
    public function schedulePage(){
        $bookings = Booking::with(['category', 'package'])
            ->whereIn('status', ['pending', 'confirmed'])
            ->get();

        $events = $bookings->map(function (Booking $booking) {
            $start = \Carbon\Carbon::parse($booking->date->format('Y-m-d') . ' ' . $booking->start_time);

            return [
                'title' => $booking->full_name . ' · ' . $booking->category->title,
                'start' => $start->toIso8601String(),
                'end' => $start->copy()->addMinutes($booking->duration_minutes)->toIso8601String(),
                'color' => $booking->status === 'confirmed' ? '#4b8b6f' : '#c58a3d',
            ];
        })->values();

        return view('admin.schedule', compact('events'));
    }
    public function editquestionPage(Question $question){
        return view('admin.question-edit',compact('question'));
    }
    public function addquestionPage(){
        return view('admin.question-add');
    }
    public function questionPage(){
        $questions=Question::latest()->get();
        return view('admin.questions',compact('questions'));
    }
    

}