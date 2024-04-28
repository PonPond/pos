<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>
        POS SYSTEM
    </title>
    <!--     Fonts and icons     -->
    <link rel="stylesheet" type="text/css"
        href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700,900|Roboto+Slab:400,700" />
    <!-- Nucleo Icons -->
    <link href="../assets/css/nucleo-icons.css" rel="stylesheet" />
    <link href="../assets/css/nucleo-svg.css" rel="stylesheet" />
    <!-- Font Awesome Icons -->
    <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>

    <!-- Material Icons -->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Round" rel="stylesheet">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>

    <!-- CSS Files -->
    <link id="pagestyle" href="../assets/css/material-dashboard.css?v=3.0.4" rel="stylesheet" />
    <link rel="stylesheet" type="text/css"
        href="https://cdn.datatables.net/v/bs5/jq-3.6.0/dt-1.12.1/datatables.min.css" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Prompt:wght@100&display=swap" rel="stylesheet">

</head>

<body class="g-sidenav-show  bg-gray-400">
    <style>
        * {
            font-family: 'Prompt', sans-serif;
            font-weight: 1000;


        }
    </style>
    <aside
        class="sidenav navbar navbar-vertical navbar-expand-xs border-0 border-radius-xl my-3 fixed-start ms-3   bg-gradient-dark"
        id="sidenav-main">
        <div class="sidenav-header">
            <i class="fas fa-times p-3 cursor-pointer text-white opacity-5 position-absolute end-0 top-0 d-none d-xl-none"
                aria-hidden="true" id="iconSidenav"></i>
            <a class="navbar-brand m-0" href=" https://demos.creative-tim.com/material-dashboard/pages/dashboard "
                target="_blank">
                <span class="ms-1 font-weight-bold text-white">POS SYSTEM</span>
            </a>
        </div>
        <hr class="horizontal light mt-0 mb-2">
        <div class="collapse navbar-collapse  w-auto h-auto " id="sidenav-collapse-main">
            <ul class="navbar-nav">
                @if (request()->routeIs('dashboard'))
                    <li class="nav-item">
                        <a class="nav-link text-white active bg-gradient-success" href="{{ route('dashboard') }}">
                            <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                                <i class="material-icons opacity-10">dashboard</i>
                            </div>
                            <span class="nav-link-text ms-1">Dashboard</span>
                        </a>
                    </li>
                @else
                    <li class="nav-item">
                        <a class="nav-link text-white " href="{{ route('dashboard') }}">
                            <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                                <i class="material-icons opacity-10">dashboard</i>
                            </div>
                            <span class="nav-link-text ms-1">Dashboard</span>
                        </a>
                    </li>
                @endif


                @if (request()->routeIs('mo'))
                    <li class="nav-item">
                        <a class="nav-link text-white active bg-gradient-success " href="{{ route('mo') }}"
                            target="_blank">
                            <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                                <i class="material-icons opacity-10">shopping_cart</i>
                            </div>
                            <span class="nav-link-text ms-1">จอแสดงผลการขาย</span>
                        </a>
                    </li>
                @else
                    <li class="nav-item">
                        <a class="nav-link text-white " href="{{ route('mo') }}" target="_blank">
                            <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                                <i class="material-icons opacity-10">shopping_cart</i>
                            </div>
                            <span class="nav-link-text ms-1">จอแสดงผลการขาย</span>
                        </a>
                    </li>
                @endif


                @if (request()->routeIs('shopP'))
                    <li class="nav-item">
                        <a class="nav-link text-white active bg-gradient-success " href="{{ route('shopP') }}">
                            <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                                <i class="material-icons opacity-10">shopping_cart</i>
                            </div>
                            <span class="nav-link-text ms-1">ระบบขายปลีก</span>
                        </a>
                    </li>
                @else
                    <li class="nav-item">
                        <a class="nav-link text-white " href="{{ route('shopP') }}">
                            <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                                <i class="material-icons opacity-10">shopping_cart</i>
                            </div>
                            <span class="nav-link-text ms-1">ระบบขายปลีก</span>
                        </a>
                    </li>
                @endif

                @if (request()->routeIs('shopS'))
                    <li class="nav-item">
                        <a class="nav-link text-white active bg-gradient-success " href="{{ route('shopS') }}">
                            <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                                <i class="material-icons opacity-10">shopping_cart</i>
                            </div>
                            <span class="nav-link-text ms-1">ระบบขายส่ง</span>
                        </a>
                    </li>
                @else
                    <li class="nav-item">
                        <a class="nav-link text-white " href="{{ route('shopS') }}">
                            <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                                <i class="material-icons opacity-10">shopping_cart</i>
                            </div>
                            <span class="nav-link-text ms-1">ระบบขายส่ง</span>
                        </a>
                    </li>
                @endif
                <li class="nav-item mt-3">
                    <h6 class="ps-4 ms-2 text-uppercase text-xs text-white font-weight-bolder opacity-8">ประวัติการขาย
                    </h6>
                </li>

                @if (request()->routeIs('listindex'))
                    <li class="nav-item">
                        <a class="nav-link text-white active bg-gradient-success " href="{{ route('listindex') }}">
                            <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                                <i class="material-icons opacity-10">folder_open</i>
                            </div>
                            <span class="nav-link-text ms-1 ">ประวัติการขายปลีก</span>
                        </a>
                    </li>
                @else
                    <li class="nav-item">
                        <a class="nav-link text-white " href="{{ route('listindex') }}">
                            <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                                <i class="material-icons opacity-10">folder_open</i>
                            </div>
                            <span class="nav-link-text ms-1">ประวัติการขายปลีก</span>
                        </a>
                    </li>
                @endif

                @if (request()->routeIs('listindexs'))
                    <li class="nav-item">
                        <a class="nav-link text-white active bg-gradient-success " href="{{ route('listindexs') }}">
                            <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                                <i class="material-icons opacity-10">folder_open</i>
                            </div>
                            <span class="nav-link-text ms-1 ">ประวัติการขายส่ง</span>
                        </a>
                    </li>
                @else
                    <li class="nav-item">
                        <a class="nav-link text-white " href="{{ route('listindexs') }}">
                            <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                                <i class="material-icons opacity-10">folder_open</i>
                            </div>
                            <span class="nav-link-text ms-1">ประวัติการขายส่ง</span>
                        </a>
                    </li>
                @endif


                <li class="nav-item mt-3">
                    <h6 class="ps-4 ms-2 text-uppercase text-xs text-white font-weight-bolder opacity-8">จัดการสินค้า
                    </h6>
                </li>

                @if (request()->routeIs('product.index'))
                    <li class="nav-item">
                        <a class="nav-link text-white active bg-gradient-success "
                            href="{{ route('product.index') }}">
                            <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                                <i class="material-icons opacity-10">add_shopping_cart</i>
                            </div>
                            <span class="nav-link-text ms-1 ">สินค้า</span>
                        </a>
                    </li>
                @else
                    <li class="nav-item">
                        <a class="nav-link text-white " href="{{ route('product.index') }}">
                            <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                                <i class="material-icons opacity-10">add_shopping_cart</i>
                            </div>
                            <span class="nav-link-text ms-1">สินค้า</span>
                        </a>
                    </li>
                @endif

                @if (request()->routeIs('product.category'))
                    <li class="nav-item">
                        <a class="nav-link text-white active bg-gradient-success "
                            href="{{ route('product.category') }}">
                            <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                                <i class="material-icons opacity-10">category</i>
                            </div>
                            <span class="nav-link-text ms-1">จัดการประเภทสินค้า</span>
                        </a>
                    </li>
                @else
                    <li class="nav-item">
                        <a class="nav-link text-white " href="{{ route('product.category') }}">
                            <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                                <i class="material-icons opacity-10">category</i>
                            </div>
                            <span class="nav-link-text ms-1">จัดการประเภทสินค้า</span>
                        </a>
                    </li>
                @endif

                @if (request()->routeIs('refund.index'))
                    <li class="nav-item">
                        <a class="nav-link text-white active bg-gradient-success "
                            href="{{ route('refund.index') }}">
                            <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                                <i class="material-icons opacity-10">category</i>
                            </div>
                            <span class="nav-link-text ms-1">คืนสินค้า</span>
                        </a>
                    </li>
                @else
                    <li class="nav-item">
                        <a class="nav-link text-white " href="{{ route('refund.index') }}">
                            <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                                <i class="material-icons opacity-10">category</i>
                            </div>
                            <span class="nav-link-text ms-1">คืนสินค้า</span>
                        </a>
                    </li>
                @endif

                <li class="nav-item mt-3">
                    <h6 class="ps-4 ms-2 text-uppercase text-xs text-white font-weight-bolder opacity-8">จัดการหนี้
                    </h6>
                </li>

                @if (request()->routeIs('debtors.index'))
                    <li class="nav-item">
                        <a class="nav-link text-white active bg-gradient-success "
                            href="{{ route('product.category') }}">
                            <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                                <i class="material-icons opacity-10">group</i>
                            </div>
                            <span class="nav-link-text ms-1">จัดการข้อมูลลูกหนี้</span>
                        </a>
                    </li>
                @else
                    <li class="nav-item">
                        <a class="nav-link text-white " href="{{ route('debtors.index') }}">
                            <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                                <i class="material-icons opacity-10">group</i>
                            </div>
                            <span class="nav-link-text ms-1">จัดการข้อมูลลูกหนี้</span>
                        </a>
                    </li>
                @endif



                @if (Auth::user()->role == 1)

                    <li class="nav-item mt-3">
                        <h6 class="ps-4 ms-2 text-uppercase text-xs text-white font-weight-bolder opacity-8">
                            จัดพนักงานขาย
                        </h6>
                    </li>

                    @if (request()->routeIs('user.index'))
                        <li class="nav-item">
                            <a class="nav-link text-white active bg-gradient-success "
                                href="{{ route('product.category') }}">
                                <div
                                    class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                                    <i class="material-icons opacity-10">group</i>
                                </div>
                                <span class="nav-link-text ms-1">ข้อมูลพนักงานขาย</span>
                            </a>
                        </li>
                    @else
                        <li class="nav-item">
                            <a class="nav-link text-white " href="{{ route('user.index') }}">
                                <div
                                    class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                                    <i class="material-icons opacity-10">group</i>
                                </div>
                                <span class="nav-link-text ms-1">ข้อมูลพนักงานขาย</span>
                            </a>
                        </li>
                    @endif
                    <li class="nav-item mt-3">
                        <h6 class="ps-4 ms-2 text-uppercase text-xs text-white font-weight-bolder opacity-8">สถิติ
                        </h6>
                    </li>

                    @if (request()->routeIs('dash1'))
                        <li class="nav-item">
                            <a class="nav-link text-white active bg-gradient-success " href="{{ route('dash1') }}">
                                <div
                                    class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                                    <i class="material-icons opacity-10">group</i>
                                </div>
                                <span class="nav-link-text ms-1">สถิติการขาย</span>
                            </a>
                        </li>
                    @else
                        <li class="nav-item">
                            <a class="nav-link text-white " href="{{ route('dash1') }}">
                                <div
                                    class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                                    <i class="material-icons opacity-10">group</i>
                                </div>
                                <span class="nav-link-text ms-1">สถิติการขาย</span>
                            </a>
                        </li>
                    @endif

                @endif
            </ul>
        </div>
        <div class="sidenav-footer position-absolute w-100 bottom-0 ">
            <div class="mx-3">
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <a class=" btn bg-gradient-success mt-4 w-100 " href="{{ route('logout') }}"
                        onclick="event.preventDefault();
            this.closest('form').submit();">
                        ออกจากระบบ
                    </a>
                </form>
            </div>
        </div>
    </aside>
    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
        <!-- Navbar -->
        <nav class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl" id="navbarBlur"
            data-scroll="true">
            <div class="container-fluid py-1 px-3">

                <div class="collapse navbar-collapse mt-sm-0 mt-2 me-md-0 me-sm-4" id="navbar">

                    <ul class="navbar-nav  justify-content-end">


                        <li class="nav-item d-xl-none ps-3 d-flex align-items-center">
                            <a href="javascript:;" class="nav-link text-body p-0" id="iconNavbarSidenav">
                                <div class="sidenav-toggler-inner">
                                    <i class="sidenav-toggler-line"></i>
                                    <i class="sidenav-toggler-line"></i>
                                    <i class="sidenav-toggler-line"></i>
                                </div>
                            </a>
                        </li>


                    </ul>
                    </li>
                    </ul>
                </div>
            </div>
        </nav>
        <!-- End Navbar -->
        <div class="container-fluid py-4">
            <div class="row">

                @include('include.content')

            </div>
    </main>

    <!--   Core JS Files   -->
    <script src="../assets/js/core/popper.min.js"></script>
    <script src="../assets/js/core/bootstrap.min.js"></script>
    <script src="../assets/js/plugins/perfect-scrollbar.min.js"></script>
    <script src="../assets/js/plugins/smooth-scrollbar.min.js"></script>
    <script src="../assets/js/plugins/chartjs.min.js"></script>

    <script>
        var win = navigator.platform.indexOf('Win') > -1;
        if (win && document.querySelector('#sidenav-scrollbar')) {
            var options = {
                damping: '0.5'
            }
            Scrollbar.init(document.querySelector('#sidenav-scrollbar'), options);
        }
    </script>
    <!-- Github buttons -->
    <script async defer src="https://buttons.github.io/buttons.js"></script>
    <script src="{{ mix('js/app.js') }}"></script>

    <!-- Control Center for Material Dashboard: parallax effects, scripts for the example pages etc -->
    <script type="text/javascript" src="https://cdn.datatables.net/v/bs5/jq-3.6.0/dt-1.12.1/datatables.min.js"></script>

    @stack('scripts')
</body>

</html>
