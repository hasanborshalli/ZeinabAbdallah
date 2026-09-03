@php
    $tr = fn ($model, $field) => app()->getLocale() === 'ar' ? $model->{$field . '_ar'} : $model->$field;
@endphp

<x-layout :nav-solid="true" :title="__('site.catalog.eyebrow') . ' — ' . __('site.brand_name')">

    {{-- Page header --}}
    <section class="page-header bg-cream">
        <div class="container-max">
            <div class="section-intro mx-auto">
                <span class="eyebrow">{{ __('site.catalog.eyebrow') }}</span>
                <h1 class="section-heading">{{ __('site.catalog.heading') }}</h1>
                <hr class="divider-gold">
                <p style="color: var(--color-ink-soft);">{{ __('site.catalog.intro') }}</p>
            </div>
        </div>
    </section>

    {{-- Filter / search bar --}}
    <div class="catalog-filter-bar">
        <div class="container-max d-flex flex-wrap gap-3 align-items-center justify-content-between">
            <div class="filter-pills">
                <button type="button" class="filter-pill active" data-filter="all">
                    {{ __('site.catalog.filter_all') }}
                </button>
                @foreach ($categories as $category)
                    <button type="button" class="filter-pill" data-filter="{{ $category->id }}">
                        {{ $tr($category, 'title') }}
                    </button>
                @endforeach
            </div>

            <div class="catalog-search">
                <i class="bi bi-search"></i>
                <input type="text" id="catalogSearch" placeholder="{{ __('site.catalog.search_placeholder') }}">
            </div>
        </div>
    </div>

    <div id="catalogNoResults" class="text-center py-5 d-none">
        <p style="color: var(--color-ink-soft);">{{ __('site.catalog.no_results') }}</p>
    </div>

    {{-- Category sections --}}
    @foreach ($categories as $category)
        <section class="catalog-category section" data-category="{{ $category->id }}" id="cat-{{ $category->id }}">
            <div class="container-max">

                <div class="catalog-category-head">
                    <span class="catalog-category-icon"><i class="bi {{ $category->icon }}"></i></span>
                    <div>
                        <h2 class="section-heading mb-1">{{ $tr($category, 'title') }}</h2>
                        <p class="mb-0" style="color: var(--color-ink-soft);">{{ $tr($category, 'description') }}</p>
                    </div>
                </div>

                @if ($tr($category, 'highlight'))
                    <p class="catalog-extra-line">
                        <i class="bi bi-gift me-1"></i> {{ $tr($category, 'highlight') }}
                    </p>
                @endif

                @if ($category->themes->isNotEmpty())
                    <div class="mb-5">
                        <h6 class="eyebrow mb-3">{{ __('site.catalog.themes_heading') }}</h6>
                        <div class="row g-3">
                            @foreach ($category->themes as $theme)
                                <div class="col-6 col-md-3 col-lg-2">
                                    <div class="theme-chip">
                                        <img src="{{ $theme->image }}" alt="{{ $tr($theme, 'name') }}" loading="lazy">
                                        <span class="theme-chip-name">{{ $tr($theme, 'name') }}</span>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endif

                <div class="row g-4 mb-5">
                    @foreach ($category->packages as $package)
                        <div
                            class="col-md-6 col-lg-4 catalog-package-item"
                            data-search="{{ mb_strtolower($tr($category, 'title') . ' ' . $tr($package, 'name')) }}"
                        >
                            <div class="package-card tier-{{ $loop->index % 3 }}">
                                <span class="package-badge">{{ $tr($package, 'name') }}</span>
                                <div class="package-price">{{ $package->formattedPrice() }}</div>
                                <div class="package-duration"><i class="bi bi-clock"></i>{{ $package->durationLabel() }}</div>
                                <ul class="package-features">
                                    @foreach ($package->features as $feature)
                                        <li><i class="bi bi-check2"></i> {{ $tr($feature, 'description') }}</li>
                                    @endforeach
                                </ul>
                                <a
                                    href="/contact?category={{ $category->id }}&package={{ \Illuminate\Support\Str::slug($package->name) }}"
                                    class="btn-outline-gold justify-content-center"
                                >
                                    {{ __('site.catalog.book_this') }}
                                </a>
                            </div>
                        </div>
                    @endforeach
                </div>

                @if ($category->notes->isNotEmpty())
                    <div class="catalog-notes-box mb-5">
                        <h6>{{ __('site.catalog.notes_heading') }}</h6>
                        <ul>
                            @foreach ($category->notes as $note)
                                <li>{{ $tr($note, 'note') }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                @if ($category->images->isNotEmpty())
                    <div>
                        <h6 class="eyebrow mb-3">{{ __('site.catalog.past_work') }}</h6>
                        <div class="row g-3">
                            @foreach ($category->images as $photo)
                                <div class="col-6 col-md-3">
                                    <div class="catalog-gallery-item">
                                        <img src="{{ $photo->image }}" alt="{{ $tr($category, 'title') }}" loading="lazy">
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endif

            </div>
        </section>
    @endforeach

</x-layout>
