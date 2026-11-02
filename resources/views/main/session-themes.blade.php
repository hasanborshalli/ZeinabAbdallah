@php
    $tr = fn ($model, $field) => app()->getLocale() === 'ar' ? $model->{$field . '_ar'} : $model->$field;
    $categoryTitle = $tr($category, 'title');
@endphp

<x-layout :title="$categoryTitle . ' ' . __('site.session_themes.heading_accent') . ' — ' . __('site.brand_name')">

    <div class="container-max sd-back-wrap">
        <a href="{{ route('sessions.show', $category->slug) }}" class="sd-back-link">
            <i class="bi bi-arrow-left"></i>
            {{ __('site.session_themes.back_link', ['session' => $categoryTitle]) }}
        </a>
    </div>

    <section class="sg-section">
        <div class="container-max">
            <header class="section-header-center">
                <span class="section-eyebrow">{{ __('site.session_themes.eyebrow') }}</span>
                <span class="section-rule mx-auto" aria-hidden="true"></span>

                <h1 class="sd-title">
                    {{ __('site.session_themes.heading_pre', ['session' => $categoryTitle]) }}
                    <em class="accent-taupe">{{ __('site.session_themes.heading_accent') }}</em>
                </h1>

                <p class="section-intro-text">{{ __('site.session_themes.intro') }}</p>
            </header>

            @if ($category->themes->isNotEmpty())
                <ul class="sd-themes-grid">
                    @foreach ($category->themes as $theme)
                        <li class="sd-theme-chip">
                            <img src="{{ $theme->image }}" alt="{{ $tr($theme, 'name') }}" loading="lazy"
                                data-lightbox>
                            <span class="sd-theme-chip-name">{{ $tr($theme, 'name') }}</span>

                            <button type="button" class="sd-theme-add" data-theme-toggle aria-pressed="false"
                                data-url="{{ route('sessions.themes.toggle', [$category->slug, $theme->id]) }}">
                                <span class="sd-theme-add-off">
                                    <i class="bi bi-bag-plus"></i>
                                    {{ __('site.session_themes.add') }}
                                </span>
                                <span class="sd-theme-add-on">
                                    <i class="bi bi-check-lg"></i>
                                    {{ __('site.session_themes.added') }}
                                </span>
                            </button>
                        </li>
                    @endforeach
                </ul>
            @else
                <p class="sg-empty">{{ __('site.session_themes.empty') }}</p>
            @endif
        </div>
    </section>

    @if ($category->themes->isNotEmpty())
        <div class="st-send-wrap">
            <a href="{{ route('sessions.form', $category->slug) }}" class="st-send-bar is-disabled"
                data-themes-send aria-disabled="true">
                <span class="st-send-count" data-themes-count>0</span>
                {{ __('site.session_themes.send') }}
                <i class="bi bi-arrow-right"></i>
            </a>
        </div>
    @endif

</x-layout>
