{{--
    One question on the session form, from config/session_forms.php: $type is
    'text', 'textarea', or a list of option keys (radios). Every input carries
    a data-label so initSessionInfoForm() picks it up for the WhatsApp message;
    nothing is preselected, so an unanswered question is simply left out.
--}}
@php
    $label = __('session_forms.fields.' . $key);
    $id = 'sf-' . str_replace('_', '-', $key);
    $placeholder = Lang::has('session_forms.placeholders.' . $key) ? __('session_forms.placeholders.' . $key) : null;
@endphp

@if (str_starts_with($key, 'sharing_'))
    <h2 class="sf-section-title">{{ __('session_forms.sharing_heading') }}</h2>
@endif

<div class="bk-field">
    @if (is_array($type))
        <span class="bk-label">{{ $label }}</span>
        <div class="sf-radio-row {{ count($type) > 2 ? 'sf-radio-stack' : '' }}">
            @foreach ($type as $option)
                <label class="sf-radio">
                    <input type="radio" name="{{ $id }}" value="{{ $option }}" data-label="{{ $label }}"
                        data-value-label="{{ __('session_forms.options.' . $option) }}">
                    {{ __('session_forms.options.' . $option) }}
                </label>
            @endforeach
        </div>

        @if (in_array('other', $type, true))
            <input type="text" class="bk-input sf-other-input"
                placeholder="{{ __('session_forms.options.other') }}: {{ __('session_forms.other_placeholder') }}"
                aria-label="{{ $label }} — {{ __('session_forms.options.other') }}"
                data-label="{{ $label }} ({{ __('session_forms.options.other') }})">
        @endif
    @elseif ($type === 'textarea')
        <label for="{{ $id }}" class="bk-label">{{ $label }}</label>
        <textarea id="{{ $id }}" class="bk-input bk-textarea" rows="3" placeholder="{{ $placeholder }}"
            data-label="{{ $label }}"></textarea>
    @else
        <label for="{{ $id }}" class="bk-label">{{ $label }}</label>
        <input id="{{ $id }}" type="{{ $key === 'phone' ? 'tel' : 'text' }}" class="bk-input"
            placeholder="{{ $placeholder }}" data-label="{{ $label }}"
            @if ($key === 'full_name') autocomplete="name" @elseif ($key === 'phone') autocomplete="tel" @endif>
    @endif
</div>
