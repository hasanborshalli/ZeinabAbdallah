<?php

namespace Database\Seeders;

use App\Models\Question;
use Illuminate\Database\Seeder;

class QuestionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $questions = [
            [
                'question' => 'When is the best time to photograph my newborn?',
                'question_ar' => 'متى هو أفضل وقت لتصوير مولودي الجديد؟',
                'answer' => 'The ideal time is within the first 10–15 days after birth, when babies are usually sleepier and easier to gently pose. Wrapped sessions can also be done up to 1 month, depending on your baby\'s size and comfort.',
                'answer_ar' => 'أفضل وقت هو خلال أول ١٠ إلى ١٥ يوماً بعد الولادة، حيث يكون نوم الطفل أعمق ويسهل تنسيق وضعيات لطيفة له. يمكن أيضاً إجراء جلسات اللَّف حتى عمر شهر، بحسب حجم طفلكِ وراحته.',
            ],
            [
                'question' => 'Is newborn photography safe for my baby?',
                'question_ar' => 'هل تصوير المواليد آمن لطفلي؟',
                'answer' => 'Absolutely. Your baby\'s safety and comfort always come first. Every pose is done gently and patiently, and the session follows your baby\'s needs and rhythm.',
                'answer_ar' => 'بالتأكيد. سلامة طفلكِ وراحته تأتي دائماً في المقام الأول. تُنفَّذ كل وضعية بلطف وصبر، وتسير الجلسة وفق احتياجات طفلكِ وإيقاعه.',
            ],
            [
                'question' => 'What if my baby cries or does not sleep?',
                'question_ar' => 'ماذا لو بكى طفلي أو لم ينم؟',
                'answer' => 'No worries at all — this is completely normal. We allow plenty of time for feeding, cuddling, changing, and soothing. We never rush your little one.',
                'answer_ar' => 'لا داعي للقلق إطلاقاً — هذا أمر طبيعي تماماً. نخصّص وقتاً كافياً للرضاعة والاحتضان وتغيير الحفاض والتهدئة، ولا نستعجل صغيركِ أبداً.',
            ],
            [
                'question' => 'How long does a newborn session take?',
                'question_ar' => 'كم تستغرق جلسة تصوير المواليد؟',
                'answer' => 'The session duration depends on the selected package and your baby\'s needs. Extra time is always allowed when needed for feeding and comforting.',
                'answer_ar' => 'تعتمد مدة الجلسة على الباقة المختارة واحتياجات طفلكِ. ويُسمح دائماً بوقت إضافي عند الحاجة للرضاعة والتهدئة.',
            ],
            [
                'question' => 'What should my baby wear for the session?',
                'question_ar' => 'ماذا يرتدي طفلي في الجلسة؟',
                'answer' => 'You don\'t need to prepare anything special. Beautiful newborn outfits, wraps, accessories, and props are provided and carefully selected to match your chosen setup.',
                'answer_ar' => 'لا تحتاجين إلى تحضير أي شيء خاص. تُوفَّر ملابس ولفّات وإكسسوارات وقطع ديكور جميلة للمواليد، ويتم اختيارها بعناية لتناسب التنسيق الذي اخترتِه.',
            ],
            [
                'question' => 'Do parents or siblings appear in the photos?',
                'question_ar' => 'هل يظهر الوالدان أو الإخوة في الصور؟',
                'answer' => 'Yes! Family and sibling photos can be included, depending on your selected package. These are often some of the most meaningful images from the session.',
                'answer_ar' => 'نعم! يمكن تضمين صور العائلة والإخوة بحسب الباقة المختارة، وغالباً ما تكون هذه من أكثر صور الجلسة معنىً.',
            ],
            [
                'question' => 'What if my baby was born early or needs extra care?',
                'question_ar' => 'ماذا لو وُلد طفلي مبكراً أو يحتاج إلى رعاية إضافية؟',
                'answer' => 'Every baby is different. Please let me know before booking so the session can be planned around your baby\'s individual needs, comfort, and wellbeing.',
                'answer_ar' => 'كل طفل مختلف. يرجى إخباري قبل الحجز ليتم التخطيط للجلسة بما يناسب احتياجات طفلكِ الخاصة وراحته وسلامته.',
            ],
            [
                'question' => 'When will we receive our photos?',
                'question_ar' => 'متى سنستلم صورنا؟',
                'answer' => 'Your professionally edited photos will be delivered within up to 2 weeks after your session.',
                'answer_ar' => 'تُسلَّم صوركِ بعد تعديلها احترافياً خلال مدة تصل إلى أسبوعين من تاريخ الجلسة.',
            ],
            [
                'question' => 'How do I book a newborn session?',
                'question_ar' => 'كيف أحجز جلسة تصوير للمواليد؟',
                'answer' => 'Simply choose your preferred package and contact me to check availability. Booking early is recommended, especially if you would like your session during your baby\'s first two weeks.',
                'answer_ar' => 'اختاري الباقة المناسبة لكِ وتواصلي معي للتحقق من المواعيد المتاحة. يُنصح بالحجز مبكراً، خاصةً إذا كنتِ ترغبين بإجراء الجلسة خلال أول أسبوعين من عمر طفلكِ.',
            ],
            [
                'question' => 'Why should I book a newborn session?',
                'question_ar' => 'لماذا أحجز جلسة تصوير للمواليد؟',
                'answer' => 'Because they are only this little once. 🤍 Newborn photography preserves those tiny details and beautiful first moments that change so quickly, giving you memories to treasure forever.',
                'answer_ar' => 'لأنهم يكونون بهذا الصِّغر مرة واحدة فقط. 🤍 يحفظ تصوير المواليد تلك التفاصيل الدقيقة واللحظات الأولى الجميلة التي تتغير بسرعة، ليمنحكِ ذكريات تحتفظين بها إلى الأبد.',
            ],
            [
                'question' => 'How is the payment made?',
                'question_ar' => 'كيف تتم عملية الدفع؟',
                'answer' => 'Full payment is required on the day of the session. Any additional photos or extras can be added for an additional fee.',
                'answer_ar' => 'يُطلب سداد كامل المبلغ في يوم الجلسة. ويمكن إضافة أي صور أو خدمات إضافية مقابل رسوم إضافية.',
            ],
            [
                'question' => 'Do you have gift vouchers?',
                'question_ar' => 'هل تتوفر بطاقات هدايا؟',
                'answer' => 'Yes. Gift vouchers are available and make a beautiful present for expecting parents, newborns, birthdays, and families.',
                'answer_ar' => 'نعم. تتوفر بطاقات هدايا، وهي هدية جميلة للأهل المنتظرين، والمواليد الجدد، وأعياد الميلاد، والعائلات.',
            ],
            [
                'question' => 'What are your opening days and hours?',
                'question_ar' => 'ما هي أيام وساعات العمل؟',
                'answer' => 'Sessions are available by appointment only. Please contact me to check available dates and times and choose what works best for you.',
                'answer_ar' => 'الجلسات متاحة بموعد مسبق فقط. يرجى التواصل معي لمعرفة التواريخ والأوقات المتاحة واختيار ما يناسبكِ.',
            ],
            [
                'question' => 'Is the studio clean and sanitized?',
                'question_ar' => 'هل الاستوديو نظيف ومعقّم؟',
                'answer' => 'Yes. Cleanliness is especially important for newborn sessions. The studio, props, wraps, and items used during sessions are carefully cleaned and prepared for every little client.',
                'answer_ar' => 'نعم. النظافة مهمة جداً في جلسات المواليد. يتم تنظيف الاستوديو وقطع الديكور واللفّات وجميع الأدوات المستخدمة وتحضيرها بعناية لكل عميل صغير.',
            ],
            [
                'question' => 'Who takes the photos?',
                'question_ar' => 'من يلتقط الصور؟',
                'answer' => 'Your session is personally photographed by Zeinab from YouPhoto.lb, from preparing your setups to capturing your baby\'s beautiful little moments. 🤍',
                'answer_ar' => 'تلتقط زينب من YouPhoto.lb صور جلستكِ بنفسها، من تحضير التنسيقات وحتى التقاط لحظات طفلكِ الجميلة الصغيرة. 🤍',
            ],
        ];

        foreach ($questions as $question) {
            Question::updateOrCreate(['question' => $question['question']], $question);
        }
    }
}
