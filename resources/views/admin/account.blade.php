@php
    $user = auth()->user();
@endphp

<x-alayout title="Account">

    <main class="col-md-9 col-lg-10 admin-main">
        <div class="mb-4">
            <h1 class="admin-page-title h4">Account</h1>
            <p class="text-muted mb-0">Manage your admin login details.</p>
        </div>

        @if (session('success'))
            <div class="alert alert-success" role="alert">
                {{ session('success') }}
            </div>
        @endif

        <div class="admin-panel mb-4">
            <p class="form-section-title">Profile Information</p>

            <form method="POST" action="{{ route('admin.account.profile') }}">
                <div class="row g-3">
                    <div class="col-md-6">
                        <label for="name" class="form-label small fw-semibold">Name</label>
                        <input type="text" name="name" id="name" class="form-control" value="{{ old('name', $user->name) }}" required>
                        @error('name')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-6">
                        <label for="email" class="form-label small fw-semibold">Email</label>
                        <input type="email" name="email" id="email" class="form-control" value="{{ old('email', $user->email) }}" required>
                        @error('email')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="mt-4 pt-3 border-top">
                    <button type="submit" class="btn btn-admin-gold">
                        <i class="bi bi-check2 me-1"></i> Save Changes
                    </button>
                </div>
            </form>
        </div>

        <div class="admin-panel">
            <p class="form-section-title">Change Password</p>

            <form method="POST" action="{{ route('admin.account.password') }}">
                <div class="row g-3">
                    <div class="col-md-4">
                        <label for="current_password" class="form-label small fw-semibold">Current Password</label>
                        <input type="password" name="current_password" id="current_password" class="form-control" required>
                        @error('current_password')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-4">
                        <label for="password" class="form-label small fw-semibold">New Password</label>
                        <input type="password" name="password" id="password" class="form-control" required>
                        @error('password')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-4">
                        <label for="password_confirmation" class="form-label small fw-semibold">Confirm New Password</label>
                        <input type="password" name="password_confirmation" id="password_confirmation" class="form-control" required>
                    </div>
                </div>
                <div class="form-text mt-2">At least 8 characters.</div>

                <div class="mt-4 pt-3 border-top">
                    <button type="submit" class="btn btn-admin-gold">
                        <i class="bi bi-key me-1"></i> Update Password
                    </button>
                </div>
            </form>
        </div>
    </main>

</x-alayout>
