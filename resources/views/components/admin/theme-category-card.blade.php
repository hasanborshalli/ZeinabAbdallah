<div class="admin-panel category-card">
    <div class="category-card-head">
        <div class="d-flex align-items-center gap-3">
            <span class="category-icon-badge"><i class="bi {{ $category->icon }}"></i></span>
            <div>
                <h5 class="mb-0">{{ $category->title }}</h5>
                <span class="text-muted small" dir="rtl">{{ $category->title_ar }}</span>
            </div>
        </div>
        <span class="text-muted small">{{ $category->themes->count() }} {{ \Illuminate\Support\Str::plural('theme',
            $category->themes->count()) }}</span>
    </div>

    @if ($category->themes->isEmpty())
    <div class="empty-state py-3 mb-3">
        <i class="bi bi-palette"></i>
        <p class="mb-0">No themes yet for this category.</p>
    </div>
    @else
    <div class="gallery-grid mb-3">
        @foreach ($category->themes as $theme)
        <div class="gallery-thumb">
            <img src="{{ $theme->image }}" alt="{{ $theme->name }}" loading="lazy">
            <span class="theme-thumb-name">{{ $theme->name }}</span>
            <button type="button" class="gallery-thumb-remove" title="Remove theme" data-bs-toggle="modal"
                data-bs-target="#deleteThemeModal" data-delete-url="{{ route('admin.themes.delete', $theme) }}"
                data-theme-name="{{ $theme->name }}">
                <i class="bi bi-trash"></i>
            </button>
        </div>
        @endforeach
    </div>
    @endif

    <form method="POST" action="{{ route('admin.themes.add') }}" enctype="multipart/form-data"
        class="d-flex flex-wrap gap-2 align-items-center">
        <input type="hidden" name="category_id" value="{{ $category->id }}">
        <input type="text" name="name" class="form-control" style="max-width: 200px;" placeholder="Theme name" required>
        <input type="text" name="name_ar" class="form-control" style="max-width: 200px;" placeholder="اسم القالب"
            required>
        <input type="file" name="image" class="form-control" style="max-width: 260px;" accept="image/*" required>
        <button type="submit" class="btn btn-sm btn-admin-gold">
            <i class="bi bi-plus-lg me-1"></i> Add Theme
        </button>
    </form>
</div>