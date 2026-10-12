@php
$footerLinks = [
['label' => __('site.nav.sessions'), 'href' => route('home') . '#sessions'],
['label' => __('site.nav.gallery'), 'href' => route('gallery')],
['label' => __('site.nav.about'), 'href' => route('about')],
['label' => __('site.nav.contact'), 'href' => route('contact')],
];
@endphp

<footer id="contact" class="site-footer">
    <div class="container-max site-footer-inner">
        <div class="site-footer-top">
            <div class="site-footer-brand-col">
                <x-logo class="site-footer-logo" />

                <p class="site-footer-desc">{{ __('site.footer.description') }}</p>

                <div class="site-footer-social">
                    <a href="https://wa.me/96170866603" target="_blank" rel="noopener" aria-label="WhatsApp">
                        <i class="bi bi-whatsapp"></i>
                    </a>
                    <a href="https://www.instagram.com/youphoto.lb" target="_blank" rel="noopener"
                        aria-label="Instagram">
                        <i class="bi bi-instagram"></i>
                    </a>
                </div>
            </div>

            <div class="site-footer-links-col">
                <nav aria-label="Footer">
                    <h2 class="site-footer-heading">{{ __('site.footer.explore_heading') }}</h2>
                    <ul class="site-footer-list">
                        @foreach ($footerLinks as $link)
                        <li><a href="{{ $link['href'] }}">{{ $link['label'] }}</a></li>
                        @endforeach
                    </ul>
                </nav>

                <div>
                    <h2 class="site-footer-heading">{{ __('site.footer.contact_heading') }}</h2>
                    <ul class="site-footer-contact-list">
                        <li>
                            <i class="bi bi-geo-alt"></i>
                            <span>{{ __('site.footer.address') }}</span>
                        </li>
                        <li>
                            <i class="bi bi-whatsapp"></i>
                            <a href="https://wa.me/96170866603" target="_blank" rel="noopener">
                                {{ __('site.footer.whatsapp_label') }}
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>

        <div class="site-footer-bottom">
            <x-flourish />
            <p class="site-footer-script">{{ __('site.tagline.script') }}</p>
            <p class="site-footer-caption">{{ __('site.tagline.caption') }}</p>
            <p class="site-footer-copyright">
                &copy; {{ now()->year }} {{ __('site.brand_name') }} — {{ __('site.brand_by') }}
            </p>
        </div>
    </div>
</footer>