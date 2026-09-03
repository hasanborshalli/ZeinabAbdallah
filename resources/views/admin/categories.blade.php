<x-admin.alayout title="Categories & Packages">

    <main class="col-md-9 col-lg-10 admin-main">
        <div class="d-flex flex-wrap align-items-center justify-content-between gap-2 mb-4">
            <div>
                <h1 class="admin-page-title h4">Categories & Packages</h1>
                <p class="text-muted mb-0">Manage your session categories, their packages, and pricing.</p>
            </div>
            <a href="{{ route('admin.categories.add.page') }}" class="btn btn-admin-gold">
                <i class="bi bi-plus-lg me-1"></i> Add Category
            </a>
        </div>

        @if (session('success'))
        <div class="alert alert-success" role="alert">
            {{ session('success') }}
        </div>
        @endif

        @forelse ($categories as $category)
        <x-category-card :category="$category" />
        @empty <div class="admin-panel">
            <div class="empty-state">
                <i class="bi bi-collection"></i>
                <p class="mb-0">No categories yet — add your first one to get started.</p>
            </div>
        </div>
        @endforelse

        <x-modal id="deleteCategoryModal" title="Delete Category"
            message="This also removes its packages, notes, and photos permanently. This cannot be undone."
            form-id="deleteCategoryForm" name-id="deleteCategoryName" />

        <x-modal id="deletePackageModal" title="Delete Package"
            message="This also removes its features permanently. This cannot be undone." form-id="deletePackageForm"
            name-id="deletePackageName" />
    </main>

</x-admin.alayout>