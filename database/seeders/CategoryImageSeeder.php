<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategoryImageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $img = fn (string $id, int $w, int $h) => "https://images.unsplash.com/photo-{$id}?auto=format&fit=crop&w={$w}&h={$h}&q=80";

        $data = [
            'Newborn Session' => [
                $img('1544126592-807ade215a0b', 500, 500),
                $img('1555252333-9f8e92e65df9', 500, 500),
            ],
            'Baby & Toddler Sessions' => [
                $img('1522771930-78848d9293e8', 500, 500),
                $img('1476703993599-0035a21b17a9', 500, 500),
            ],
            'Birthday Sessions' => [
                $img('1607453998774-d533f65dac99', 500, 500),
                $img('1530103862676-de8c9debad1d', 500, 500),
            ],
            'Family Sessions' => [
                $img('1476234251651-f353703a034d', 500, 500),
                $img('1531983412531-1f49a365ffed', 500, 500),
            ],
            'Gender Reveal Sessions' => [
                $img('1530103862676-de8c9debad1d', 500, 500),
            ],
        ];

        foreach ($data as $categoryTitle => $images) {
            $category = Category::where('title', $categoryTitle)->first();

            if (! $category) {
                continue;
            }

            $category->images()->delete();
            $category->images()->createMany(array_map(fn ($image) => ['image' => $image], $images));
        }
    }
}
