<div class="admin-panel category-card">
    <div class="category-card-head">
        <div class="d-flex align-items-center gap-3">
            <img src="{{ $category->main_image }}" alt="{{ $category->title }}"
                style="width: 46px; height: 46px; object-fit: cover; border-radius: 50%;">
            <div>
                <h5 class="mb-0">{{ $category->title }}</h5>
                <span class="text-muted small" dir="rtl">{{ $category->title_ar }}</span>
            </div>
        </div>
        <div class="d-flex flex-wrap gap-2">
            <a href="{{ route('admin.categories.edit.page', $category) }}" class="btn btn-sm btn-outline-secondary">
                <i class="bi bi-pencil me-1"></i> Edit
            </a>
            <button type="button" class="btn btn-sm btn-outline-danger" data-bs-toggle="modal"
                data-bs-target="#deleteCategoryModal"
                data-delete-url="{{ route('admin.categories.delete', $category) }}"
                data-category-name="{{ $category->title }}">
                <i class="bi bi-trash me-1"></i> Delete
            </button>
            <a type="button" class="btn btn-sm btn-outline-dark"
                href="{{ route('admin.packages.add.page',$category->id) }}">
                <i class="bi bi-plus-lg me-1"></i> Add Package
            </a>
        </div>
    </div>

    <p class="text-muted small mb-3">{{ $category->description }}</p>

    @if ($category->packages->isEmpty())
    <div class="empty-state py-3">
        <i class="bi bi-box-seam"></i>
        <p class="mb-0">No packages yet for this category.</p>
    </div>
    @else
    <div class="table-responsive">
        <table class="table admin-table align-middle mb-0">
            <thead>
                <tr>
                    <th>Package</th>
                    <th>Price</th>
                    <th>Duration</th>
                    <th>Features</th>
                    <th>Status</th>
                    <th class="text-end">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($category->packages as $package)
                <x-package-card :package="$package" />
                @endforeach
            </tbody>
        </table>
    </div>
    @endif
</div>