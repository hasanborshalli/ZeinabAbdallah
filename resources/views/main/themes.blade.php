@php
    $tr = fn ($model, $field) => app()->getLocale() === 'ar' ? $model->{$field . '_ar'} : $model->$field;
    $sessionsWithThemes = $sessions->filter(fn ($category) => $category->pagedThemes->total() > 0);
@endphp

<x-layout :title="__('site.themes_page.heading_pre') . ' ' . __('site.themes_page.heading_accent') . ' — ' . __('site.brand_name')">

    <section class="gp-intro">
        <div class="container-max">
            <header class="section-header-center">
                <span class="section-eyebrow">{{ __('site.themes_page.eyebrow') }}</span>
                <span class="section-rule mx-auto" aria-hidden="true"></span>

                <h1 class="sd-title">
                    {{ __('site.themes_page.heading_pre') }}
                    <em class="accent-taupe">{{ __('site.themes_page.heading_accent') }}</em>
                </h1>

                <p class="section-intro-text">{{ __('site.themes_page.intro') }}</p>
            </header>
        </div>
    </section>

    @if ($sessionsWithThemes->isNotEmpty())
        @foreach ($sessionsWithThemes as $category)
            <section class="gp-session {{ $loop->last ? 'gp-session-last' : '' }}">
                <div class="container-max">
                    <div class="gp-session-header">
                        <h2 class="gp-session-title">{{ $tr($category, 'title') }}</h2>
                        <a href="{{ route('sessions.show', $category->slug) }}" class="gp-session-link">
                            {{ __('site.themes_page.session_link') }}
                            <i class="bi bi-arrow-right"></i>
                        </a>
                    </div>

                    <ul class="sd-themes-grid">
                        @foreach ($category->pagedThemes as $theme)
                            <li class="sd-theme-chip">
                                <img src="{{ $theme->image }}" alt="{{ $tr($theme, 'name') }}" loading="lazy"
                                    data-lightbox>
                                <span class="sd-theme-chip-name">{{ $tr($theme, 'name') }}</span>
                            </li>
                        @endforeach
                    </ul>

                    <x-pagination :paginator="$category->pagedThemes" />
                </div>
            </section>
        @endforeach
    @else
        <section class="gp-session gp-session-last">
            <div class="container-max">
                <p class="sg-empty">{{ __('site.themes_page.empty') }}</p>
            </div>
        </section>
    @endif

</x-layout>
