@php
    $tr = fn ($model, $field) => app()->getLocale() === 'ar' ? $model->{$field . '_ar'} : $model->$field;
@endphp

<x-layout :nav-solid="true" :title="__('site.faq.eyebrow') . ' — ' . __('site.brand_name')">

    {{-- Page header --}}
    <section class="page-header bg-cream">
        <div class="container-max">
            <div class="section-intro mx-auto">
                <span class="eyebrow">{{ __('site.faq.eyebrow') }}</span>
                <h1 class="section-heading">{{ __('site.faq.heading') }}</h1>
                <hr class="divider-gold">
            </div>
        </div>
    </section>

    {{-- FAQ list --}}
    <section class="section">
        <div class="container-max">
            <div class="faq-list mx-auto">
                @foreach ($faqs as $faq)
                    <details class="faq-item">
                        <summary class="faq-question">
                            <span>{{ $tr($faq, 'question') }}</span>
                            <svg class="faq-arrow" width="20" height="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                                <path d="M6 9l6 6 6-6" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                        </summary>
                        <div class="faq-answer">
                            <p>{{ $tr($faq, 'answer') }}</p>
                        </div>
                    </details>
                @endforeach
            </div>

            <div class="faq-help text-center mx-auto">
                <h3 class="section-heading fs-3">{{ __('site.faq.help_heading') }}</h3>
                <p class="fs-5" style="color: var(--color-ink-soft);">{{ __('site.faq.help_text') }}</p>
                <div class="faq-help-actions">
                    <a href="https://wa.me/96170866603" target="_blank" rel="noopener" class="btn-gold">{{ __('site.faq.help_whatsapp') }}</a>
                    <a href="/contact" class="btn-outline-gold">{{ __('site.faq.help_contact') }}</a>
                </div>
            </div>
        </div>
    </section>

</x-layout>
