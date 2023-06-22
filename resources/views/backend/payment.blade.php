@include('backend.layouts.header')
@include('backend.layouts.nav')

<main id="main" class="main">

<div class="pagetitle">
  <h1>Payment History</h1>

</div><!-- End Page Title -->

<section class="section">
  <div class="row">


    <div class="col-lg-12">

      <div class="card">
        <div class="card-body">
          <h5 class="card-title">Payment History</h5>
                @if(session('status'))
                    <div class="alert alert-{{session('status')['type']}}">
                        {{session('status')['text']}}
                    </div>
                @endif
          <!-- Table with stripped rows -->
          <table class="table table-striped">
            <thead>
              <tr>
                <th scope="col">Full Name</th>
                <th scope="col">Phone</th>
                <th scope="col">User Type</th>
                <th scope="col">Payment Proof</th>

                <th scope="col">Action</th>
              </tr>
            </thead>
            <tbody>
            @foreach ( $user as $row )
              <tr>
                <td>{{ $row->first_name }} {{ $row->last_name }}</td>
                <td> {{ $row->phone }}</td>
                <td> {{ $row->user_type }}</td>
  

                <td><a target="_blank" href="{{ asset('uploads/payment/'.$row->payment_picture) }}"><img width="100px" src="{{ asset('uploads/payment/'.$row->payment_picture) }}"></a></td>

                <td><a href="/admin/confirm-payment/{{ $row->user_id }}">Confirm Payment</a></td>
              </tr>
            @endforeach
              
            </tbody>
          </table>
          <!-- End Table with stripped rows -->

<div class="pagination-box text-center mt-50">
  <br>
    <nav aria-label="Page navigation example">
        <ul class="pagination">
            {!! $user->links() !!}
        </ul>
    </nav>
</div>

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