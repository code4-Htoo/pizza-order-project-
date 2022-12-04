<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>MultiShop - Online Shop Website Template</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="Free HTML Templates" name="keywords">
    <meta content="Free HTML Templates" name="description">

    <!-- Favicon -->
    {{-- <link href="img/favicon.ico" rel="icon"> --}}
    <!-- Fontfaces CSS-->
    <link href="{{ asset('admin/css/font-face.css') }}" rel="stylesheet" media="all">
    <link href="{{ asset('admin/vendor/font-awesome-4.7/css/font-awesome.min.css') }}" rel="stylesheet" media="all">
    <link href="{{ asset('admin/vendor/font-awesome-5/css/fontawesome-all.min.css') }}" rel="stylesheet" media="all">
    <link href="{{ asset('admin/vendor/mdi-font/css/material-design-iconic-font.min.css') }}" rel="stylesheet"
        media="all">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css">

    <!-- Main CSS-->
    <link href="{{ asset('admin/css/theme.css') }}" rel="stylesheet" media="all">

    <!-- Libraries Stylesheet -->
    <link href="{{ asset('user/lib/animate/animate.min.css')}}" rel="stylesheet">
    <link href="{{ asset('user/lib/owlcarousel/assets/owl.carousel.min.css')}}" rel="stylesheet">

    <!-- Customized Bootstrap Stylesheet -->
    <link href="{{ asset('user/css/style.css')}}" rel="stylesheet">

    {{-- bootstrap 5 css lnk --}}
    <!-- CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
</head>

<body>

    <!-- Navbar Start -->
    <div class="container-fluid bg-dark mb-30">
        <div class="row px-xl-5">
            <div class="col-lg-3 d-none d-lg-block">
                <a href="" class="text-decoration-none ">
                    <span class="h2 text-uppercase text-warning  px-2">Pizza</span>
                    <span class="h2 text-uppercase text-dark bg-white px-2 ml-n1">Lab</span>
                </a>
            </div>
            <div class="col-lg-9">
                <nav class="navbar navbar-expand-lg bg-dark navbar-dark py-3 py-lg-0 px-0">

                    <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#navbarCollapse">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse justify-content-between" id="navbarCollapse">
                        <div class="navbar-nav mr-auto py-0">
                            <a href="{{ route('user#home') }}" class="nav-item nav-link active">Home</a>
                            <a href="{{ route('user#cartList') }}" class="nav-item nav-link">My Cart</a>
                            <a href="{{ route('user#contactListPage') }}" class="nav-item nav-link">Contact</a>
                        </div>
                        <div class="navbar-nav ml-auto py-0 d-none d-lg-block">

                                    <div class="btn-group d-inline mr-5">
                                        <button class="btn btn-sm bg-secondary dropdown-toggle text-white" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                                            <i class="fa-solid fa-user mr-2 text-warning"></i>{{ Auth::user()->name }}
                                        </button>
                                        <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                                          <li><a class="dropdown-item my-2" href="{{ route('user#accountEditPage') }}"><i class="fa-solid fa-user mr-3"></i>Account</a></li>
                                          <li><a class="dropdown-item my-2" href="{{ route('user#changepasswordPage') }}"><i class="fa-solid fa-key mr-3"></i>Change password</a></li>
                                          <li><span class="dropdown-item my-2 ">
                                            <form action="{{ route('logout') }}" method="post" class="text-center">
                                                @csrf
                                                <button class="btn text-white bg-danger" type="submit"><i class="fa-solid fa-arrow-right-from-bracket mr-2 text-white"></i>Logout</button>
                                            </form>
                                        </span></li>
                                        </ul>
                                    </div>
                        </div>
                    </div>
                </nav>
            </div>
        </div>
    </div>
    <!-- Navbar End -->

    @yield('content')

    <!-- Footer Start -->
    <div class="container-fluid bg-dark text-secondary mt-5 pt-5">
        <div class="row px-xl-5 pt-5">
            <div class="col-lg-4 col-md-12 mb-5 pr-3 pr-xl-5">
                <h5 class="text-secondary text-uppercase mb-4">Get In Touch</h5>
                <p class="mb-4">Being approachable and easy to talk to is a simple way of building trust with your website visitors. It’s easier to trust someone new who seems friendly right from the start. Brands are no different.</p>
                <p class="mb-2"><i class="fa fa-map-marker-alt text-success mr-3"></i>Yangon, Myanmar</p>
                <p class="mb-2"><i class="fa fa-envelope text-success mr-3"></i>htooaungwai.prof@gmail.com</p>
                <p class="mb-0"><i class="fa fa-phone-alt text-success mr-3"></i>+959 422 525 966</p>
            </div>
            <div class="col-lg-8 col-md-12">
                <div class="row">
                    <div class="col ">
                        <div class="col-md-10 mb-5 offset-1">
                            <h5 class="text-secondary text-uppercase ms-3 mb-4">I Love Shopping, Especially Food Shopping.</h5>
                                <h6 class="text-secondary text-uppercase ms-3 mb-4">Food is your body's fuel, your body wants to shut down.</h6>
                        </div>
                    </div>
                    <div class="col-md-4 mb-5">
                        <h5 class="text-secondary text-uppercase mb-4">Quick Shop</h5>
                        <div class="d-flex flex-column justify-content-start">
                            <a class="text-secondary mb-2" href="{{ route('user#home') }}"><i class="fa fa-angle-right mr-2"></i>Home</a>
                            <a class="text-secondary mb-2" href="{{ route('user#cartList') }}"><i class="fa fa-angle-right mr-2"></i>Shopping Cart</a>
                            <a class="text-secondary mb-2" href="#"><i class="fa fa-angle-right mr-2"></i>Checkout History</a>
                            <a class="text-secondary" href="{{ route('user#contactListPage') }}"><i class="fa fa-angle-right mr-2"></i>Contact Us</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row border-top mx-xl-5 py-4" style="border-color: rgba(256, 256, 256, .1) !important;">
            <div class="col-md-6 px-xl-0">
                <p class="mb-md-0 text-center text-md-left text-secondary">
                    &copy; <a class="text-white" href="#">Htoo</a>. All Rights Reserved. Designed
                    by
                    <a class="text-white" href="https://htmlcodex.com">Htoo Aung Wai</a>
                </p>
            </div>
            <div class="col-md-6 px-xl-0 text-center text-md-right">
                <img class="img-fluid" src="{{ asset('image/payment.png') }}" alt="" style="width: 50px; height:15px">
            </div>
        </div>
    </div>
    <!-- Footer End -->


    <!-- Back to Top -->
    <a href="#" class="btn btn-dark back-to-top"><i class="fa fa-angle-double-up"></i></a>


    <!-- JavaScript Libraries -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('user/lib/easing/easing.min.js')}}"></script>
    <script src="{{ asset('user/lib/owlcarousel/owl.carousel.min.js')}}"></script>

    <!-- Contact Javascript File -->
    {{-- <script src="{{ asset('user/mail/jqBootstrapValidation.min.js')}}"></script> --}}
    {{-- <script src="{{ asset('user/mail/contact.js')}}"></script> --}}

    <!-- Template Javascript -->
    <script src="{{ asset('user/js/main.js')}}"></script>

    {{-- Jquery CDN --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
    <!-- JavaScript Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
</body>
    @yield('scriptSource')
</html>
