<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}" dir="{{ app()->getLocale() === 'ar' ? 'rtl' : 'ltr' }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ $title ?? __('site.brand_name') . ' — ' . __('site.brand_tagline') }}</title>

    <link rel="icon" href="/assets/images/zeinab_abdallah_logo.jpg">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400;0,500;0,600;0,700;1,400;1,500;1,600&family=Poppins:wght@200;300;400;500;600;700&family=Parisienne&family=Tajawal:wght@300;400;500;700&display=swap"
        rel="stylesheet">

    @if(app()->getLocale() === 'ar')
        <link href="/assets/dist/css/bootstrap.rtl.min.css" rel="stylesheet" />
    @else
        <link href="/assets/dist/css/bootstrap.min.css" rel="stylesheet" />
    @endif

    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet" />

    <link href="/assets/css/style.css" rel="stylesheet" />

    {{ $head ?? '' }}
</head>

<body class="lang-{{ app()->getLocale() }}">
    <x-navbar />

    <main>
        {{ $slot }}
    </main>

    <x-footer />

    <a
        href="https://wa.me/96170866603"
        target="_blank"
        rel="noopener"
        class="whatsapp-float"
        aria-label="{{ __('site.whatsapp_cta') }}"
        title="{{ __('site.whatsapp_cta') }}"
    >
        <svg viewBox="0 0 32 32" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
            <path d="M16.01 3C9.38 3 4 8.35 4 14.94c0 2.34.64 4.52 1.76 6.4L3 29l7.86-2.68a12.9 12.9 0 0 0 5.15 1.06h.01c6.63 0 12.01-5.35 12.01-11.94C28.03 8.85 22.65 3 16.01 3zm0 21.86h-.01a10.6 10.6 0 0 1-5.42-1.5l-.39-.23-4.66 1.59 1.57-4.56-.25-.4a9.86 9.86 0 0 1-1.53-5.32C5.32 9.5 10.06 4.8 16 4.8c5.94 0 9.83 4.7 9.83 10.14 0 5.44-4.7 9.92-9.82 9.92zm5.52-7.42c-.3-.15-1.78-.88-2.06-.98-.28-.1-.48-.15-.68.15-.2.3-.78.98-.96 1.18-.18.2-.35.22-.65.08-.3-.15-1.26-.46-2.4-1.47-.89-.79-1.48-1.76-1.66-2.06-.17-.3-.02-.46.13-.6.14-.14.3-.36.45-.54.15-.18.2-.3.3-.5.1-.2.05-.38-.02-.53-.08-.15-.68-1.62-.93-2.22-.24-.58-.49-.5-.68-.5-.17-.01-.37-.01-.57-.01-.2 0-.53.08-.8.38-.28.3-1.05 1.02-1.05 2.5 0 1.48 1.08 2.9 1.23 3.1.15.2 2.12 3.23 5.13 4.53.72.31 1.28.5 1.72.64.72.23 1.38.2 1.9.12.58-.09 1.78-.73 2.03-1.43.25-.7.25-1.3.17-1.43-.07-.13-.27-.2-.57-.35z" />
        </svg>
    </a>

    {{-- Shared lightbox — any <img data-lightbox> on the page opens full-size here. --}}
    <div id="lightbox" class="lightbox" hidden>
        <button type="button" class="lightbox-close" data-lightbox-close aria-label="{{ __('site.lightbox_close') }}">
            <i class="bi bi-x-lg"></i>
        </button>
        <img src="" alt="" class="lightbox-img">
    </div>

    <script src="/assets/dist/js/bootstrap.bundle.min.js"></script>
    <script src="/assets/js/main.js"></script>

    {{ $scripts ?? '' }}
</body>

</html>
