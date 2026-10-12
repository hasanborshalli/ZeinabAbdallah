<section aria-label="{{ __('site.brand_name') }}" class="trust-strip">
    <div class="container-max trust-strip-inner">
        <ul class="trust-stats-list">
            <li class="trust-stat">
                <i class="bi bi-camera"></i>
                <span class="trust-stat-value">{{ __('site.stats.years_value') }}</span>
                <span class="trust-stat-label">{{ __('site.stats.years_label') }}</span>
            </li>
            <li class="trust-stat">
                <i class="bi bi-heart"></i>
                <span class="trust-stat-label">{{ __('site.stats.memories_label') }}</span>
            </li>
            <li class="trust-stat">
                <i class="bi bi-people"></i>
                <span class="trust-stat-value">{{ __('site.stats.love_value') }}</span>
                <span class="trust-stat-label">{{ __('site.stats.love_label') }}</span>
            </li>
        </ul>

        <div class="trust-bottom">
            <x-flourish />
            <div class="trust-bottom-row">
                <span class="trust-bottom-line" aria-hidden="true"></span>
                <p class="trust-bottom-caption">
                    {{ __('site.tagline.script') }}
                    <br>
                    {{ __('site.tagline.caption') }}
                </p>
                <span class="trust-bottom-line" aria-hidden="true"></span>
            </div>
        </div>

        {{ $slot }}
    </div>
</section>
