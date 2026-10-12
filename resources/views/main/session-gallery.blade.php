@php
    $tr = fn ($model, $field) => app()->getLocale() === 'ar' ? $model->{$field . '_ar'} : $model->$field;
    $categoryTitle = $tr($category, 'title');
@endphp

<x-layout :title="$categoryTitle . ' ' . __('site.session_gallery.heading_accent') . ' — ' . __('site.brand_name')">

    <div class="container-max sd-back-wrap">
        <a href="{{ route('sessions.show', $category->slug) }}" class="sd-back-link">
            <i class="bi bi-arrow-left"></i>
            {{ __('site.session_gallery.back_link', ['session' => $categoryTitle]) }}
        </a>
    </div>

    <section class="sg-section">
        <div class="container-max">
            <header class="section-header-center">
                <span class="section-eyebrow">{{ __('site.session_gallery.eyebrow') }}</span>
                <span class="section-rule mx-auto" aria-hidden="true"></span>

                <h1 class="sd-title">
                    {{ __('site.session_gallery.heading_pre', ['session' => $categoryTitle]) }}
                    <em class="accent-taupe">{{ __('site.session_gallery.heading_accent') }}</em>
                </h1>

                <p class="section-intro-text">{{ __('site.session_gallery.intro') }}</p>
            </header>

            @if ($category->images->isNotEmpty())
                <ul class="sg-grid">
                    @foreach ($category->images as $photo)
                        <li class="sg-grid-item">
                            <img src="{{ $photo->image }}" alt="{{ $categoryTitle }}" loading="lazy" data-lightbox>
                        </li>
                    @endforeach
                </ul>
            @else
                <p class="sg-empty">{{ __('site.session_gallery.empty') }}</p>
            @endif
        </div>
    </section>

</x-layout>
