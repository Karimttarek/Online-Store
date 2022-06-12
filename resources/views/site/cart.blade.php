@extends('layouts.app')

@section('content')

    <div class="container">
    @if($products->count())

        <!-- Shoping Cart Section Begin -->
            <section class="shoping-cart spad">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="shoping__cart__table">
                                <table>
                                    <thead>
                                    <tr>
                                        <th class="shoping__product">Products</th>
                                        <th>Price</th>
                                        <th>Quantity</th>
                                        <th>Total</th>
                                        <th></th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($products as $product)
                                        <tr>
                                            <td class="shoping__cart__item">
                                                <img src="{{URL::asset('image/products/'.$product->product->image)}}" alt="" class="img-thumbnail img-fluid" width="100px" height="100px">
                                                @if(\LaravelLocalization::getCurrentLocale() == 'en')
                                                <h5>{{$product->product->name}}</h5>
                                                @else
                                                    <h5>{{$product->product->name_ar}}</h5>
                                                @endif
                                            </td>
                                            <td class="shoping__cart__price">
                                                ${{$product->product->price}}
                                            </td>
                                            <td class="shoping__cart__quantity">
                                                <div class="quantity">
                                                    <div class="pro-qty">
                                                        <input type="text" id="qty" data-id="{{$product->product->id}}" data-price="{{$product->product->price}}" value="{{$product->qty}}">
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="shoping__cart__price">
                                                ${{$product->qty * $product->product->price}}
                                            </td>
                                            <td class="shoping__cart__item__close">
                                                <span><i class="fa fa-close delete" data-id="{{$product->product->id}}"></i></span>
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="shoping__cart__btns">
                                <a href="/" class="primary-btn cart-btn">CONTINUE SHOPPING</a>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="shoping__continue">
                                <div class="shoping__discount">
                                    <h5>Discount Codes</h5>
                                    <form action="#">
                                        <input type="text" placeholder="Enter your coupon code">
                                        <button type="submit" class="site-btn">APPLY COUPON</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="shoping__checkout">
                                <h5>Cart Total</h5>
                                <ul>
                                    <li>Subtotal <span>${{$products->sum('total')}}</span></li>
                                    <li>Total <span>${{$products->sum('total')}}</span></li>
                                </ul>
                                <a href="{{route('checkout')}}" class="primary-btn">PROCEED TO CHECKOUT</a>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <!-- Shoping Cart Section End -->
        @else
            <div class="container text-center p-t-50">
                <img src="{{URL::asset('image/empty-cart.png')}}" class="img-fluid" alt="">
                <div class="">
                    <a href="/" class=""><h4>START SHOPPING</h4></a>
                </div>
            </div>
        @endif

    </div>
    {{--    <div class="d-flex justify-content-center">--}}
    {{--        {!!  $products -> links("pagination::bootstrap-4") !!}--}}
    {{--    </div>--}}
@endsection


@push('script')
    <script>
        $(document).ready(function(){
            $('.delete').on('click' , function(){
                $.ajax({
                    url:"{{route('cart.delete')}}",
                    type:'GET',
                    data:{
                        'id':$(this).data('id'),
                    },
                    success:function(message){
                        location.reload();
                        toastr.success(message)
                    }
                });
            });

            $(document).on('input', '#qty', function() {
                let qty = $(this).val();
                $.ajax({
                    url:"{{route('cart.updateQuantity')}}",
                    type:'GET',
                    data:{
                        'id':$(this).data('id'),
                        'qty':qty,
                        'price':$(this).data('price'),
                    },
                    success:function(message){
                        location.reload();
                        toastr.success(message)
                    }
                });
            });
        });

    </script>
@endpush
