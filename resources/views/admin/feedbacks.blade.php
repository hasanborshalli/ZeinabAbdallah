<x-admin.alayout title="Feedback">

    <main class="col-md-9 col-lg-10 admin-main">
        <div class="d-flex flex-wrap align-items-center justify-content-between gap-2 mb-4">
            <div>
                <h1 class="admin-page-title h4">Feedback</h1>
                <p class="text-muted mb-0">Manage client feedback shown on the homepage.</p>
            </div>
            <a href="{{ route('admin.feedbacks.add.page') }}" class="btn btn-admin-gold">
                <i class="bi bi-plus-lg me-1"></i> Add Feedback
            </a>
        </div>

        @if (session('success'))
        <div class="alert alert-success" role="alert">
            {{ session('success') }}
        </div>
        @endif

        <div class="admin-panel">
            @forelse ($feedbacks as $feedback)
            <div
                class="d-flex flex-wrap justify-content-between align-items-start gap-3 py-3 {{ !$loop->last ? 'border-bottom' : '' }}">
                <div class="pe-3" style="max-width: 720px;">
                    <p class="fw-semibold mb-1">{{ $feedback->name }}</p>
                    <p class="text-muted small mb-1" dir="rtl">{{ $feedback->name_ar }}</p>
                    <p class="text-muted small mb-0">{{ \Illuminate\Support\Str::limit($feedback->feedback, 140) }}</p>
                </div>
                <div class="d-flex gap-2 flex-shrink-0">
                    <a href="{{ route('admin.feedbacks.edit.page', $feedback) }}"
                        class="btn btn-sm btn-outline-secondary">
                        <i class="bi bi-pencil me-1"></i> Edit
                    </a>
                    <button type="button" class="btn btn-sm btn-outline-danger" data-bs-toggle="modal"
                        data-bs-target="#deleteFeedbackModal"
                        data-delete-url="{{ route('admin.feedbacks.delete', $feedback) }}"
                        data-feedback-name="{{ \Illuminate\Support\Str::limit($feedback->name, 60) }}">
                        <i class="bi bi-trash me-1"></i> Delete
                    </button>
                </div>
            </div>
            @empty
            <div class="empty-state">
                <i class="bi bi-chat-quote"></i>
                <p class="mb-0">No feedback yet — add your first client feedback to get started.</p>
            </div>
            @endforelse
        </div>

        <x-modal id="deleteFeedbackModal" title="Delete Feedback" message="This cannot be undone."
            form-id="deleteFeedbackForm" name-id="deleteFeedbackName" />
    </main>

</x-admin.alayout>
