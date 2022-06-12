@extends('layouts.app')

@section('content')
    <!-- Page Preloder -->
    <div id="preloder">
        <div class="loader"></div>
    </div>



    <!-- Hero Section Begin -->
    <section class="hero">
        <div class="container">
            <div class="row">
                <div class="col-lg-3">
                    <div class="hero__categories">
                        <div class="hero__categories__all">
                            <i class="fa fa-bars"></i>
                            <span>{{__('dashboard.categories')}}</span>
                        </div>
                        <ul>
                            @foreach($categories as $category)
                                @if(\LaravelLocalization::getCurrentLocale() == 'en')
                                <li><a href="{{route('category.product',$category->id)}}">{{$category->name}}</a></li>
                                @else
                                    <li><a href="{{url('category/'.$category->id )}}">{{$category->name_ar}}</a></li>
                                @endif
                            @endforeach
                            </ul>
                        </div>
                    </div>
                    <div class="col-lg-9">
                        <div class="hero__search">
                            <input type="text" class="col-lg-9 p-2" placeholder="What are you looking for ?" id="searchInput" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <input type="button" class="site-btn col-lg-2" value="Search">
                            <div class="dropdown-menu col-lg-9" id="searchMenu" aria-labelledby="searchInput">
                            </div>
                        </div>

                    <div class="hero__item set-bg" data-setbg="{{URL::asset('image/banners/banner.jpg')}}">
                        <div class="hero__text">
                            <span>FRUIT FRESH</span>
                            <h2>Vegetable <br />100% Organic</h2>
                            <p>Free Pickup and Delivery Available</p>
                            <a href="#" class="primary-btn">SHOP NOW</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Hero Section End -->

    <!-- Our Product -->
    <div class="container">
        <div class="section-title flex-l">
            <h2>Our Product</h2>
        </div>
        <div class="owl-carousel owl-theme xxx ">
            @foreach($products as $product)
                    <div class="text-center card">
                        <a href="{{route('productDetail',$product->id)}}">
                            <img src="{{URL::asset('image/products/'.$product->image)}}" alt="" height="200px">
                            <p style="height: 50px;overflow: hidden">{{$product->name}}</p>
                        </a>
                        <p class="text-muted"><strong class="text-dark">${{$product->price}}</strong></p>
                    </div>
            @endforeach
        </div>
    </div>
    <!-- Our Product -->


    <hr class="container b-1">
    <!-- Featured Section Begin -->
    <section class="featured spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="section-title flex-l">
                        <h2>Latest Product</h2>
                    </div>
                </div>
            </div>
            <div class="row featured__filter">
                <div class="album py-5 bg-light">
                    <div class="container">
                        <div class="row">
                            @foreach ($latestproducts as $product)
                                <div class="product-card col-lg-2 col-xl-2 col-md-4 col-sm-6" style="height: 400px">
                                    <div class="card shadow-sm">
                                        <a href="{{route('productDetail',$product->id)}}">
                                            <img src="{{URL::asset('image/products/'.$product->image)}}" alt="" class="bd-placeholder-img bd-placeholder-img-lg img-fluid" style="height: 150px">
                                        </a>
                                        <input type="hidden" class=" dis-none hidden" value="{{$product->id}}">
                                        <div class="card-body">
                                            <a href="{{url('product/'.$product->id)}}"></a>
                                            <h6 class="card-texts overflow-hidden" style="height: 50px">{{$product->name}}</h6>
                                            <div class="d-flex justify-content-between align-items-center">
                                                <p class="text-mutesd"><strong class="text-dark">{{$product->price}}</strong> <del class="text-primary">50% off</del></p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
        </div>
    </section>
    <!-- Featured Section End -->

    <!-- Banner Begin -->
    <div class="banner">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-md-6 col-sm-6">
                    <div class="banner__pic">
                        <img src="{{URL::asset('image/banners/ban-01.jpg')}}" alt="">
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-6">
                    <div class="banner__pic">
                        <img src="{{URL::asset('image/banners/ban-02.jpg')}}" alt="">
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Banner End -->

    <!-- Blog Section Begin -->
    <section class="from-blog spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="section-title from-blog__title">
                        <h2>From The Blog</h2>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-4 col-md-4 col-sm-6">
                    <div class="blog__item">
                        <div class="blog__item__pic">
                            <img src="img/blog/blog-1.jpg" alt="">
                        </div>
                        <div class="blog__item__text">
                            <ul>
                                <li><i class="fa fa-calendar-o"></i> May 4,2019</li>
                                <li><i class="fa fa-comment-o"></i> 5</li>
                            </ul>
                            <h5><a href="#">Cooking tips make cooking simple</a></h5>
                            <p>Sed quia non numquam modi tempora indunt ut labore et dolore magnam aliquam quaerat </p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-4 col-sm-6">
                    <div class="blog__item">
                        <div class="blog__item__pic">
                            <img src="img/blog/blog-2.jpg" alt="">
                        </div>
                        <div class="blog__item__text">
                            <ul>
                                <li><i class="fa fa-calendar-o"></i> May 4,2019</li>
                                <li><i class="fa fa-comment-o"></i> 5</li>
                            </ul>
                            <h5><a href="#">6 ways to prepare breakfast for 30</a></h5>
                            <p>Sed quia non numquam modi tempora indunt ut labore et dolore magnam aliquam quaerat </p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-4 col-sm-6">
                    <div class="blog__item">
                        <div class="blog__item__pic">
                            <img src="img/blog/blog-3.jpg" alt="">
                        </div>
                        <div class="blog__item__text">
                            <ul>
                                <li><i class="fa fa-calendar-o"></i> May 4,2019</li>
                                <li><i class="fa fa-comment-o"></i> 5</li>
                            </ul>
                            <h5><a href="#">Visit the clean farm in the US</a></h5>
                            <p>Sed quia non numquam modi tempora indunt ut labore et dolore magnam aliquam quaerat </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Blog Section End -->
@endsection

@push('script')
    <script>
        $('.xxx').owlCarousel({
            rtl:true,
            loop:true,
            margin:10,
            nav:true,
            responsive:{
                0:{
                    items:1
                },
                600:{
                    items:3
                },
                1000:{
                    items:5
                }
            }
        })
    </script>
@endpush
