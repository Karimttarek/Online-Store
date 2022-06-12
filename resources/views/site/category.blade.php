@extends('layouts.app')

@section('content')

    <div class="container xx">
        <div class="row">
            <!-- filter -->
                <!-- SIDEBAR -->
                <div class="col-md-3">
                    <div class="mb-5">
                        <!-- Brands -->
                        <div>
                            <h6 class="text-uppercase text-bold">{{__('dashboard.brands')}}</h6>
                            @foreach($brands as $brand)
                                <div class="d-block">
                                    <input type="checkbox" class="brand-check check" id="{{$brand->brand->code}}" value="{{ $brand->brand->id}}">
                                    <label for="{{$brand->brand->code}}">
                                        @if(LaravelLocalization::getCurrentLocale() == 'en')
                                            {{ $brand->brand->name}}
                                        @else
                                            {{ $brand->brand->name_ar}}
                                        @endif
                                    </label>
                                </div>
                            @endforeach
                        </div>
                        <br>
                        <!-- End Brands -->


                        <!-- sub category -->
                        <div>
                            <h6 class="text-uppercase text-bold">{{__('dashboard.categories')}}</h6>
                            @foreach($subcategories as $subcategory)
                                <div class="d-block">
                                    <input type="checkbox" class="subcategory-check check" id="{{$subcategory->subcategory->code}}" value="{{ $subcategory->subcategory->id }}">
                                    <label for="{{$subcategory->subcategory->code}}">
                                        @if(LaravelLocalization::getCurrentLocale() == 'en')
                                            {{ $subcategory->subcategory->name}}
                                        @else
                                            {{ $subcategory->subcategory->name_ar}}
                                        @endif
                                    </label>
                                </div>
                            @endforeach
                        </div>
                        <br>
                        <!-- End sub category  -->


                        <!-- price  -->
                        <div>
                            <h5>price</h5>
                            <div class="row">
                                <div class="col-12">
                                    <label class="col-6" for="">From</label>
                                    <label class="col-5" for="">To</label>
                                </div>
                                <div class="col-12">
                                    <input class="btn b-1 col-6" type="number" max="{{$data->max('price')}}" min="0" value="1" placeholder="from" id="price-from">
                                    <input class="btn b-1 col-5" type="number" max="{{$data->max('price')+1}}" min="0"  value="{{ $data->max('price')+1}}" placeholder="To" id="price-to" >
                                </div>
                            </div>
                        </div>
                        <!-- End price  -->

                    </div>
                    <button class="btn btn-primary col-12" id="go-filter" style="height: 30px ; line-height: 0px">Apply</button>
                <!-- END SIDEBAR -->
            </div>
            <!-- End filter -->
            <div class="col-md-9 b-l-1" id="items">
            @include('site.productdata')
            </div>
        </div>
    </div>

    @foreach($data as $c)
            <input type="hidden" id="data-x" value="{{$c->category->id}}">
    @endforeach

{{--    <div class="d-flex justify-content-center">--}}
{{--        {!!  $data -> links("pagination::bootstrap-4") !!}--}}
{{--    </div>--}}
@endsection


@push('script')
    <script>
        // function loadMoreData(page){
        //     $.ajax({
        //         url:'?page=' + page,
        //         type:'get',
        //         beforeSend:function (){
        //             $('.ajax-load').removeClass('dis-none');
        //         }
        //     })
        //         .done(function (data){
        //             if (data.html == " "){
        //                 $('.ajax-load').html('No More Records');
        //                 return;
        //             }
        //             $('.ajax-load').addClass('dis-none');
        //             $('#items').append(data.html);
        //         })
        //         .fail(function (jqXHR,ajaxOptions , thrownError){
        //             alert('Server Error');
        //         })
        // }
        // let page = 1;
        // $(window).scroll(function (){
        //     if ($(window).scrollTop() + $(window).height() >= $(document).height() - 300){
        //         page++;
        //         loadMoreData(page);
        //     }
        // })
$(document).ready(function(){
        var brandArr = [];
        var SubArr = [];
        var priceFrom ;
        var priceTo ;
        var id = $('#data-x').val();
        // BRAND CHECKBOX
     $('.brand-check ,#go-filter').on('click' , function(){

            priceFrom = $('#price-from ').val();
            priceTo = $('#price-to ').val();
            if($(this).prop('checked')== true){
                brandArr.push($(this).val());
            }
            else if($(this).prop('checked') == false){
                var removebrand = $(this).val();
                brandArr = jQuery.grep(brandArr , function (v){
                    return v !=removebrand;
                });
            }
        $.ajax({
            url:"{{route('filter.category')}}",
            type:'GET',
            data:{
                'id':id,
                'brand_id':brandArr,
                'subcategory_id':SubArr,
                'pricefrom':priceFrom,
                'priceto':priceTo,
            },
            success:function(data){
                $('#items').html(data);
            }
        });
    });

    // $('.subcategory-check').on('click' , function(){

    //     priceFrom = $('#price-from ').val();
    //     priceTo = $('#price-to ').val();
    //     if($(this).prop('checked')== true){
    //         SubArr.push($(this).val());
    //     }
    //     else if($(this).prop('checked') == false){
    //         var removesyb = $(this).val();
    //         SubArr = jQuery.grep(SubArr , function (v){
    //             return v !=removesyb;
    //         });
    //     }
    //     $.ajax({
    //         url:"{{route('filter.category')}}",
    //         type:'GET',
    //         data:{
    //             'id':id,
    //             'brand_id':brandArr,
    //             'subcategory_id':SubArr,
    //             'pricefrom':priceFrom,
    //             'priceto':priceTo,
    //         },
    //         success:function(data){
    //             $('#items').html(data);
    //         }
    //     });
    // });
});

    </script>
@endpush
