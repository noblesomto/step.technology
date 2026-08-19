{{-- Params: $journal (null on create) --}}
@php
    $journal = $journal ?? null;
    $val = fn ($field, $default = '') => old($field, $journal->{$field} ?? $default);
    $categories = ['Renewable Energy', 'Oil & Gas', 'Energy Efficiency', 'Technology & Innovation', 'Cybersecurity', 'Digital Transformation', 'Sustainability', 'Research & Development', 'Policy & Regulation', 'Other'];
@endphp

<div class="mb-4">
    <label class="block text-sm font-semibold text-gray-700 mb-1.5">Title</label>
    @if ($errors->has('title')) <span class="block text-red-600 text-sm mb-1">{{ $errors->first('title') }}</span> @endif
    <input type="text" name="title" value="{{ $val('title') }}" placeholder="Journal / publication title" required class="w-full max-w-xl h-11 rounded-md border-gray-300 focus:border-step-primary focus:ring-step-primary text-sm px-3">
</div>

<div class="mb-4 grid grid-cols-1 sm:grid-cols-2 gap-4 max-w-xl">
    <div>
        <label class="block text-sm font-semibold text-gray-700 mb-1.5">Category</label>
        @if ($errors->has('category')) <span class="block text-red-600 text-sm mb-1">{{ $errors->first('category') }}</span> @endif
        <select name="category" class="w-full h-11 rounded-md border-gray-300 focus:border-step-primary focus:ring-step-primary text-sm px-3">
            <option value="">Select Category</option>
            @foreach ($categories as $c)
                <option value="{{ $c }}" @selected($val('category') === $c)>{{ $c }}</option>
            @endforeach
        </select>
    </div>
</div>

<div class="mb-4">
    <label class="block text-sm font-semibold text-gray-700 mb-1.5">Abstract / Excerpt</label>
    @if ($errors->has('excerpt')) <span class="block text-red-600 text-sm mb-1">{{ $errors->first('excerpt') }}</span> @endif
    <textarea name="excerpt" rows="3" maxlength="500" placeholder="A short summary of your journal (max 500 characters) — shown on the listing page" required class="w-full max-w-xl rounded-md border-gray-300 focus:border-step-primary focus:ring-step-primary text-sm px-3 py-2.5">{{ $val('excerpt') }}</textarea>
</div>

<div class="mb-4">
    <label class="block text-sm font-semibold text-gray-700 mb-1.5">Feature Image {{ $journal ? '(leave blank to keep current)' : '' }}</label>
    @if ($errors->has('feature_image')) <span class="block text-red-600 text-sm mb-1">{{ $errors->first('feature_image') }}</span> @endif
    @if ($journal && $journal->feature_image)
        <img src="{{ asset('uploads/thumbnails/'.$journal->feature_image) }}" alt="" class="w-32 h-20 object-cover rounded-md border border-gray-200 mb-2">
    @endif
    <input type="file" name="feature_image" @if (!$journal) required @endif class="text-sm text-gray-600 file:mr-4 file:py-2.5 file:px-4 file:rounded-md file:border-0 file:bg-step-primary/10 file:text-step-primary file:font-semibold hover:file:bg-step-primary/20">
</div>

@include('backend.layouts.tailwind.trix-editor', ['name' => 'body', 'label' => 'Full Content', 'value' => $val('body')])
