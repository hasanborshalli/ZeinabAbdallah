<x-admin.alayout title="Add Feedback">

    <main class="col-md-9 col-lg-10 admin-main">
        <div class="d-flex align-items-center gap-3 mb-4">
            <a href="{{ route('admin.feedbacks.page') }}" class="btn btn-sm btn-light">
                <i class="bi bi-arrow-left"></i>
            </a>
            <div>
                <h1 class="admin-page-title h4 mb-0">Add Feedback</h1>
                <p class="text-muted mb-0">Add a new client feedback to show on the homepage.</p>
            </div>
        </div>

        <form method="POST" action="{{ route('admin.feedbacks.add') }}" class="admin-panel">
            @include('admin.partials.feedback-form-fields')

            <div class="d-flex gap-2 mt-4 pt-3 border-top">
                <button type="submit" class="btn btn-admin-gold">
                    <i class="bi bi-check2 me-1"></i> Add Feedback
                </button>
                <a href="{{ route('admin.feedbacks.page') }}" class="btn btn-light">Cancel</a>
            </div>
        </form>
    </main>

</x-admin.alayout>
