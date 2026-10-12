@php
$package = $package ?? null;

$field = fn (string $name) => old($name, data_get($package, $name, ''));
$isActive = old('is_active', data_get($package, 'is_active', true));

$existingFeatures = old('features', $package?->features?->mapWithKeys(fn ($feature) => [
    $feature->id => ['description' => $feature->description, 'description_ar' => $feature->description_ar],
])->all() ?: []);
$existingFeatures = $existingFeatures ?: [['description' => '', 'description_ar' => '']];
$nextFeatureIndex = $existingFeatures ? max(array_keys($existingFeatures)) + 1 : 0;
@endphp

<div class="form-section">
    <p class="form-section-title">Package Details</p>

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
            <input type="text" name="name_ar" id="name_ar" class="form-control" dir="rtl"
                value="{{ $field('name_ar') }}" required>
            @error('name_ar')
            <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="col-md-4">
            <label for="price" class="form-label small fw-semibold">Price (USD)</label>
            <div class="input-group">
                <span class="input-group-text">$</span>
                <input type="number" name="price" id="price" class="form-control" step="0.01" min="0"
                    value="{{ $field('price') }}" required>
            </div>
            @error('price')
            <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
        <div class="col-md-4">
            <label for="duration_min_minutes" class="form-label small fw-semibold">Minimum Duration (minutes)</label>
            <input type="number" name="duration_min_minutes" id="duration_min_minutes" class="form-control" min="1"
                value="{{ $field('duration_min_minutes') }}" required>
            @error('duration_min_minutes')
            <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
        <div class="col-md-4">
            <label for="duration_max_minutes" class="form-label small fw-semibold">Maximum Duration (minutes)</label>
            <input type="number" name="duration_max_minutes" id="duration_max_minutes" class="form-control" min="1"
                value="{{ $field('duration_max_minutes') }}" required>
            <div class="form-text">The maximum is what actually blocks the customer's time slot on the calendar.</div>
            @error('duration_max_minutes')
            <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
    </div>
</div>

<div class="form-section">
    <p class="form-section-title">Visibility</p>
    <div class="form-check form-switch">
        <input class="form-check-input" type="checkbox" role="switch" id="is_active" name="is_active" value="1"
            @checked($isActive)>
        <label class="form-check-label" for="is_active">Visible on the public catalog page</label>
    </div>
</div>

<div class="form-section">
    <p class="form-section-title">Features</p>
    <p class="text-muted small mb-3">
        Bullet points shown on this package's card, e.g. "2 themes", "10 edited & printed photos".
    </p>

    <div id="featuresList" class="d-flex flex-column gap-2 mb-3">
        @foreach ($existingFeatures as $i => $feature)
        <div class="feature-row border rounded p-2">
            <div class="row g-2">
                <div class="col-md-6">
                    <input type="text" name="features[{{ $i }}][description]" class="form-control"
                        value="{{ $feature['description'] ?? '' }}" placeholder="Feature (English)">
                </div>
                <div class="col-md-5">
                    <input type="text" name="features[{{ $i }}][description_ar]" class="form-control" dir="rtl"
                        value="{{ $feature['description_ar'] ?? '' }}" placeholder="ميزة (عربي)">
                </div>
                <div class="col-md-1 d-flex">
                    <button type="button" class="btn btn-outline-danger remove-feature-row w-100">
                        <i class="bi bi-trash"></i>
                    </button>
                </div>
            </div>
        </div>
        @endforeach
    </div>

    <button type="button" id="addFeatureRow" class="btn btn-sm btn-outline-secondary"
        data-next-index="{{ $nextFeatureIndex }}">
        <i class="bi bi-plus-lg me-1"></i> Add Feature
    </button>

    <template id="featureRowTemplate">
        <div class="feature-row border rounded p-2">
            <div class="row g-2">
                <div class="col-md-6">
                    <input type="text" name="features[__INDEX__][description]" class="form-control"
                        placeholder="Feature (English)">
                </div>
                <div class="col-md-5">
                    <input type="text" name="features[__INDEX__][description_ar]" class="form-control" dir="rtl"
                        placeholder="ميزة (عربي)">
                </div>
                <div class="col-md-1 d-flex">
                    <button type="button" class="btn btn-outline-danger remove-feature-row w-100">
                        <i class="bi bi-trash"></i>
                    </button>
                </div>
            </div>
        </div>
    </template>

    @error('features')
    <div class="text-danger">{{ $message }}</div>
    @enderror
    @error('features.*.description')
    <div class="text-danger">{{ $message }}</div>
    @enderror
    @error('features.*.description_ar')
    <div class="text-danger">{{ $message }}</div>
    @enderror
</div>
