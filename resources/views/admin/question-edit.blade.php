<x-admin.alayout title="Edit Question">

    <main class="col-md-9 col-lg-10 admin-main">
        <div class="d-flex align-items-center gap-3 mb-4">
            <a href="{{ route('admin.questions.page') }}" class="btn btn-sm btn-light">
                <i class="bi bi-arrow-left"></i>
            </a>
            <div>
                <h1 class="admin-page-title h4 mb-0">Edit Question</h1>
                <p class="text-muted mb-0">{{ \Illuminate\Support\Str::limit($question->question, 80) }}</p>
            </div>
        </div>

        <form method="POST" action="{{ route('admin.questions.edit', $question) }}" class="admin-panel mb-4">
            @include('admin.partials.question-form-fields')

            <div class="d-flex gap-2 mt-4 pt-3 border-top">
                <button type="submit" class="btn btn-admin-gold">
                    <i class="bi bi-check2 me-1"></i> Save Changes
                </button>
                <a href="{{ route('admin.questions.page') }}" class="btn btn-light">Cancel</a>
            </div>
        </form>

        <div class="danger-zone">
            <h5>Danger Zone</h5>
            <p class="text-muted small mb-3">
                Deleting this question removes it from that session's FAQ section permanently. This cannot be undone.
            </p>
            <button type="button" class="btn btn-outline-danger" data-bs-toggle="modal"
                data-bs-target="#deleteQuestionModal" data-delete-url="{{ route('admin.questions.delete', $question) }}"
                data-question-name="{{ \Illuminate\Support\Str::limit($question->question, 60) }}">
                <i class="bi bi-trash me-1"></i> Delete This Question
            </button>
        </div>

        <x-modal id="deleteQuestionModal" title="Delete Question" message="This cannot be undone."
            form-id="deleteQuestionForm" name-id="deleteQuestionName" />
    </main>

</x-admin.alayout>