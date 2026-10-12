@php
    $feedback = $feedback ?? null;
    $field = fn (string $name) => old($name, data_get($feedback, $name, ''));
@endphp

<div class="form-section">
    <p class="form-section-title">Client Name</p>

    <div class="row g-3">
        <div class="col-md-6">
            <label for="name" class="form-label small fw-semibold">Name (English)</label>
            <input type="text" name="name" id="name" class="form-control" value="{{ $field('name') }}" required>
            @error('name')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
        <div class="col-md-6">
            <label for="name_ar" class="form-label small fw-semibold">Name (Arabic)</label>
            <input type="text" name="name_ar" id="name_ar" class="form-control" dir="rtl" value="{{ $field('name_ar') }}" required>
            @error('name_ar')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
    </div>
</div>

<div class="form-section">
    <p class="form-section-title">Feedback</p>

    <div class="row g-3">
        <div class="col-md-6">
            <label for="feedback" class="form-label small fw-semibold">Feedback (English)</label>
            <textarea name="feedback" id="feedback" class="form-control" rows="4" required>{{ $field('feedback') }}</textarea>
            @error('feedback')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
        <div class="col-md-6">
            <label for="feedback_ar" class="form-label small fw-semibold">Feedback (Arabic)</label>
            <textarea name="feedback_ar" id="feedback_ar" class="form-control" dir="rtl" rows="4" required>{{ $field('feedback_ar') }}</textarea>
            @error('feedback_ar')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
    </div>
</div>
