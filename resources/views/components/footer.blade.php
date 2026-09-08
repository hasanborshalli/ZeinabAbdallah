<footer class="site-footer">
    <div class="container-max">
        <div class="row gy-4">
            <div class="col-lg-4">
                <span class="footer-brand">{{ __('site.brand_name') }}</span>
                <p class="mb-3">{{ __('site.brand_tagline') }}</p>
                <p class="mb-0">{{ __('site.footer.about') }}</p>
            </div>

            <div class="col-6 col-lg-2">
                <h6>{{ __('site.footer.quick_links') }}</h6>
                <ul>
                    <li><a href="{{ route('home') }}">{{ __('site.nav.home') }}</a></li>
                    <li><a href="/catalog">{{ __('site.nav.catalog') }}</a></li>
                    <li><a href="/faq">{{ __('site.nav.faq') }}</a></li>
                    <li><a href="/contact">{{ __('site.nav.contact') }}</a></li>
                </ul>
            </div>

            <div class="col-6 col-lg-3">
                <h6>{{ __('site.footer.contact') }}</h6>
                <ul>
                    <li>{{ __('site.footer.location') }}</li>
                    <li>
                        <a href="tel:+96170866603" dir="ltr" style="unicode-bidi: isolate; display: inline-block;">
                            +961 70 866 603
                        </a>
                    </li>
                </ul>
            </div>

            <div class="col-lg-3">
                <h6>{{ __('site.footer.follow') }}</h6>
                <div class="footer-social">
                    <a href="https://wa.me/96170866603" target="_blank" rel="noopener" aria-label="WhatsApp">
                        <svg viewBox="0 0 32 32" xmlns="http://www.w3.org/2000/svg" fill="currentColor" aria-hidden="true">
                            <path d="M16.01 3C9.38 3 4 8.35 4 14.94c0 2.34.64 4.52 1.76 6.4L3 29l7.86-2.68a12.9 12.9 0 0 0 5.15 1.06h.01c6.63 0 12.01-5.35 12.01-11.94C28.03 8.85 22.65 3 16.01 3zm5.52 17.44c-.3-.15-1.78-.88-2.06-.98-.28-.1-.48-.15-.68.15-.2.3-.78.98-.96 1.18-.18.2-.35.22-.65.08-.3-.15-1.26-.46-2.4-1.47-.89-.79-1.48-1.76-1.66-2.06-.17-.3-.02-.46.13-.6.14-.14.3-.36.45-.54.15-.18.2-.3.3-.5.1-.2.05-.38-.02-.53-.08-.15-.68-1.62-.93-2.22-.24-.58-.49-.5-.68-.5-.17-.01-.37-.01-.57-.01-.2 0-.53.08-.8.38-.28.3-1.05 1.02-1.05 2.5 0 1.48 1.08 2.9 1.23 3.1.15.2 2.12 3.23 5.13 4.53.72.31 1.28.5 1.72.64.72.23 1.38.2 1.9.12.58-.09 1.78-.73 2.03-1.43.25-.7.25-1.3.17-1.43-.07-.13-.27-.2-.57-.35z"/>
                        </svg>
                    </a>
                    <a href="https://www.instagram.com/youphoto.lb" target="_blank" rel="noopener" aria-label="Instagram">
                        <svg viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" fill="currentColor" aria-hidden="true">
                            <path d="M12 2.2c3.2 0 3.58.01 4.85.07 1.17.05 1.8.24 2.22.41.56.21.96.47 1.38.89.42.42.68.82.89 1.38.17.42.36 1.05.41 2.22.06 1.27.07 1.65.07 4.85s-.01 3.58-.07 4.85c-.05 1.17-.24 1.8-.41 2.22-.21.56-.47.96-.89 1.38-.42.42-.82.68-1.38.89-.42.17-1.05.36-2.22.41-1.27.06-1.65.07-4.85.07s-3.58-.01-4.85-.07c-1.17-.05-1.8-.24-2.22-.41a3.72 3.72 0 0 1-1.38-.89 3.72 3.72 0 0 1-.89-1.38c-.17-.42-.36-1.05-.41-2.22-.06-1.27-.07-1.65-.07-4.85s.01-3.58.07-4.85c.05-1.17.24-1.8.41-2.22.21-.56.47-.96.89-1.38.42-.42.82-.68 1.38-.89.42-.17 1.05-.36 2.22-.41 1.27-.06 1.65-.07 4.85-.07zM12 0C8.74 0 8.33.01 7.05.07c-1.28.06-2.15.26-2.91.56a5.9 5.9 0 0 0-2.14 1.4A5.9 5.9 0 0 0 .6 4.17c-.3.76-.5 1.63-.56 2.91C-.01 8.36 0 8.77 0 12s.01 3.64.07 4.92c.06 1.28.26 2.15.56 2.91.31.79.72 1.46 1.4 2.14.68.68 1.35 1.09 2.14 1.4.76.3 1.63.5 2.91.56C8.33 23.99 8.74 24 12 24s3.64-.01 4.92-.07c1.28-.06 2.15-.26 2.91-.56a5.9 5.9 0 0 0 2.14-1.4 5.9 5.9 0 0 0 1.4-2.14c.3-.76.5-1.63.56-2.91.06-1.28.07-1.69.07-4.92s-.01-3.64-.07-4.92c-.06-1.28-.26-2.15-.56-2.91a5.9 5.9 0 0 0-1.4-2.14 5.9 5.9 0 0 0-2.14-1.4c-.76-.3-1.63-.5-2.91-.56C15.64.01 15.23 0 12 0zm0 5.84A6.16 6.16 0 1 0 18.16 12 6.16 6.16 0 0 0 12 5.84zM12 16a4 4 0 1 1 4-4 4 4 0 0 1-4 4zm6.41-10.85a1.44 1.44 0 1 1-1.44-1.44 1.44 1.44 0 0 1 1.44 1.44z"/>
                        </svg>
                    </a>
                    <a href="https://facebook.com/Youphoto.lb" target="_blank" rel="noopener" aria-label="Facebook">
                        <svg viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" fill="currentColor" aria-hidden="true">
                            <path d="M13.5 22v-9h3l.5-3.5h-3.5V7.4c0-1 .3-1.7 1.8-1.7H17V2.5c-.3 0-1.3-.1-2.5-.1-2.5 0-4.2 1.5-4.2 4.3V9.5H7v3.5h3.3v9h3.2z"/>
                        </svg>
                    </a>
                    <a href="https://tiktok.com/@Youphoto.lb" target="_blank" rel="noopener" aria-label="TikTok">
                        <svg viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" fill="currentColor" aria-hidden="true">
                            <path d="M16.6 5.82c-.9-.99-1.4-2.27-1.4-3.62h-3.05v13.6a2.9 2.9 0 1 1-2.05-2.77V9.9a6 6 0 1 0 5.1 5.94V9.14a8.36 8.36 0 0 0 4.9 1.57V7.63a5.1 5.1 0 0 1-3.5-1.81z"/>
                        </svg>
                    </a>
                </div>
            </div>
        </div>

        <div class="footer-bottom">
            {{ __('site.brand_name') }} &middot; {{ __('site.brand_tagline') }} &middot;
            &copy; {{ now()->year }} {{ __('site.footer.rights') }}
        </div>
    </div>
</footer>
