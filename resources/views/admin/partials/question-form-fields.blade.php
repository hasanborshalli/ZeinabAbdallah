@php
    $question = $question ?? null;
    $categories = $categories ?? collect();
    $field = fn (string $name) => old($name, data_get($question, $name, ''));
    $selectedCategoryId = old('category_id', data_get($question, 'category_id', ''));
@endphp

<div class="form-section">
    <p class="form-section-title">Session</p>

    <div class="row g-3">
        <div class="col-md-6">
            <label for="category_id" class="form-label small fw-semibold">Which session is this FAQ for?</label>
            <select name="category_id" id="category_id" class="form-select" required>
                <option value="" disabled {{ $selectedCategoryId === '' ? 'selected' : '' }}>Select a session</option>
                @foreach ($categories as $category)
                    <option value="{{ $category->id }}" @selected((string) $selectedCategoryId === (string) $category->id)>
                        {{ $category->title }}
                    </option>
                @endforeach
            </select>
            <div class="form-text">Each session has its own FAQ list on its session detail page.</div>
            @error('category_id')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
    </div>
</div>

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
