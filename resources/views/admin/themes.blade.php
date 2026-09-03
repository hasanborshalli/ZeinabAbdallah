<x-admin.alayout title="Themes">

    <main class="col-md-9 col-lg-10 admin-main">
        <div class="d-flex flex-wrap align-items-center justify-content-between gap-2 mb-4">
            <div>
                <h1 class="admin-page-title h4">Themes</h1>
                <p class="text-muted mb-0">Manage the themes customers can choose from for each category, shown on the
                    catalog page.</p>
            </div>
        </div>

        @if (session('success'))
        <div class="alert alert-success" role="alert">
            {{ session('success') }}
        </div>
        @endif

        @forelse ($categories as $category)
        <x-theme-category-card :category="$category" />
        @empty
        <div class="admin-panel">
            <div class="empty-state">
                <i class="bi bi-collection"></i>
                <p class="mb-0">No categories yet — add one first from Categories & Packages.</p>
            </div>
        </div>
        @endforelse

        <x-modal id="deleteThemeModal" title="Delete Theme" message="This cannot be undone." form-id="deleteThemeForm"
            name-id="deleteThemeName" />
    </main>

</x-admin.alayout>