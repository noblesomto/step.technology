@include('backend.layouts.tailwind.header')
@include('backend.layouts.tailwind.nav', ['active' => 'blog'])

<link rel="stylesheet" href="https://unpkg.com/trix@2.0.8/dist/trix.css">
<link rel="stylesheet" href="{{ asset('backend/css/trix-editor.css') }}">

<div class="mb-6">
    <h1 class="font-step-heading font-bold text-2xl text-gray-900">Edit Blog Post</h1>
</div>

@if (session('status'))
    <div class="mb-6 rounded-md px-4 py-3 text-sm {{ session('status')['type'] === 'success' ? 'bg-green-50 text-green-700 border border-green-200' : 'bg-red-50 text-red-700 border border-red-200' }}">
        {{ session('status')['text'] }}
    </div>
@endif

<div class="bg-white rounded-lg border border-gray-200 p-6 sm:p-8">
    <form action="/blogpost/edit-post/{{ $post->blog_id }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="mb-4">
            <label class="block text-sm font-semibold text-gray-700 mb-1.5">Title</label>
            @if ($errors->has('blog_title'))
                <span class="block text-red-600 text-sm mb-1">{{ $errors->first('blog_title') }}</span>
            @endif
            <input type="text" name="blog_title" placeholder="Blog Post Title" value="{{ $post->blog_title }}" required class="w-full max-w-xl h-11 rounded-md border-gray-300 focus:border-step-primary focus:ring-step-primary text-sm px-3">
        </div>

        <div class="mb-4">
            <label class="block text-sm font-semibold text-gray-700 mb-1.5">Featured Image</label>
            @if ($errors->has('blog_picture'))
                <span class="block text-red-600 text-sm mb-1">{{ $errors->first('blog_picture') }}</span>
            @endif
            <input type="file" name="blog_picture" class="text-sm text-gray-600 file:mr-4 file:py-2.5 file:px-4 file:rounded-md file:border-0 file:bg-step-primary/10 file:text-step-primary file:font-semibold hover:file:bg-step-primary/20">
            <img src="{{ asset('uploads/thumbnails/'.$post->blog_picture) }}" loading="lazy" class="w-36 rounded border border-gray-200 mt-3">
        </div>

        @include('backend.layouts.tailwind.trix-editor', ['name' => 'blog_body', 'label' => 'Blog Body', 'value' => $post->blog_body])

        <button type="submit" class="bg-step-primary text-white font-step-heading font-semibold px-6 py-2.5 rounded-full hover:bg-step-accent transition-colors">Publish</button>
    </form>
</div>

<script src="https://unpkg.com/trix@2.0.8/dist/trix.umd.min.js"></script>
<script src="{{ asset('backend/js/trix-editor.js') }}"></script>

@include('backend.layouts.tailwind.footer')
