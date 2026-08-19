@include('frontend.layouts.tailwind.header')
@include('frontend.layouts.tailwind.nav')
@include('frontend.layouts.tailwind.page-header', ['pageTitle' => 'Journals & Publications'])

<section class="py-16">
    <div class="max-w-7xl mx-auto px-4">
        <div class="flex flex-col sm:flex-row sm:items-end sm:justify-between gap-4 mb-12">
            <div>
                <h1 class="font-step-heading font-bold text-2xl sm:text-3xl text-step-primary mb-2">STEP Journals & Publications</h1>
                <span class="block w-16 h-1 bg-step-accent"></span>
            </div>
            <a href="/user/journals/create" class="shrink-0 inline-block bg-step-primary text-white font-step-heading font-semibold px-6 py-3 rounded-full hover:bg-step-accent transition-colors">
                Submit Your Journal
            </a>
        </div>

        @if ($journals->isEmpty())
            <p class="italic text-gray-500 text-center py-10">Check back soon, as new journals & publications are coming to STEP.</p>
        @else
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                @foreach ($journals as $row)
                    <a href="/journal-publication/{{ $row->id }}/{{ $row->slug }}" class="group block bg-white rounded-lg overflow-hidden border border-gray-200 hover:shadow-lg transition-shadow">
                        <div class="relative h-48 overflow-hidden">
                            <img src="{{ asset('uploads/thumbnails/'.$row->feature_image) }}" alt="{{ $row->title }}" loading="lazy" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300">
                            @if ($row->category)
                                <span class="absolute top-3 left-3 bg-step-primary text-white text-xs font-step-heading font-semibold px-3 py-1 rounded-full">{{ $row->category }}</span>
                            @endif
                        </div>
                        <div class="p-5">
                            <h3 class="font-step-heading font-semibold text-lg text-gray-900 group-hover:text-step-primary transition-colors">{{ Str::words($row->title, 10) }}</h3>
                            <p class="mt-2 text-sm text-gray-600">{{ Str::words($row->excerpt, 18) }}</p>
                            <div class="mt-4 flex items-center justify-between text-sm">
                                <span class="text-gray-500">By {{ $row->author->first_name ?? '' }} {{ $row->author->last_name ?? '' }}</span>
                                <span class="text-gray-400 flex items-center gap-1"><i class="fa fa-eye"></i> {{ $row->views }}</span>
                            </div>
                        </div>
                    </a>
                @endforeach
            </div>

            <div class="mt-12">
                {{ $journals->links('pagination::tailwind') }}
            </div>
        @endif
    </div>
</section>

@include('frontend.layouts.tailwind.cta-banner')
@include('frontend.layouts.tailwind.footer')
