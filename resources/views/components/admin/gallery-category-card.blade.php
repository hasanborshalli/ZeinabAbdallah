<div class="admin-panel category-card">
    <div class="category-card-head">
        <div class="d-flex align-items-center gap-3">
            <span class="category-icon-badge"><i class="bi {{ $category->icon }}"></i></span>
            <div>
                <h5 class="mb-0">{{ $category->title }}</h5>
                <span class="text-muted small" dir="rtl">{{ $category->title_ar }}</span>
            </div>
        </div>
        <span class="text-muted small">{{ count($category->images) }} {{
            \Illuminate\Support\Str::plural('photo',
            count($category->images)) }}</span>
    </div>

    @if (empty($category->images))
    <div class="empty-state py-3 mb-3">
        <i class="bi bi-images"></i>
        <p class="mb-0">No past-work photos yet for this category.</p>
    </div>
    @else
    <div class="gallery-grid mb-3">
        @foreach ($category->images as $photo)
        <div class="gallery-thumb">
            <img src="{{ $photo->image }}" alt="{{ $category->title }}" loading="lazy">
            <button
                type="button"
                class="gallery-thumb-remove"
                title="Remove photo"
                data-bs-toggle="modal"
                data-bs-target="#deleteImageModal"
                data-delete-url="{{ route('admin.images.delete', $photo) }}"
                data-photo-label="this photo"
            >
                <i class="bi bi-trash"></i>
            </button>
        </div>
        @endforeach
    </div>
    @endif

    <form method="POST" action="{{ route('admin.images.add',$category->id) }}" enctype="multipart/form-data"
        class="d-flex flex-wrap gap-2 align-items-center">
        <input type="file" name="image" class="form-control" style="max-width: 320px;" multiple accept="image/*">
        <button type="submit" class="btn btn-sm btn-admin-gold">
            <i class="bi bi-upload me-1"></i> Add Photo
        </button>
    </form>
</div>