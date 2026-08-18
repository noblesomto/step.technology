{{-- Params: $name (field name), $value (existing HTML content, default ''), $label (default 'Content') --}}
@php
    $value = $value ?? '';
    $label = $label ?? 'Content';
@endphp

<div class="mb-4">
    <label class="block text-sm font-semibold text-gray-700 mb-1.5">{{ $label }}</label>
    @if ($errors->has($name))
        <span class="block text-red-600 text-sm mb-1">{{ $errors->first($name) }}</span>
    @endif

    <div class="custom-toolbar">
        <div class="toolbar-group">
            <button type="button" class="toolbar-btn" data-trix-attribute="bold"><b>B</b></button>
            <button type="button" class="toolbar-btn" data-trix-attribute="italic"><i>I</i></button>
            <button type="button" class="toolbar-btn" data-trix-attribute="strike"><s>S</s></button>
        </div>
        <div class="toolbar-group">
            <button type="button" class="toolbar-btn" data-trix-attribute="heading1">H1</button>
            <button type="button" class="toolbar-btn" data-trix-attribute="quote">&ldquo;&rdquo;</button>
            <button type="button" class="toolbar-btn" data-trix-attribute="code">&lt;/&gt;</button>
        </div>
        <div class="toolbar-group">
            <button type="button" class="toolbar-btn" data-trix-attribute="bullet">&bull; List</button>
            <button type="button" class="toolbar-btn" data-trix-attribute="number">1. List</button>
        </div>
        <div class="toolbar-group">
            <button type="button" class="toolbar-btn" onclick="alignText('text-left')">Left</button>
            <button type="button" class="toolbar-btn" onclick="alignText('text-center')">Center</button>
            <button type="button" class="toolbar-btn" onclick="alignText('text-right')">Right</button>
        </div>
        <div class="toolbar-group">
            <button type="button" class="toolbar-btn" data-trix-action="link">Link</button>
            <button type="button" class="toolbar-btn" onclick="TrixCustom.triggerFileUpload()">Image</button>
        </div>
        <div class="toolbar-group">
            <button type="button" class="toolbar-btn" data-trix-action="undo">Undo</button>
            <button type="button" class="toolbar-btn" data-trix-action="redo">Redo</button>
        </div>
    </div>

    <input id="{{ $name }}" type="hidden" name="{{ $name }}" value="{{ $value }}">
    <trix-editor input="{{ $name }}" class="trix-editor-wrapper block w-full rounded-b-md border border-t-0 border-gray-300 min-h-[240px] px-3 py-2.5"></trix-editor>
</div>
