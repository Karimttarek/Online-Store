<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" dir="{{LaravelLocalization::getCurrentLocaleDirection()}}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Elomda Template">
    <meta name="keywords" content="Omda, Elomda, Loaloat elomda, html">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <!--insecure content was loaded over HTTPS -->
    <meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests"> 
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <link rel="icon" href="{{URL::asset('dist/img/AdminLTELogo.png')}}">
    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    @if(\App\Http\direction()== 'rtl')
        <link href="{{ URL::asset('css/rtl/bootstrap.rtl.min.css') }}" rel="stylesheet">
        <link rel="stylesheet" href="https://getbootstrap.com/docs/5.0/examples/carousel-rtl/">
        <link rel="canonical" href="https://getbootstrap.com/docs/5.0/examples/cheatsheet-rtl/">
    @endif
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>

    <!-- Css Styles -->
{{--    <link rel="stylesheet" href="{{URL::asset('css/master/bootstrap.min.css')}}" type="text/css">--}}
{{--    <link rel="stylesheet" href="{{URL::asset('css/master/font-awesome.min.css')}}" type="text/css">--}}
{{--    <link rel="stylesheet" href="{{URL::asset('css/master/elegant-icons.css')}}" type="text/css">--}}
{{--    <link rel="stylesheet" href="{{URL::asset('css/master/nice-select.css')}}" type="text/css">--}}
{{--    <link rel="stylesheet" href="{{URL::asset('css/master/jquery-ui.min.css')}}" type="text/css">--}}
{{--    <link rel="stylesheet" href="{{URL::asset('css/master/owl.carousel.min.css')}}" type="text/css">--}}
{{--    <link rel="stylesheet" href="{{URL::asset('css/master/slicknav.min.css')}}" type="text/css">--}}
    <link rel="stylesheet" href="{{URL::asset('css/master/style.css')}}" type="text/css">
    <link rel="stylesheet" href="{{URL::asset('css/plugins/util.css')}}" type="text/css">

    <!-- Toastr -->
    <link rel="stylesheet" href="{{ URL::asset('plugins/toastr/toastr.min.css') }}">
    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="{{URL::asset('plugins/fontawesome-free/css/all.min.css')}}">
    <!-- IonIcons -->
{{--    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">--}}
    <!-- Theme style -->
    <link rel="stylesheet" href="{{URL::asset('dist/css/adminlte.min.css')}}">
    <!-- Owl Carousel -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.min.css" integrity="sha512-sMXtMNL1zRzolHYKEujM2AqCLUR9F2C4/05cdbxjjLSRvMQIciEPCQZo++nk7go3BtSuK9kfa/s+a4f4i5pLkw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css" integrity="sha512-tS3S5qG0BlhnQROyJXvNjeEM4UpMXHrQfTGmbQ1gKmelCxlSEBUaxhRBj/EFTzpbP4RVSrpEikbmdJobCvhE3g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body>
