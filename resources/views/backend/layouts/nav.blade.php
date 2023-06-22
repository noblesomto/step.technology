<body>

    <!-- ======= Header ======= -->
    <header id="header" class="header fixed-top d-flex align-items-center">
  
      <div class="d-flex align-items-center justify-content-between">
        <a href="/admin/index" class="logo d-flex align-items-center">
          <img src="{{ asset('frontend/img/logos/logo.png') }}" alt="">
          <span class="d-none d-lg-block">Admin</span>
        </a>
        <i class="bi bi-list toggle-sidebar-btn"></i>
      </div><!-- End Logo -->
  
      <div class="search-bar">
        <form class="search-form d-flex align-items-center" method="POST" action="/admin/search">
          @csrf
          <input type="text" name="search" placeholder="Search" title="Enter search keyword">
          <button type="submit" title="Search"><i class="bi bi-search"></i></button>
        </form>
      </div><!-- End Search Bar -->
  
 
  
    </header><!-- End Header -->
  
    <!-- ======= Sidebar ======= -->
    <aside id="sidebar" class="sidebar">
  
      <ul class="sidebar-nav" id="sidebar-nav">
  
        <li class="nav-item">
          <a class="nav-link " href="/admin/index">
            <i class="bi bi-grid"></i>
            <span>Dashboard</span>
          </a>
        </li><!-- End Dashboard Nav -->
  
        <li class="nav-item">
          <a class="nav-link collapsed" data-bs-target="#components-nav" data-bs-toggle="collapse" href="#">
            <i class="bi bi-menu-button-wide"></i><span>Blog</span><i class="bi bi-chevron-down ms-auto"></i>
          </a>
          <ul id="components-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
            <li>
              <a href="/blogpost/new-post">
                <i class="bi bi-circle"></i><span>New Post</span>
              </a>
            </li>
            <li>
              <a href="/blogpost/all-post">
                <i class="bi bi-circle"></i><span>All Post</span>
              </a>
            </li>
            
          </ul>
        </li><!-- End Components Nav -->

        <li class="nav-item">
          <a class="nav-link collapsed" data-bs-target="#components-event" data-bs-toggle="collapse" href="#">
            <i class="bi bi-menu-button-wide"></i><span>Events</span><i class="bi bi-chevron-down ms-auto"></i>
          </a>
          <ul id="components-event" class="nav-content collapse " data-bs-parent="#sidebar-nav">
            <li>
              <a href="/event/new-post">
                <i class="bi bi-circle"></i><span>New Event</span>
              </a>
            </li>
            <li>
              <a href="/event/all-events">
                <i class="bi bi-circle"></i><span>All Event</span>
              </a>
            </li>
            
          </ul>
        </li><!-- End Components Nav -->
  
    
  
        <li class="nav-item">
          <a class="nav-link collapsed" href="/admin/payment">
            <i class="bi bi-box-arrow-in-right"></i>
            <span>Payments</span>
          </a>
        </li><!-- End Login Page Nav -->
       
  

  
        <li class="nav-item">
          <a class="nav-link collapsed" href="/admin/logout">
            <i class="bi bi-box-arrow-in-right"></i>
            <span>Logout</span>
          </a>
        </li><!-- End Login Page Nav -->
  
       
  
      </ul>
  
    </aside><!-- End Sidebar-->
  