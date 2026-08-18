{{-- Params: $pageTitle (string), $breadcrumb (string, defaults to $pageTitle) --}}
@php($breadcrumb = $breadcrumb ?? $pageTitle)

<section class="relative bg-step-primary py-20" style="background-image: linear-gradient(to right, rgba(0,31,102,0.9), rgba(0,31,102,0.7)), url('{{ asset('frontend/img/banner.jpg') }}'); background-size: cover; background-position: center;">
    <div class="max-w-7xl mx-auto px-4">
        <h1 class="font-step-heading font-bold text-3xl sm:text-4xl text-white">{{ $pageTitle }}</h1>
    </div>
</section>

<div class="border-b border-gray-200">
    <div class="max-w-7xl mx-auto px-4 py-4 flex items-center justify-between text-sm">
        <ul class="flex items-center gap-2 text-gray-500">
            <li><a href="/" class="hover:text-step-primary">Home</a></li>
            <li><i class="fa fa-angle-right text-xs"></i></li>
            <li class="text-step-primary font-medium">{{ $breadcrumb }}</li>
        </ul>
        <a href="#" class="text-gray-500 hover:text-step-primary flex items-center gap-1">
            <i class="fa fa-share-alt"></i> Share
        </a>
    </div>
</div>
