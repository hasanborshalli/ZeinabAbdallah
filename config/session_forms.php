<?php

/*
|--------------------------------------------------------------------------
| Session info form questions
|--------------------------------------------------------------------------
|
| The questions on /sessions/{category}/form, per Category::bookingTemplate(),
| in display order. Each field is either 'text', 'textarea', or a list of
| option keys (rendered as radio buttons — stacked when there are more than
| two). An 'other' option gets its own free-text box. Wording for every
| field and option lives in lang/{locale}/session_forms.php.
|
*/

$sharing = ['photos_reels', 'photos_only', 'private'];

return [

    'newborn' => [
        'full_name' => 'text',
        'baby_name' => 'text',
        'baby_gender' => ['boy', 'girl'],
        'baby_age' => 'text',
        'baby_twin' => ['yes', 'no'],
        'sharing_baby' => $sharing,
    ],

    'baby' => [
        'baby_name' => 'text',
        'baby_gender' => ['boy', 'girl'],
        'baby_age' => 'text',
        'baby_twin' => ['yes', 'no'],
        'baby_sits' => ['yes', 'no'],
        'baby_mobility' => ['not_yet', 'crawling', 'walking'],
        'baby_favorite' => 'textarea',
        'sharing_baby' => $sharing,
    ],

    'birthday' => [
        'child_name' => 'text',
        'child_gender' => ['boy', 'girl'],
        'child_age' => 'text',
        'birthday_number' => 'text',
        'birthday_twin' => ['yes', 'no'],
        'preferred_colors' => 'text',
        'cake_smash' => ['yes', 'no'],
        'bring_cake' => ['yes', 'no'],
        'birthday_joining' => ['child_only', 'with_siblings', 'with_parents', 'whole_family'],
        'sharing_child' => $sharing,
    ],

    'maternity' => [
        'mother_name' => 'text',
        'weeks_pregnant' => 'text',
        'first_pregnancy' => ['yes', 'no'],
        'expecting' => ['baby_boy', 'baby_girl', 'twins', 'surprise'],
        'maternity_joining' => ['mother_only', 'with_partner', 'with_children', 'whole_family'],
        'maternity_count' => 'text',
        'maternity_outfit' => ['studio_dresses', 'own_outfit', 'both'],
        'comfort_notes' => 'textarea',
        'sharing_maternity' => $sharing,
    ],

    'gender_reveal' => [
        'mother_name' => 'text',
        'father_name' => 'text',
        'weeks_pregnant' => 'text',
        'first_baby' => ['yes', 'no'],
        'know_gender' => ['yes', 'no_surprise'],
        'who_knows' => ['parents', 'photographer_only', 'family_friend'],
        'reveal_method' => ['balloons', 'cake', 'confetti', 'other'],
        'preferred_colors' => 'text',
        'reveal_joining' => ['couple_only', 'with_children', 'with_family_members'],
        'people_count' => 'text',
        'own_accessories' => ['yes', 'no'],
        'sharing_gender_reveal' => $sharing,
    ],

    'family' => [
        'client_name' => 'text',
        'family_count' => 'text',
        'children_ages' => 'textarea',
        'babies_joining' => ['yes', 'no'],
        'family_photo_type' => ['together', 'parents_children', 'siblings_together', 'individual', 'mix'],
        'sharing_family' => $sharing,
    ],

    // Any session without its own question set yet.
    'generic' => [
        'full_name' => 'text',
        'phone' => 'text',
        'notes' => 'textarea',
    ],

];
