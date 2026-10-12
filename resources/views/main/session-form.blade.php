@php
    $tr = fn ($model, $field) => app()->getLocale() === 'ar' ? $model->{$field . '_ar'} : $model->$field;
    $whatsappUrl = 'https://wa.me/96170866603';
    $categoryTitle = $tr($category, 'title');
    $template = $category->bookingTemplate();
    $messageIntro = __('site.session_form.message_intro', ['session' => $categoryTitle]);
@endphp

<x-layout :title="$categoryTitle . ' ' . __('site.session_form.heading_accent') . ' — ' . __('site.brand_name')">

    <section class="bk-section">
        <div class="container-max bk-inner">
            <header class="section-header-center">
                <span class="section-eyebrow">{{ __('site.session_form.eyebrow') }}</span>
                <span class="section-rule mx-auto" aria-hidden="true"></span>

                <h1 class="bk-heading">
                    {{ $categoryTitle }}
                    <em class="accent-taupe">{{ __('site.session_form.heading_accent') }}</em>
                </h1>

                <p class="section-intro-text">{{ __('site.session_form.intro') }}</p>
            </header>

            <form id="sessionInfoForm" class="bk-form" data-whatsapp-url="{{ $whatsappUrl }}"
                data-message-intro="{{ $messageIntro }}" novalidate>

                <div class="bk-field">
                    <label for="sf-name" class="bk-label">{{ __('site.session_form.full_name') }}</label>
                    <input id="sf-name" type="text" class="bk-input" required autocomplete="name"
                        data-label="{{ __('site.session_form.full_name') }}">
                </div>

                <div class="bk-field">
                    <label for="sf-phone" class="bk-label">{{ __('site.session_form.phone') }}</label>
                    <input id="sf-phone" type="tel" class="bk-input" required autocomplete="tel"
                        data-label="{{ __('site.session_form.phone') }}">
                </div>

                @if ($template === 'newborn')
                    <div class="bk-field">
                        <label for="sf-baby-name" class="bk-label">{{ __('site.session_form.baby_name') }}</label>
                        <input id="sf-baby-name" type="text" class="bk-input" required
                            data-label="{{ __('site.session_form.baby_name') }}">
                    </div>

                    <div class="bk-field">
                        <label for="sf-baby-age" class="bk-label">{{ __('site.session_form.baby_age') }}</label>
                        <input id="sf-baby-age" type="text" class="bk-input" required
                            placeholder="{{ __('site.session_form.baby_age_placeholder') }}"
                            data-label="{{ __('site.session_form.baby_age') }}">
                    </div>

                    <div class="bk-field">
                        <label for="sf-dress" class="bk-label">{{ __('site.session_form.dress_label') }}</label>
                        <textarea id="sf-dress" class="bk-input bk-textarea" rows="3"
                            placeholder="{{ __('site.session_form.dress_placeholder') }}"
                            data-label="{{ __('site.session_form.dress_label') }}"></textarea>
                    </div>

                    <div class="bk-field">
                        <span class="bk-label">{{ __('site.session_form.social_label') }}</span>
                        <div class="sf-radio-row">
                            <label class="sf-radio">
                                <input type="radio" name="sf-social" value="yes" checked
                                    data-label="{{ __('site.session_form.social_label') }}"
                                    data-value-label="{{ __('site.session_form.social_yes') }}">
                                {{ __('site.session_form.social_yes') }}
                            </label>
                            <label class="sf-radio">
                                <input type="radio" name="sf-social" value="no"
                                    data-label="{{ __('site.session_form.social_label') }}"
                                    data-value-label="{{ __('site.session_form.social_no') }}">
                                {{ __('site.session_form.social_no') }}
                            </label>
                        </div>
                    </div>
                @else
                    <p class="sf-generic-notice">{{ __('site.session_form.generic_notice') }}</p>

                    <div class="bk-field">
                        <label for="sf-notes" class="bk-label">{{ __('site.session_form.generic_notes_label') }}</label>
                        <textarea id="sf-notes" class="bk-input bk-textarea" rows="4"
                            placeholder="{{ __('site.session_form.generic_notes_placeholder') }}"
                            data-label="{{ __('site.session_form.generic_notes_label') }}"></textarea>
                    </div>
                @endif

                <button type="submit" class="bk-submit">
                    <i class="bi bi-chat-dots"></i>
                    {{ __('site.session_form.submit') }}
                    <i class="bi bi-arrow-right"></i>
                </button>

                <p class="bk-status" data-booking-status aria-live="polite"
                    data-default-text="{{ __('site.session_form.status_default') }}"
                    data-sent-text="{{ __('site.session_form.status_sent') }}">
                    {{ __('site.session_form.status_default') }}
                </p>
            </form>
        </div>
    </section>

</x-layout>
