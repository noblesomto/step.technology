@include('backend.layouts.header')
@include('backend.layouts.nav')

<script src="{{ asset('backend/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('backend/js/jquery.min.js') }}"></script>
<script src="{{ asset('ckeditor/ckeditor.js') }}"></script>
<main id="main" class="main">

    <div class="pagetitle">
    <h1>Event</h1>
  
    </div><!-- End Page Title -->
    
    <section class="section">
    <div class="row">
    <div class="col-lg-12">
    
        <div class="card">
        <div class="card-body">
            <h5 class="card-title">New Event Post</h5>
            @if(session('status'))
                <div class="alert alert-{{session('status')['type']}}">
                    {{session('status')['text']}}
                </div>
            @endif
            <!-- General Form Elements -->
            <form action="/event/new-post" method="POST" role="form" class="" enctype="multipart/form-data">
             @csrf 
    
            <div class="row mb-3">
                <label for="inputText" class="col-sm-2 col-form-label">Title</label>
                <div class="col-sm-10">
                    @if ($errors->has('event_title'))
                        <span class="text-danger">{{ $errors->first('event_title') }}</span>
                    @endif
                <input type="text" name="event_title" class="form-control" placeholder="Event Post Title" value="{{ old('event_title') }}" required>
                </div>
            </div>


            <div class="row mb-3">
                <label for="inputText" class="col-sm-2 col-form-label">Event Date</label>
                <div class="col-sm-10">
                    @if ($errors->has('event_date'))
                        <span class="text-danger">{{ $errors->first('event_date') }}</span>
                    @endif
                <input type="date" name="event_date" class="form-control" placeholder="Event Date" value="{{ old('event_date') }}" required>
                </div>
            </div>

         
            <div class="row mb-3">
                <label for="inputNumber" class="col-sm-2 col-form-label">Featured Image</label>
                <div class="col-sm-10">
                    @if ($errors->has('event_picture'))
                        <span class="text-danger">{{ $errors->first('event_picture') }}</span>
                    @endif
                <input class="form-control" name="event_picture" type="file" id="formFile" required>
                </div>
            </div>




    
            <div class="row mb-3">
                <label for="inputPassword" class="col-sm-2 col-form-label">Event Description</label>
                <div class="col-sm-10">
                    @if ($errors->has('event_body'))
                        <span class="text-danger">{{ $errors->first('event_body') }}</span>
                    @endif
                <textarea class="form-control tinymce-editor" name="event_body" id="tiny" style="height: 100px" required>{{ old('event_body') }}</textarea>
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
                <button type="submit" class="btn btn-primary">Publish Event</button>
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