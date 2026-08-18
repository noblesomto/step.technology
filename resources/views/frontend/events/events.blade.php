@include('frontend.layouts.tailwind.header')
@include('frontend.layouts.tailwind.nav')
@include('frontend.layouts.tailwind.page-header', ['pageTitle' => 'Our Events', 'breadcrumb' => 'Events'])

<section class="py-16">
    <div class="max-w-7xl mx-auto px-4">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            @foreach ($event as $row)
                <a href="/events/{{ $row->event_id }}/{{ $row->event_slug }}" class="group block bg-white rounded-lg overflow-hidden border border-gray-200 hover:shadow-lg transition-shadow">
                    <div class="relative h-48 overflow-hidden">
                        <img src="{{ asset('uploads/thumbnails/'.$row->event_picture) }}" alt="{{ $row->event_title }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300">
                        <span class="absolute top-3 left-3 bg-step-primary text-white text-xs font-step-heading font-semibold px-3 py-1 rounded-full">{{ $row->created_at->format('j F') }}</span>
                    </div>
                    <div class="p-5">
                        <h3 class="font-step-heading font-semibold text-lg text-gray-900 group-hover:text-step-primary transition-colors">{{ Str::words($row->event_title, 10) }}</h3>
                        <div class="mt-2 text-sm text-gray-600">{!! Str::words(strip_tags($row->event_body), 15) !!}</div>
                        <div class="mt-4">
                            <span class="text-step-primary font-step-heading font-semibold text-sm">Read More</span>
                        </div>
                    </div>
                </a>
            @endforeach
        </div>

        <div class="mt-12">
            {{ $event->links('pagination::tailwind') }}
        </div>
    </div>
</section>

@include('frontend.layouts.tailwind.footer')
