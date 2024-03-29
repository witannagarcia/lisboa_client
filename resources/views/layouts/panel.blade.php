<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <title>{{ env('APP_NAME') }}</title>
    <!-- plugins:css -->
    <link rel="stylesheet" href="{{ asset('css/vendors/mdi/css/materialdesignicons.min.css') }}">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/vendors/flag-icon-css/css/flag-icon.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/vendors/css/vendor.bundle.base.css') }}">
    <!-- endinject -->
    <!-- Plugin css for this page -->
    <link rel="stylesheet" href="{{ asset('css/vendors/jquery-bar-rating/css-stars.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/tata.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/vendors/font-awesome/css/font-awesome.min.css') }}" />
    <!-- End plugin css for this page -->
    <!-- inject:css -->
    <!-- endinject -->
    <!-- Layout styles -->
    <link rel="stylesheet" href="{{ asset('css/panel.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/style.css') }}" />
</head>

<body>
    <div class="container-scroller">
        <!-- partial:partials/_sidebar.html -->
        <nav class="sidebar sidebar-offcanvas" id="sidebar">
            <ul class="nav">
                <li class="nav-item nav-profile border-bottom">
                    <a href="#" class="nav-link flex-column">
                        <div class="nav-profile-image">
                            <img src="{{ asset('images/logo.jpeg') }}" alt="profile" />
                            <!--change to offline or busy as needed-->
                        </div>
                        <div class="nav-profile-text d-flex ml-0 mb-3 flex-column">
                            <span
                                class="font-weight-semibold mb-1 mt-2 text-center">{{ Auth::user()->restaurant->name }}</span>
                            <span class="text-secondary icon-sm text-center">{{ Auth::user()->name }}</span>
                        </div>
                    </a>
                </li>
                <!--<li class="nav-item pt-3">
            <a class="nav-link d-block" href="index.html">
              <img class="sidebar-brand-logo" src="../assets/images/logo.svg" alt="" />
              <img class="sidebar-brand-logomini" src="../assets/images/logo-mini.svg" alt="" />
              <div class="small font-weight-light pt-1">Responsive Dashboard</div>
            </a>
            <form class="d-flex align-items-center" action="#">
              <div class="input-group">
                <div class="input-group-prepend">
                  <i class="input-group-text border-0 mdi mdi-magnify"></i>
                </div>
                <input type="text" class="form-control border-0" placeholder="Search" />
              </div>
            </form>
          </li>-->
                <li class="pt-2 pb-1">
                    <span class="nav-item-head">Generales</span>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ url('/panel/sucursales') }}">
                        <i class="mdi mdi-file-tree menu-icon"></i>
                        <span class="menu-title">Sucursales</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ url('/panel/configuracion') }}">
                        <i class="mdi mdi-settings menu-icon"></i>
                        <span class="menu-title">Configuraciones</span>
                    </a>
                </li>
                <li class="pt-2 pb-1">
                    <span class="nav-item-head">Catálogos de sucursal</span>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="{{ url('/panel/dashboard') }}">
                      <i class="mdi mdi-compass-outline menu-icon"></i>
                      <span class="menu-title">Dashboard</span>
                  </a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="{{ url('/panel/usuarios') }}">
                    <i class="mdi mdi-account-group menu-icon"></i>
                    <span class="menu-title">Usuarios</span>
                </a>
            </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ url('/panel/categorias') }}">
                        <i class="mdi mdi-drawing menu-icon"></i>
                        <span class="menu-title">Categorías</span>
                    </a>
                </li>
                <!--<li class="nav-item">
                  <a class="nav-link" data-toggle="collapse" href="#ui-basic" aria-expanded="false" aria-controls="ui-basic">
                    <i class="mdi mdi-crosshairs-gps menu-icon"></i>
                    <span class="menu-title">UI Elements</span>
                    <i class="menu-arrow"></i>
                  </a>
                  <div class="collapse" id="ui-basic">
                    <ul class="nav flex-column sub-menu">
                      <li class="nav-item">
                        <a class="nav-link" href="pages/ui-features/buttons.html">Buttons</a>
                      </li>
                      <li class="nav-item">
                        <a class="nav-link" href="pages/ui-features/dropdowns.html">Dropdowns</a>
                      </li>
                      <li class="nav-item">
                        <a class="nav-link" href="pages/ui-features/typography.html">Typography</a>
                      </li>
                    </ul>
                  </div>
                </li>-->
                <li class="nav-item">
                    <a class="nav-link" href="{{ url('/panel/platillos') }}">
                        <i class="mdi mdi-food menu-icon"></i>
                        <span class="menu-title">Platillos</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ url('/panel/qr') }}">
                        <i class="mdi mdi-qrcode menu-icon"></i>
                        <span class="menu-title">Configuración de menu</span>
                    </a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="{{ url('/panel/mesas') }}">
                      <i class="mdi mdi-grid menu-icon"></i>
                      <span class="menu-title">Configuración de Mesas</span>
                  </a>
              </li>
                <!--<li class="nav-item">
            <a class="nav-link" data-toggle="collapse" href="#ui-basic" aria-expanded="false" aria-controls="ui-basic">
              <i class="mdi mdi-crosshairs-gps menu-icon"></i>
              <span class="menu-title">UI Elements</span>
              <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="ui-basic">
              <ul class="nav flex-column sub-menu">
                <li class="nav-item">
                  <a class="nav-link" href="pages/ui-features/buttons.html">Buttons</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="pages/ui-features/dropdowns.html">Dropdowns</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="pages/ui-features/typography.html">Typography</a>
                </li>
              </ul>
            </div>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="pages/icons/mdi.html">
              <i class="mdi mdi-contacts menu-icon"></i>
              <span class="menu-title">Icons</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="pages/forms/basic_elements.html">
              <i class="mdi mdi-format-list-bulleted menu-icon"></i>
              <span class="menu-title">Forms</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="pages/charts/chartjs.html">
              <i class="mdi mdi-chart-bar menu-icon"></i>
              <span class="menu-title">Charts</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="pages/tables/basic-table.html">
              <i class="mdi mdi-table-large menu-icon"></i>
              <span class="menu-title">Tables</span>
            </a>
          </li>
          <li class="nav-item pt-3">
            <a class="nav-link" href="http://bootstrapdash.com/demo/plus-free/documentation/documentation.html" target="_blank">
              <i class="mdi mdi-file-document-box menu-icon"></i>
              <span class="menu-title">Documentation</span>
            </a>
          </li>-->
            </ul>
        </nav>
        <!-- partial -->
        <div class="container-fluid page-body-wrapper">
            <!-- partial:partials/_settings-panel.html -->
            <!--<div id="settings-trigger"><i class="mdi mdi-settings"></i></div>-->
            <div id="theme-settings" class="settings-panel">
                <i class="settings-close mdi mdi-close"></i>
                <p class="settings-heading">SIDEBAR SKINS</p>
                <div class="sidebar-bg-options selected" id="sidebar-default-theme">
                    <div class="img-ss rounded-circle bg-light border mr-3"></div>Default
                </div>
                <div class="sidebar-bg-options" id="sidebar-dark-theme">
                    <div class="img-ss rounded-circle bg-dark border mr-3"></div>Dark
                </div>
                <p class="settings-heading mt-2">HEADER SKINS</p>
                <div class="color-tiles mx-0 px-4">
                    <div class="tiles default primary"></div>
                    <div class="tiles success"></div>
                    <div class="tiles warning"></div>
                    <div class="tiles danger"></div>
                    <div class="tiles info"></div>
                    <div class="tiles dark"></div>
                    <div class="tiles light"></div>
                </div>
            </div>
            <!-- partial -->
            <!-- partial:partials/_navbar.html -->
            <nav class="navbar default-layout-navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
                <div class="navbar-menu-wrapper d-flex align-items-stretch">
                    <!--<button class="navbar-toggler navbar-toggler align-self-center" type="button" data-toggle="minimize">
              <span class="mdi mdi-chevron-double-left"></span>
            </button>
            <div class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-center">
              <a class="navbar-brand brand-logo-mini" href="index.html"><img src="../assets/images/logo-mini.svg" alt="logo" /></a>
            </div>-->
                    <ul class="navbar-nav">
                        <li class="nav-item d-none d-md-block">
                            <button class="navbar-toggler navbar-toggler align-self-center" type="button"
                                data-toggle="minimize">
                                <span class="mdi mdi-menu"></span>
                            </button>
                        </li>
                        <li class="nav-item d-flex justify-content-around align-items-center">
                            <div id="dd" class="wrapper-dropdown-1" tabindex="1">
                                @if (session()->exists('branch'))
                                    <span>Sucursal: {{ session()->get('branch')->name }}</span>
                                @else
                                    <span>Sucursal: Ninguna</span>
                                @endif
                                <ul class="dropdown">
                                    @foreach (Auth::user()->restaurant->branches as $branchG)
                                        <li><a
                                                href="{{ url('/panel/cambiar-sucursal/' . $branchG->id) }}">{{ $branchG->name }}</a>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                            <!--<div class="select-box">
                                <div class="select-box__current" tabindex="1">
                                    @foreach (Auth::user()->restaurant->branches as $key => $branchG)
                                        <div class="select-box__value">
                                            <input class="select-box__input" type="radio" id="{{ $key }}"
                                                value="{{ $branchG->id }}" name="{{ $branchG->name }}"
                                                checked="checked" />
                                            <p class="select-box__input-text">{{ $branchG->name }}</p>
                                        </div>
                                        @endforeach<img class="select-box__icon"
                                            src="https://cdn.onlinewebfonts.com/svg/img_295694.svg" alt="Arrow Icon"
                                            aria-hidden="true" />
                                </div>
                                <ul class="select-box__list">
                                    @foreach (Auth::user()->restaurant->branches as $key => $branchG)
                                        <li>
                                            <label class="select-box__option" for="{{ $key }}"
                                                aria-hidden="aria-hidden">{{ $branchG->name }}</label>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>-->
                        </li>
                        <!--<li class="nav-item dropdown">
                <a class="nav-link" id="messageDropdown" href="#" data-toggle="dropdown" aria-expanded="false">
                  <i class="mdi mdi-email-outline"></i>
                </a>
                <div class="dropdown-menu dropdown-menu-left navbar-dropdown preview-list" aria-labelledby="messageDropdown">
                  <h6 class="p-3 mb-0 font-weight-semibold">Messages</h6>
                  <div class="dropdown-divider"></div>
                  <a class="dropdown-item preview-item">
                    <div class="preview-thumbnail">
                      <img src="../assets/images/faces/face1.jpg" alt="image" class="profile-pic">
                    </div>
                    <div class="preview-item-content d-flex align-items-start flex-column justify-content-center">
                      <h6 class="preview-subject ellipsis mb-1 font-weight-normal">Mark send you a message</h6>
                      <p class="text-gray mb-0"> 1 Minutes ago </p>
                    </div>
                  </a>
                  <div class="dropdown-divider"></div>
                  <a class="dropdown-item preview-item">
                    <div class="preview-thumbnail">
                      <img src="../assets/images/faces/face6.jpg" alt="image" class="profile-pic">
                    </div>
                    <div class="preview-item-content d-flex align-items-start flex-column justify-content-center">
                      <h6 class="preview-subject ellipsis mb-1 font-weight-normal">Cregh send you a message</h6>
                      <p class="text-gray mb-0"> 15 Minutes ago </p>
                    </div>
                  </a>
                  <div class="dropdown-divider"></div>
                  <a class="dropdown-item preview-item">
                    <div class="preview-thumbnail">
                      <img src="../assets/images/faces/face7.jpg" alt="image" class="profile-pic">
                    </div>
                    <div class="preview-item-content d-flex align-items-start flex-column justify-content-center">
                      <h6 class="preview-subject ellipsis mb-1 font-weight-normal">Profile picture updated</h6>
                      <p class="text-gray mb-0"> 18 Minutes ago </p>
                    </div>
                  </a>
                  <div class="dropdown-divider"></div>
                  <h6 class="p-3 mb-0 text-center text-primary font-13">4 new messages</h6>
                </div>
              </li>
              <li class="nav-item dropdown ml-3">
                <a class="nav-link" id="notificationDropdown" href="#" data-toggle="dropdown">
                  <i class="mdi mdi-bell-outline"></i>
                </a>
                <div class="dropdown-menu dropdown-menu-left navbar-dropdown preview-list" aria-labelledby="notificationDropdown">
                  <h6 class="px-3 py-3 font-weight-semibold mb-0">Notifications</h6>
                  <div class="dropdown-divider"></div>
                  <a class="dropdown-item preview-item">
                    <div class="preview-thumbnail">
                      <div class="preview-icon bg-success">
                        <i class="mdi mdi-calendar"></i>
                      </div>
                    </div>
                    <div class="preview-item-content d-flex align-items-start flex-column justify-content-center">
                      <h6 class="preview-subject font-weight-normal mb-0">New order recieved</h6>
                      <p class="text-gray ellipsis mb-0"> 45 sec ago </p>
                    </div>
                  </a>
                  <div class="dropdown-divider"></div>
                  <a class="dropdown-item preview-item">
                    <div class="preview-thumbnail">
                      <div class="preview-icon bg-warning">
                        <i class="mdi mdi-settings"></i>
                      </div>
                    </div>
                    <div class="preview-item-content d-flex align-items-start flex-column justify-content-center">
                      <h6 class="preview-subject font-weight-normal mb-0">Server limit reached</h6>
                      <p class="text-gray ellipsis mb-0"> 55 sec ago </p>
                    </div>
                  </a>
                  <div class="dropdown-divider"></div>
                  <a class="dropdown-item preview-item">
                    <div class="preview-thumbnail">
                      <div class="preview-icon bg-info">
                        <i class="mdi mdi-link-variant"></i>
                      </div>
                    </div>
                    <div class="preview-item-content d-flex align-items-start flex-column justify-content-center">
                      <h6 class="preview-subject font-weight-normal mb-0">Kevin karvelle</h6>
                      <p class="text-gray ellipsis mb-0"> 11:09 PM </p>
                    </div>
                  </a>
                  <div class="dropdown-divider"></div>
                  <h6 class="p-3 font-13 mb-0 text-primary text-center">View all notifications</h6>
                </div>
              </li>-->
                    </ul>
                    <ul class="navbar-nav navbar-nav-right">
                        <li class="nav-item">
                            <a class="nav-link" href="{{ url('/cocina/ordenes') }}">
                                <i class="fas fa-concierge-bell"></i>
                            </a>
                        </li>
                        <li class="nav-item">
                            <div class="dropdown">
                                <button class="btn btn-default text-white dropdown-toggle" type="button"
                                    id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                    <i class="mdi mdi-account"></i>
                                </button>
                                <ul class="dropdown-menu" aria-labelledby="dropdownMenu1">
                                    <li>
                                        <a href="{{ url('/panel/auth/logout') }}"><i
                                                class="mdi mdi-logout mr-2"></i>Salir</a>
                                    </li>
                                </ul>
                            </div>
                        </li>
                        <li class="nav-item">
                            <div class="dropdown">
                                <!-- Link or button to toggle dropdown -->
                                <ul class="dropdown-menu" role="menu" aria-labelledby="dLabel">
                                    <li><a tabindex="-1" href="#">Action</a></li>
                                    <li><a tabindex="-1" href="#">Another action</a></li>
                                    <li><a tabindex="-1" href="#">Something else here</a></li>
                                    <li class="divider"></li>
                                    <li><a tabindex="-1" href="#">Separated link</a></li>
                                </ul>
                            </div>
                        </li>
                    </ul>
                    <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button"
                        data-toggle="offcanvas">
                        <span class="mdi mdi-menu"></span>
                    </button>
                </div>
            </nav>
            <!-- partial -->
            <div class="main-panel">
                <div class="content-wrapper pb-0">
                    @if ($message = Session::get('success'))
                        <div class="alert alert-success rounded-pill alert-dismissible fade show" role="alert">
                            {{ $message }}
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    @endif
                    @if ($message = Session::get('danger'))
                        <div class="alert alert-danger rounded-pill alert-dismissible fade show" role="alert">
                            {{ $message }}
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    @endif
                    @yield('content')
                </div>
                <!--<div class="content-wrapper pb-0">
            <div class="page-header flex-wrap">
              <div class="header-left">
                <button class="btn btn-primary mb-2 mb-md-0 mr-2"> Create new document </button>
                <button class="btn btn-outline-primary bg-white mb-2 mb-md-0"> Import documents </button>
              </div>
              <div class="header-right d-flex flex-wrap mt-2 mt-sm-0">
                <div class="d-flex align-items-center">
                  <a href="#">
                    <p class="m-0 pr-3">Dashboard</p>
                  </a>
                  <a class="pl-3 mr-4" href="#">
                    <p class="m-0">ADE-00234</p>
                  </a>
                </div>
                <button type="button" class="btn btn-primary mt-2 mt-sm-0 btn-icon-text">
                  <i class="mdi mdi-plus-circle"></i> Add Prodcut </button>
              </div>
            </div>
            <div class="row">
              <div class="col-xl-9 stretch-card grid-margin">
                <div class="card">
                  <div class="card-body">
                    <div class="d-flex justify-content-between flex-wrap">
                      <div>
                        <div class="card-title mb-0">Sales Revenue</div>
                        <h3 class="font-weight-bold mb-0">$32,409</h3>
                      </div>
                      <div>
                        <div class="d-flex flex-wrap pt-2 justify-content-between sales-header-right">
                          <div class="d-flex mr-5">
                            <button type="button" class="btn btn-social-icon btn-outline-sales">
                              <i class="mdi mdi-inbox-arrow-down"></i>
                            </button>
                            <div class="pl-2">
                              <h4 class="mb-0 font-weight-semibold head-count"> $8,217 </h4>
                              <span class="font-10 font-weight-semibold text-muted">TOTAL SALES</span>
                            </div>
                          </div>
                          <div class="d-flex mr-3 mt-2 mt-sm-0">
                            <button type="button" class="btn btn-social-icon btn-outline-sales profit">
                              <i class="mdi mdi-cash text-info"></i>
                            </button>
                            <div class="pl-2">
                              <h4 class="mb-0 font-weight-semibold head-count"> 2,804 </h4>
                              <span class="font-10 font-weight-semibold text-muted">TOTAL PROFIT</span>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                    <p class="text-muted font-13 mt-2 mt-sm-0"> Your sales monitoring dashboard template. <a class="text-muted font-13" href="#"><u>Learn more</u></a>
                    </p>
                    <div class="flot-chart-wrapper">
                      <div id="flotChart" class="flot-chart">
                        <canvas class="flot-base"></canvas>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-xl-3 stretch-card grid-margin">
                <div class="card card-img">
                  <div class="card-body d-flex align-items-center">
                    <div class="text-white">
                      <h1 class="font-20 font-weight-semibold mb-0"> Get premium </h1>
                      <h1 class="font-20 font-weight-semibold">account!</h1>
                      <p>to optimize your selling prodcut</p>
                      <p class="font-10 font-weight-semibold"> Enjoy the advantage of premium. </p>
                      <button class="btn bg-white font-12">Get Premium</button>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-sm-6 stretch-card grid-margin">
                <div class="card">
                  <div class="card-body">
                    <div class="d-flex justify-content-between">
                      <div class="card-title"> Customers <small class="d-block text-muted">August 01 - August 31</small>
                      </div>
                      <div class="d-flex text-muted font-20">
                        <i class="mdi mdi-printer mouse-pointer"></i>
                        <i class="mdi mdi-help-circle-outline ml-2 mouse-pointer"></i>
                      </div>
                    </div>
                    <h3 class="font-weight-bold mb-0"> 2,409 <span class="text-success h5">4,5%<i class="mdi mdi-arrow-up"></i></span>
                    </h3>
                    <span class="text-muted font-13">Avg customers/Day</span>
                    <div class="line-chart-wrapper">
                      <canvas id="linechart" height="80"></canvas>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-sm-6 stretch-card grid-margin">
                <div class="card">
                  <div class="card-body">
                    <div class="d-flex justify-content-between">
                      <div class="card-title"> Conversions <small class="d-block text-muted">August 01 - August 31</small>
                      </div>
                      <div class="d-flex text-muted font-20">
                        <i class="mdi mdi-printer mouse-pointer"></i>
                        <i class="mdi mdi-help-circle-outline ml-2 mouse-pointer"></i>
                      </div>
                    </div>
                    <h3 class="font-weight-bold mb-0"> 0.40% <span class="text-success h5">0.20%<i class="mdi mdi-arrow-up"></i></span>
                    </h3>
                    <span class="text-muted font-13">Avg customers/Day</span>
                    <div class="bar-chart-wrapper">
                      <canvas id="barchart" height="80"></canvas>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-sm-4 stretch-card grid-margin">
                <div class="card">
                  <div class="card-body p-0">
                    <img class="img-fluid w-100" src="../assets/images/dashboard/img_1.jpg" alt="" />
                  </div>
                  <div class="card-body px-3 text-dark">
                    <div class="d-flex justify-content-between">
                      <p class="text-muted font-13 mb-0">ENTIRE APARTMENT</p>
                      <i class="mdi mdi-heart-outline"></i>
                    </div>
                    <h5 class="font-weight-semibold"> Cosy Studio flat in London </h5>
                    <div class="d-flex justify-content-between font-weight-semibold">
                      <p class="mb-0">
                        <i class="mdi mdi-star star-color pr-1"></i>4.60 (35) </p>
                      <p class="mb-0">$5,267/night</p>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-sm-4 stretch-card grid-margin">
                <div class="card">
                  <div class="card-body p-0">
                    <img class="img-fluid w-100" src="../assets/images/dashboard/img_2.jpg" alt="" />
                  </div>
                  <div class="card-body px-3 text-dark">
                    <div class="d-flex justify-content-between">
                      <p class="text-muted font-13 mb-0">ENTIRE APARTMENT</p>
                      <i class="mdi mdi-heart-outline"></i>
                    </div>
                    <h5 class="font-weight-semibold"> Victoria Bedsit Studio Ensuite </h5>
                    <div class="d-flex justify-content-between font-weight-semibold">
                      <p class="mb-0">
                        <i class="mdi mdi-star star-color pr-1"></i>4.83 (12) </p>
                      <p class="mb-0">$6,144/night</p>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-sm-4 stretch-card grid-margin">
                <div class="card">
                  <div class="card-body p-0">
                    <img class="img-fluid w-100" src="../assets/images/dashboard/img_3.jpg" alt="" />
                  </div>
                  <div class="card-body px-3 text-dark">
                    <div class="d-flex justify-content-between">
                      <p class="text-muted font-13 mb-0">ENTIRE APARTMENT</p>
                      <i class="mdi mdi-heart-outline"></i>
                    </div>
                    <h5 class="font-weight-semibold">Fabulous Huge Room</h5>
                    <div class="d-flex justify-content-between font-weight-semibold">
                      <p class="mb-0">
                        <i class="mdi mdi-star star-color pr-1"></i>3.83 (15) </p>
                      <p class="mb-0">$5,267/night</p>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-xl-4 grid-margin">
                <div class="card card-stat stretch-card mb-3">
                  <div class="card-body">
                    <div class="d-flex justify-content-between">
                      <div class="text-white">
                        <h3 class="font-weight-bold mb-0">$168.90</h3>
                        <h6>This Month</h6>
                        <div class="badge badge-danger">23%</div>
                      </div>
                      <div class="flot-bar-wrapper">
                        <div id="column-chart" class="flot-chart"></div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="card stretch-card mb-3">
                  <div class="card-body d-flex flex-wrap justify-content-between">
                    <div>
                      <h4 class="font-weight-semibold mb-1 text-black"> Member Profit </h4>
                      <h6 class="text-muted">Average Weekly Profit</h6>
                    </div>
                    <h3 class="text-success font-weight-bold">+168.900</h3>
                  </div>
                </div>
                <div class="card stretch-card mb-3">
                  <div class="card-body d-flex flex-wrap justify-content-between">
                    <div>
                      <h4 class="font-weight-semibold mb-1 text-black"> Total Profit </h4>
                      <h6 class="text-muted">Weekly Customer Orders</h6>
                    </div>
                    <h3 class="text-success font-weight-bold">+6890.00</h3>
                  </div>
                </div>
                <div class="card mt-3">
                  <div class="card-body d-flex flex-wrap justify-content-between">
                    <div>
                      <h4 class="font-weight-semibold mb-1 text-black"> Issue Reports </h4>
                      <h6 class="text-muted">System bugs and issues</h6>
                    </div>
                    <h3 class="text-danger font-weight-bold">-8380.00</h3>
                  </div>
                </div>
              </div>
              <div class="col-xl-8 stretch-card grid-margin">
                <div class="card">
                  <div class="card-body pb-0">
                    <h4 class="card-title mb-0">Financial management review</h4>
                  </div>
                  <div class="card-body p-0">
                    <div class="table-responsive">
                      <table class="table custom-table text-dark">
                        <thead>
                          <tr>
                            <th>Name</th>
                            <th>Sale Rate</th>
                            <th>Actual</th>
                            <th>Variance</th>
                          </tr>
                        </thead>
                        <tbody>
                          <tr>
                            <td>
                              <img src="../assets/images/faces/face2.jpg" class="mr-2" alt="image" /> Jacob Jensen </td>
                            <td>
                              <div class="d-flex">
                                <span class="pr-2 d-flex align-items-center">85%</span>
                                <select id="star-1" name="rating" autocomplete="off">
                                  <option value="1">1</option>
                                  <option value="2">2</option>
                                  <option value="3">3</option>
                                  <option value="4">4</option>
                                  <option value="5">5</option>
                                </select>
                              </div>
                            </td>
                            <td>32,435</td>
                            <td>40,234</td>
                          </tr>
                          <tr>
                            <td>
                              <img src="../assets/images/faces/face3.jpg" class="mr-2" alt="image" /> Cecelia Bradley </td>
                            <td>
                              <div class="d-flex">
                                <span class="pr-2 d-flex align-items-center">55%</span>
                                <select id="star-2" name="rating" autocomplete="off">
                                  <option value="1">1</option>
                                  <option value="2">2</option>
                                  <option value="3">3</option>
                                  <option value="4">4</option>
                                  <option value="5">5</option>
                                </select>
                              </div>
                            </td>
                            <td>4,36780</td>
                            <td>765728</td>
                          </tr>
                          <tr>
                            <td>
                              <img src="../assets/images/faces/face4.jpg" class="mr-2" alt="image" /> Leah Sherman </td>
                            <td>
                              <div class="d-flex">
                                <span class="pr-2 d-flex align-items-center">23%</span>
                                <select id="star-3" name="rating" autocomplete="off">
                                  <option value="1">1</option>
                                  <option value="2">2</option>
                                  <option value="3">3</option>
                                  <option value="4">4</option>
                                  <option value="5">5</option>
                                </select>
                              </div>
                            </td>
                            <td>2300</td>
                            <td>22437</td>
                          </tr>
                          <tr>
                            <td>
                              <img src="../assets/images/faces/face5.jpg" class="mr-2" alt="image" /> Ina Curry </td>
                            <td>
                              <div class="d-flex">
                                <span class="pr-2 d-flex align-items-center">44%</span>
                                <select id="star-4" name="rating" autocomplete="off">
                                  <option value="1">1</option>
                                  <option value="2">2</option>
                                  <option value="3">3</option>
                                  <option value="4">4</option>
                                  <option value="5">5</option>
                                </select>
                              </div>
                            </td>
                            <td>53462</td>
                            <td>1,75938</td>
                          </tr>
                          <tr>
                            <td>
                              <img src="../assets/images/faces/face7.jpg" class="mr-2" alt="image" /> Lida Fitzgerald </td>
                            <td>
                              <div class="d-flex">
                                <span class="pr-2 d-flex align-items-center">65%</span>
                                <select id="star-5" name="rating" autocomplete="off">
                                  <option value="1">1</option>
                                  <option value="2">2</option>
                                  <option value="3">3</option>
                                  <option value="4">4</option>
                                  <option value="5">5</option>
                                </select>
                              </div>
                            </td>
                            <td>67453</td>
                            <td>765377</td>
                          </tr>
                          <tr>
                            <td>
                              <img src="../assets/images/faces/face2.jpg" class="mr-2" alt="image" /> Stella Johnson </td>
                            <td>
                              <div class="d-flex">
                                <span class="pr-2 d-flex align-items-center">49%</span>
                                <select id="star-6" name="rating" autocomplete="off">
                                  <option value="1">1</option>
                                  <option value="2">2</option>
                                  <option value="3">3</option>
                                  <option value="4">4</option>
                                  <option value="5">5</option>
                                </select>
                              </div>
                            </td>
                            <td>43662</td>
                            <td>96535</td>
                          </tr>
                          <tr>
                            <td>
                              <img src="../assets/images/faces/face9.jpg" class="mr-2" alt="image" /> Maria Ortiz </td>
                            <td>
                              <div class="d-flex">
                                <span class="pr-2 d-flex align-items-center">65%</span>
                                <select id="star-7" name="rating" autocomplete="off">
                                  <option value="1">1</option>
                                  <option value="2">2</option>
                                  <option value="3">3</option>
                                  <option value="4">4</option>
                                  <option value="5">5</option>
                                </select>
                              </div>
                            </td>
                            <td>76555</td>
                            <td>258546</td>
                          </tr>
                        </tbody>
                      </table>
                    </div>
                    <a class="text-black font-13 d-block pt-2 pb-2 pb-lg-0 font-weight-bold pl-4" href="#">Show more</a>
                  </div>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-sm-12 stretch-card grid-margin">
                <div class="card">
                  <div class="row">
                    <div class="col-md-4">
                      <div class="card border-0">
                        <div class="card-body">
                          <div class="card-title">Channel Sessions</div>
                          <div class="d-flex flex-wrap">
                            <div class="doughnut-wrapper w-50">
                              <canvas id="doughnutChart1" width="100" height="100"></canvas>
                            </div>
                            <div id="doughnut-chart-legend" class="pl-lg-3 rounded-legend align-self-center flex-grow legend-vertical legend-bottom-left"></div>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="col-md-4">
                      <div class="card border-0">
                        <div class="card-body">
                          <div class="card-title">News Sessions</div>
                          <div class="d-flex flex-wrap">
                            <div class="doughnut-wrapper w-50">
                              <canvas id="doughnutChart2" width="100" height="100"></canvas>
                            </div>
                            <div id="doughnut-chart-legend2" class="pl-lg-3 rounded-legend align-self-center flex-grow legend-vertical legend-bottom-left"></div>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="col-md-4">
                      <div class="card border-0">
                        <div class="card-body">
                          <div class="card-title">Device Sessions</div>
                          <div class="d-flex flex-wrap">
                            <div class="doughnut-wrapper w-50">
                              <canvas id="doughnutChart3" width="100" height="100"></canvas>
                            </div>
                            <div id="doughnut-chart-legend3" class="pl-lg-3 rounded-legend align-self-center flex-grow legend-vertical legend-bottom-left"></div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-sm-6 col-xl-4 stretch-card grid-margin">
                <div class="card">
                  <div class="card-body">
                    <div class="card-title mb-2">Upcoming events (3)</div>
                    <h3 class="mb-3">23 september 2019</h3>
                    <div class="d-flex border-bottom border-top py-3">
                      <div class="form-check">
                        <label class="form-check-label">
                          <input type="checkbox" class="form-check-input" checked /></label>
                      </div>
                      <div class="pl-2">
                        <span class="font-12 text-muted">Tue, Mar 5, 9.30am</span>
                        <p class="m-0 text-black"> Hey I attached some new PSD files… </p>
                      </div>
                    </div>
                    <div class="d-flex border-bottom py-3">
                      <div class="form-check">
                        <label class="form-check-label">
                          <input type="checkbox" class="form-check-input" /></label>
                      </div>
                      <div class="pl-2">
                        <span class="font-12 text-muted">Mon, Mar 11, 4.30 PM</span>
                        <p class="m-0 text-black"> Discuss performance with manager </p>
                      </div>
                    </div>
                    <div class="d-flex border-bottom py-3">
                      <div class="form-check">
                        <label class="form-check-label">
                          <input type="checkbox" class="form-check-input" /></label>
                      </div>
                      <div class="pl-2">
                        <span class="font-12 text-muted">Tue, Mar 5, 9.30am</span>
                        <p class="m-0 text-black">Meeting with Alisa</p>
                      </div>
                    </div>
                    <div class="d-flex pt-3">
                      <div class="form-check">
                        <label class="form-check-label">
                          <input type="checkbox" class="form-check-input" /></label>
                      </div>
                      <div class="pl-2">
                        <span class="font-12 text-muted">Mon, Mar 11, 4.30 PM</span>
                        <p class="m-0 text-black"> Hey I attached some new PSD files… </p>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-sm-6 col-xl-4 stretch-card grid-margin">
                <div class="card">
                  <div class="card-body">
                    <div class="d-flex border-bottom mb-4 pb-2">
                      <div class="hexagon">
                        <div class="hex-mid hexagon-warning">
                          <i class="mdi mdi-clock-outline"></i>
                        </div>
                      </div>
                      <div class="pl-4">
                        <h4 class="font-weight-bold text-warning mb-0"> 12.45 </h4>
                        <h6 class="text-muted">Schedule Meeting</h6>
                      </div>
                    </div>
                    <div class="d-flex border-bottom mb-4 pb-2">
                      <div class="hexagon">
                        <div class="hex-mid hexagon-danger">
                          <i class="mdi mdi-account-outline"></i>
                        </div>
                      </div>
                      <div class="pl-4">
                        <h4 class="font-weight-bold text-danger mb-0">34568</h4>
                        <h6 class="text-muted">Profile visits</h6>
                      </div>
                    </div>
                    <div class="d-flex border-bottom mb-4 pb-2">
                      <div class="hexagon">
                        <div class="hex-mid hexagon-success">
                          <i class="mdi mdi-laptop-chromebook"></i>
                        </div>
                      </div>
                      <div class="pl-4">
                        <h4 class="font-weight-bold text-success mb-0"> 33.50% </h4>
                        <h6 class="text-muted">Bounce Rate</h6>
                      </div>
                    </div>
                    <div class="d-flex border-bottom mb-4 pb-2">
                      <div class="hexagon">
                        <div class="hex-mid hexagon-info">
                          <i class="mdi mdi-clock-outline"></i>
                        </div>
                      </div>
                      <div class="pl-4">
                        <h4 class="font-weight-bold text-info mb-0">12.45</h4>
                        <h6 class="text-muted">Schedule Meeting</h6>
                      </div>
                    </div>
                    <div class="d-flex">
                      <div class="hexagon">
                        <div class="hex-mid hexagon-primary">
                          <i class="mdi mdi-timer-sand"></i>
                        </div>
                      </div>
                      <div class="pl-4">
                        <h4 class="font-weight-bold text-primary mb-0"> 12.45 </h4>
                        <h6 class="text-muted mb-0">Browser Usage</h6>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-sm-6 col-xl-4 stretch-card grid-margin">
                <div class="card color-card-wrapper">
                  <div class="card-body">
                    <img class="img-fluid card-top-img w-100" src="../assets/images/dashboard/img_5.jpg" alt="" />
                    <div class="d-flex flex-wrap justify-content-around color-card-outer">
                      <div class="col-6 p-0 mb-4">
                        <div class="color-card primary m-auto">
                          <i class="mdi mdi-clock-outline"></i>
                          <p class="font-weight-semibold mb-0">Delivered</p>
                          <span class="small">15 Packages</span>
                        </div>
                      </div>
                      <div class="col-6 p-0 mb-4">
                        <div class="color-card bg-success m-auto">
                          <i class="mdi mdi-tshirt-crew"></i>
                          <p class="font-weight-semibold mb-0">Ordered</p>
                          <span class="small">72 Items</span>
                        </div>
                      </div>
                      <div class="col-6 p-0">
                        <div class="color-card bg-info m-auto">
                          <i class="mdi mdi-trophy-outline"></i>
                          <p class="font-weight-semibold mb-0">Arrived</p>
                          <span class="small">34 Upgraded</span>
                        </div>
                      </div>
                      <div class="col-6 p-0">
                        <div class="color-card bg-danger m-auto">
                          <i class="mdi mdi-presentation"></i>
                          <p class="font-weight-semibold mb-0">Reported</p>
                          <span class="small">72 Support</span>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>-->
                <!-- content-wrapper ends -->
                <!-- partial:partials/_footer.html -->
                <!--<footer class="footer">
            <div class="d-sm-flex justify-content-center justify-content-sm-between">
              <span class="text-muted d-block text-center text-sm-left d-sm-inline-block">Copyright © bootstrapdash.com 2020</span>
              <span class="float-none float-sm-right d-block mt-1 mt-sm-0 text-center"> Free <a href="https://www.bootstrapdash.com/" target="_blank">Bootstrap dashboard templates</a> from Bootstrapdash.com</span>
            </div>
          </footer>-->
                <!-- partial -->
            </div>

            <!-- main-panel ends -->
        </div>
        <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <form action="" class="deleteForm" method="post">
                        @csrf
                        @method("DELETE")
                        <div class="modal-body">
                            <h5 class="modal-title" id="exampleModalLabel">¿Esta seguro de eliminar?</h5>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
                            <button type="submit" class="btn btn-success">Si</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="modal fade" id="deleteAjaxModal" tabindex="-1"  data-backdrop="static" data-keyboard="false" role="dialog"
            aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                        <div class="modal-body">
                            <h5 class="modal-title" id="exampleModalLabel">¿Esta seguro de eliminar?</h5>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
                            <button type="submit" class="btn btn-success acceptAjaxDelete">
                              <span class="spinner-border spinner-border-sm d-none" role="status" aria-hidden="true"></span>
                              <span class="text">Si</span>
                            </button>
                        </div>
                </div>
            </div>
        </div>

        <div class="modal fade" id="brachSelectModal" data-backdrop="static" data-keyboard="false" tabindex="-1"
            role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLongTitle">Seleccionar sucursal</h5>
                    </div>
                    <div class="modal-body">
                        @if (Auth::user()->restaurant->branches->count() > 0)
                            <p>Selecciona un sucursal para poder configurar los catálogos del sistema.</p>
                            <div class="form-group">
                                <select name="branchD" id="" class="form-control">
                                    <option value="">Seleccionar sucursal</option>
                                    @foreach (Auth::user()->restaurant->branches as $branchD)
                                        <option value="{{ $branchD->id }}">{{ $branchD->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        @else
                            <p class="text-center">Aun no has registrado sucursales.</p>
                            <p class="text-center">
                                <a href="{{ url('/panel/sucursales/create') }}" class="btn btn-primary">Nueva
                                    sucursal</a>
                            </p>
                        @endif
                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade" id="QRModal" tabindex="-1"
            role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-body text-center">                        
                    </div>
                </div>
            </div>
        </div>
        <!-- page-body-wrapper ends -->
    </div>
    <!-- container-scroller -->
    <!-- plugins:js -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"
        integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"
        integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.min.js"
        integrity="sha384-+YQ4JLhjyBLPDQt//I+STsc9iw4uQqACwlvpslubQzn4u2UU2UFM80nGisd026JF" crossorigin="anonymous">
    </script>
    <script src="{{ asset('css/vendors/js/vendor.bundle.base.js') }}"></script>
    <!-- endinject -->
    <!-- Plugin js for this page -->
    <script src="{{ asset('css/vendors/jquery-bar-rating/jquery.barrating.min.js') }}"></script>
    <script src="{{ asset('css/vendors/chart.js/Chart.min.js') }}"></script>
    <script src="{{ asset('css/vendors/flot/jquery.flot.js') }}"></script>
    <script src="{{ asset('css/vendors/flot/jquery.flot.resize.js') }}"></script>
    <script src="{{ asset('css/vendors/flot/jquery.flot.categories.js') }}"></script>
    <script src="{{ asset('css/vendors/flot/jquery.flot.fillbetween.js') }}"></script>
    <script src="{{ asset('css/vendors/flot/jquery.flot.stack.js') }}"></script>
    <!-- End plugin js for this page -->
    <!-- inject:js -->
    <script src="{{ asset('/js/off-canvas.js') }}"></script>
    <script src="{{ asset('/js/hoverable-collapse.js') }}"></script>
    <script src="{{ asset('/js/misc.js') }}"></script>
    <script src="{{ asset('/js/settings.js') }}"></script>
    <script src="{{ asset('/js/todolist.js') }}"></script>
    <script src="{{ asset('js/tata.js') }}"></script>
    <!-- endinject -->
    <!-- Custom js for this page -->
    <script src="{{ asset('/js/dashboard.js') }}"></script>

    @yield('scripts')
    <script>
      let urlDelete = '';
        $(document).on('click', '#dd', function() {
            $(this).addClass('active');
            return false;
        })

        $(document).on('click', '#dd a', function() {
            window.location.href = $(this).attr('href')
        })

        function DropDown(el) {
            this.dd = el;
            this.placeholder = this.dd.children('span');
            this.opts = this.dd.find('ul.dropdown > li');
            this.val = '';
            this.index = -1;
            this.initEvents();
        }
        DropDown.prototype = {
            initEvents: function() {
                var obj = this;
            }
        }

        $(document).ready(function() {

            @if (!session()->exists('branch') && \Request::getRequestUri() !== '/panel/sucursales/create')
                $('#brachSelectModal').modal()
            @endif

            var dd = new DropDown($('#dd'));

            $(document).click(function() {
                // all dropdowns
                $('.wrapper-dropdown-1').removeClass('active');
            });

            $(document).on('change', 'select[name="branchD"]', function() {
                window.location.href = "{{ url('/panel/cambiar-sucursal') }}/" + $(this)
                    .val()
            })
        })
    </script>
    <!-- End custom js for this page -->
</body>

</html>
