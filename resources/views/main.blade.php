<!DOCTYPE html>
<html dir="ltr" lang="en">
<head>

    @include('layout.include-header')
    @vite(['resources/js/app.js', 'resources/css/app.css'])
</head>


<body>
    @include('layout.loading-animation')

    <div id="main-wrapper" data-layout="vertical" data-navbarbg="skin5" data-sidebartype="full"
        data-sidebar-position="absolute" data-header-position="absolute" data-boxed-layout="full">
        <!-- ============================================================== -->
        @include('layout.header')
        @include('layout.nav')

        <div class="page-wrapper">

            <!-- ============================================================== -->
            <!-- Bread crumb and right sidebar toggle -->
            <!-- ============================================================== -->
            <div class="page-breadcrumb">
                <div class="row align-items-center">
                    <div class="col-6">
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb mb-0 d-flex align-items-center">
                              <li class="breadcrumb-item"><a href="#" class="link"><i class="mdi mdi-home-outline fs-4"></i></a></li>
                              <li class="breadcrumb-item active" aria-current="page" id="breadcrumb-text">
                                @if(Route::currentRouteName() == 'dashboard')
                                    Dashboard
                                @elseif(Route::currentRouteName() == 'product')
                                    Product
                                @elseif(Route::currentRouteName() == 'user')
                                     User
                                @elseif(Route::currentRouteName() == 'sales')
                                     sales
                                @else
                                    Halaman Tidak Diketahui
                                @endif
                              </li>
                            </ol>
                          </nav>
                          <h1 class="mb-0 fw-bold" id="page-title"></h1>
                    </div>
                </div>
            </div>
            <script>
                document.addEventListener("DOMContentLoaded", function () {
                  const breadcrumbText = document.getElementById("breadcrumb-text").innerText;
                  document.getElementById("page-title").innerText = breadcrumbText;
                });
              </script>
            <div class="container-fluid">
                @yield('content')
            </div>
            @include('layout.footer')
        </div>

    </div>

    @include('layout.include-footer')
    @stack('script')
</body>

</html>
