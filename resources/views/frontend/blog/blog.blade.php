@include('frontend.layouts.tailwind.header')
@include('frontend.layouts.tailwind.nav')
@include('frontend.layouts.tailwind.page-header', ['pageTitle' => 'Our Blog', 'breadcrumb' => 'Blog'])

<section class="py-16">
    <div class="max-w-7xl mx-auto px-4">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            @foreach ($blog as $row)
                <a href="/blog/{{ $row->blog_id }}/{{ $row->blog_slug }}" class="group block bg-white rounded-lg overflow-hidden border border-gray-200 hover:shadow-lg transition-shadow">
                    <div class="relative h-48 overflow-hidden">
                        <img src="{{ asset('uploads/thumbnails/'.$row->blog_picture) }}" alt="{{ $row->blog_title }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300">
                        <span class="absolute top-3 left-3 bg-step-primary text-white text-xs font-step-heading font-semibold px-3 py-1 rounded-full">{{ $row->created_at->format('j F') }}</span>
                    </div>
                    <div class="p-5">
                        <h3 class="font-step-heading font-semibold text-lg text-gray-900 group-hover:text-step-primary transition-colors">{{ Str::words($row->blog_title, 10) }}</h3>
                        <div class="mt-2 text-sm text-gray-600">{!! Str::words(strip_tags($row->blog_body), 15) !!}</div>
                        <div class="mt-4 flex items-center justify-between text-sm">
                            <span class="text-step-primary font-step-heading font-semibold">Read More</span>
                            <span class="text-gray-400 flex items-center gap-1"><i class="fa fa-eye"></i> {{ $row->blog_views }}</span>
                        </div>
                    </div>
                </a>
            @endforeach
        </div>

        <div class="mt-12">
            {{ $blog->links('pagination::tailwind') }}
        </div>
    </div>
</section>

@include('frontend.layouts.tailwind.footer')
