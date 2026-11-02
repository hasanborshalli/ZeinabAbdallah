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

                @if ($orderedThemes->isNotEmpty())
                <div class="bk-field">
                    <span class="bk-label">{{ __('site.session_form.themes_heading') }}</span>
                    <ul class="sf-themes-list">
                        @foreach ($orderedThemes as $theme)
                        <li class="sd-theme-chip">
                            <img src="{{ $theme->image }}" alt="{{ $tr($theme, 'name') }}" loading="lazy" data-lightbox>
                            <span class="sd-theme-chip-name">{{ $tr($theme, 'name') }}</span>
                        </li>
                        @endforeach
                    </ul>
                    {{-- Picked up by initSessionInfoForm() like any other data-label field. --}}
                    <input type="hidden" data-label="{{ __('site.session_form.themes_label') }}"
                        value="{{ $orderedThemes->map(fn ($theme) => $tr($theme, 'name'))->implode(', ') }}">
                </div>
                @endif



                @foreach (config('session_forms.' . $template) as $key => $type)
                @include('main.partials.session-form-field', ['key' => $key, 'type' => $type])
                @endforeach

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