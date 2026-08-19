@include('dashboard.layouts.tailwind.header')
@include('dashboard.layouts.tailwind.nav', ['active' => 'journals'])

<link rel="stylesheet" href="https://unpkg.com/trix@2.0.8/dist/trix.css">
<link rel="stylesheet" href="{{ asset('backend/css/trix-editor.css') }}">

<div class="mb-6">
    <h1 class="font-step-heading font-bold text-2xl text-gray-900">Submit Journal</h1>
    <nav class="text-sm text-gray-500 mt-1">
        <a href="/user/journals" class="hover:text-step-primary">My Journals</a>
        <span class="mx-1">/</span>
        <span class="text-step-primary">Submit</span>
    </nav>
</div>

<div class="bg-white rounded-lg border border-gray-200 p-6 sm:p-8 max-w-3xl">
    <p class="text-sm text-gray-500 mb-6">Your submission will be reviewed by an admin before it appears in the public Journals &amp; Publications section.</p>

    <form action="/user/journals" method="POST" enctype="multipart/form-data">
        @csrf

        @include('dashboard.journals._form', ['journal' => null])

        <div class="flex items-center gap-3 pt-2">
            <button type="submit" class="bg-step-primary text-white font-step-heading font-semibold px-6 py-2.5 rounded-full hover:bg-step-accent transition-colors">Submit for Review</button>
            <a href="/user/journals" class="text-sm font-step-heading font-semibold text-gray-500 hover:text-step-primary">Cancel</a>
        </div>
    </form>
</div>

<script src="https://unpkg.com/trix@2.0.8/dist/trix.umd.min.js"></script>
<script src="{{ asset('backend/js/trix-editor.js') }}"></script>

@include('dashboard.layouts.tailwind.footer')
