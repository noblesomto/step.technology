@include('backend.layouts.header')
@include('backend.layouts.nav')

<script src="{{ asset('backend/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('backend/js/jquery.min.js') }}"></script>
<script src="{{ asset('ckeditor/ckeditor.js') }}"></script>
<main id="main" class="main">

    <div class="pagetitle">
    <h1>Blog</h1>
  
    </div><!-- End Page Title -->
    
    <section class="section">
    <div class="row">
    <div class="col-lg-12">
    
        <div class="card">
        <div class="card-body">
            <h5 class="card-title">New Blog Post</h5>
            @if(session('status'))
                <div class="alert alert-{{session('status')['type']}}">
                    {{session('status')['text']}}
                </div>
            @endif
            <!-- General Form Elements -->
            <form action="/blog/new-post" method="POST" role="form" class="" enctype="multipart/form-data">
             @csrf 
    
            <div class="row mb-3">
                <label for="inputText" class="col-sm-2 col-form-label">Title</label>
                <div class="col-sm-10">
                    @if ($errors->has('blog_title'))
                        <span class="text-danger">{{ $errors->first('blog_title') }}</span>
                    @endif
                <input type="text" name="blog_title" class="form-control" placeholder="Blog Post Title" value="{{ old('blog_title') }}" required>
                </div>
            </div>

         
            <div class="row mb-3">
                <label for="inputNumber" class="col-sm-2 col-form-label">Featured Image</label>
                <div class="col-sm-10">
                    @if ($errors->has('blog_picture'))
                        <span class="text-danger">{{ $errors->first('blog_picture') }}</span>
                    @endif
                <input class="form-control" name="blog_picture" type="file" id="formFile" required>
                </div>
            </div>




    
            <div class="row mb-3">
                <label for="inputPassword" class="col-sm-2 col-form-label">Blog Body</label>
                <div class="col-sm-10">
                    @if ($errors->has('blog_body'))
                        <span class="text-danger">{{ $errors->first('blog_body') }}</span>
                    @endif
                <textarea class="form-control tinymce-editor" name="blog_body" id="tiny" style="height: 100px" required>{{ old('blog_body') }}</textarea>
                </div>
            </div>
    
            <script type="text/javascript">
                CKEDITOR.replace('tiny', {
                    filebrowserUploadUrl: "{{route('ckeditor.image-upload', ['_token' => csrf_token() ])}}",
                    filebrowserUploadMethod: 'form'
                });
            </script>


    
            <div class="row mb-3">
                <label class="col-sm-2 col-form-label"></label>
                <div class="col-sm-10">
                <button type="submit" class="btn btn-primary">Publish</button>
                </div>
            </div>
    
            </form><!-- End General Form Elements -->
    
        </div>
        </div>
    
    </div>
    
    </div>
    </section>
    
    </main><!-- End #main -->

    @include('backend.layouts.footer')