@include('frontend.layouts.tailwind.header')
@include('frontend.layouts.tailwind.nav')
@include('frontend.layouts.tailwind.page-header', ['pageTitle' => $journal->title, 'breadcrumb' => 'Journals & Publications'])

<section class="py-16">
    <div class="max-w-3xl mx-auto px-4">
        <article>
            <div class="relative rounded-lg overflow-hidden mb-8">
                <img src="{{ asset('uploads/journals/'.$journal->feature_image) }}" alt="{{ $journal->title }}" class="w-full h-80 object-cover">
                @if ($journal->category)
                    <span class="absolute top-4 left-4 bg-step-primary text-white text-xs font-step-heading font-semibold px-3 py-1 rounded-full">{{ $journal->category }}</span>
                @endif
            </div>

            <h1 class="font-step-heading font-bold text-2xl sm:text-3xl text-step-primary mb-2">{{ $journal->title }}</h1>
            <p class="text-sm text-gray-500 mb-6">By {{ $journal->author->first_name ?? '' }} {{ $journal->author->last_name ?? '' }} &middot; {{ $journal->published_at?->format('j F Y') ?? $journal->created_at->format('j F Y') }} &middot; <i class="fa fa-eye"></i> {{ $journal->views }} views</p>

            <p class="text-lg text-gray-600 italic border-l-4 border-step-primary/30 pl-4 mb-8">{{ $journal->excerpt }}</p>

            <div class="prose prose-sm sm:prose max-w-none text-gray-700">
                {!! $journal->body !!}
            </div>
        </article>

        {{-- Share --}}
        <div class="mt-10 pt-6 border-t border-gray-200 flex items-center justify-between">
            <span class="font-step-heading font-semibold text-gray-700 flex items-center gap-2"><i class="fa fa-share-alt"></i> Share</span>
            <div class="flex gap-3">
                <a href="http://www.facebook.com/sharer.php?u={{ url()->current() }}" target="_blank" class="w-9 h-9 rounded-full bg-gray-100 flex items-center justify-center hover:bg-step-primary hover:text-white transition-colors"><i class="fa fa-facebook-f"></i></a>
                <a href="https://twitter.com/share?url={{ url()->current() }}&text={{ $journal->title }}" target="_blank" class="w-9 h-9 rounded-full bg-gray-100 flex items-center justify-center hover:bg-step-primary hover:text-white transition-colors"><i class="fa fa-twitter"></i></a>
                <a href="http://www.linkedin.com/shareArticle?mini=true&url={{ url()->current() }}" target="_blank" class="w-9 h-9 rounded-full bg-gray-100 flex items-center justify-center hover:bg-step-primary hover:text-white transition-colors"><i class="fa fa-linkedin"></i></a>
                <a href="https://wa.me/?text={{ url()->current() }}" target="_blank" class="w-9 h-9 rounded-full bg-gray-100 flex items-center justify-center hover:bg-step-primary hover:text-white transition-colors"><i class="fa fa-whatsapp"></i></a>
            </div>
        </div>

        @if ($recent->isNotEmpty())
            <div class="mt-12 pt-8 border-t border-gray-200">
                <h3 class="font-step-heading font-semibold text-lg text-step-primary mb-6">More Journals</h3>
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                    @foreach ($recent as $row)
                        <a href="/journal-publication/{{ $row->id }}/{{ $row->slug }}" class="group flex items-center gap-4">
                            <img src="{{ asset('uploads/thumbnails/'.$row->feature_image) }}" alt="{{ $row->title }}" class="w-20 h-20 rounded-md object-cover shrink-0">
                            <h4 class="font-step-heading font-semibold text-sm text-gray-900 group-hover:text-step-primary transition-colors">{{ Str::words($row->title, 10) }}</h4>
                        </a>
                    @endforeach
                </div>
            </div>
        @endif
    </div>
</section>

@include('frontend.layouts.tailwind.footer')
