
<!-- items -->
<div class="row">
    @foreach($data as $product)
        <div class="card-body b-1">
            <div class="row g-0">
                <div class="col-md-3 b-r-1">
                    <a href="{{route('productDetail',$product->id)}}">
                        <img src="{{URL::asset('image/products/'.$product->image)}}" alt="" class="bd-placeholder-img bd-placeholder-img-lg img-fluid" style="max-height: 250px">
                    </a>
                </div>
                <div class="col-md-8">
                    <div class="card-body">
                        <div class="row-col-12">
                            <h5 class="">
                                @if(LaravelLocalization::getCurrentLocale() == 'en')
                                    {{$product->name}}
                                @else
                                    {{$product->name_ar}}
                                @endif
                            </h5>
                            <p class="">This is a wider card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
                            <div class="row">
                                <div class="col-6">
                                    <p class=""><small class="text-muted">{{$product->brand->name}}</small></p>
                                    <h5 class="text-primary text-bold">{{$product->price}}</h5>
                                </div>
                                <div class="col-6">
                                    <button class="btn btn-default shadow-sm">
                                        <a href="{{route('productDetail',$product->id)}}" class="text-gray">VIEW FULL DETAILS</a>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
</div>
<!-- items -->

{{-- <div class="ajax-load text-center">
    <p><img src="{{URL::asset('image/loader.gif')}}" class="image-fluid"> Loading Products ..</p>
</div> --}}
