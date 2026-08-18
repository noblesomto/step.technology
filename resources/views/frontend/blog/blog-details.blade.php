@include('frontend.layouts.tailwind.header')
@include('frontend.layouts.tailwind.nav')
@include('frontend.layouts.tailwind.page-header', ['pageTitle' => $blog->blog_title, 'breadcrumb' => 'Blog'])

<section class="py-16">
    <div class="max-w-3xl mx-auto px-4">
        <article>
            <div class="relative rounded-lg overflow-hidden mb-8">
                <img src="{{ asset('uploads/blog/'.$blog->blog_picture) }}" alt="{{ $blog->blog_title }}" class="w-full h-80 object-cover">
                <span class="absolute top-4 left-4 bg-step-primary text-white text-xs font-step-heading font-semibold px-3 py-1 rounded-full">{{ $blog->created_at->format('j F') }}</span>
            </div>

            <h1 class="font-step-heading font-bold text-2xl sm:text-3xl text-step-primary mb-2">{{ $blog->blog_title }}</h1>
            <p class="text-sm text-gray-400 mb-6">0 Comments</p>

            <div class="prose prose-sm sm:prose max-w-none text-gray-700">
                {!! $blog->blog_body !!}
            </div>
        </article>

        {{-- Share --}}
        <div class="mt-10 pt-6 border-t border-gray-200 flex items-center justify-between">
            <span class="font-step-heading font-semibold text-gray-700 flex items-center gap-2"><i class="fa fa-share-alt"></i> Share</span>
            <div class="flex gap-3">
                <a href="http://www.facebook.com/sharer.php?u={{ url()->current() }}" target="_blank" class="w-9 h-9 rounded-full bg-gray-100 flex items-center justify-center hover:bg-step-primary hover:text-white transition-colors"><i class="fa fa-facebook-f"></i></a>
                <a href="https://twitter.com/share?url={{ url()->current() }}&text={{ $blog->blog_title }}" target="_blank" class="w-9 h-9 rounded-full bg-gray-100 flex items-center justify-center hover:bg-step-primary hover:text-white transition-colors"><i class="fa fa-twitter"></i></a>
                <a href="http://www.linkedin.com/shareArticle?mini=true&url={{ url()->current() }}" target="_blank" class="w-9 h-9 rounded-full bg-gray-100 flex items-center justify-center hover:bg-step-primary hover:text-white transition-colors"><i class="fa fa-linkedin"></i></a>
                <a href="https://wa.me/?text={{ url()->current() }}" target="_blank" class="w-9 h-9 rounded-full bg-gray-100 flex items-center justify-center hover:bg-step-primary hover:text-white transition-colors"><i class="fa fa-whatsapp"></i></a>
            </div>
        </div>

        @include('frontend.layouts.tailwind.comment-box')
    </div>
</section>

@include('frontend.layouts.tailwind.footer')
