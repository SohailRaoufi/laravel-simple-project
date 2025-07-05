<!doctype html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=yes ">
  <meta name="description" content="">
  <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
  <meta name="generator" content="Hugo 0.118.2">
  <title>Admin Panel</title>

  <link rel="canonical" href="https://getbootstrap.com/docs/5.3/examples/sidebars/">

  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@docsearch/css@3">

  <link href="{{ URL::asset('assets/css/bootstrap.min.css') }}" rel="stylesheet">

  <style>
    .bd-placeholder-img {
      font-size: 1.125rem;
      text-anchor: middle;
      -webkit-user-select: none;
      -moz-user-select: none;
      user-select: none;
    }

    @media (min-width: 768px) {
      .bd-placeholder-img-lg {
        font-size: 3.5rem;
      }
    }

    .b-example-divider {
      width: 100%;
      height: 3rem;
      background-color: rgba(0, 0, 0, .1);
      border: solid rgba(0, 0, 0, .15);
      border-width: 1px 0;
      box-shadow: inset 0 .5em 1.5em rgba(0, 0, 0, .1), inset 0 .125em .5em rgba(0, 0, 0, .15);
    }

    .b-example-vr {
      flex-shrink: 0;
      width: 1.5rem;
      height: 100vh;
    }

    .bi {
      vertical-align: -.125em;
      fill: currentColor;
    }

    .nav-scroller {
      position: relative;
      z-index: 2;
      height: 2.75rem;
      overflow-y: hidden;
    }

    .nav-scroller .nav {
      display: flex;
      flex-wrap: nowrap;
      padding-bottom: 1rem;
      margin-top: -1px;
      overflow-x: auto;
      text-align: center;
      white-space: nowrap;
      -webkit-overflow-scrolling: touch;
    }

    .btn-bd-primary {
      --bd-violet-bg: #712cf9;
      --bd-violet-rgb: 112.520718, 44.062154, 249.437846;

      --bs-btn-font-weight: 600;
      --bs-btn-color: var(--bs-white);
      --bs-btn-bg: var(--bd-violet-bg);
      --bs-btn-border-color: var(--bd-violet-bg);
      --bs-btn-hover-color: var(--bs-white);
      --bs-btn-hover-bg: #6528e0;
      --bs-btn-hover-border-color: #6528e0;
      --bs-btn-focus-shadow-rgb: var(--bd-violet-rgb);
      --bs-btn-active-color: var(--bs-btn-hover-color);
      --bs-btn-active-bg: #5a23c8;
      --bs-btn-active-border-color: #5a23c8;
    }

    .bd-mode-toggle {
      z-index: 1500;
    }

    .bd-mode-toggle .dropdown-menu .active .bi {
      display: block !important;
    }

    form *{
      margin-top:0.5rem; 
    }
  </style>


  <!-- Custom styles for this template -->
  <link href="{{ URL::asset('/assets/css/sidebars.css') }}" rel="stylesheet">
  <link href="{{ URL::asset('/assets/css/news-table.css') }}" rel="stylesheet">
  <link href="{{ URL::asset('/assets/css/responsive_admin.css') }}" rel="stylesheet">

</head>


<body>



  {{-- Side Nav Code --}}
  <aside class="d-flex flex-nowrap sidebar">
    <div class="d-flex flex-column flex-shrink-0 p-3 text-bg-dark" style="width: 280px;height:100vh;">
      <h2 href="/" class="d-flex align-items-center mb-3 mb-md-0 me-md-auto text-white text-decoration-none">
        <img src="{{asset('assets/img/admin-page-icons/user-round-cog.svg')}}" alt="menu_icon">
        <span class="fs-4 ms-2">Admin Panel</span>
      </h2>
      <hr>
      <ul class="nav nav-pills flex-column mb-auto">
        <li class="nav-item">
          <a href="{{url('/user/admin')}}" class="nav-link text-white @if (url('/user/admin') === Request::url()) active @else hover @endif" aria-current="page">
            <img src="{{asset('assets/img/admin-page-icons/newspaper.svg')}}" alt="news-icon" class="me-2">
            News & Insights
          </a>
        </li>
        <li>
          <a href="{{url('/user/admin/production')}}" class="nav-link text-white @if (url('/user/admin/production') === Request::url()) active @else hover @endif">
            <img src="{{asset('assets/img/admin-page-icons/production-icon.svg')}}" alt="production-icon" class="me-2">
            Production
          </a>
        </li>
        <li>
          <a href="{{url('user/admin/admins')}}" class="nav-link text-white @if (url('user/admin/admins') === Request::url()) active @else hover @endif">
            <img src="{{asset('assets/img/admin-page-icons/person-circle.svg')}}" alt="person-icon" class="me-2">
            Admins
          </a>
        </li>
      </ul>
      <hr>
      <div class="dropdown">
        <a href="#" class="d-flex align-items-center text-white text-decoration-none dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
          <img src="{{asset('assets/img/admin-page-icons/person.svg')}}" alt="" width="32" height="32" class="rounded-circle me-2">
          <strong>{{$_SESSION['name'] ?? 'unknown'}}</strong>
        </a>
        <ul class="dropdown-menu dropdown-menu-dark text-small shadow">
          <li><a class="dropdown-item" href="{{url('user/admin/signout')}}">Sign out</a></li>
        </ul>
      </div>
    </div>
  </aside>
  
  <script src="{{ URL::asset('/assets/js/bootstrap.bundle.min.js') }}"></script>



  {{-- Main Body Content --}}
  <main>
    @yield('main-content')
    <div class="w-50 mt-5">
      <h2>@yield('title')</h2>
      <hr style="width: 70rem">
    </div>
    @yield('button')

    @yield('data')

    @yield('form')

    @yield('table-show')
  </main>

  {{-- <script>
    const menuToggle = document.querySelector('.menu-toggle');
    const sidebar = document.querySelector('.sidebar');

    menuToggle.addEventListener('click', function() {
      sidebar.classList.toggle('visible');
    });
  </script> --}}

</body>
</html>