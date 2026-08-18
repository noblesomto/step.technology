{{-- Params: $batch (null on create) --}}
@php
    $batch = $batch ?? null;
    $val = fn ($field, $default = '') => old($field, $batch->{$field} ?? $default);
@endphp

<div>
    <label class="block text-sm font-semibold text-gray-700 mb-1.5">Name</label>
    @if ($errors->has('name')) <span class="block text-red-600 text-sm mb-1">{{ $errors->first('name') }}</span> @endif
    <input type="text" name="name" value="{{ $val('name') }}" placeholder="e.g. June 2026 Sitting" required class="w-full h-11 rounded-md border-gray-300 focus:border-step-primary focus:ring-step-primary text-sm px-3">
</div>

<div>
    <label class="block text-sm font-semibold text-gray-700 mb-1.5">Description</label>
    <textarea name="description" rows="2" class="w-full rounded-md border-gray-300 focus:border-step-primary focus:ring-step-primary text-sm px-3 py-2.5">{{ $val('description') }}</textarea>
</div>

<div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
    <div>
        <label class="block text-sm font-semibold text-gray-700 mb-1.5">Starts</label>
        @if ($errors->has('starts_at')) <span class="block text-red-600 text-sm mb-1">{{ $errors->first('starts_at') }}</span> @endif
        <input type="date" name="starts_at" value="{{ $val('starts_at') ? \Illuminate\Support\Carbon::parse($val('starts_at'))->format('Y-m-d') : '' }}" class="w-full h-11 rounded-md border-gray-300 focus:border-step-primary focus:ring-step-primary text-sm px-3">
    </div>
    <div>
        <label class="block text-sm font-semibold text-gray-700 mb-1.5">Ends</label>
        @if ($errors->has('ends_at')) <span class="block text-red-600 text-sm mb-1">{{ $errors->first('ends_at') }}</span> @endif
        <input type="date" name="ends_at" value="{{ $val('ends_at') ? \Illuminate\Support\Carbon::parse($val('ends_at'))->format('Y-m-d') : '' }}" class="w-full h-11 rounded-md border-gray-300 focus:border-step-primary focus:ring-step-primary text-sm px-3">
    </div>
</div>

<label class="flex items-center gap-2 text-sm text-gray-700">
    <input type="checkbox" name="is_active" value="1" @checked($val('is_active', false)) class="rounded border-gray-300 text-step-primary focus:ring-step-primary">
    Make this the open sitting (candidates can take the exam; closes any other open sitting)
</label>
