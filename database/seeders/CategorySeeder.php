<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $img = fn (string $id, int $w, int $h) => "https://images.unsplash.com/photo-{$id}?auto=format&fit=crop&w={$w}&h={$h}&q=80";

        $categories = [
            [
                'title' => 'Newborn Sessions',
                'title_ar' => 'جلسات المواليد الجدد',
                'description' => 'Gentle, unhurried sessions capturing your baby\'s very first days.',
                'description_ar' => 'جلسات هادئة وغير مستعجلة لتوثيق أولى أيام طفلك.',
                'highlight' => 'Reel included for an extra $50 · All photos delivered by link',
                'highlight_ar' => 'ريل بإضافة 50$ · جميع الصور تُسلَّم عبر رابط',
                'icon' => 'bi-moon-stars-fill',
                'main_image' => $img('1544126592-807ade215a0b', 800, 800),
            ],
            [
                'title' => 'Baby & Toddler Sessions',
                'title_ar' => 'جلسات الأطفال والدارجين',
                'description' => 'Playful studio sessions celebrating your little one\'s growing personality.',
                'description_ar' => 'جلسات استوديو مرحة تحتفي بشخصية طفلك المتنامية.',
                'highlight' => 'Phone reel included · All photos delivered by link',
                'highlight_ar' => 'ريل هاتف مشمول · جميع الصور تُسلَّم عبر رابط',
                'icon' => 'bi-cake2',
                'main_image' => $img('1522771930-78848d9293e8', 800, 800),
            ],
            [
                'title' => 'Birthday Sessions',
                'title_ar' => 'جلسات أعياد الميلاد',
                'description' => 'A fully styled studio set-up to celebrate every candle and milestone.',
                'description_ar' => 'ديكور استوديو متكامل للاحتفال بكل شمعة وإنجاز صغير.',
                'highlight' => 'Phone reel included · All photos delivered by link',
                'highlight_ar' => 'ريل هاتف مشمول · جميع الصور تُسلَّم عبر رابط',
                'icon' => 'bi-balloon-heart-fill',
                'main_image' => $img('1607453998774-d533f65dac99', 800, 800),
            ],
            [
                'title' => 'Family Sessions',
                'title_ar' => 'الجلسات العائلية',
                'description' => 'Everlasting family moments — timeless portraits of the ones you love.',
                'description_ar' => 'لحظات عائلية خالدة — صور دافئة لمن تحبين.',
                'highlight' => 'Phone reel included · All photos delivered by link',
                'highlight_ar' => 'ريل هاتف مشمول · جميع الصور تُسلَّم عبر رابط',
                'icon' => 'bi-stars',
                'main_image' => $img('1476234251651-f353703a034d', 800, 800),
            ],
            [
                'title' => 'Gender Reveal Sessions',
                'title_ar' => 'جلسات كشف جنس المولود',
                'description' => 'Celebrate the big reveal with a beautifully styled studio moment.',
                'description_ar' => 'احتفلي باللحظة الكبرى بديكور استوديو أنيق.',
                'highlight' => 'All photos delivered by link',
                'highlight_ar' => 'جميع الصور تُسلَّم عبر رابط',
                'icon' => 'bi-heart-fill',
                'main_image' => $img('1530103862676-de8c9debad1d', 800, 800),
            ],
        ];

        foreach ($categories as $category) {
            Category::updateOrCreate(['title' => $category['title']], $category);
        }
    }
}
