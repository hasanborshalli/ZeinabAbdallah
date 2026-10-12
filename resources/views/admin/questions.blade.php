<x-admin.alayout title="FAQ Questions">

    <main class="col-md-9 col-lg-10 admin-main">
        <div class="d-flex flex-wrap align-items-center justify-content-between gap-2 mb-4">
            <div>
                <h1 class="admin-page-title h4">FAQ Questions</h1>
                <p class="text-muted mb-0">Manage the questions and answers shown on each session's FAQ section.</p>
            </div>
            <a href="{{ route('admin.questions.add.page') }}" class="btn btn-admin-gold">
                <i class="bi bi-plus-lg me-1"></i> Add Question
            </a>
        </div>

        @if (session('success'))
        <div class="alert alert-success" role="alert">
            {{ session('success') }}
        </div>
        @endif

        <div class="admin-panel">
            @forelse ($questions as $question)
            <div
                class="d-flex flex-wrap justify-content-between align-items-start gap-3 py-3 {{ !$loop->last ? 'border-bottom' : '' }}">
                <div class="pe-3" style="max-width: 720px;">
                    <span class="badge text-bg-light border mb-2">
                        <i class="bi bi-collection me-1"></i>
                        {{ $question->category->title ?? 'Unassigned' }}
                    </span>
                    <p class="fw-semibold mb-1">{{ $question->question }}</p>
                    <p class="text-muted small mb-1" dir="rtl">{{ $question->question_ar }}</p>
                    <p class="text-muted small mb-0">{{ \Illuminate\Support\Str::limit($question->answer, 140) }}</p>
                </div>
                <div class="d-flex gap-2 flex-shrink-0">
                    <a href="{{ route('admin.questions.edit.page', $question) }}"
                        class="btn btn-sm btn-outline-secondary">
                        <i class="bi bi-pencil me-1"></i> Edit
                    </a>
                    <button type="button" class="btn btn-sm btn-outline-danger" data-bs-toggle="modal"
                        data-bs-target="#deleteQuestionModal"
                        data-delete-url="{{ route('admin.questions.delete', $question) }}"
                        data-question-name="{{ \Illuminate\Support\Str::limit($question->question, 60) }}">
                        <i class="bi bi-trash me-1"></i> Delete
                    </button>
                </div>
            </div>
            @empty
            <div class="empty-state">
                <i class="bi bi-question-circle"></i>
                <p class="mb-0">No questions yet — add your first FAQ entry to get started.</p>
            </div>
            @endforelse
        </div>

        <x-modal id="deleteQuestionModal" title="Delete Question" message="This cannot be undone."
            form-id="deleteQuestionForm" name-id="deleteQuestionName" />
    </main>

</x-admin.alayout>