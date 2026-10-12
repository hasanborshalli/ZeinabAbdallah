<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Feedback;
use App\Models\Package;
use App\Models\Question;
use Illuminate\Http\Request;

class PagesController extends Controller
{
    public function homePage()
    {
        $sessions = Category::orderBy('id')->get();
        $feedbacks = Feedback::orderBy('id', 'desc')->get();

        return view('main.home', compact('sessions', 'feedbacks'));
    }

    public function galleryIndexPage()
    {
        // Every session's photos, grouped by session — the full-site gallery
        // linked from the hero's "View Gallery" button. Sessions with no
        // photos yet are simply skipped in the view rather than shown empty.
        // Each session paginates independently (its own ?page_{id}= query
        // param), since with many photos per category a single flat list
        // wouldn't scale.
        $sessions = Category::orderBy('id')->get();

        $sessions->each(function (Category $category) {
            $category->setRelation('pagedImages', $category->images()
                ->orderBy('id', 'desc')
                ->paginate(18, ['*'], 'page_' . $category->id));
        });

        return view('main.gallery', compact('sessions'));
    }

    public function themesIndexPage()
    {
        // Same concept as the gallery page, but for themes — every session's
        // available themes, grouped by session, each paginating on its own.
        $sessions = Category::orderBy('id')->get();

        $sessions->each(function (Category $category) {
            $category->setRelation('pagedThemes', $category->themes()
                ->orderBy('id')
                ->paginate(18, ['*'], 'page_' . $category->id));
        });

        return view('main.themes', compact('sessions'));
    }

    public function sessionDetailPage(Category $category)
    {
        $category->load([
            'packages' => fn ($q) => $q->where('is_active', true)->orderBy('id')->with(['features' => fn ($q) => $q->orderBy('id')]),
            'notes' => fn ($q) => $q->orderBy('id'),
            'images' => fn ($q) => $q->orderBy('id'),
            // Newest first — the session detail page only previews the last
            // 4, so "last" needs to mean "most recently added" here.
            'themes' => fn ($q) => $q->orderBy('id', 'desc'),
        ]);

        $faqs = Question::where('category_id', $category->id)->orderBy('id')->get();

        return view('main.session-detail', compact('category', 'faqs'));
    }

    public function sessionGalleryPage(Category $category)
    {
        $category->load(['images' => fn ($q) => $q->orderBy('id', 'desc')]);

        return view('main.session-gallery', compact('category'));
    }

    public function sessionThemesPage(Category $category)
    {
        $category->load(['themes' => fn ($q) => $q->orderBy('id', 'desc')]);

        return view('main.session-themes', compact('category'));
    }

    /**
     * The private, per-session "tell us more" form the photographer sends
     * over WhatsApp once a booking is confirmed — not a booking form itself
     * (no date/time, nothing saved), just the shoot-prep questions for that
     * category. Field set is keyed by Category::bookingTemplate(), same
     * template key the old booking form used; only 'newborn' has its real
     * fields built so far, everything else gets a generic fallback for now.
     */
    public function sessionInfoFormPage(Category $category)
    {
        return view('main.session-form', compact('category'));
    }

    public function bookingPage(Request $request)
    {
        // Optional context carried over from a specific session/package "Book
        // Now" link, so the WhatsApp message it produces can mention which
        // one the customer meant, without turning this into a multi-field form.
        $sessionName = $request->query('session');
        $packageName = $request->query('package');

        return view('main.booking', compact('sessionName', 'packageName'));
    }

    public function loginPage()
    {
        return view('admin.login');
    }

    public function dashboardPage()
    {
        $stats = [
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

        return view('admin.dashboard', compact('stats'));
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
        return view('main.contact');
    }
    public function aboutPage(){
        return view('main.about');
    }
    public function editquestionPage(Question $question){
        $categories = Category::orderBy('title')->get();

        return view('admin.question-edit',compact('question', 'categories'));
    }
    public function addquestionPage(){
        $categories = Category::orderBy('title')->get();

        return view('admin.question-add',compact('categories'));
    }
    public function questionPage(){
        $questions=Question::with('category')->latest()->get();
        return view('admin.questions',compact('questions'));
    }

    public function feedbacksPage(){
        $feedbacks = Feedback::latest()->get();
        return view('admin.feedbacks', compact('feedbacks'));
    }

    public function addFeedbackPage(){
        return view('admin.add-feedback');
    }

    public function editFeedbackPage(Feedback $feedback){
        return view('admin.edit-feedback', compact('feedback'));
    }

}