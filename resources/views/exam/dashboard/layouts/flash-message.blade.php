@php
    $flash = null;
    foreach (['success' => 'success', 'error' => 'danger', 'warning' => 'warning', 'info' => 'info'] as $key => $type) {
        if (session()->has($key)) {
            $flash = ['text' => session($key), 'type' => $type];
            break;
        }
    }
@endphp

@if ($flash)
    <div class="mb-6 rounded-md px-4 py-3 text-sm {{ [
        'success' => 'bg-green-50 text-green-700 border border-green-200',
        'danger' => 'bg-red-50 text-red-700 border border-red-200',
        'warning' => 'bg-yellow-50 text-yellow-700 border border-yellow-200',
        'info' => 'bg-step-primary/5 text-step-primary border border-step-primary/20',
    ][$flash['type']] }}">
        {{ $flash['text'] }}
    </div>
@endif

@if ($errors->any())
    <div class="mb-6 rounded-md px-4 py-3 text-sm bg-red-50 text-red-700 border border-red-200">
        Please check the form below for errors.
    </div>
@endif
