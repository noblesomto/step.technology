@include('backend.layouts.tailwind.header')
@include('backend.layouts.tailwind.nav', ['active' => 'enrollments'])

<div class="mb-6">
    <h1 class="font-step-heading font-bold text-2xl text-gray-900">New Exam Sitting</h1>
    <nav class="text-sm text-gray-500 mt-1">
        <a href="/admin/index" class="hover:text-step-primary">Home</a>
        <span class="mx-1">/</span>
        <a href="/admin/exam-batches" class="hover:text-step-primary">Exam Sittings</a>
        <span class="mx-1">/</span>
        <span class="text-step-primary">New</span>
    </nav>
</div>

<div class="bg-white rounded-lg border border-gray-200 p-6 sm:p-8 max-w-xl">
    <form action="/admin/exam-batches" method="POST" class="space-y-4">
        @csrf
        @include('backend.exam.batches._form', ['batch' => null])
        <div class="flex items-center gap-3 pt-2">
            <button type="submit" class="bg-step-primary text-white font-step-heading font-semibold px-6 py-2.5 rounded-full hover:bg-step-accent transition-colors">Create Sitting</button>
            <a href="/admin/exam-batches" class="text-sm font-step-heading font-semibold text-gray-500 hover:text-step-primary">Cancel</a>
        </div>
    </form>
</div>

@include('backend.layouts.tailwind.footer')
