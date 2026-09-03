<x-alayout title="Add Question">

    <main class="col-md-9 col-lg-10 admin-main">
        <div class="d-flex align-items-center gap-3 mb-4">
            <a href="{{ route('admin.questions.page') }}" class="btn btn-sm btn-light">
                <i class="bi bi-arrow-left"></i>
            </a>
            <div>
                <h1 class="admin-page-title h4 mb-0">Add Question</h1>
                <p class="text-muted mb-0">Add a new question to the homepage FAQ section.</p>
            </div>
        </div>

        <form method="POST" action="{{ route('admin.questions.add') }}" class="admin-panel">
            @include('admin.partials.question-form-fields')

            <div class="d-flex gap-2 mt-4 pt-3 border-top">
                <button type="submit" class="btn btn-admin-gold">
                    <i class="bi bi-check2 me-1"></i> Add Question
                </button>
                <a href="{{ route('admin.questions.page') }}" class="btn btn-light">Cancel</a>
            </div>
        </form>
    </main>

</x-alayout>
