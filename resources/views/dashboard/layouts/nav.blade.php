<body>

    <!-- ======= Header ======= -->
    <header id="header" class="header fixed-top d-flex align-items-center">
  
      <div class="d-flex align-items-center justify-content-between">
        <a href="/user/index" class="logo d-flex align-items-center">
          <img src="{{ asset('frontend/img/new-logo.png') }}" alt="User Dashboard">
          <span class="d-none d-lg-block"></span>
        </a>
        <i class="bi bi-list toggle-sidebar-btn"></i>
      </div><!-- End Logo -->
  
      <div class="search-bar">
        <form class="search-form d-flex align-items-center" method="POST" action="/user/search">
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
          <a class="nav-link " href="/user/index">
            <i class="bi bi-grid"></i>
            <span>Dashboard</span>
          </a>
        </li><!-- End Dashboard Nav -->
  
     
  
        <li class="nav-item">
          <a class="nav-link collapsed" href="/user/profile">
            <i class="bi bi-person-square"></i>
            <span>Profile</span>
          </a>
        </li><!-- End Login Page Nav -->

        <li class="nav-item">
          <a class="nav-link collapsed" href="/user/membership">
            <i class="bi bi-person-square"></i>
            <span>Memebership</span>
          </a>
        </li><!-- End Login Page Nav -->
       
  

  
        <li class="nav-item">
          <a class="nav-link collapsed" href="/user/logout">
            <i class="bi bi-box-arrow-in-right"></i>
            <span>Logout</span>
          </a>
        </li><!-- End Login Page Nav -->
  
       
  
      </ul>
  
    </aside><!-- End Sidebar-->
  