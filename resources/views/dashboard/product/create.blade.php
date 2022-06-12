@extends('layouts.dashboard')
@section('content')
<div class="container">

    @if (session('status'))
        <div class="alert alert-success col-md-6 m-auto">
            {{ session('status') }}
        </div>
    @endif
    <div class="row justify-content-center p-t-50">
        <div class="col-md-12">
            <div class="card">
{{--                <div class="card-header btn-group row">--}}
{{--                    <button id="basic" type="button" class="btn btn-outline-primary btn-block active col-4"><a href="#basic-form" class="text-dark">{{__('dashboard.required')}}</a></button>--}}
{{--                    <button id="secondary" type="button" class="btn btn-outline-primary col-4"><a href="#secondary-form" class="text-dark">{{__('dashboard.information')}}</a></button>--}}
{{--                    <button id="attribuite" type="button" class="btn btn-outline-primary col-4"><a href="#attr-form" class="text-dark">{{__('dashboard.attribuites')}}</a></button>--}}
{{--                </div>--}}

                <div class="card-body">
                    <form method="POST" action="{{route('product.store')}}" enctype="multipart/form-data" id="form-prod">
                        @csrf
                            <fieldset id="basic-form">
                                <legend>{{__('dashboard.required')}}</legend>
                                <div class="form-group row">
                                    <div class="col-md-6">
                                        <div class="col-md-12">
                                            <label for="name" class="col-form-label text-md-right">{{__('dashboard.product') .' '. __('dashboard.name')}}</label>
                                            <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>
                                        </div>
                                        @error('name')
                                        <div class="alert alert-danger">
                                            <span class="text-danger">{{$message}}</span>
                                        </div>
                                        @enderror
                                    </div>
                                    <div class="col-md-6">
                                        <div class="col-md-12">
                                            <label for="name_ar" class="col-form-label text-md-right">{{__('dashboard.product') .' '. __('dashboard.namear')}}</label>
                                            <input id="name_ar" type="text" class="form-control @error('name_ar') is-invalid @enderror" name="name_ar" value="{{ old('name_ar') }}" required autocomplete="name_ar" autofocus >
                                        </div>
                                        @error('name_ar')
                                        <div class="alert alert-danger">
                                            <span class="text-danger">{{$message}}</span>
                                        </div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="col-md-12">
                                        <label for="description" class="col-form-label text-md-right">{{__('dashboard.description')}}</label>
                                        <textarea id="description" type="text" class="form-control @error('description') is-invalid @enderror" name="description" required cols="10" rows="5" maxlength="999"></textarea>
                                    </div>
                                    @error('description')
                                    <div class="alert alert-danger">
                                        <span class="text-danger">{{$message}}</span>
                                    </div>
                                    @enderror
                                </div>

                                <!-- Inputs -->
                                <div class="form-group row">
                                    <div class="col-md-6">
                                        <div class="col-md-12">
                                            <label for="category_id" class="col-form-label text-md-right">{{__('dashboard.category')}}</label>
                                            <select id="category_id" class="form-select @error('category_id') is-invalid @enderror" name="category_id"  required autofocus >
                                                <option value="" disabled selected>Choose Category</option>
                                                @foreach($categories as $category)
                                                        @if(\LaravelLocalization::getCurrentLocale() == 'en')
                                                    <option value="{{$category->id}}">{{$category->name}}</option>
                                                    @else
                                                        <option value="{{$category->id}}">{{$category->name_ar}}</option>
                                                    @endif
                                                @endforeach
                                            </select>
                                        </div>
                                        @error('category_id')
                                        <div class="alert alert-danger">
                                            <span class="text-danger">{{$message}}</span>
                                        </div>
                                        @enderror
                                    </div>

                                    <div class="col-md-6">
                                        <div class="col-md-12">
                                            <label for="subcategory_id" class="col-form-label text-md-right">{{__('dashboard.subcategory')}}</label>
                                            <select name="subcategory_id" id="subcategory_id" class="form-select">
                                                <option value="" disabled selected>Choose Sub Category</option>
                                            </select>
                                        </div>
                                        @error('subcategory_id')
                                        <div class="alert alert-danger">
                                            <span class="text-danger">{{$message}}</span>
                                        </div>
                                        @enderror
                                    </div>

                                    <div class="col-md-6">
                                        <div class="col-md-12">
                                            <label for="brand_id" class="col-form-label text-md-right">{{__('dashboard.brand')}}</label>
                                            <select id="brand_id" class="form-select @error('brand_id') is-invalid @enderror" name="brand_id"  required autofocus >
                                                <option value="" disabled selected>Choose Brand</option>
                                                @foreach($brands as $brand)
                                                    @if(\LaravelLocalization::getCurrentLocale() == 'en')
                                                        <option value="{{$brand->id}}">{{$brand->name}}</option>
                                                    @else
                                                        <option value="{{$brand->id}}">{{$brand->name_ar}}</option>
                                                    @endif
                                                @endforeach
                                            </select>
                                        </div>
                                        @error('brand_id')
                                        <div class="alert alert-danger">
                                            <span class="text-danger">{{$message}}</span>
                                        </div>
                                        @enderror
                                    </div>
                                    </div>

                                <div class="form-group row">
                                    <div class="col-md-3">
                                        <div class="col-md-12">
                                            <label for="price" class="col-form-label text-md-right">{{__('dashboard.price')}}</label>
                                            <input id="price" type="number" class="form-control @error('price') is-invalid @enderror" name="price" step="any"  required autocomplete="price" autofocus >
                                        </div>
                                        @error('price')
                                        <div class="alert alert-danger">
                                            <span class="text-danger">{{$message}}</span>
                                        </div>
                                        @enderror
                                    </div>
                                    <div class="col-md-3">
                                        <div class="col-md-12">
                                            <label for="tax" class="col-form-label text-md-right">{{__('dashboard.tax')}}</label>
                                            <input id="tax" type="number" class="form-control" name="tax"  autocomplete="tax" autofocus >
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="col-md-12">
                                            <label for="discount" class="col-form-label text-md-right">{{__('dashboard.discount')}}</label>
                                            <input id="discount" type="number" class="form-control" name="discount"  autocomplete="discount" autofocus >
                                        </div>
                                    </div>
                                </div>
                            </fieldset>
                        <!-- Basics -->

                        <hr>
                        <!-- Information -->
                        <fieldset id="secondary-form" class="dis-nones">
                            <legend>{{__('dashboard.information')}}</legend>
                            <label for="photo" class="col-form-label">{{__('dashboard.photo')}}</label>
                            <div class="col-md-3">
                                <div class="col-md-12" id="uploader">
                                    <input name="image" id="image" type="file" class="form-control"/> <!-- onchange="javascript:updateList()" -->
                                </div>
                            </div>
                        </fieldset>
                        <hr>
                        <!-- attr -->
                        <fieldset id="attr-form">
                            <legend>{{__('dashboard.attribuites')}}</legend>
                            <div class="form-group row">
                                <div class="col-md-6">
                                    <div class="col-md-12">
                                        <label for="weight" class="col-form-label text-md-right">{{__('dashboard.weight')}}</label>
                                        <input id="weight" type="text" class="form-control " name="weight" value="{{ old('weight') }}" autocomplete="weight" autofocus>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="col-md-12">
                                        <label for="qty" class="col-form-label text-md-right">{{__('dashboard.qty')}} <small></small></label>
                                        <input id="qty" type="text" class="form-control" name="qty" value="{{ old('qty') }}" autocomplete="qty" autofocus >
                                    </div>
                                </div>
                            </div>

                        </fieldset>
                    </form>



                    <br>
                    <hr>
                    <label for="">Multiple Photo</label>
                    <form action="{{route('uploadImage')}}" class="dropzone b-1" id="dropzoneForm">
                        @csrf
                        <input type="hidden" value="">
                    </form>
                    <button type="submit" id="submit-all" class="btn" hidden>upload</button>
                    <!-- Form Submit -->
                    <hr>

                    <div class="form-group row mb-0">
                        <div class="col-md-12 flex-c">
                            <button type="submit" form="form-prod" class="btn btn-outline-success col-md-6" onclick="document.getElementById('submit-all').click()">
                                Save
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>

@endsection


@push('script')
    <script>

        Dropzone.options.dropzoneForm = {
            autoProcessQueue: false,
            parallelUploads: 10,
            maxFiles: 10,

            init:function (){
              var Submit = document.getElementById('submit-all');
              myDropzone = this;
              Submit.addEventListener('click' , function (){
                 myDropzone.processQueue();
                  this.options.autoProcessQueue = true;
              });
              this.on('complete' , function (){
                 if (this.getQueuedFiles().length == 0 && this.getUploadingFiles().length == 0) {
                     var _this = this;
                     _this.removeAllFiles();
                     this.options.autoProcessQueue = false;
                 }
              });
            }
        };
    </script>


    <script>
        // Basic Form
        // $('#basic').on('click' , function (){
        //     $('#secondary').removeClass('btn-block active');
        //     $('#attribuite').removeClass('btn-block active');
        //     $(this).addClass('btn-block active');
        //
        //     $('#basic-form').removeClass('dis-none');
        //     $('#secondary-form').addClass('dis-none');
        //     $('#attr-form').addClass('dis-none');
        // });
        //
        // $('#secondary').on('click' , function (){
        //     $('#basic').removeClass('btn-block active');
        //     $('#attribuite').removeClass('btn-block active');
        //     $(this).addClass('btn-block active');
        //
        //     $('#basic-form').addClass('dis-none');
        //     $('#attr-form').addClass('dis-none');
        //     $('#secondary-form').removeClass('dis-none');
        // });
        //
        // $('#attribuite').on('click' , function (){
        //     $('#basic').removeClass('btn-block active');
        //     $('#secondary').removeClass('btn-block active');
        //     $(this).addClass('btn-block active');
        //
        //     $('#basic-form').addClass('dis-none');
        //     $('#secondary-form').addClass('dis-none');
        //     $('#attr-form').removeClass('dis-none');
        //
        // });

        //get subcategory
        $(document).ready(function() {
            //get Brands
            $('#category_id').change( function(){
                var id = $(this).val();
                // get Sub Category
                $.ajax({
                    url:"{{route('getSubCategory')}}",
                    type:'GET',
                    data:{
                        '_token': "{{csrf_token()}}",
                        'id':id
                    },
                    success:function(data){
                        $('#subcategory_id').html(data);
                    }
                });
            });
        });


    </script>

@endpush
