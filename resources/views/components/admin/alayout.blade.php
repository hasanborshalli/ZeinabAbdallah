<!doctype html>
<html lang="en" data-bs-theme="light">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="description" content="Youphoto admin panel" />
    <title>{{ $title ?? 'Admin Dashboard' }} · Youphoto</title>
    <link rel="icon" href="/assets/images/zeinab_abdallah_logo.jpg">
    <link href="/assets/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet" />
    <meta name="theme-color" content="#af8656" />
    <link href="/assets/css/dashboard.css" rel="stylesheet" />
</head>

<body>

    <x-admin.admin-navbar />

    <div class="container-fluid">
        <div class="row">
            <x-admin.admin-sidebar />

            {{ $slot }}
        </div>
    </div>

    <script src="/assets/dist/js/bootstrap.bundle.min.js"></script>
    <script src="/assets/js/admin.js"></script>

    {{ $scripts ?? '' }}
</body>

</html>