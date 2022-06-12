@extends('layouts.app')

@section('content')
    <div class="container">

        <section class="content">
            <!-- Default box -->
            <div class="card card-solid m-t-2">
                <div class="card-body">
                    <div class="row">
                        <div class="col-12 col-sm-4">
                            @foreach($data as $product)
                            <h3 class="d-inline-block d-sm-none">{{$product->name}}</h3>
                            <div class="col-lg-12 col-sm-12  flex-c">
                                <img src="{{URL::asset('image/products/'.$product->image)}}" class="bd-placeholder-img bd-placeholder-img-lg img-fluid" style="height: 400px" id="product-image" alt="Product Image">
                            </div>
                            <div class="col-12 product-image-thumbs">
                                @foreach($product->images as $image)
                                <div class="product-image-thumb" ><img src="{{URL::asset('image/products/'.$image->image)}}" alt="Product Image"></div>
                                @endforeach
                            </div>
                        </div>
                        <div class="col-12 col-sm-8">
                            @if(LaravelLocalization::getCurrentLocale() == 'en')
                                <h3 class="my-3">{{$product->name}}</h3>
                            @else
                                <h3 class="my-3">{{$product->name_ar}}</h3>
                            @endif
                                <div class="row">
                                    <div class="col-lg-6 col-8">
                                        <p>by
                                            <a href="{{url('category='.$product->category->code.'&'.$product->category->id.'')}}">{{$product->brand->name}}</a> ,
                                            <a href="{{url('category='.$product->category->code.'&'.$product->category->id.'')}}">{{$product->subcategory->name}}</a>
                                        </p>
                                    </div>
                                    <div class="col-lg-6 col-4">
                                        <i class="fa fa-star" style="color: #fec000"></i>
                                        <i class="fa fa-star" style="color: #fec000"></i>
                                        <i class="fa fa-star" style="color: #fec000"></i>
                                        <i class="fa fa-star" style="color: #fec000"></i>
                                        <i class="fa fa-star"></i>
                                    </div>
                                </div>
                            <div>{{$product->description}}.</div>

                               <h4 class="mt-3">Size <small>Please select one</small></h4>
                               <div class="btn-group btn-group-toggle" data-toggle="buttons">
                                   <label class="btn btn-default text-center">
                                       <input type="radio" name="color_option" id="color_option_b1" autocomplete="off">
                                       <span class="text-xl">S</span>
                                       <br>
                                       Small
                                    </label>
                                   <label class="btn btn-default text-center">
                                       <input type="radio" name="color_option" id="color_option_b2" autocomplete="off">
                                       <span class="text-xl">M</span>
                                       <br>
                                       Medium
                                   </label>
                                   <label class="btn btn-default text-center">
                                       <input type="radio" name="color_option" id="color_option_b3" autocomplete="off">
                                       <span class="text-xl">L</span>
                                       <br>
                                       Large
                                   </label>
                                   <label class="btn btn-default text-center">
                                       <input type="radio" name="color_option" id="color_option_b4" autocomplete="off">
                                       <span class="text-xl">XL</span>
                                       <br>
                                     Xtra-Large
                                 </label>
                              </div>
                            <div class="py-2 px-3 mt-4 b-t-1">
                                <h4 class="">
                                    <small>50% OFF</small>
                                </h4>
                                <h2 class="mb-0">
                                    ${{$product->price}}
                                </h2>
                            </div>

                                <div class="row col-md-6">
                                    <div class="py-2 px-3 mt-4 b-t-1 col-md-6">
                                        <ul>
                                            @foreach($product->attribuite as $attribuite)
                                                <li>{{$attribuite->name}}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                    <div class="py-2 px-3 mt-4 b-t-1 col-md-6">
                                        <ul>
                                            @foreach($product->attribuite as $attribuite)
                                                <li class="list-none">{{$attribuite->value}}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                </div>


                            <div class="mt-4 p-1 row">
                                <input type="hidden" id="sku" value="{{$product->id}}">
                                <input type="hidden" id="name" value="{{$product->name}}">
                                <input type="hidden" id="cost" value="{{$product->price}}">
                                <input type="number" id="qty" class="btn btn-default b-1 col-lg-2 col-md-2 col-sm-12" value="1" max="{{$product->stock}}" min="1">

                                @if(isset($cart) && $cart->count() > 0)
                                <button class="btn btn-success disabled col-lg-4 col-md-4 col-sm-6" id="cart">
                                    <i class="fas fa-cart-plus fa-lg mr-2"></i>
                                    Add to Cart
                                </button>
                                @else
                                    <button class="btn btn-success col-lg-4 col-md-4 col-sm-6" id="cart">
                                        <i class="fas fa-cart-plus fa-lg mr-2"></i>
                                        Add to Cart
                                    </button>
                                @endif


                                @if(isset($wishlists) && $wishlists->count() > 0)
                                    <button class="btn btn-danger col-lg-4 col-md-4 col-sm-6" id="wishlist">
                                        <i class="fas fa-heart fa-lg mr-2"></i>
                                        Wishlist
                                    </button>
                                    @else
                                    <button class="btn btn-default col-lg-4 col-md-4 col-sm-6" id="wishlist">
                                        <i class="fas fa-heart fa-lg mr-2"></i>
                                        Wishlist
                                    </button>
                                    @endif


                            </div>
                            @endforeach
                        </div>
                    </div>
                    <div class="row mt-4">
                        <nav class="w-100">
                            <div class="nav nav-tabs" id="product-tab" role="tablist">
                                <a class="nav-item nav-link active" id="product-desc-tab" data-toggle="tab" href="#product-desc" role="tab" aria-controls="product-desc" aria-selected="true">Description</a>
                                <a class="nav-item nav-link" id="product-comments-tab" data-toggle="tab" href="#product-comments" role="tab" aria-controls="product-comments" aria-selected="false">Specifications</a>
                                <a class="nav-item nav-link" id="product-rating-tab" data-toggle="tab" href="#product-rating" role="tab" aria-controls="product-rating" aria-selected="false">Rating</a>
                            </div>
                        </nav>
                        <div class="tab-content p-3" id="nav-tabContent">
                            <!-- Description -->
                            <div class="tab-pane fade show active" id="product-desc" role="tabpanel" aria-labelledby="product-desc-tab">
                                {{$product->description}}
                            </div>
                            <!-- End Description -->
                            <!-- Specifications -->
                            <div class="tab-pane fade" id="product-comments" role="tabpanel" aria-labelledby="product-comments-tab">
                                <ul>
                                    @foreach($product->spec as $spec)
                                        <div class="row">
                                            <div class="col-lg-3 col-4  m-b-4">
                                                <ul>
                                                    <li>{{$spec->name}}</li>
                                                </ul>
                                            </div>
                                            <div class="col-lg-6 col-8">
                                                <div class="btn-group btn-group-toggle" data-toggle="buttons">
                                                    {{$spec->value}}
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </ul>
                            </div>
                            <!-- Specifications -->
                            <div class="tab-pane fade" id="product-rating" role="tabpanel" aria-labelledby="product-rating-tab"> Cras ut ipsum ornare, aliquam ipsum non, posuere elit. In hac habitasse platea dictumst. Aenean elementum leo augue, id fermentum risus efficitur vel. Nulla iaculis malesuada scelerisque. Praesent vel ipsum felis. Ut molestie, purus aliquam placerat sollicitudin, mi ligula euismod neque, non bibendum nibh neque et erat. Etiam dignissim aliquam ligula, aliquet feugiat nibh rhoncus ut. Aliquam efficitur lacinia lacinia. Morbi ac molestie lectus, vitae hendrerit nisl. Nullam metus odio, malesuada in vehicula at, consectetur nec justo. Quisque suscipit odio velit, at accumsan urna vestibulum a. Proin dictum, urna ut varius consectetur, sapien justo porta lectus, at mollis nisi orci et nulla. Donec pellentesque tortor vel nisl commodo ullamcorper. Donec varius massa at semper posuere. Integer finibus orci vitae vehicula placerat. </div>
                        </div>
                    </div>
                </div>
                <!-- /.card-body -->
            </div>
            <!-- /.card -->

        </section>
        <!-- /.content -->

        <!-- Related Products -->
        <h4>Related product</h4>
        <div class="album py-5 bg-light">
            <div class="container">
                <div class="row">
                    @foreach ($products as $product)
                        <div class="product-card col-lg-2 col-xl-2 col-md-4 col-sm-6">
                            <div class="card shadow-sm">
                                <a href="{{route('productDetail',$product->id)}}">
                                    <img src="{{URL::asset('image/products/'.$product->image)}}" alt="" class="bd-placeholder-img bd-placeholder-img-lg img-fluid" style="height: 150px">
                                </a>
                                <div class="card-body">
                                    <p class="card-texts overflow-hidden"  style="height: 50px" >{{$product->name}}</p>
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
        <!-- /.related products -->
    </div>
@endsection


@push('script')

    <script>
        var Toast = Swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 3000
        });
        $(document).ready(function() {
            $('.product-image-thumb').on('click', function () {
                var $image_element = $(this).find('img')
                $('#product-image').prop('src', $image_element.attr('src'))
                $('.product-image-thumb.active').removeClass('active')
                $(this).addClass('active')
            })
        })

        // Add to Wishlist
        $('#wishlist').on('click' , function(){
            let id = $('#sku').val();
            let cost = $('#cost').val();
            let qty = $('#qty').val();
            $.ajax({
                url:"{{route('wishlist')}}",
                type:'GET',
                data:{
                    'id':id,
                    'qty':qty,
                    'cost':cost,
                },
                success:function(message){
                    $('#wishlist').prop('disabled', true);
                    setTimeout(function() {
                        $('#wishlist').prop('disabled', false);
                    }, 5000);
                    location.reload();
                    toastr.success(message)
                },
                error:function (){
                    toastr.error('Login first')
                    $('#wishlist').prop('disabled', true);
                    setTimeout(function() {
                        $('#wishlist').prop('disabled', false);
                    }, 5000);
                }
            });
        });

        // Add to Cart
        $('#cart').on('click' , function(){
            let id = $('#sku').val();
            let name = $('#name').val();
            let cost = $('#cost').val();
            let qty = $('#qty').val();
            $.ajax({
                url:"{{route('cart.add')}}",
                type:'GET',
                data:{
                    'id':id,
                    'qty':qty,
                    'cost':cost,
                    'name':name,
                },
                success:function(message){
                    $('#cart').prop('disabled', true);
                    setTimeout(function() {
                        $('#cart').prop('disabled', false);
                    }, 5000);
                    location.reload();
                    toastr.success(message)
                },
                error:function (){
                    toastr.error('Login first')
                    $('#cart').prop('disabled', true);
                    setTimeout(function() {
                        $('#cart').prop('disabled', false);
                    }, 5000);
                }
            });
        });

    </script>
@endpush
