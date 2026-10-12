@php
    $whatsappUrl = 'https://wa.me/96170866603';
    $hasContext = filled($sessionName ?? null) && filled($packageName ?? null);
    $messageTemplate = $hasContext
        ? __('site.booking.whatsapp_message_with_context', ['package' => $packageName, 'session' => $sessionName])
        : __('site.booking.whatsapp_message');
@endphp

<x-layout :title="__('site.booking.heading_pre') . ' ' . __('site.booking.heading_accent') . ' — ' . __('site.brand_name')">

    <section class="bk-section">
        <div class="container-max bk-inner">
            <header class="section-header-center">
                <span class="section-eyebrow">{{ __('site.booking.eyebrow') }}</span>
                <span class="section-rule mx-auto" aria-hidden="true"></span>

                <h1 class="bk-heading">
                    {{ __('site.booking.heading_pre') }}
                    <em class="accent-taupe">{{ __('site.booking.heading_accent') }}</em>
                    <i class="bi bi-heart-fill bk-heading-heart" aria-hidden="true"></i>
                </h1>

                <p class="section-intro-text">{{ __('site.booking.intro') }}</p>
            </header>

            @if ($hasContext)
                <div class="bk-context-chip-wrap">
                    <span class="bk-context-chip">
                        {{ __('site.booking.context_label') }}
                        {{ $sessionName }} — {{ $packageName }}
                    </span>
                </div>
            @endif

            <form id="bookingForm" class="bk-form" data-whatsapp-url="{{ $whatsappUrl }}"
                data-message-template="{{ $messageTemplate }}" novalidate>
                <div class="bk-field">
                    <label for="booking-name" class="bk-label">{{ __('site.booking.label_name') }}</label>
                    <input id="booking-name" name="name" type="text" required autocomplete="name"
                        placeholder="{{ __('site.booking.placeholder_name') }}" class="bk-input">
                </div>

                <div class="bk-field">
                    <label for="booking-phone" class="bk-label">{{ __('site.booking.label_phone') }}</label>
                    <input id="booking-phone" name="phone" type="tel" required autocomplete="tel"
                        placeholder="{{ __('site.booking.placeholder_phone') }}" class="bk-input">
                </div>

                <button type="submit" class="bk-submit">
                    <i class="bi bi-chat-dots"></i>
                    {{ __('site.booking.submit') }}
                    <i class="bi bi-arrow-right"></i>
                </button>

                <p class="bk-status" data-booking-status aria-live="polite"
                    data-default-text="{{ __('site.booking.status_default') }}"
                    data-sent-text="{{ __('site.booking.status_sent') }}">
                    {{ __('site.booking.status_default') }}
                </p>
            </form>

            <div class="bk-heart-rule-wrap">
                <div class="sd-heart-rule">
                    <span></span>
                    <i class="bi bi-heart"></i>
                    <span></span>
                </div>
            </div>

            <p class="bk-closing-script">{{ __('site.booking.closing_script') }}</p>
        </div>
    </section>

</x-layout>
