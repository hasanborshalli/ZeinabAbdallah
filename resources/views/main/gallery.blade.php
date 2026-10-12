@php
    $tr = fn ($model, $field) => app()->getLocale() === 'ar' ? $model->{$field . '_ar'} : $model->$field;
    $sessionsWithPhotos = $sessions->filter(fn ($category) => $category->pagedImages->total() > 0);
@endphp

<x-layout :title="__('site.gallery.heading_pre') . ' ' . __('site.gallery.heading_accent') . ' — ' . __('site.brand_name')">

    <section class="gp-intro">
        <div class="container-max">
            <header class="section-header-center">
                <span class="section-eyebrow">{{ __('site.gallery.eyebrow') }}</span>
                <span class="section-rule mx-auto" aria-hidden="true"></span>

                <h1 class="sd-title">
                    {{ __('site.gallery.heading_pre') }}
                    <em class="accent-taupe">{{ __('site.gallery.heading_accent') }}</em>
                </h1>

                <p class="section-intro-text">{{ __('site.gallery.intro') }}</p>
            </header>
        </div>
    </section>

    @if ($sessionsWithPhotos->isNotEmpty())
        @foreach ($sessionsWithPhotos as $category)
            <section class="gp-session {{ $loop->last ? 'gp-session-last' : '' }}">
                <div class="container-max">
                    <div class="gp-session-header">
                        <h2 class="gp-session-title">{{ $tr($category, 'title') }}</h2>
                        <a href="{{ route('sessions.show', $category->slug) }}" class="gp-session-link">
                            {{ __('site.gallery.session_link') }}
                            <i class="bi bi-arrow-right"></i>
                        </a>
                    </div>

                    <ul class="sg-grid">
                        @foreach ($category->pagedImages as $photo)
                            <li class="sg-grid-item">
                                <img src="{{ $photo->image }}" alt="{{ $tr($category, 'title') }}" loading="lazy"
                                    data-lightbox>
                            </li>
                        @endforeach
                    </ul>

                    <x-pagination :paginator="$category->pagedImages" />
                </div>
            </section>
        @endforeach
    @else
        <section class="gp-session gp-session-last">
            <div class="container-max">
                <p class="sg-empty">{{ __('site.gallery.empty') }}</p>
            </div>
        </section>
    @endif

</x-layout>
