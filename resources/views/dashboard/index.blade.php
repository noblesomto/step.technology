@include('dashboard.layouts.header')
@include('dashboard.layouts.nav')

<main id="main" class="main">

    <div class="pagetitle">
      <h1>Dashboard</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="/user/index">Home</a></li>
          <li class="breadcrumb-item active">Dashboard</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->
    @if($user->address =="")
    <div class="alert alert-warning">
      <h5>Complete your registeration</h5> <a class="btn btn-primary" href="/user/profile">Proceed</a>
    </div>
    @endif

    @if(empty($user->member_status) && (!empty($user->address)))
    <div class="alert alert-warning">
      <h5>Pay your Membership Fee</h5> <a class="btn btn-primary" href="/user/membership">Proceed</a>
    </div>
    @endif

    <section class="section dashboard">
      <div class="row">

        <!-- Left side columns -->
        <div class="col-lg-12">
          <div class="row">

            <!-- Sales Card -->
            <div class="col-xxl-4 col-md-6">
              <div class="card info-card sales-card">

               

                <div class="card-body">
                  <h5 class="card-title">Journals/Publications</h5>

                  <div class="d-flex align-items-center">
                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                      <i class="bi bi-book"></i>
                    </div>
                    <div class="ps-3">
                      <h6>0</h6>
                      

                    </div>
                  </div>
                </div>

              </div>
            </div><!-- End Sales Card -->

            <!-- Revenue Card -->
            <div class="col-xxl-4 col-md-6">
              <div class="card info-card revenue-card">

              

                <div class="card-body">
                  <h5 class="card-title">Certifications Available </h5>

                  <div class="d-flex align-items-center">
                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                      <i class="bi bi-people"></i>
                    </div>
                    <div class="ps-3">
                      <h6>0</h6>
                      

                    </div>
                  </div>
                </div>

              </div>
            </div><!-- End Revenue Card -->

            <!-- Customers Card -->
            <div class="col-xxl-4 col-xl-12">

              <div class="card info-card customers-card">

            

                <div class="card-body">
                  <h5 class="card-title">Membership ID </h5>

                  <div class="d-flex align-items-center">
                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                      <i class="bi bi-eye"></i>
                    </div>
                    <div class="ps-3">
                      <h6>{{ $user->step_id }}</h6>
                    

                    </div>
                  </div>

                </div>
              </div>

            </div><!-- End Customers Card -->

           
              </div>
            </div><!-- End Top Selling -->

          </div>
        </div><!-- End Left side columns -->

   

      </div>
    </section>

  </main><!-- End #main -->
  @include('dashboard.layouts.footer')