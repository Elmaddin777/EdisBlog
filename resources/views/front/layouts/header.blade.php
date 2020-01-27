<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">
  
  @if (!Request::segment(1))
    <title> {{ $config->title  }}</title>
  @else
    <title>@yield('title') - {{ $config->title  }}</title>
  @endif
  

  <!-- Bootstrap core CSS -->
  <link href="{{ asset('front/') }}/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

  <!-- Custom fonts for this template -->
  <link href="{{ asset('front/') }}/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href='https://fonts.googleapis.com/css?family=Lora:400,700,400italic,700italic' rel='stylesheet' type='text/css'>
  <link href='https://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800' rel='stylesheet' type='text/css'>

  <!-- Custom styles for this template -->
  <link href="{{ asset('front/') }}/css/clean-blog.min.css" rel="stylesheet">
  <link rel="shortcut icon" type="image/png" href="{{ asset('admin/'.$config->favicon) }}">

</head>

<body>

  <!-- Navigation -->
  <nav class="navbar navbar-expand-lg navbar-light fixed-top" id="mainNav">
    <div class="container">
      <div class="row">
        <div class="col-md-10">
          <div class="logo">
            <a class="navbar-brand" href="{{ route('homepage') }}">
              @if (!$config->logo == null)
                  <img src="{{ asset('admin/'.$config->logo) }}" alt="" width="125" />
              @else
                {{ $config->title }}
              @endif
            
            </a>
          </div>
        </div>
        <div class="col-md-2 mt-3">
          <div class="collapse navbar-collapse" id="navbarResponsive">
            <ul class="navbar-nav ml-auto">
              <li class="nav-item">
                <a class="nav-link" href="{{ route('homepage') }}">Home</a>
              </li>
              @foreach ($nav_items as $nav_item)
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('page', $nav_item->slug) }}">{{ $nav_item->title }}</a>
                </li>
              @endforeach
              <li class="nav-item">
                <a class="nav-link" href="{{ route('contact') }}">Contact</a>
              </li>
            </ul>
          </div>
        </div>
      </div>
    </div>  

  </nav>

  <!-- Page Header -->
  <header class="masthead" style=" background-image: url(@yield('bg', asset('front//img/home-bg.jpg')) ">
    <div class="overlay"></div>
    <div class="container">
      <div class="row">
        <div class="col-lg-8 col-md-10 mx-auto">
          <div class="site-heading">
            @if(Route::currentRouteName() == 'homepage')
              <h1>  @yield('title')  </h1>
              <span class="subheading">Just For Fun</span>
            @elseif(Route::currentRouteName() == 'contact')
              <h1>  @yield('title')  </h1>
              <span class="subheading">Have questions? I have answers.</span>
            @elseif (Request::segment(1) == 'categories')
              <h2>  @yield('title')  </h2>
            @else
              <h1>  @yield('title')  </h1>
            @endif
          </div>
        </div>
      </div>
    </div>
  </header>

  <!-- Main Content -->
  <div class="container">
    <div class="row">