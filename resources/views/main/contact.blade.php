@php
    $tr = fn ($model, $field) => app()->getLocale() === 'ar' ? $model->{$field . '_ar'} : $model->$field;

    $timeSlots = [];
    $slot = \Carbon\Carbon::createFromTime(10, 0);
    $close = \Carbon\Carbon::createFromTime(16, 0);
    while ($slot->lt($close)) {
        $timeSlots[] = $slot->format('g:i A');
        $slot->addMinutes(30);
    }
@endphp

<x-layout :nav-solid="true" :title="__('site.contact.eyebrow') . ' — ' . __('site.brand_name')">

    {{-- Page header --}}
    <section class="page-header bg-cream">
        <div class="container-max">
            <div class="section-intro mx-auto">
                <span class="eyebrow">{{ __('site.contact.eyebrow') }}</span>
                <h1 class="section-heading">{{ __('site.contact.heading') }}</h1>
                <hr class="divider-gold">
                <p style="color: var(--color-ink-soft);">{{ __('site.contact.intro') }}</p>
            </div>
        </div>
    </section>

    {{-- Studio Information --}}
    <section class="section">
        <div class="container-max">
            <div class="section-intro mx-auto text-center mb-5">
                <span class="eyebrow">{{ __('site.contact.studio.eyebrow') }}</span>
                <p class="mb-0" style="color: var(--color-ink-soft);">{{ __('site.contact.studio.intro') }}</p>
            </div>

            <div class="row g-4">
                <div class="col-md-6">
                    <div class="studio-info-card">
                        <span class="studio-info-icon"><i class="bi bi-clock"></i></span>
                        <h3>{{ __('site.contact.studio.hours_title') }}</h3>
                        <p class="fw-semibold mb-1">{{ __('site.contact.studio.hours_days') }}</p>
                        <p>{{ __('site.contact.studio.hours_time') }}</p>
                        <p class="fst-italic mb-0">{{ __('site.contact.studio.hours_note') }}</p>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="studio-info-card">
                        <span class="studio-info-icon"><i class="bi bi-geo-alt"></i></span>
                        <h3>{{ __('site.contact.studio.location_title') }}</h3>
                        <p class="mb-3">{{ __('site.contact.studio.location_address') }}</p>
                        <a
                            href="https://maps.google.com/maps?q=33.830657958984375%2C35.566673278808594&z=17&hl=en"
                            target="_blank"
                            rel="noopener"
                            class="btn-outline-gold"
                        >
                            <i class="bi bi-compass me-1"></i> {{ __('site.contact.studio.directions_cta') }}
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- Our Recommendations --}}
    <section class="section bg-cream">
        <div class="container-max">
            <div class="section-intro mx-auto text-center mb-5">
                <span class="eyebrow">{{ __('site.contact.tips.eyebrow') }}</span>
                <h2 class="section-heading">{{ __('site.contact.tips.heading') }}</h2>
                <hr class="divider-gold">
                <p style="color: var(--color-ink-soft);">{{ __('site.contact.tips.intro') }}</p>
            </div>

            <div class="row g-4">
                @foreach (__('site.contact.tips.items') as $tip)
                    <div class="col-md-6 col-lg-4">
                        <div class="recommendation-card">
                            <span class="recommendation-number">{{ sprintf('%02d', $loop->iteration) }}</span>
                            <div>
                                <h3>{{ $tip['title'] }}</h3>
                                <p>{{ $tip['text'] }}</p>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <p class="text-center fst-italic mt-5 mb-0" style="color: var(--color-ink-soft); max-width: 720px; margin-inline: auto;">
                {{ __('site.contact.tips.closing') }}
            </p>
        </div>
    </section>

    {{-- Booking form --}}
    <section class="section">
        <div class="container-max" style="max-width: 860px;">
            <div class="section-intro mx-auto text-center mb-5">
                <span class="eyebrow">{{ __('site.contact.form.eyebrow') }}</span>
                <h2 class="section-heading">{{ __('site.contact.form.heading') }}</h2>
                <hr class="divider-gold">
            </div>

            @if (session('success'))
                <div class="alert alert-success mb-4">{{ session('success') }}</div>
            @endif

            @if ($errors->any())
                <div class="alert alert-danger mb-4">
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form method="POST" action="{{ route('contact.store') }}" class="booking-panel">
                @csrf
                <div class="row g-4">
                    <div class="col-12">
                        <label for="sessionType">{{ __('site.contact.form.session_type_label') }}</label>
                        <select name="category_id" id="sessionType" class="form-select" required>
                            <option value="" disabled selected>{{ __('site.contact.form.session_type_placeholder') }}</option>
                            @foreach ($categories as $category)
                                <option
                                    value="{{ $category->id }}"
                                    {{ old('category_id') == $category->id ? 'selected' : '' }}
                                    data-template="{{ $category->bookingTemplate() }}"
                                    data-packages="{{ $category->packages->map(fn ($p) => [
                                        'id' => $p->id,
                                        'name' => $tr($p, 'name'),
                                        'price' => $p->formattedPrice(),
                                        'duration' => $p->durationLabel(),
                                        'theme_limit' => (int) $p->theme_limit,
                                        'features' => $p->features->map(fn ($f) => $tr($f, 'description'))->all(),
                                    ])->toJson() }}"
                                    data-themes="{{ $category->themes->map(fn ($t) => ['id' => $t->id, 'name' => $tr($t, 'name'), 'image' => $t->image])->toJson() }}"
                                >
                                    {{ $tr($category, 'title') }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-md-6">
                        <label for="full_name">{{ __('site.contact.form.full_name') }}</label>
                        <input type="text" name="full_name" id="full_name" class="form-control" value="{{ old('full_name') }}" required>
                    </div>
                    <div class="col-md-6">
                        <label for="phone">{{ __('site.contact.form.phone') }}</label>
                        <input type="tel" name="phone" id="phone" class="form-control" value="{{ old('phone') }}" required>
                    </div>

                    {{-- Newborn --}}
                    <div class="col-12 booking-fields row g-4" data-template="newborn" hidden>
                        <div class="col-md-6">
                            <label for="baby_name">{{ __('site.contact.form.baby_name') }}</label>
                            <input type="text" name="details[baby_name]" id="baby_name" class="form-control">
                        </div>
                        <div class="col-md-6">
                            <label for="baby_age">{{ __('site.contact.form.baby_age') }}</label>
                            <input type="text" name="details[baby_age]" id="baby_age" class="form-control" placeholder="{{ __('site.contact.form.baby_age_placeholder') }}">
                        </div>
                        <div class="col-12">
                            <label for="dress_newborn">{{ __('site.contact.form.dress_label') }}</label>
                            <textarea name="details[dress_choice]" id="dress_newborn" class="form-control" rows="2" placeholder="{{ __('site.contact.form.dress_placeholder') }}"></textarea>
                        </div>
                    </div>

                    {{-- Baby & Toddler --}}
                    <div class="col-12 booking-fields row g-4" data-template="baby" hidden>
                        <div class="col-md-6">
                            <label for="child_name_baby">{{ __('site.contact.form.child_name') }}</label>
                            <input type="text" name="details[child_name]" id="child_name_baby" class="form-control">
                        </div>
                        <div class="col-md-6">
                            <label for="child_age_baby">{{ __('site.contact.form.child_age') }}</label>
                            <input type="text" name="details[child_age]" id="child_age_baby" class="form-control">
                        </div>
                        <div class="col-12">
                            <label for="dress_baby">{{ __('site.contact.form.dress_label') }}</label>
                            <textarea name="details[dress_choice]" id="dress_baby" class="form-control" rows="2" placeholder="{{ __('site.contact.form.dress_placeholder') }}"></textarea>
                        </div>
                    </div>

                    {{-- Birthday --}}
                    <div class="col-12 booking-fields row g-4" data-template="birthday" hidden>
                        <div class="col-md-6">
                            <label for="child_name_birthday">{{ __('site.contact.form.child_name') }}</label>
                            <input type="text" name="details[child_name]" id="child_name_birthday" class="form-control">
                        </div>
                        <div class="col-md-6">
                            <label for="turning_age">{{ __('site.contact.form.turning_age') }}</label>
                            <input type="text" name="details[turning_age]" id="turning_age" class="form-control">
                        </div>
                        <div class="col-md-6">
                            <label for="cake_choice">{{ __('site.contact.form.cake_label') }}</label>
                            <select name="details[cake_choice]" id="cake_choice" class="form-select">
                                <option value="none">{{ __('site.contact.form.cake_none') }}</option>
                                <option value="classic">{{ __('site.contact.form.cake_classic') }}</option>
                                <option value="fun">{{ __('site.contact.form.cake_fun') }}</option>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label for="family_shots_count">{{ __('site.contact.form.family_shots_label') }}</label>
                            <input type="number" min="0" name="details[family_shots_count]" id="family_shots_count" class="form-control">
                        </div>
                    </div>

                    {{-- Family --}}
                    <div class="col-12 booking-fields row g-4" data-template="family" hidden>
                        <div class="col-md-6">
                            <label for="family_count">{{ __('site.contact.form.family_count') }}</label>
                            <input type="number" min="1" name="details[family_count]" id="family_count" class="form-control">
                        </div>
                        <div class="col-md-6">
                            <label for="children_ages">{{ __('site.contact.form.children_ages') }}</label>
                            <input type="text" name="details[children_ages]" id="children_ages" class="form-control">
                        </div>
                        <div class="col-12">
                            <label for="outfit_colors">{{ __('site.contact.form.outfit_colors') }}</label>
                            <input type="text" name="details[outfit_colors]" id="outfit_colors" class="form-control">
                            <div class="form-text">{{ __('site.contact.form.outfit_colors_hint') }}</div>
                        </div>
                    </div>

                    {{-- Gender reveal --}}
                    <div class="col-12 booking-fields row g-4" data-template="gender_reveal" hidden>
                        <div class="col-md-4">
                            <label for="reveal_color">{{ __('site.contact.form.reveal_color') }}</label>
                            <select name="details[reveal_color]" id="reveal_color" class="form-select">
                                <option value="pink">{{ __('site.contact.form.reveal_pink') }}</option>
                                <option value="blue">{{ __('site.contact.form.reveal_blue') }}</option>
                                <option value="surprise">{{ __('site.contact.form.reveal_surprise') }}</option>
                            </select>
                        </div>
                        <div class="col-md-4">
                            <label for="guest_count">{{ __('site.contact.form.guest_count') }}</label>
                            <input type="number" min="0" name="details[guest_count]" id="guest_count" class="form-control">
                        </div>
                        <div class="col-md-4">
                            <label for="dress_rental">{{ __('site.contact.form.dress_rental') }}</label>
                            <select name="details[dress_rental]" id="dress_rental" class="form-select">
                                <option value="0">{{ __('site.contact.form.social_no') }}</option>
                                <option value="1">{{ __('site.contact.form.social_yes') }}</option>
                            </select>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <label for="packageSelect">{{ __('site.contact.form.package_label') }}</label>
                        <select
                            name="package_id"
                            id="packageSelect"
                            class="form-select"
                            data-placeholder="{{ __('site.contact.form.package_placeholder') }}"
                            required
                        >
                            <option value="" disabled selected>{{ __('site.contact.form.package_placeholder') }}</option>
                        </select>
                        <div id="packageFeatures" class="mt-2"></div>
                    </div>
                    <div class="col-md-6">
                        <label for="date">{{ __('site.contact.form.date_label') }}</label>
                        <input type="date" name="date" id="date" class="form-control" value="{{ old('date') }}" required>
                    </div>

                    <div class="col-12" id="themeGroup" hidden>
                        <label>{{ __('site.contact.form.theme_label') }}</label>
                        <div class="form-text mb-2" id="themeHint"
                            data-base="{{ __('site.contact.form.theme_hint') }}"
                            data-limit-one="{{ __('site.contact.form.theme_limit_one') }}"
                            data-limit-many="{{ __('site.contact.form.theme_limit_many') }}">{{ __('site.contact.form.theme_hint') }}</div>
                        <div id="themeChoices" class="theme-choice-grid"></div>
                    </div>

                    <div class="col-md-6">
                        <label for="time">{{ __('site.contact.form.time_label') }}</label>
                        <select name="time" id="time" class="form-select" required>
                            <option value="" disabled selected>{{ __('site.contact.form.time_placeholder') }}</option>
                            @foreach ($timeSlots as $time)
                                <option value="{{ $time }}" {{ old('time') === $time ? 'selected' : '' }}>{{ $time }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-md-6">
                        <label class="d-block">{{ __('site.contact.form.social_label') }}</label>
                        <div class="d-flex gap-4 mt-2">
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="share_on_social" id="social_yes" value="1" checked>
                                <label class="form-check-label" for="social_yes">{{ __('site.contact.form.social_yes') }}</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="share_on_social" id="social_no" value="0">
                                <label class="form-check-label" for="social_no">{{ __('site.contact.form.social_no') }}</label>
                            </div>
                        </div>
                    </div>

                    <div class="col-12 pt-3 border-top">
                        <button type="submit" class="btn-gold">
                            {{ __('site.contact.form.submit') }}
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </section>

</x-layout>
