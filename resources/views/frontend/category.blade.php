@include('frontend.layouts.header')
@include('frontend.layouts.nav')







<div class="full-row py-5">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <h2 class="mb-2">Category: {{ $category }}</h2>
                </div>
                <div class="col-lg-12">
                    <nav aria-label="breadcrumb" class="float-start">
                        <ol class="breadcrumb mb-0 bg-transparent p-0">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item"><a href="#">Category</a></li>
                            <li class="breadcrumb-item active" aria-current="page">{{ $category }}</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>

    <div class="full-row p-0">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-md-8 mb-5">
                    <div class="row">
                        @foreach ( $post as $row )
                        <div class="col-md-12">
                            <div class="thumb-blog-horizontal clearfix hover-img-zoom transation mb-5">
                                <div class="post-image category-page overflow-hidden">
                                    <a href="/blog/{{ $row->blog_id }}/{{ $row->blog_slug }}">
                                    <img src="{{ asset('uploads/thumbnails/'.$row->blog_picture) }}" alt="{{ config('global.site_title') }}">
                                    </a>
                                </div>
                                <div class="post-content ps-3">
                                    <div class="post-meta font-mini text-uppercase list-color-light">
                                        <a href="#"><span>{{ $row->blog_category }}</span></a>
                                    </div>
                                    <h4 class="mb-2"><a href="/blog/{{ $row->blog_id }}/{{ $row->blog_slug }}" class="transation text-dark hover-text-primary d-block">{{ $row->blog_title }}</a></h4>
                                    <p>{!! Str::words($row->blog_body, 30) !!}</p>
                                    <div class="date text-primary font-mini text-uppercase"><span>{{ $row->created_at->format('j F Y');  }}</span></div>
                                </div>
                            </div>
                        </div>
                        @endforeach

                        <div class="col-lg-12 mt-3">
                            {!! $post->links() !!}
                        </div>
                       
                    </div>
                </div>
                <div class="col-lg-4 col-md-4">
                <div id="sidebar" class="sidebar sidebar-blog">
                    <div class="widget search-widget">
                        <form action="/search" method="post">
                            @csrf
                            <input type="text" class="form-control" name="search" placeholder="Search">
                            <button type="submit" name="submit"><i class="flaticon-search flat-mini text-white"></i></button>
                        </form>
                    </div>
                    
                    <div class="widget widget_recent_entries">
                        <h4 class="widget-title down-line">Recent Post</h4>
                        <ul>
                            @foreach ( $recent as $row )
                            <li>
                                <a href="/blog/{{ $row->blog_id }}/{{ $row->blog_slug }}">{{ $row->blog_title }}</a>
                                <span class="post-date">{{ $row->created_at->format('j F Y');  }}</span>
                            </li>
                            @endforeach
                    
                        </ul>
                    </div>
                
               
                </div>
            </div>
            </div>
        </div>
    </div>









@include('frontend.layouts.footer')