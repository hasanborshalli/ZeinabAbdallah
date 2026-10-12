@php
$category = $category ?? null;

$field = fn (string $name) => old($name, data_get($category, $name, ''));

$existingNotes = old('notes', $category?->notes?->mapWithKeys(fn ($note) => [
$note->id => ['note' => $note->note, 'note_ar' => $note->note_ar],
])->all() ?: []);
$existingNotes = $existingNotes ?: [['note' => '', 'note_ar' => '']];
$nextNoteIndex = $existingNotes ? max(array_keys($existingNotes)) + 1 : 0;
@endphp

<div class="form-section">
    <p class="form-section-title">Category Details</p>

    <div class="row g-3">
        <div class="col-md-6">
            <label for="title" class="form-label small fw-semibold">Title (English)</label>
            <input type="text" name="title" id="title" class="form-control" value="{{ $field('title') }}" required>
            @error('title')
            <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
        <div class="col-md-6">
            <label for="title_ar" class="form-label small fw-semibold">Title (Arabic)</label>
            <input type="text" name="title_ar" id="title_ar" class="form-control" dir="rtl"
                value="{{ $field('title_ar') }}">
            @error('title_ar')
            <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="col-md-12">
            <label for="slug" class="form-label small fw-semibold">URL Slug</label>
            <input type="text" name="slug" id="slug" class="form-control" value="{{ $field('slug') }}" required>
            <div class="form-text">e.g.
                youphoto.lb/sessions/<strong>newborn-sessions</strong>. Lowercase letters, numbers, and hyphens
                only</div>
            @error('slug')
            <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="col-md-6">
            <label for="small_description" class="form-label small fw-semibold">Short Caption (English)</label>
            <input type="text" name="small_description" id="small_description" class="form-control"
                value="{{ $field('small_description') }}">
            <div class="form-text">Short tagline shown under the title on the homepage session card, e.g. "The
                beginning of a beautiful story".</div>
            @error('small_description')
            <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
        <div class="col-md-6">
            <label for="small_description_ar" class="form-label small fw-semibold">Short Caption (Arabic)</label>
            <input type="text" name="small_description_ar" id="small_description_ar" class="form-control" dir="rtl"
                value="{{ $field('small_description_ar') }}">
            @error('small_description_ar')
            <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="col-md-6">
            <label for="description" class="form-label small fw-semibold">Description (English)</label>
            <textarea name="description" id="description" class="form-control"
                rows="3">{{ $field('description') }}</textarea>
            @error('description')
            <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
        <div class="col-md-6">
            <label for="description_ar" class="form-label small fw-semibold">Description (Arabic)</label>
            <textarea name="description_ar" id="description_ar" class="form-control" dir="rtl"
                rows="3">{{ $field('description_ar') }}</textarea>
            @error('description_ar')
            <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="col-md-6">
            <label for="highlight" class="form-label small fw-semibold">Highlight Line (English)</label>
            <input type="text" name="highlight" id="highlight" class="form-control" value="{{ $field('highlight') }}">
            <div class="form-text">Short highlighted note under the header, e.g. "Reel included for an extra $50".</div>
            @error('highlight')
            <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
        <div class="col-md-6">
            <label for="highlight_ar" class="form-label small fw-semibold">Highlight Line (Arabic)</label>
            <input type="text" name="highlight_ar" id="highlight_ar" class="form-control" dir="rtl"
                value="{{ $field('highlight_ar') }}">
            @error('highlight_ar')
            <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="col-md-12">
            <div class="form-check">
                <input type="checkbox" name="gift" id="gift" class="form-check-input" value="1"
                    {{ old('gift', data_get($category, 'gift', false)) ? 'checked' : '' }}>
                <label for="gift" class="form-check-label small fw-semibold">Show Gift Voucher Section</label>
            </div>
            <div class="form-text">When enabled, the gift voucher section is shown on this session's page.</div>
            @error('gift')
            <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
    </div>
</div>

<div class="form-section">
    <p class="form-section-title">Main Image</p>

    @if (!empty($category['main_image']))
    <div class="mb-3">
        <img src="{{ $category['main_image'] }}" alt=""
            style="width: 120px; height: 120px; object-fit: cover; border-radius: 8px;">
    </div>
    @endif

    <input type="file" name="main_image" class="form-control" accept="image/*">
    <div class="form-text">The featured image used for this category's card on the homepage and catalog page.</div>
    <div class="form-text">
        <strong>Recommended size: 1600 × 900px (16:9, landscape).</strong>
        This card is shown wide and cropped to fill its box, so keep the main subject centered — it gets
        cropped tighter on mobile than on desktop.
    </div>
    @error('main_image')
    <div class="text-danger">{{ $message }}</div>
    @enderror
</div>

<div class="form-section">
    <p class="form-section-title">Notes</p>
    <p class="text-muted small mb-3">
        Short policy notes shown to customers under this category on the catalog page
        (e.g. payment terms, age requirements, editing turnaround).
    </p>

    <div id="notesList" class="d-flex flex-column gap-2 mb-3">
        @foreach ($existingNotes as $i => $note)
        <div class="notes-row border rounded p-2">
            <div class="row g-2">
                <div class="col-md-6">
                    <input type="text" name="notes[{{ $i }}][note]" class="form-control"
                        value="{{ $note['note'] ?? '' }}" placeholder="Note (English)">
                </div>
                <div class="col-md-5">
                    <input type="text" name="notes[{{ $i }}][note_ar]" class="form-control" dir="rtl"
                        value="{{ $note['note_ar'] ?? '' }}" placeholder="ملاحظة (عربي)">
                </div>
                <div class="col-md-1 d-flex">
                    <button type="button" class="btn btn-outline-danger remove-note-row w-100">
                        <i class="bi bi-trash"></i>
                    </button>
                </div>
            </div>
        </div>
        @endforeach
    </div>

    <button type="button" id="addNoteRow" class="btn btn-sm btn-outline-secondary"
        data-next-index="{{ $nextNoteIndex }}">
        <i class="bi bi-plus-lg me-1"></i> Add Note
    </button>

    <template id="noteRowTemplate">
        <div class="notes-row border rounded p-2">
            <div class="row g-2">
                <div class="col-md-6">
                    <input type="text" name="notes[__INDEX__][note]" class="form-control" placeholder="Note (English)">
                </div>
                <div class="col-md-5">
                    <input type="text" name="notes[__INDEX__][note_ar]" class="form-control" dir="rtl"
                        placeholder="ملاحظة (عربي)">
                </div>
                <div class="col-md-1 d-flex">
                    <button type="button" class="btn btn-outline-danger remove-note-row w-100">
                        <i class="bi bi-trash"></i>
                    </button>
                </div>
            </div>
        </div>
    </template>

    @error('notes')
    <div class="text-danger">{{ $message }}</div>
    @enderror
    @error('notes.*.note')
    <div class="text-danger">{{ $message }}</div>
    @enderror
</div>