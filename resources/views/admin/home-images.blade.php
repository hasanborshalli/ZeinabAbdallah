<x-admin.alayout title="Home Images">

    <main class="col-md-9 col-lg-10 admin-main">
        <div class="d-flex flex-wrap align-items-center justify-content-between gap-2 mb-4">
            <div>
                <h1 class="admin-page-title h4">Home Images</h1>
                <p class="text-muted mb-0">Manage the photos shown in the "Portfolio" grid on the public home page.</p>
            </div>
            <span class="text-muted small">
                {{ $images->count() }} {{ \Illuminate\Support\Str::plural('image', $images->count()) }}
            </span>
        </div>

        @if (session('success'))
        <div class="alert alert-success" role="alert">
            {{ session('success') }}
        </div>
        @endif

        @if ($errors->any())
        <div class="alert alert-danger" role="alert">
            <ul class="mb-0 ps-3">
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif

        <div class="admin-panel">
            <h5 class="mb-3">Add an image</h5>
            <form method="POST" action="{{ route('admin.homeImage.add') }}" enctype="multipart/form-data"
                class="d-flex flex-wrap gap-3 align-items-center">
                @csrf
                <input type="file" name="image" class="form-control" style="max-width: 320px;" accept="image/*"
                    required>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="tall" value="1" id="tallCheck">
                    <label class="form-check-label" for="tallCheck">Tall (portrait) tile</label>
                </div>
                <button type="submit" class="btn btn-sm btn-admin-gold">
                    <i class="bi bi-upload me-1"></i> Add Image
                </button>
            </form>
            <p class="text-muted small mt-2 mb-0">JPG, PNG, GIF or SVG — max 2&nbsp;MB. Tall tiles span two rows in the
                grid.</p>
        </div>

        <div class="admin-panel">
            <h5 class="mb-3">Current images</h5>

            @if ($images->isEmpty())
            <div class="empty-state">
                <i class="bi bi-images"></i>
                <p class="mb-0">No home images yet — add one above.</p>
            </div>
            @else
            <div class="gallery-grid">
                @foreach ($images as $image)
                <div class="gallery-thumb">
                    <img src="{{ $image->image }}" alt="Home portfolio image" loading="lazy">
                    @if ($image->tall)
                    <span class="theme-thumb-name">Tall</span>
                    @endif
                    <button type="button" class="gallery-thumb-remove" title="Remove image" data-bs-toggle="modal"
                        data-bs-target="#deleteImageModal"
                        data-delete-url="{{ route('admin.homeImage.delete', $image) }}"
                        data-photo-label="this home image">
                        <i class="bi bi-trash"></i>
                    </button>
                </div>
                @endforeach
            </div>
            @endif
        </div>

        <x-modal id="deleteImageModal" title="Delete Home Image" message="This cannot be undone."
            form-id="deleteImageForm" name-id="deleteImageName" />
    </main>

</x-admin.alayout>