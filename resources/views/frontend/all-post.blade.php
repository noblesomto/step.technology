@include('frontend.layouts.header')
@include('frontend.layouts.nav')





<div class="full-row p-7">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 col-md-8">
                <h2 class="mb-4">LATEST POST</h2>
            </div>
            <div class="col-lg-4 col-md-4">
                
            </div>
        </div>
        <div class="row">
            @foreach ( $post as $row )
            <div class="col-lg-3 col-md-6">
                <div class="thumb-blog-simple transation hover-img-zoom mb-3">
                    <div class="post-image category-image overflow-hidden">
                        <a href="/blog/{{ $row->blog_id }}/{{ $row->blog_slug }}">
                        <img src="{{ asset('uploads/thumbnails/'.$row->blog_picture) }}" alt="{{ config('global.site_title') }}">
                        </a>
                    </div>
                    <div class="post-content py-3">
                        <div class="post-meta font-mini text-uppercase list-color-light">
                            <a href="/blog/{{ $row->blog_category }}"><span>{{ $row->blog_category }}</span></a>
                        </div>
                        <h5><a href="/blog/{{ $row->blog_id }}/{{ $row->blog_slug }}" class="transation text-dark hover-text-primary d-block mb-4">{{ $row->blog_title }}</a></h5>
                        <a href="/blog/{{ $row->blog_id }}/{{ $row->blog_slug }}" class="my-2 btn-link text-secondary">Read More</a>
                    </div>
                </div>
            </div>
            @endforeach
          
        </div>
        <div class="row">
            <div class="col-lg-12 mt-3">
                {!! $post->links() !!}
            </div>
        </div>
    </div>
</div>





@include('frontend.layouts.footer')