<?php

namespace Database\Seeders;

use App\Models\Feedback;
use Illuminate\Database\Seeder;

class FeedbackSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $feedbacks = [
            [
                'name' => 'Rana Khalil',
                'name_ar' => 'رنا خليل',
                'feedback' => 'Zeinab made our newborn session so calm and easy. The photos are absolutely stunning and we will treasure them forever.',
                'feedback_ar' => 'جعلت زينب جلسة تصوير مولودنا هادئة وسهلة جداً. الصور رائعة حقاً وسنعتز بها إلى الأبد.',
            ],
            [
                'name' => 'Sarah Nasser',
                'name_ar' => 'سارة ناصر',
                'feedback' => 'From the first message to the final delivery, everything was professional and warm. Highly recommend her for family sessions!',
                'feedback_ar' => 'من أول رسالة وحتى استلام الصور، كان كل شيء احترافياً ودافئاً. أنصح بها بشدة للجلسات العائلية!',
            ],
            [
                'name' => 'Lea Chami',
                'name_ar' => 'ليا شامي',
                'feedback' => 'Our baby\'s birthday shoot turned out even better than we imagined. Zeinab has such a gift for capturing genuine smiles.',
                'feedback_ar' => 'جلسة عيد ميلاد طفلنا جاءت أجمل مما تخيلنا. لدى زينب موهبة حقيقية في التقاط الابتسامات الصادقة.',
            ],
            [
                'name' => 'Maya Haddad',
                'name_ar' => 'مايا حداد',
                'feedback' => 'A truly patient and gentle photographer. She made sure our little one was comfortable the whole time. The results speak for themselves.',
                'feedback_ar' => 'مصورة صبورة ولطيفة حقاً. حرصت على راحة طفلنا طوال الوقت، والنتيجة تتحدث عن نفسها.',
            ],
        ];

        foreach ($feedbacks as $feedback) {
            Feedback::updateOrCreate(['name' => $feedback['name']], $feedback);
        }
    }
}
