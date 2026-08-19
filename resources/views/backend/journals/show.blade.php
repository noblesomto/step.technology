@include('backend.layouts.tailwind.header')
@include('backend.layouts.tailwind.nav', ['active' => 'journals'])

<div class="mb-6">
    <h1 class="font-step-heading font-bold text-2xl text-gray-900">Review Journal</h1>
    <nav class="text-sm text-gray-500 mt-1">
        <a href="/admin/index" class="hover:text-step-primary">Home</a>
        <span class="mx-1">/</span>
        <a href="/admin/journals" class="hover:text-step-primary">Journals</a>
        <span class="mx-1">/</span>
        <span class="text-step-primary">{{ Str::limit($journal->title, 40) }}</span>
    </nav>
</div>

@if (session('status'))
    <div class="mb-6 rounded-md px-4 py-3 text-sm {{ session('status')['type'] === 'success' ? 'bg-green-50 text-green-700 border border-green-200' : 'bg-red-50 text-red-700 border border-red-200' }}">
        {{ session('status')['text'] }}
    </div>
@endif

<div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
    <div class="lg:col-span-2 bg-white rounded-lg border border-gray-200 overflow-hidden">
        <img src="{{ asset('uploads/journals/'.$journal->feature_image) }}" alt="{{ $journal->title }}" class="w-full h-64 object-cover">
        <div class="p-6 sm:p-8">
            @if ($journal->category)
                <span class="inline-block bg-step-primary/10 text-step-primary text-xs font-semibold px-2.5 py-1 rounded-full mb-3">{{ $journal->category }}</span>
            @endif
            <h2 class="font-step-heading font-bold text-2xl text-gray-900 mb-2">{{ $journal->title }}</h2>
            <p class="text-sm text-gray-500 mb-6">By {{ $journal->author?->first_name }} {{ $journal->author?->last_name }} &middot; {{ $journal->created_at->format('j M Y') }}</p>

            <p class="text-gray-600 italic border-l-4 border-step-primary/30 pl-4 mb-6">{{ $journal->excerpt }}</p>

            <div class="prose prose-sm sm:prose max-w-none text-gray-700">
                {!! $journal->body !!}
            </div>
        </div>
    </div>

    <div class="space-y-6">
        <div class="bg-white rounded-lg border border-gray-200 p-6">
            <h3 class="font-step-heading font-semibold text-gray-900 mb-4">Status</h3>
            <div class="mb-4">
                @if ($journal->status === 'approved')
                    <span class="inline-block bg-green-50 text-green-700 text-xs font-semibold px-2.5 py-1 rounded-full">Approved</span>
                @elseif ($journal->status === 'rejected')
                    <span class="inline-block bg-red-50 text-red-700 text-xs font-semibold px-2.5 py-1 rounded-full">Rejected</span>
                @else
                    <span class="inline-block bg-yellow-50 text-yellow-700 text-xs font-semibold px-2.5 py-1 rounded-full">Pending Review</span>
                @endif
            </div>

            <form action="/admin/journals/{{ $journal->id }}/status/approved" method="POST" class="mb-3">
                @csrf
                @method('PUT')
                <button type="submit" class="w-full text-sm font-step-heading font-semibold px-4 py-2.5 rounded-full border border-green-200 text-green-700 hover:bg-green-50 transition-colors">
                    <i class="fa fa-check"></i> Approve & Publish
                </button>
            </form>

            <form action="/admin/journals/{{ $journal->id }}/status/rejected" method="POST">
                @csrf
                @method('PUT')
                <div class="mb-3">
                    <label class="block text-xs font-semibold text-gray-500 mb-1.5">Note to author (optional)</label>
                    <textarea name="admin_notes" rows="3" placeholder="Reason for rejection, or requested changes" class="w-full rounded-md border-gray-300 focus:border-step-primary focus:ring-step-primary text-sm px-3 py-2">{{ $journal->admin_notes }}</textarea>
                </div>
                <button type="submit" class="w-full text-sm font-step-heading font-semibold px-4 py-2.5 rounded-full border border-red-200 text-red-700 hover:bg-red-50 transition-colors">
                    <i class="fa fa-times"></i> Reject
                </button>
            </form>

            @if ($journal->status === 'approved')
                <a href="/journal-publication/{{ $journal->id }}/{{ $journal->slug }}" target="_blank" class="block text-center mt-3 text-sm font-step-heading font-semibold text-step-primary hover:text-step-accent">
                    View Live <i class="fa fa-external-link"></i>
                </a>
            @endif
        </div>

        <div class="bg-white rounded-lg border border-gray-200 p-6">
            <h3 class="font-step-heading font-semibold text-gray-900 mb-4">Author</h3>
            <p class="text-sm text-gray-500">Name</p>
            <p class="font-medium text-gray-900 mb-3">{{ $journal->author?->first_name }} {{ $journal->author?->last_name }}</p>
            <p class="text-sm text-gray-500">Email</p>
            <p class="font-medium text-gray-900 mb-3">{{ $journal->author?->email }}</p>
            @if ($journal->author)
                <a href="/admin/users/{{ $journal->author->user_id }}" class="text-sm font-step-heading font-semibold text-step-primary hover:text-step-accent">View User Profile</a>
            @endif
        </div>
    </div>
</div>

@include('backend.layouts.tailwind.footer')
