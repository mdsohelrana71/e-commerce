<!-- /*
* Bootstrap 5
*/ -->
<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="author" content="Untree.co">
  <link rel="shortcut icon" href="{{ get_image(get_potion('shop_favicon'),'logo') }}">

  <meta name="description" content="" />
  <meta name="keywords" content="bootstrap, bootstrap4" />
    <!-- Bootstrap CSS -->
    <link href="{{ asset('frontend/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    {{-- <link href="{{ asset('frontend/css/font-awesome.all.min.css') }}" rel="stylesheet"> --}}
    <link href="{{ asset('frontend/css/tiny-slider.css') }}" rel="stylesheet">
    <link href="{{ asset('frontend/css/style.css') }}" rel="stylesheet">
    @php
        use Illuminate\Support\Facades\Route;
        $current_route = Route::current();
        $current_route = $current_route->getName();

        $home = $shop = $blog = $aboute = $service = $contact ='';
        if($current_route == 'home'){
            $home = 'active';
        }elseif($current_route == 'shop') {
            $shop = 'active';
        }elseif($current_route == 'blog') {
            $blog = 'active';
        }elseif($current_route == 'about') {
            $aboute = 'active';
        }elseif($current_route == 'service') {
            $service = 'active';
        }elseif($current_route == 'contact') {
            $contact = 'active';
        }
    @endphp
    <title>{{ ucfirst($current_route); }}</title>
</head>

<body>
    <!-- Start Header/Navigation -->
    <nav class="custom-navbar navbar navbar navbar-expand-md navbar-dark bg-dark" arial-label="Furni navigation bar">
        <div class="container">
            <a class="navbar-brand" href="{{ route('home'); }}"><img src="{{ get_image(get_potion('shop_logo'),'logo') }}" alt=""></a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarsFurni" aria-controls="navbarsFurni" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarsFurni">
                <ul class="custom-navbar-nav navbar-nav ms-auto mb-2 mb-md-0">
                    <li class="nav-item {{$home}}">
                        <a class="nav-link" href="{{ route('home'); }}">Home</a>
                    </li>
                    <li class="nav-item {{$shop}}">
                        <a class="nav-link" href="{{ route('shop'); }}">Shop</a>
                    </li>
                    <li class="nav-item {{$aboute}}">
                        <a class="nav-link" href="{{ route('about'); }}">About us</a>
                    </li>
                    <li class="nav-item {{$service}}">
                        <a class="nav-link" href="{{ route('service'); }}">Services</a>
                    </li>
                    <li class="nav-item {{$blog}}">
                        <a class="nav-link" href="{{ route('blog'); }}">Blog</a>
                    </li>
                    <li class="nav-item {{$contact}}">
                        <a class="nav-link" href="{{ route('contact'); }}">Contact us</a>
                    </li>
                </ul>
                <ul class="custom-navbar-cta navbar-nav mb-2 mb-md-0 ms-5">
                    <li>
                        <div class="dropdown user-info">
                            <a class="nav-link text-success dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <img src="{{ asset('frontend/images/user.svg') }}">
                            </a>
                            <ul class="dropdown-menu">
                                @if(Auth::check())
                                    <li class="nav-item preview-item-content dropdown-item">
                                        <a class="dashboard" href="<?php if(is_admin() == true){echo route('dashboard'); }else{ echo route('user.profile'); } ?>">Dashboard</a>
                                    </li>
                                    <li class="nav-item">
                                        <form method="POST" action="{{ route('logout') }}">
                                            @csrf
                                            <a href="route('logout')"onclick="event.preventDefault(); this.closest('form').submit();" class="dropdown-item preview-item">
                                                <div class="preview-thumbnail">
                                                <div class="preview-icon bg-dark rounded-circle">
                                                    <i class="mdi mdi-logout text-danger"></i>
                                                </div>
                                                </div>
                                                <div class="preview-item-content">
                                                    <p class="preview-subject mb-1">Log out</p>
                                                </div>
                                            </a>
                                        </form>
                                    </li>
                                @else
                                    <li class="nav-item dropdown-item">
                                        <a class="login" href="{{ route('login'); }}">Login</a>
                                    </li>
                                @endif
                            </ul>
                        </div>
                    </li>
                    <li><a class="nav-link" href="cart.html"><img src="{{ asset('frontend/images/cart.svg') }}"></a></li>
                </ul>
            </div>
        </div>
    </nav>
    <!-- End Header/Navigation -->

