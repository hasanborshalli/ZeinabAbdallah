<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class NoteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            'Newborn Session' => [
                ['en' => 'For wrapped sleeping poses, babies should be 10–15 days old.', 'ar' => 'للوضعيات الملفوفة أثناء النوم، يفضّل أن يكون عمر الطفل بين 10 و15 يوماً.'],
                ['en' => 'Wrapped poses can be done up to 1 month old, depending on the baby\'s size and weight.', 'ar' => 'يمكن تنفيذ الوضعيات الملفوفة حتى عمر شهر، بحسب حجم الطفل ووزنه.'],
                ['en' => 'Full payment is required on the day of the session.', 'ar' => 'الدفع الكامل مطلوب يوم الجلسة.'],
                ['en' => 'Punctuality is key to ensuring a smooth and successful session.', 'ar' => 'الالتزام بالموعد أساسي لإنجاح الجلسة.'],
                ['en' => 'Photo editing and printing take up to two weeks.', 'ar' => 'تستغرق عملية التعديل والطباعة حتى أسبوعين.'],
            ],
            'Baby & Toddler Sessions' => [
                ['en' => 'Props & outfits are included.', 'ar' => 'الإكسسوارات والإطلالات مشمولة.'],
                ['en' => 'Additional photos can be purchased for an extra charge.', 'ar' => 'يمكن شراء صور إضافية مقابل رسم إضافي.'],
                ['en' => 'Full payment is required on the day of the session.', 'ar' => 'الدفع الكامل مطلوب يوم الجلسة.'],
                ['en' => 'Punctuality is key to ensuring a smooth and successful session.', 'ar' => 'الالتزام بالموعد أساسي لإنجاح الجلسة.'],
                ['en' => 'Photo editing and printing take up to two weeks.', 'ar' => 'تستغرق عملية التعديل والطباعة حتى أسبوعين.'],
                ['en' => 'Add a video for an extra $50.', 'ar' => 'أضيفي فيديو مقابل 50$ إضافية.'],
            ],
            'Birthday Sessions' => [
                ['en' => 'Add a cake for an extra $35.', 'ar' => 'أضيفي كيكة مقابل 35$ إضافية.'],
                ['en' => 'Add a fun cake for an extra $20.', 'ar' => 'أضيفي كيكة تنكرية مقابل 20$ إضافية.'],
                ['en' => 'Upgrade your session with a 1–2 minute video for $50.', 'ar' => 'طوّري جلستك بفيديو من دقيقة إلى دقيقتين مقابل 50$.'],
                ['en' => 'All outfits and accessories are provided.', 'ar' => 'جميع الإطلالات والإكسسوارات مؤمَّنة.'],
                ['en' => 'Additional photos can be purchased for an extra charge.', 'ar' => 'يمكن شراء صور إضافية مقابل رسم إضافي.'],
            ],
            'Family Sessions' => [
                ['en' => 'Choice of family room or plain backgrounds.', 'ar' => 'إمكانية اختيار غرفة العائلة أو خلفية بسيطة.'],
                ['en' => 'Recommended outfits: white, off-white or nude tones for a timeless look.', 'ar' => 'الإطلالات المقترحة: أبيض أو off-white أو بيج لإطلالة خالدة.'],
                ['en' => 'Photo editing and printing take up to two weeks.', 'ar' => 'تستغرق عملية التعديل والطباعة حتى أسبوعين.'],
                ['en' => 'A non-refundable deposit of $20 is due upon confirmation.', 'ar' => 'يُطلب عربون غير قابل للاسترداد بقيمة 20$ عند تأكيد الحجز.'],
                ['en' => 'Full payment is required on the day of the session.', 'ar' => 'الدفع الكامل مطلوب يوم الجلسة.'],
            ],
            'Gender Reveal Sessions' => [
                ['en' => 'Gender reveal setup available in pink or blue theme.', 'ar' => 'ديكور كشف الجنس متوفر بثيم وردي أو أزرق.'],
                ['en' => 'All photos delivered via a private download link.', 'ar' => 'جميع الصور تُسلَّم عبر رابط تحميل خاص.'],
                ['en' => 'Dress rental available upon request.', 'ar' => 'إمكانية استئجار فستان عند الطلب.'],
                ['en' => 'Full payment is required on the day of the session.', 'ar' => 'الدفع الكامل مطلوب يوم الجلسة.'],
            ],
        ];

        foreach ($data as $categoryTitle => $notes) {
            $category = Category::where('title', $categoryTitle)->first();

            if (! $category) {
                continue;
            }

            $category->notes()->delete();
            $category->notes()->createMany(array_map(fn ($note) => [
                'note' => $note['en'],
                'note_ar' => $note['ar'],
            ], $notes));
        }
    }
}
