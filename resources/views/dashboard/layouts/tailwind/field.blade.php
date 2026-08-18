{{-- Params: $name, $label, $value, $type (default 'text'), $required (default false), $readonly (default false) --}}
@php
    $type = $type ?? 'text';
    $required = $required ?? false;
    $readonly = $readonly ?? false;
@endphp
<div class="mb-4">
    <label class="block text-sm font-semibold text-gray-700 mb-1.5">{{ $label }}</label>
    @if ($errors->has($name))
        <span class="block text-red-600 text-sm mb-1">{{ $errors->first($name) }}</span>
    @endif
    <input
        type="{{ $type }}"
        name="{{ $name }}"
        value="{{ $value }}"
        @if ($required) required @endif
        @if ($readonly) readonly @endif
        class="w-full max-w-md rounded-md border-gray-300 focus:border-step-primary focus:ring-step-primary text-sm px-3 py-2.5 {{ $readonly ? 'bg-gray-100 text-gray-500' : '' }}"
    >
</div>
