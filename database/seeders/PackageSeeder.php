<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Package;
use Illuminate\Database\Seeder;

class PackageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            'Newborn Sessions' => [
                [
                    'name' => 'Bronze Package', 'name_ar' => 'الباقة البرونزية',
                    'price' => 100, 'duration_min_minutes' => 30, 'duration_max_minutes' => 40,
                    'features' => [
                        ['2 themes', 'ثيمان'],
                        ['10 edited & printed photos', '10 صور معدّلة ومطبوعة'],
                        ['All photos in high resolution', 'جميع الصور بدقة عالية'],
                        ['Family photos included', 'صور عائلية مشمولة'],
                    ],
                ],
                [
                    'name' => 'Silver Package', 'name_ar' => 'الباقة الفضية',
                    'price' => 150, 'duration_min_minutes' => 45, 'duration_max_minutes' => 60,
                    'features' => [
                        ['3 themes', '3 ثيمات'],
                        ['12 edited & printed photos', '12 صورة معدّلة ومطبوعة'],
                        ['All photos in high resolution', 'جميع الصور بدقة عالية'],
                        ['Family photos included', 'صور عائلية مشمولة'],
                    ],
                ],
                [
                    'name' => 'Gold Package', 'name_ar' => 'الباقة الذهبية',
                    'price' => 200, 'duration_min_minutes' => 60, 'duration_max_minutes' => 90,
                    'features' => [
                        ['4 themes', '4 ثيمات'],
                        ['15 edited & printed photos', '15 صورة معدّلة ومطبوعة'],
                        ['All photos in high resolution', 'جميع الصور بدقة عالية'],
                        ['Family photos included', 'صور عائلية مشمولة'],
                    ],
                ],
            ],
            'Baby & Toddler Sessions' => [
                [
                    'name' => 'Bronze Package', 'name_ar' => 'الباقة البرونزية',
                    'price' => 100, 'duration_min_minutes' => 30, 'duration_max_minutes' => 45,
                    'features' => [
                        ['1 theme', 'ثيم واحد'],
                        ['8 edited & printed photos', '8 صور معدّلة ومطبوعة'],
                        ['Family photos included', 'صور عائلية مشمولة'],
                    ],
                ],
                [
                    'name' => 'Silver Package', 'name_ar' => 'الباقة الفضية',
                    'price' => 150, 'duration_min_minutes' => 45, 'duration_max_minutes' => 60,
                    'features' => [
                        ['2 themes', 'ثيمان'],
                        ['12 edited & printed photos', '12 صورة معدّلة ومطبوعة'],
                        ['Family shoots included', 'جلسات عائلية مشمولة'],
                    ],
                ],
                [
                    'name' => 'Gold Package', 'name_ar' => 'الباقة الذهبية',
                    'price' => 180, 'duration_min_minutes' => 60, 'duration_max_minutes' => 90,
                    'features' => [
                        ['3 themes', '3 ثيمات'],
                        ['15 edited & printed photos', '15 صورة معدّلة ومطبوعة'],
                        ['Family shoots included', 'جلسات عائلية مشمولة'],
                    ],
                ],
            ],
            'Birthday Sessions' => [
                [
                    'name' => 'Bronze Package', 'name_ar' => 'الباقة البرونزية',
                    'price' => 100, 'duration_min_minutes' => 30, 'duration_max_minutes' => 45,
                    'features' => [
                        ['1 theme', 'ثيم واحد'],
                        ['8 edited & printed photos', '8 صور معدّلة ومطبوعة'],
                        ['Family shoots available for an extra $20', 'جلسات عائلية متاحة مقابل 20$ إضافية'],
                    ],
                ],
                [
                    'name' => 'Silver Package', 'name_ar' => 'الباقة الفضية',
                    'price' => 150, 'duration_min_minutes' => 45, 'duration_max_minutes' => 60,
                    'features' => [
                        ['2 themes', 'ثيمان'],
                        ['12 edited & printed photos', '12 صورة معدّلة ومطبوعة'],
                        ['Family shoots included', 'جلسات عائلية مشمولة'],
                    ],
                ],
                [
                    'name' => 'Gold Package', 'name_ar' => 'الباقة الذهبية',
                    'price' => 180, 'duration_min_minutes' => 60, 'duration_max_minutes' => 90,
                    'features' => [
                        ['3 themes', '3 ثيمات'],
                        ['15 edited & printed photos', '15 صورة معدّلة ومطبوعة'],
                        ['Family shoots included', 'جلسات عائلية مشمولة'],
                    ],
                ],
            ],
            'Family Sessions' => [
                [
                    'name' => 'Package One', 'name_ar' => 'الباقة الأولى',
                    'price' => 100, 'duration_min_minutes' => 30, 'duration_max_minutes' => 30,
                    'features' => [
                        ['10 professionally edited photos', '10 صور معدّلة باحترافية'],
                        ['Printed photograph (size A5)', 'صورة مطبوعة مقاس A5'],
                    ],
                ],
                [
                    'name' => 'Package Two', 'name_ar' => 'الباقة الثانية',
                    'price' => 150, 'duration_min_minutes' => 30, 'duration_max_minutes' => 45,
                    'features' => [
                        ['15 professionally edited photos', '15 صورة معدّلة باحترافية'],
                        ['Printed photograph (size A5)', 'صورة مطبوعة مقاس A5'],
                    ],
                ],
            ],
            'Gender Reveal Sessions' => [
                [
                    'name' => 'Gender Reveal Package', 'name_ar' => 'باقة كشف الجنس',
                    'price' => 100, 'duration_min_minutes' => 30, 'duration_max_minutes' => 45,
                    'features' => [
                        ['10 professionally edited photos', '10 صور معدّلة باحترافية'],
                        ['High resolution video included', 'فيديو عالي الدقة مشمول'],
                        ['Pink or blue theme setup', 'ديكور بثيم وردي أو أزرق'],
                        ['Family photos included', 'صور عائلية مشمولة'],
                    ],
                ],
            ],
        ];

        foreach ($data as $categoryTitle => $packages) {
            $category = Category::where('title', $categoryTitle)->first();

            if (! $category) {
                continue;
            }

            foreach ($packages as $packageData) {
                $features = $packageData['features'];
                unset($packageData['features']);

                $package = Package::updateOrCreate(
                    ['category_id' => $category->id, 'name' => $packageData['name']],
                    $packageData + ['category_id' => $category->id, 'is_active' => true]
                );

                $package->features()->delete();
                $package->features()->createMany(array_map(
                    fn ($feature) => ['description' => $feature[0], 'description_ar' => $feature[1]],
                    $features
                ));
            }
        }
    }
}
