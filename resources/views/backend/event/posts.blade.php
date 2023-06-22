@include('backend.layouts.header')
@include('backend.layouts.nav')

<main id="main" class="main">

<div class="pagetitle">
  <h1>Event Posts</h1>

</div><!-- End Page Title -->

<section class="section">
  <div class="row">


    <div class="col-lg-12">

      <div class="card">
        <div class="card-body">
          <h5 class="card-title">All Event Post</h5>
          @if(session('status'))
                <div class="alert alert-{{session('status')['type']}}">
                    {{session('status')['text']}}
                </div>
            @endif

          <!-- Table with stripped rows -->
          <div class="table-responsive">
          <table class="table table-striped">
            <thead>
              <tr>
                <th scope="col">Event Title</th>
                <th scope="col">Published Date</th>
                <th scope="col">Action</th>
                <th scope="col">Edit</th>
                <th scope="col">Delete</th>
              </tr>
            </thead>
            <tbody>
            @foreach ( $post as $row )
              <tr>
                <td>{{ $row->event_title }}</td>
                <td>{{ $row->created_at->format('j F Y');  }} </td>
                <td>
                    @if( $row->event_status == 1 )
                        <a href="/event/post-status/{{ $row->event_id }}/0">Unpublish</a>
                    @else
                        <a href="/event/post-status/{{ $row->event_id }}/1">Publish</a>
                    @endif  
                </td>
                <td><a href="/event/edit-post/{{ $row->event_id }}">Edit Post</a></td>
                <td><a href="/event/delete-post/{{ $row->event_id }}" onclick="return confirm('Are you sure you want to delete?');">Delete</a></td>
              </tr>
            @endforeach
              
            </tbody>
          </table>
        </div>
          <!-- End Table with stripped rows -->

        </div>
      </div>

      



    </div>
  </div>
</section>

</main><!-- End #main -->
<script>
function myFunction() {
  confirm("Are you sure you want to delete?");
}
</script>
@include('backend.layouts.footer')