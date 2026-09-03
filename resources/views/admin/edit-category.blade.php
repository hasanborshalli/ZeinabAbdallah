<x-admin.alayout title="Edit Category">

    <main class="col-md-9 col-lg-10 admin-main">
        <div class="d-flex align-items-center gap-3 mb-4">
            <a href="{{ route('admin.categories.page') }}" class="btn btn-sm btn-light">
                <i class="bi bi-arrow-left"></i>
            </a>
            <div>
                <h1 class="admin-page-title h4 mb-0">Edit Category</h1>
                <p class="text-muted mb-0">{{ $category->title }}</p>
            </div>
        </div>

        <form method="POST" action="{{ route('admin.categories.edit',$category->id) }}" class="admin-panel mb-4"
            enctype="multipart/form-data">


            @include('admin.partials.category-form-fields')

            <div class="d-flex gap-2 mt-4 pt-3 border-top">
                <button type="submit" class="btn btn-admin-gold">
                    <i class="bi bi-check2 me-1"></i> Save Changes
                </button>
                <a href="{{ route('admin.categories.page') }}" class="btn btn-light">Cancel</a>
            </div>
        </form>

        <div class="danger-zone">
            <h5>Danger Zone</h5>
            <p class="text-muted small mb-3">
                Deleting this category also removes its packages and past-work photos from the public catalog. This
                cannot be undone.
            </p>
            <button type="button" class="btn btn-outline-danger" data-bs-toggle="modal"
                data-bs-target="#deleteCategoryModal"
                data-delete-url="{{ route('admin.categories.delete', $category) }}"
                data-category-name="{{ $category->title }}">
                <i class="bi bi-trash me-1"></i> Delete "{{ $category->title }}"
            </button>
        </div>

        <x-modal id="deleteCategoryModal" title="Delete Category"
            message="This also removes its packages, notes, and photos permanently. This cannot be undone."
            form-id="deleteCategoryForm" name-id="deleteCategoryName" />
    </main>

</x-admin.alayout>