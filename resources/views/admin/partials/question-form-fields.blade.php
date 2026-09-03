@php
    $question = $question ?? null;
    $field = fn (string $name) => old($name, data_get($question, $name, ''));
@endphp

<div class="form-section">
    <p class="form-section-title">Question</p>

    <div class="row g-3">
        <div class="col-md-6">
            <label for="question" class="form-label small fw-semibold">Question (English)</label>
            <input type="text" name="question" id="question" class="form-control" value="{{ $field('question') }}" required>
            @error('question')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
        <div class="col-md-6">
            <label for="question_ar" class="form-label small fw-semibold">Question (Arabic)</label>
            <input type="text" name="question_ar" id="question_ar" class="form-control" dir="rtl" value="{{ $field('question_ar') }}" required>
            @error('question_ar')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
    </div>
</div>

<div class="form-section">
    <p class="form-section-title">Answer</p>

    <div class="row g-3">
        <div class="col-md-6">
            <label for="answer" class="form-label small fw-semibold">Answer (English)</label>
            <textarea name="answer" id="answer" class="form-control" rows="4" required>{{ $field('answer') }}</textarea>
            @error('answer')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
        <div class="col-md-6">
            <label for="answer_ar" class="form-label small fw-semibold">Answer (Arabic)</label>
            <textarea name="answer_ar" id="answer_ar" class="form-control" dir="rtl" rows="4" required>{{ $field('answer_ar') }}</textarea>
            @error('answer_ar')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
    </div>
</div>
