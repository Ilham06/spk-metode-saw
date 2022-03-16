<!doctype html>
<!--
* Tabler - Premium and Open Source dashboard template with responsive and high quality UI.
* @version 1.0.0-beta9
* @link https://tabler.io
* Copyright 2018-2022 The Tabler Authors
* Copyright 2018-2022 codecalm.net Paweł Kuna
* Licensed under MIT (https://github.com/tabler/tabler/blob/master/LICENSE)
-->
<html lang="en">
  <head>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover"/>
    <meta http-equiv="X-UA-Compatible" content="ie=edge"/>
    <title>@yield('title')</title>
    <!-- CSS files -->
    <link href="{{ asset('assets/css/tabler.min.css') }}" rel="stylesheet"/>
    <link href="{{ asset('assets/css/demo.min.css') }}" rel="stylesheet"/>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
  </head>
  <body >
    <div class="page">
      <header class="navbar navbar-expand-md navbar-light d-print-none">
        <div class="container-xl">
          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbar-menu">
            <span class="navbar-toggler-icon"></span>
          </button>
          <h1 class="navbar-brand navbar-brand-autodark d-none-navbar-horizontal pe-0 pe-md-3">
            <a href=".">
              MY SPK
            </a>
          </h1>
          <div class="navbar-nav flex-row order-md-last">
            <div class="nav-item dropdown">
              <a href="#" class="nav-link d-flex lh-1 text-reset p-0" data-bs-toggle="dropdown" aria-label="Open user menu">
                <span class="avatar avatar-sm" style="background-image: url({{ asset('assets/avatar.png') }})"></span>
                <div class="d-none d-xl-block ps-2">
                  <div>{{ auth()->user()->name }}</div>
                  <div class="mt-1 small text-muted">{{ auth()->user()->role }}</div>
                </div>
              </a>
              <div class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                <form onclick="return confirm('ingin logout?')" action="{{ route('logout') }}" method="POST">
                  @csrf
                  <button type="submit" class="dropdown-item">Logout</button>
                </form>
              </div>
            </div>
          </div>
        </div>
      </header>
      <div class="navbar-expand-md">
        <div class="collapse navbar-collapse" id="navbar-menu">
          <div class="navbar navbar-light">
            <div class="container-xl">
              <ul class="navbar-nav">
                <li class="nav-item {{ request()->is('/') ? 'active' : '' }}">
                  <a class="nav-link" href="{{ route('home') }}" >
                    <i class="fas fa-home me-2"></i>
                    <span class="nav-link-title">
                      Home
                    </span>
                  </a>
                </li>
                <li class="nav-item dropdown {{ request()->is('criteria') || request()->is('crips') ? 'active' : '' }}">
                  <a class="nav-link dropdown-toggle" href="#navbar-base" data-bs-toggle="dropdown" data-bs-auto-close="outside" role="button" aria-expanded="false" > 
                    <i class="fas fa-chart-bar me-2"></i>
                    <span class="nav-link-title">
                      Kriteria 
                    </span>
                  </a>
                  <div class="dropdown-menu">
                    <div class="dropdown-menu-columns">
                      <div class="dropdown-menu-column">
                        <a class="dropdown-item" href="{{ route('criteria.index') }}" >
                          Data Kriteria
                        </a>
                        <a class="dropdown-item" href="{{ route('crips.index') }}" >
                          Data Crips
                        </a>
                      </div>
                    </div>
                  </div>
                </li>
                <li class="nav-item dropdown {{ request()->is('alternative') ? 'active' : '' }}">
                  <a class="nav-link dropdown-toggle" href="#navbar-extra" data-bs-toggle="dropdown" data-bs-auto-close="outside" role="button" aria-expanded="false" >
                    <i class="fas fa-list-ol me-2"></i>
                    <span class="nav-link-title">
                      Alternatif
                    </span>
                  </a>
                  <div class="dropdown-menu">
                    <a class="dropdown-item" href="{{ route('alternative.index') }}" >
                      Data Alternatif
                    </a>
                  </div>
                </li>
                <li class="nav-item dropdown {{ request()->is('calculating') || request()->is('calculating/result') ? 'active' : '' }}">
                  <a class="nav-link dropdown-toggle" href="#navbar-layout" data-bs-toggle="dropdown" data-bs-auto-close="outside" role="button" aria-expanded="false" >
                    <i class="fas fa-calculator me-2"></i>
                    <span class="nav-link-title">
                      Perhitungan
                    </span>
                  </a>
                  <div class="dropdown-menu">
                    <div class="dropdown-menu-columns">
                      <div class="dropdown-menu-column">
                        <a class="dropdown-item" href="{{ route('calculate.index') }}" >
                          Penentuan Nilai
                        </a>
                        <a class="dropdown-item" href="{{ route('calculate.proses') }}" >
                          Hasil
                        </a>
                      </div>
                    </div>
                  </div>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="{{ route('user.index') }}" >
                    <i class="fas fa-user me-2"></i>
                    <span class="nav-link-title">
                      User
                    </span>
                  </a>
                </li>
              </ul>
            </div>
          </div>
        </div>
      </div>
      <div class="page-wrapper">
        <div class="container-xl">
          <!-- Page title -->
          <div class="page-header d-print-none">
            @yield('header')
          </div>
        </div>
        <div class="page-body">
          @yield('content')
        </div>
        <footer class="footer d-print-none">
          <div class="container-xl">
            <div class="row text-center align-items-center flex-row-reverse">
              <div class="col-lg-auto ms-lg-auto">
                <ul class="list-inline list-inline-dots mb-0">
                  <li class="list-inline-item">Admin Template by <a href="https://github.com/tabler/tabler" target="_blank" rel="noopener">Tabler</a></li>
                </ul>
              </div>
              <div class="col-12 col-lg-auto mt-3 mt-lg-0">
                <ul class="list-inline list-inline-dots mb-0">
                  <li class="list-inline-item">
                    Made By <a href="https://github/ilham06" >Ilham Muhamad</a>.
                  </li>
                </ul>
              </div>
            </div>
          </div>
        </footer>
      </div>
    </div>
    <!-- Libs JS -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- Tabler Core -->
    <script src="{{ asset('assets/js/tabler.min.js') }}"></script>
    <script src="{{ asset('assets/js/demo.min.js') }}"></script>
    @yield('script')
  </body>
</html>