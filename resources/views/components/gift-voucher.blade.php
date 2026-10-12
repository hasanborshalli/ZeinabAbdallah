@php
$whatsappUrl = 'https://wa.me/96170866603';
@endphp

<section id="gift" class="gift-section">
    <div class="container-max gift-inner">
        <div class="gift-icon-row" aria-hidden="true">
            <i class="bi bi-gift"></i>
            <i class="bi bi-heart"></i>
        </div>

        <h2 class="gift-heading">
            {{ __('site.vouchers.heading_pre') }}
            <br>
            <em class="accent-shell">{{ __('site.vouchers.heading_accent') }}</em>
            <i class="bi bi-heart gift-heading-heart" aria-hidden="true"></i>
        </h2>

        <p class="gift-text">{{ __('site.vouchers.text') }}</p>

        <div class="gift-rule" aria-hidden="true">
            <span></span>
            <i class="bi bi-heart"></i>
            <span></span>
        </div>

        <p class="gift-text">{{ __('site.vouchers.text_2') }}</p>

        <div class="gift-actions">
            <a href="{{ $whatsappUrl }}" target="_blank" rel="noopener" class="btn-pill btn-pill-cream">
                <i class="bi bi-chat-dots"></i>
                {{ __('site.vouchers.cta_primary') }}
                <i class="bi bi-arrow-right"></i>
            </a>
            <a href="{{ route('contact') }}" class="btn-pill btn-pill-outline-white">
                {{ __('site.vouchers.cta_secondary') }}
                <i class="bi bi-arrow-right"></i>
            </a>
        </div>

        <p class="gift-script">
            {{ __('site.vouchers.closing_script') }}
            <i class="bi bi-heart"></i>
        </p>
    </div>
</section>
