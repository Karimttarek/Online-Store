
<!-- Humberger Begin -->
<div class="humberger__menu__overlay"></div>
<div class="humberger__menu__wrapper">
    <div class="humberger__menu__logo">
        <a href="#"><img src="{{URL::asset('image/omda.jpg')}}" alt=""></a>
    </div>
    <div class="humberger__menu__cart">
        <ul>
            <li><a href="#"><i class="fa fa-heart"></i> <span>1</span></a></li>
            <li><a href="{{route('cart')}}"><i class="fa fa-shopping-cart"></i>
                @if(isset($cartCount))
                    <span>{{$cartCount}}</span>
                @else

                @endif
            </a></li>
        </ul>

    </div>
    <div class="humberger__menu__widget">
        <div class="header__top__right__language">
            <div class="dropdown-toggle">{{\LaravelLocalization::getCurrentLocaleName()}}</div>
            <ul>
                @foreach(LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
                    <li>
                        <a rel="alternate" hreflang="{{ $localeCode }}" href="{{ LaravelLocalization::getLocalizedURL($localeCode, null, [], true) }}">
                            {{ $properties['native'] }}
                        </a>
                    </li>
                @endforeach
            </ul>
        </div>
        @guest
            @if (Route::has('login'))
                <div class="header__top__right__auth">
                    <a href="{{ route('login') }}"><i class="fa fa-user"></i>{{ __('auth.Login') }}</a>
                </div>
            @endif
        @else
            <div class="header__top__right__auth">
                <div class="nav-item dropdown">
                    <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                        {{ Auth::user()->name }}
                    </a>
                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="{{ route('logout') }}"
                           onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                            {{ __('Logout') }}
                        </a>

                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>
                    </div>
                </div>
            </div>
        @endguest
    </div>
    <nav class="humberger__menu__nav mobile-menu">
        <ul>
            <li class="active"><a href="/">Home</a></li>
            <li><a href="{{route('allproducts')}}">Shop</a></li>
            <li><a href="#">Pages</a>
                <ul class="header__menu__dropdown">
                    <li><a href=".{{route('allproducts')}}">Shop Details</a></li>
                    <li><a href="{{route('cart')}}">Shoping Cart</a></li>
                    <li><a href="{{route('checkout')}}">Check Out</a></li>
                    <li><a href="./blog-details.html">Blog Details</a></li>
                </ul>
            </li>
            <li><a href="./blog.html">Blog</a></li>
            <li><a href="{{route('contact')}}">Contact</a></li>
            @if(isset(Auth::user()->name) && Auth::user()->admin >= 1)
                <li><a href="{{route('dashboard')}}">Dashboard</a></li>
            @endif
        </ul>
    </nav>
    <div id="mobile-menu-wrap"></div>
    <div class="header__top__right__social">
        <a href="#"><i class="fab fa-facebook-f"></i></a>
        <a href="#"><i class="fab fa-twitter"></i></a>
        <a href="#"><i class="fab fa-youtube"></i></a>
    </div>
    <div class="humberger__menu__contact">
        <ul>
            <li><i class="fa fa-envelope"></i>example@info.com</li>
            <li>Free Shipping for all Order</li>
        </ul>
    </div>
</div>
<!-- Humberger End -->

<header class="p-2 bg-dark">
    <div class="container">
        <div class="d-flex flex-wrap align-items-center justify-content-center justify-content-lg-start">
            <div class="col-lg-1">
                <a href="/" class="d-flex align-items-center mb-2 mb-lg-0 text-white text-decoration-none">
                    {{config('app.name') }}
                </a>
            </div>

            <div class="col-lg-8">
                <input type="text" class="form-control form-control-dark" placeholder="What are you looking for ?" id="searchInput" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <div class="dropdown-menu text-dark" id="searchMenu" aria-labelledby="searchInput" >
                </div>
            </div>

            <div class="col-lg-3 text-white">
                <div class="text-end">
                    <div class="header__top__right__language  text-white">
                        <div class="dropdown-toggle text-white">{{\LaravelLocalization::getCurrentLocaleName()}}</div>
                        <ul>
                            @foreach(LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
                                <li>
                                    <a rel="alternate" hreflang="{{ $localeCode }}" href="{{ LaravelLocalization::getLocalizedURL($localeCode, null, [], true) }}">
                                        {{ $properties['native'] }}
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                    @guest
                        @if (Route::has('login'))
                            <div class="header__top__right__language  text-white">
                                <a href="{{ route('login') }}" class=" text-white"><i class="fa fa-user"></i>{{ __('auth.Login') }}</a>
                            </div>
                        @endif
                    @else
                    <div class="header__top__right__language  text-white">
                        <div class="nav-item dropdown">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle text-white" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                {{ Auth::user()->name }}
                            </a>
                        </div>
                        <ul>
                            <li>
                                <a href="{{ route('logout') }}"
                                    onclick="event.preventDefault();
                                        document.getElementById('logout-form').submit();">
                                    {{ __('auth.Logout') }}
                                </a>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                    @csrf
                                </form>
                            </li>
                        </ul>
                    </div>
                    @endguest
                </div>
            </div>
        </div>
    </div>
</header>
<!-- Header Section Begin -->
<div class="container-fluid" style="background-color: #f5f5f5;max-height: 70px">
    <div class="container">
        <div class="row">
            <div class="col-lg-9">
                <nav class="header__menu">
                    <ul>
                        <li class="active"><a href="/">{{__('site.home')}}</a></li>
                        <li><a href="{{route('allproducts')}}">{{__('site.shopnow')}}</a></li>
                        <li><a href="{{route('contact')}}">Contact</a></li>
                        <li><a href="./blog.html">Blog</a></li>
                        @if(isset(Auth::user()->name) && Auth::user()->admin >= 1)
                            <li><a href="{{route('dashboard')}}">Dashboard</a></li>
                        @endif
                    </ul>
                </nav>
            </div>
            <div class="col-lg-2">
                <div class="header__cart">
                    <ul>
                        <li><a href="#"><i class="fa fa-heart"></i> <span>1</span></a></li>
                        <li><a href="{{route('cart')}}"><i class="fa fa-shopping-cart"></i>
                                @if(isset($cartCount))
                                    <span>{{$cartCount}}</span>
                                @else

                                @endif
                            </a></li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="humberger__open">
            <i class="fa fa-bars"></i>
        </div>
    </div>
</div>
<!-- Header Section End -->

@push('script')
    <script>
        $('#searchInput').on('input' , function(){
            if ($('#searchInput').val().length != 0){
                let data = $(this).val();
                $.ajax({
                    url:"{{route('searchMenu')}}",
                    type:'GET',
                    data:{
                        'data':data,
                    },
                    success:function(data){
                        $('#searchMenu').html(data)
                    },
                });
                $('#searchMenu').addClass('dropdown-menu show');
            }else {
                $('#searchMenu').removeClass('show');
            }
        });
        $('body').on('click' , function (){
            $('#searchMenu').removeClass('show');
        });
    </script>
@endpush
