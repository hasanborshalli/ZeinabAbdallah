<x-admin.alayout title="Edit Package">

    <main class="col-md-9 col-lg-10 admin-main">
        <div class="d-flex align-items-center gap-3 mb-4">
            <a href="{{ route('admin.categories.page') }}" class="btn btn-sm btn-light">
                <i class="bi bi-arrow-left"></i>
            </a>
            <div>
                <h1 class="admin-page-title h4 mb-0">Edit Package</h1>
                <p class="text-muted mb-0">{{ $package->category->title }} &middot; {{ $package->name }}</p>
            </div>
        </div>

        <form method="POST" action="{{ route('admin.packages.edit', $package) }}" class="admin-panel mb-4">
            @csrf

            @include('admin.partials.package-form-fields')

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
                Deleting this package removes it and its features permanently. This cannot be undone.
            </p>
            <button type="button" class="btn btn-outline-danger" data-bs-toggle="modal"
                data-bs-target="#deletePackageModal" data-delete-url="{{ route('admin.packages.delete', $package) }}"
                data-package-name="{{ $package->name }}">
                <i class="bi bi-trash me-1"></i> Delete "{{ $package->name }}"
            </button>
        </div>

        <x-modal id="deletePackageModal" title="Delete Package"
            message="This also removes its features permanently. This cannot be undone." form-id="deletePackageForm"
            name-id="deletePackageName" />
    </main>

</x-admin.alayout>