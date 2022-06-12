@extends('layouts.app')

@section('content')
    <div class="album py-5 bg-light">
        <div class="container">
            <div class="row">
                @foreach ($data as $product)
                    <div class="product-card col-lg-2 col-xl-2 col-md-4 col-sm-6" style="height: 400px">
                        <div class="card shadow-sm">
                            <a href="{{route('productDetail',$product->id)}}">
                                <img src="{{URL::asset('image/products/'.$product->image)}}" alt="" class="bd-placeholder-img bd-placeholder-img-lg img-fluid" style="height: 150px">
                            </a>
                            <input type="hidden" class=" dis-none hidden" value="{{$product->id}}">
                            <div class="card-body">
                                <a href="{{url('product/'.$product->id)}}"></a>
                                <p class="card-texts overflow-hidden" style="height: 50px">{{$product->name}}</p>
                                <p class="text-mutesd"><strong class="text-dark">{{$product->price}}</strong> <del class="text-primary">50% off</del></p>
                                <hr>
                                <div class="d-flex justify-content-between align-items-center">
                                    <div class="btn-group">
                                        <button type="button" class="btn btn-sm btn-outline-secondary"><i class=" fa fa-cart-plus"></i></button>
                                        @if(isset($wishlists) && $wishlists->count() > 0)
                                        <button type="button" class="btn btn-sm btn-danger"><i class=" fa fa-star"></i></button>
                                        @else
                                            <button type="button" class="wishlist btn btn-sm btn-outline-secondary"><i class=" fa fa-star"></i></button>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>

    <div class="d-flex justify-content-center">
        {!!  $data -> links("pagination::bootstrap-4") !!}
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

        $('.wishlist .fa-star').on('click' , function(){
            let id = $('.hidden').val();
            console.log(id);
            $.ajax({
                url:"{{route('wishlist')}}",
                type:'GET',
                data:{
                    'id':id,
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
                    toastr.error('Please Login')
                    $('#wishlist').prop('disabled', true);
                    setTimeout(function() {
                        $('#wishlist').prop('disabled', false);
                    }, 5000);

                }
            });
        });

    </script>
@endpush
