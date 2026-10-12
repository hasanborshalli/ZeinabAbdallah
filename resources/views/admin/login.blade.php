<!doctype html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login · Youphoto</title>
    <link rel="icon" href="/assets/images/zeinab_abdallah_logo.jpg">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,500;0,600;0,700;1,500&family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <link href="/assets/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet" />
    <link href="/assets/css/style.css" rel="stylesheet" />
</head>

<body class="lang-en" style="min-height: 100vh; display: flex; align-items: center; justify-content: center; background-color: var(--color-cream); padding: 1.5rem;">

    <div style="width: 100%; max-width: 400px;">

        <div class="text-center mb-4">
            <img src="/assets/images/zeinab_abdallah_logo.jpg" alt="Youphoto" style="height: 64px; border-radius: 50%; object-fit: cover;">
            <h1 class="font-heading mt-3 mb-1" style="font-size: 1.6rem;">Youphoto</h1>
            <p class="mb-0" style="color: var(--color-muted); font-size: 0.85rem; letter-spacing: 0.08em; text-transform: uppercase;">Admin Login</p>
        </div>

        <div style="background-color: var(--color-white); border: 1px solid var(--color-sand); border-radius: var(--radius); padding: 2rem;">

            @if ($errors->any())
                <div class="alert alert-danger py-2 small mb-3">
                    {{ $errors->first() }}
                </div>
            @endif

            <form method="POST" action="{{ route('login.action') }}">
                @csrf
                <div class="mb-3">
                    <label for="email" class="form-label small fw-semibold">Email</label>
                    <input
                        type="email"
                        name="email"
                        id="email"
                        class="form-control @error('email') is-invalid @enderror"
                        value="{{ old('email') }}"
                        required
                        autofocus
                    >
                </div>

                <div class="mb-3">
                    <label for="password" class="form-label small fw-semibold">Password</label>
                    <input
                        type="password"
                        name="password"
                        id="password"
                        class="form-control @error('password') is-invalid @enderror"
                        required
                    >
                </div>

                <div class="mb-3 form-check">
                    <input type="checkbox" name="remember" id="remember" class="form-check-input">
                    <label for="remember" class="form-check-label small">Remember me</label>
                </div>

                <button type="submit" class="btn-pill btn-pill-solid w-100">
                    Log In
                </button>
            </form>

        </div>

        <div class="text-center mt-4">
            <a href="{{ route('home') }}" class="small" style="color: var(--color-muted);">
                <i class="bi bi-arrow-left me-1"></i> Back to main site
            </a>
        </div>

    </div>

</body>

</html>
