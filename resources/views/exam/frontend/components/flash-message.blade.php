@php
    $flash = null;
    foreach (['success' => 'success', 'error' => 'danger', 'warning' => 'warning', 'info' => 'info'] as $key => $type) {
        if (Session::has($key)) {
            $flash = ['text' => Session::get($key), 'type' => $type];
            break;
        }
    }
@endphp

@if ($flash)
    <div class="w-full my-2 rounded-lg p-3 text-base {{ [
        'success' => 'bg-green-100 text-green-900',
        'danger' => 'bg-red-100 text-red-900',
        'warning' => 'bg-yellow-100 text-yellow-900',
        'info' => 'bg-blue-100 text-blue-900',
    ][$flash['type']] }}">
        <h4 class="font-semibold text-lg">{{ $flash['text'] }}</h4>
    </div>
@endif

@if ($errors->any())
    <div class="w-full my-2 rounded-lg p-3 text-base bg-red-100 text-red-900">
        <h4 class="font-semibold text-lg">Please check the form below for errors</h4>
    </div>
@endif
