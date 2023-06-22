@include('backend.layouts.header')
@include('backend.layouts.nav')

<main id="main" class="main">

<div class="pagetitle">
  <h1>Users</h1>

</div><!-- End Page Title -->

<section class="section">
  <div class="row">


    <div class="col-lg-12">

      <div class="card">
        <div class="card-body">
          <h5 class="card-title">User Details</h5>
                @if(session('status'))
                    <div class="alert alert-{{session('status')['type']}}">
                        {{session('status')['text']}}
                    </div>
                @endif



            <div><hr></div>
            <div class="row mt-30">
            
              <p><strong>Name: </strong> {{ $user->first_name }} {{ $user->last_name }}</p>
              <p><strong>Email: </strong> {{ $user->email }} </p>
              <p><strong>Phone: </strong> {{ $user->phone }} </p>
              <p><strong>Address: </strong> {{ $user->address }} </p>
              <p><strong>City: </strong> {{ $user->city }} </p>
              <p><strong>State: </strong> {{ $user->state }} </p>
              <p><strong>Balance: </strong> N{{ number_format($user->balance, 2, '.', ',') }} </p>

              @if($user->acc_status =="0" )
              <p><strong>Registration Status: </strong> <span class="text-danger">Pending</span></p>
              @else
              <p><strong>Registration Status: </strong> <span class="text-success">Verified</span></p>
              @endif

              @if($user->payment_status =="0" )
              <p><strong>Payment Status: </strong> <span class="text-danger">Pending</span></p>
              @else
              <p><strong>Payment Status: </strong> <span class="text-success">Paid</span></p>
              @endif
              

            </div>

            <div><hr></div>
            <div class="row mt-30 text-center">
              <div class="col-lg-4">
                <h5>Disable User</h5>
                @if($user->acc_status =="0" )
                    <a href="/admin/disable/{{ $user->user_id }}/1" class="btn btn-primary" onclick="return confirm('Are you sure you want to Disable User?');">Activate</a>
                @else
                    <a href="/admin/disable/{{ $user->user_id }}/0" class="btn btn-primary" onclick="return confirm('Are you sure you want to Disable User?');">Disable</a>
                @endif
              </div>
              <div class="col-lg-4">
                <h5>Confirm User Payment</h5>
                <a href="/admin/confirm-pay/{{ $user->user_id }}" class="btn btn-success" onclick="return confirm('Are you sure you want to confirm payment?');">Confirm</a>
              </div>
              <div class="col-lg-4">
                <h5>Delete User</h5>
                <a href="/admin/delete-user/{{ $user->user_id }}" class="btn btn-danger" onclick="return confirm('Are you sure you want to DELETE USER?');">Delete</a>
              </div>
            </div>
          
        </div>
      </div>

      



    </div>
  </div>
</section>

</main><!-- End #main -->
<script type="text/javascript">
    $(document).on('click', ':not(form)[data-confirm]', function(e){
    if(!confirm($(this).data('confirm'))){
        e.stopImmediatePropagation();
        e.preventDefault();
    }
});
</script>
@include('backend.layouts.footer')