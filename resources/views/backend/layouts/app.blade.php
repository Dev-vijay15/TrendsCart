<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <title>TrendsCart</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta charset="utf-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="author" content="themesflat.com">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <link rel="stylesheet" type="text/css" href="{{ asset('backend/assets/css/animate.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('backend/assets/css/animation.css ') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('backend/assets/css/bootstrap.css ') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('backend/assets/css/bootstrap-select.min.css ') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('backend/assets/css/style.css ') }}">
    {{-- <link rel="stylesheet" href="{{asset('backend/assets/font/fonts.css ') }}"> --}}
    <link rel="stylesheet" href="{{ asset('backend/assets/icon/style.css ') }}">
    <link rel="shortcut icon" href="{{ asset('backend/assets/images/favicon.ico ') }}">
    <link rel="apple-touch-icon-precomposed" href="{{ asset('backend/assets/images/favicon3.png ') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('backend/assets/css/sweetalert.min.css ') }}">
    <link href="https://cdn.jsdelivr.net/npm/toastr@2.1.4/build/toastr.min.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="{{ asset('backend/assets/css/custom.css ') }}">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
    @yield('styles')
    <style>
        .toast {
            font-size: 15px !important;
            /* Smaller font size */
            max-width: 450px !important;
            /* Set a max width for the message box */
        }
        
    </style>


</head>

<body class="body">
    <div id="wrapper">
        <div id="page" class="">
            <div class="layout-wrap">

                {{-- <div id="preload" class="preload-container">
                    <div class="preloading">
                        <span></span>
                    </div>
                </div> --}}

                <div class="section-menu-left">
                    <div class="box-logo">
                        <a href="index.html" id="site-logo-inner">
                            <img class="" id="logo_header" alt=""
                                src="{{ asset('backend/assets/images/logo/trendscart.png') }}"
                                data-light="images/logo/logo.png" data-dark="images/logo/logo.png">

                        </a>
                        <div class="button-show-hide">
                            <i class="icon-menu-left"></i>
                        </div>
                    </div>
                    <div class="center">
                        <div class="center-item">
                            <div class="center-heading">Main Home</div>
                            <ul class="menu-list">
                                <li class="menu-item">
                                    <a href="{{ route('admin.dashboard') }}" class="">
                                        <div class="icon"><i class="icon-grid"></i></div>
                                        <div class="text">Dashboard</div>
                                    </a>
                                </li>
                            </ul>
                        </div>
                        <div class="center-item">
                            <ul class="menu-list">

                                <li class="menu-item has-children">
                                    @can('read users management')
                                        <a href="javascript:void(0);" class="menu-item-button">
                                            <div><img src="{{ asset('backend\assets\icon\user.png') }}" alt="Example Image"
                                                    style="height:18px"></div>
                                            <div class="text">Users</div>
                                        </a>
                                    @endcan

                                    <ul class="sub-menu">
                                        @can('read users')
                                            <li class="sub-menu-item">
                                                <a href="{{ route('users.list') }}" class="">
                                                    <div class="text"> Users List</div>
                                                </a>
                                            </li>
                                        @endcan

                                        @can('create users')
                                            <li class="sub-menu-item">
                                                <a href="{{ route('users.create') }}" class="">
                                                    <div class="text">Add Users</div>
                                                </a>
                                            </li>
                                        @endcan
                                    </ul>
                                </li>
                                <li class="menu-item has-children">
                                    <a href="javascript:void(0);" class="menu-item-button">
                                        <div><img src="{{ asset('backend\assets\icon\role-permissions2.png') }}"
                                                alt="Example Image" style="height:20px"></div>
                                        <div class="text">permission</div>
                                    </a>
                                    <ul class="sub-menu">
                                        @can('read permissions')
                                            <li class="sub-menu-item">
                                                <a href="{{ route('permission.list') }}" class="">
                                                    <div class="text"> permission</div>
                                                </a>
                                            </li>
                                        @endcan
                                        @can('create permissions')
                                            <li class="sub-menu-item">
                                                <a href="{{ route('permission.create') }}" class="">
                                                    <div class="text">Add Permission</div>
                                                </a>
                                            </li>
                                        @endcan
                                    </ul>
                                </li>
                                <li class="menu-item has-children">
                                    <a href="javascript:void(0);" class="menu-item-button">
                                        <div><img src="{{ asset('backend\assets\icon\role.png') }}"
                                                alt="Example Image" style="height:20px"></div>
                                        <div class="text">Role</div>
                                    </a>
                                    <ul class="sub-menu">
                                        @can('read roles')
                                            <li class="sub-menu-item">
                                                <a href="{{ route('role.list') }}" class="">
                                                    <div class="text"> Role</div>
                                                </a>
                                            </li>
                                        @endcan

                                        @can('create roles')
                                            <li class="sub-menu-item">
                                                <a href="{{ route('role.create') }}" class="">
                                                    <div class="text">Add Role</div>
                                                </a>
                                            </li>
                                        @endcan
                                    </ul>
                                </li>
                                <li class="menu-item has-children">
                                    <a href="javascript:void(0);" class="menu-item-button">
                                        <div><img src="{{ asset('backend\assets\icon\brand.png') }}"
                                                alt="Example Image" style="height:22px ;"></div>
                                        <div class="text">Brands</div>
                                    </a>
                                    <ul class="sub-menu">
                                        @can('read brands')
                                            <li class="sub-menu-item">
                                                <a href="{{ route('brands.list') }}" class="">
                                                    <div class="text">Brand List</div>
                                                </a>
                                            @endcan
                                        </li>
                                        @can('create brands')
                                            <li class="sub-menu-item">
                                                <a href="{{ route('brands.create') }}" class="">
                                                    <div class="text">Add Brands</div>
                                                </a>
                                            </li>
                                        @endcan

                                    </ul>
                                </li>
                                <li class="menu-item has-children">
                                    <a href="javascript:void(0);" class="menu-item-button">
                                        <div class="icon"><i class="icon-layers"></i></div>
                                        <div class="text">Category</div>
                                    </a>
                                    <ul class="sub-menu">
                                        <li class="sub-menu-item">
                                            <a href="{{ route('products.create') }}" class="">
                                                <div class="text">New Category</div>
                                            </a>
                                        </li>
                                        <li class="sub-menu-item">
                                            <a href="{{ route('products.create') }}" class="">
                                                <div class="text">Categories</div>
                                            </a>
                                        </li>
                                    </ul>
                                </li>
                                <li class="menu-item has-children">
                                    <a href="javascript:void(0);" class="menu-item-button">
                                        <div class="icon"><i class="icon-shopping-cart"></i></div>
                                        <div class="text">Products</div>
                                    </a>
                                    <ul class="sub-menu">

                                        @can('read products')
                                            <li class="sub-menu-item">
                                                <a href="{{ route('products.list') }}" class="">
                                                    <div class="text"> Product</div>
                                                </a>
                                            </li>
                                        @endcan
                                        @can('create products')
                                            <li class="sub-menu-item">
                                                <a href="{{ route('products.create') }}" class="">
                                                    <div class="text">Add Products</div>
                                                </a>
                                            </li>
                                        @endcan
                                    </ul>
                                </li>



                                <li class="menu-item has-children">
                                    <a href="javascript:void(0);" class="menu-item-button">
                                        <div class="icon"><i class="icon-file-plus"></i></div>
                                        <div class="text">Order</div>
                                    </a>
                                    <ul class="sub-menu">
                                        <li class="sub-menu-item">
                                            <a href="orders.html" class="">
                                                <div class="text">Orders</div>
                                            </a>
                                        </li>
                                        <li class="sub-menu-item">
                                            <a href="order-tracking.html" class="">
                                                <div class="text">Order tracking</div>
                                            </a>
                                        </li>
                                    </ul>
                                </li>
                                <li class="menu-item">
                                    <a href="slider.html" class="">
                                        <div class="icon"><i class="icon-image"></i></div>
                                        <div class="text">Slider</div>
                                    </a>
                                </li>
                                <li class="menu-item">
                                    <a href="coupons.html" class="">
                                        <div><img src="{{ asset('backend\assets\icon\coupan.png') }}"
                                                alt="Example Image" style="height:20px"></div>
                                        <div class="text">Coupans</div>
                                    </a>
                                </li>

                                {{-- <li class="menu-item">
                                    <a href="users.html" class="">
                                        <div class="icon"><i class="icon-user"></i></div>
                                        <div class="text">User</div>
                                    </a>
                                </li> --}}

                                <li class="menu-item">
                                    <a href="settings.html" class="">
                                        <div class="icon"><i class="icon-settings"></i></div>
                                        <div class="text">Settings</div>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>

                <div class="section-content-right">

                    <div class="header-dashboard">
                        <div class="wrap">
                            <div class="header-left">
                                <a href="index-2.html">
                                    <img class="" id="logo_header_mobile" alt=""
                                        src="{{ asset('backend/assets/images/logo/logo.png') }}"
                                        data-light="images/logo/logo.png" data-dark="images/logo/logo.png"
                                        data-width="154px" data-height="52px" data-retina="images/logo/logo.png">
                                </a>
                                <div class="button-show-hide">
                                    <i class="icon-menu-left"></i>
                                </div>


                                <form class="form-search flex-grow">
                                    <fieldset class="name">
                                        <input type="text" placeholder="Search here..." class="show-search"
                                            name="name" tabindex="2" value="" aria-required="true"
                                            required="">
                                    </fieldset>
                                    <div class="button-submit">
                                        <button class="" type="submit"><i class="icon-search"></i></button>
                                    </div>
                                    <div class="box-content-search" id="box-content-search">
                                        <ul class="mb-24">
                                            <li class="mb-14">
                                                <div class="body-title">Top selling product</div>
                                            </li>
                                            <li class="mb-14">
                                                <div class="divider"></div>
                                            </li>
                                            <li>
                                                <ul>
                                                    <li class="product-item gap14 mb-10">
                                                        <div class="image no-bg">
                                                            <img src="{{ asset('backend/assets/images/products/17.png') }}"
                                                                alt="">
                                                        </div>
                                                        <div class="flex items-center justify-between gap20 flex-grow">
                                                            <div class="name">
                                                                <a href="product-list.html" class="body-text">Dog Food
                                                                    Rachael Ray Nutrish®</a>
                                                            </div>
                                                        </div>
                                                    </li>
                                                    <li class="mb-10">
                                                        <div class="divider"></div>
                                                    </li>
                                                    <li class="product-item gap14 mb-10">
                                                        <div class="image no-bg">
                                                            <img src="{{ asset('backend/assets/images/products/18.png') }}"
                                                                alt="">
                                                        </div>
                                                        <div class="flex items-center justify-between gap20 flex-grow">
                                                            <div class="name">
                                                                <a href="product-list.html" class="body-text">Natural
                                                                    Dog Food Healthy Dog Food</a>
                                                            </div>
                                                        </div>
                                                    </li>
                                                    <li class="mb-10">
                                                        <div class="divider"></div>
                                                    </li>
                                                    <li class="product-item gap14">
                                                        <div class="image no-bg">
                                                            <img src="{{ asset('backend/assets/images/products/19.png') }}"
                                                                alt="">
                                                        </div>
                                                        <div class="flex items-center justify-between gap20 flex-grow">
                                                            <div class="name">
                                                                <a href="product-list.html" class="body-text">Freshpet
                                                                    Healthy Dog Food and Cat</a>
                                                            </div>
                                                        </div>
                                                    </li>
                                                </ul>
                                            </li>
                                        </ul>
                                        <ul class="">
                                            <li class="mb-14">
                                                <div class="body-title">Order product</div>
                                            </li>
                                            <li class="mb-14">
                                                <div class="divider"></div>
                                            </li>
                                            <li>
                                                <ul>
                                                    <li class="product-item gap14 mb-10">
                                                        <div class="image no-bg">
                                                            <img src="{{ asset('backend/assets/images/products/20.png') }}"
                                                                alt="">
                                                        </div>
                                                        <div class="flex items-center justify-between gap20 flex-grow">
                                                            <div class="name">
                                                                <a href="product-list.html" class="body-text">Sojos
                                                                    Crunchy Natural Grain Free...</a>
                                                            </div>
                                                        </div>
                                                    </li>
                                                    <li class="mb-10">
                                                        <div class="divider"></div>
                                                    </li>
                                                    <li class="product-item gap14 mb-10">
                                                        <div class="image no-bg">
                                                            <img src="{{ asset('backend/assets/images/products/21.png') }}"
                                                                alt="">
                                                        </div>
                                                        <div class="flex items-center justify-between gap20 flex-grow">
                                                            <div class="name">
                                                                <a href="product-list.html" class="body-text">Kristin
                                                                    Watson</a>
                                                            </div>
                                                        </div>
                                                    </li>
                                                    <li class="mb-10">
                                                        <div class="divider"></div>
                                                    </li>
                                                    <li class="product-item gap14 mb-10">
                                                        <div class="image no-bg">
                                                            <img src="{{ asset('backend/assets/images/products/22.png') }}"
                                                                alt="">
                                                        </div>
                                                        <div class="flex items-center justify-between gap20 flex-grow">
                                                            <div class="name">
                                                                <a href="product-list.html" class="body-text">Mega
                                                                    Pumpkin Bone</a>
                                                            </div>
                                                        </div>
                                                    </li>
                                                    <li class="mb-10">
                                                        <div class="divider"></div>
                                                    </li>
                                                    <li class="product-item gap14">
                                                        <div class="image no-bg">
                                                            <img src="{{ asset('backend/assets/images/products/23.png') }}"
                                                                alt="">
                                                        </div>
                                                        <div class="flex items-center justify-between gap20 flex-grow">
                                                            <div class="name">
                                                                <a href="product-list.html" class="body-text">Mega
                                                                    Pumpkin Bone</a>
                                                            </div>
                                                        </div>
                                                    </li>
                                                </ul>
                                            </li>
                                        </ul>
                                    </div>
                                </form>

                            </div>
                            <div class="header-grid">

                                <div class="popup-wrap message type-header">
                                    <div class="dropdown">
                                        <button class="btn btn-secondary dropdown-toggle" type="button"
                                            id="dropdownMenuButton2" data-bs-toggle="dropdown" aria-expanded="false">
                                            <span class="header-item">
                                                <span class="text-tiny">1</span>
                                                <i class="icon-bell"></i>
                                            </span>
                                        </button>
                                        <ul class="dropdown-menu dropdown-menu-end has-content"
                                            aria-labelledby="dropdownMenuButton2">
                                            <li>
                                                <h6>Notifications</h6>
                                            </li>
                                            <li>
                                                <div class="message-item item-1">
                                                    <div class="image">
                                                        <i class="icon-noti-1"></i>
                                                    </div>
                                                    <div>
                                                        <div class="body-title-2">Discount available</div>
                                                        <div class="text-tiny">Morbi sapien massa, ultricies at rhoncus
                                                            at, ullamcorper nec diam</div>
                                                    </div>
                                                </div>
                                            </li>
                                            <li>
                                                <div class="message-item item-2">
                                                    <div class="image">
                                                        <i class="icon-noti-2"></i>
                                                    </div>
                                                    <div>
                                                        <div class="body-title-2">Account has been verified</div>
                                                        <div class="text-tiny">Mauris libero ex, iaculis vitae rhoncus
                                                            et</div>
                                                    </div>
                                                </div>
                                            </li>
                                            <li>
                                                <div class="message-item item-3">
                                                    <div class="image">
                                                        <i class="icon-noti-3"></i>
                                                    </div>
                                                    <div>
                                                        <div class="body-title-2">Order shipped successfully</div>
                                                        <div class="text-tiny">Integer aliquam eros nec sollicitudin
                                                            sollicitudin</div>
                                                    </div>
                                                </div>
                                            </li>
                                            <li>
                                                <div class="message-item item-4">
                                                    <div class="image">
                                                        <i class="icon-noti-4"></i>
                                                    </div>
                                                    <div>
                                                        <div class="body-title-2">Order pending: <span>ID 305830</span>
                                                        </div>
                                                        <div class="text-tiny">Ultricies at rhoncus at ullamcorper
                                                        </div>
                                                    </div>
                                                </div>
                                            </li>
                                            <li><a href="#" class="tf-button w-full">View all</a></li>
                                        </ul>
                                    </div>
                                </div>




                                <div class="popup-wrap user type-header">
                                    <div class="dropdown">
                                        <button class="btn btn-secondary dropdown-toggle" type="button"
                                            id="dropdownMenuButton3" data-bs-toggle="dropdown" aria-expanded="false">
                                            <span class="header-user wg-user">
                                                <span class="image">
                                                    <img src="{{ asset('backend/assets/images/avatar/user-1.png') }}"
                                                        alt="">
                                                </span>
                                                <span class="flex flex-column">
                                                    @if (Auth::guard('admin')->check())
                                                        <!-- Check if the user is logged in -->
                                                        <span class="body-title mb-2">
                                                            {{ Auth::guard('admin')->user()->first_name . ' ' . Auth::guard('admin')->user()->last_name }}
                                                        </span>
                                                        <span
                                                            class="text-tiny">{{ Auth::guard('admin')->user()->role == 1 ? 'Super Admin' : 'Admin' }}</span>
                                                    @else
                                                        <p>You are not logged in.</p>
                                                    @endif
                                                </span>
                                            </span>
                                        </button>
                                        <ul class="dropdown-menu dropdown-menu-end has-content"
                                            aria-labelledby="dropdownMenuButton3">
                                            <li>
                                                <a href="#" class="user-item">
                                                    <div class="icon">
                                                        <i class="icon-user"></i>
                                                    </div>
                                                    <div class="body-title-2">Account</div>
                                                </a>
                                            </li>
                                            <li>
                                                <a href="#" class="user-item">
                                                    <div class="icon">
                                                        <i class="icon-mail"></i>
                                                    </div>
                                                    <div class="body-title-2">Inbox</div>
                                                    <div class="number">27</div>
                                                </a>
                                            </li>
                                            <li>
                                                <a href="#" class="user-item">
                                                    <div class="icon">
                                                        <i class="icon-file-text"></i>
                                                    </div>
                                                    <div class="body-title-2">Taskboard</div>
                                                </a>
                                            </li>
                                            <li>
                                                <a href="#" class="user-item">
                                                    <div class="icon">
                                                        <i class="icon-headphones"></i>
                                                    </div>
                                                    <div class="body-title-2">Support</div>
                                                </a>
                                            </li>
                                            <li>
                                                <a href="{{ route('admin.logout') }}" class="user-item">
                                                    <div class="icon">
                                                        <i class="icon-log-out"></i>
                                                    </div>
                                                    <div class="body-title-2">Log out</div>
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>

                    <div class="main-content">
                        @yield('content')

                        <div class="bottom-page bottom-margin">
                            <div class="body-text">Copyright © 2024 TrendsCart</div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>

    {{-- <script src="{{asset('backend/assets/js/jquery.min.js') }}"></script> --}}
    <script src="{{ asset('backend/assets/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('backend/assets/js/bootstrap-select.min.js') }}"></script>
    {{-- <script src="{{asset('backend/assets/js/sweetalert.min.js') }}"></script>  --}}
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdn.jsdelivr.net/npm/toastr@2.1.4/build/toastr.min.js"></script>
    <script src="{{ asset('backend/assets/js/apexcharts/apexcharts.js') }}"></script>
    <script src="{{ asset('backend/assets/js/main.js') }}"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>


    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
    </script>
    @stack('scripts')

    <script>
        toastr.options = {
            //   "closeButton": true,         // Display close button on the notification
            "debug": false,
            "newestOnTop": true, // Show newest notifications at the top
            "progressBar": true, // Show progress bar
            "positionClass": "toast-top-center", // Position where Toastr appears (top-r"preventDuplicates": true,   // Prevent duplicate notifications

        };

        // Check if there's a toastr message in the session and show it
    </script>

    <script>
        @if (session('success'))
            toastr.success("{{ session('success') }}");
        @elseif (session('error'))
            toastr.error("{{ session('error') }}");
        @elseif (session('info'))
            toastr.info("{{ session('info') }}");
        @elseif (session('warning'))
            toastr.warning("{{ session('warning') }}");
        @endif
    </script>

{{-- string to slug convert comman function for all pages  --}}
    <script>
       $("input[name='name']").on("change",function(){
                    $("input[name='slug']").val(StringToSlug($(this).val()));
                });

                function StringToSlug(Text) {
                return Text.toLowerCase()
                .replace(/[^\w ]+/g, "")
                .replace(/ +/g, "-");
            }  
    </script>
{{-- script for image drag and drop and image preview while image uploads --}}
<script>
    $(function() {
$("#myFile").on("change", function(e) {
    const photoInp = $("#myFile");
    const [file] = this.files;
    if (file) {
        $("#imgpreview img").attr('src', URL.createObjectURL(file));
        $("#imgpreview").show(); 
        $("#deleteImage").show();  // Show the delete button
    }
});

// Handle delete button click
$("#deleteImage").on("click", function() {
    $("#imgpreview").hide();  // Hide the image preview
    $("#myFile").val('');      // Clear the file input
    $("#deleteImage").hide(); // Hide the delete button
});
});
</script>


</body>

</html>
