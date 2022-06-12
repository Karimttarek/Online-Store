@extends('layouts.dashboard')
@section('content')
<div class="container">

    @if (session('status'))
        <div class="alert alert-success col-md-6 m-auto">
            {{ session('status') }}
        </div>
    @endif
    <div class="row justify-content-center p-t-50">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">New Subcategory</div>

                <div class="card-body">
                    <form method="POST" action="{{route('subcategory.store')}}" enctype="multipart/form-data">
                        @csrf

                        <div class="form-group ">
                            <label for="name" class="col-form-label text-md-right">SubCategory name</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>
                            </div>
                            @error('name')
                            <div class="alert alert-danger">
                                <span class="text-danger">{{$message}}</span>
                            </div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="name_ar" class="col-form-label text-md-right">Subcategory name(ar)</label>

                            <div class="col-md-6">
                                <input id="name_ar" type="text" class="form-control @error('name_ar') is-invalid @enderror" name="name_ar" value="{{ old('name_ar') }}" required autocomplete="name_ar" autofocus >
                            </div>
                            @error('name_ar')
                            <div class="alert alert-danger">
                                <span class="text-danger">{{$message}}</span>
                            </div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="category_id" class="col-form-label text-md-right">Category</label>
                            <div class="col-md-6">
                                <select id="category_id" class="form-control @error('category_id') is-invalid @enderror" name="category_id" value="{{ old('category_id') }}" required autocomplete="category_id" autofocus >
                                    <option value="" disabled selected>Choose Category</option>
                                    @foreach($categories as $category)
                                        <option value="{{$category->id}}">{{$category->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            @error('category_id')
                            <div class="alert alert-danger">
                                <span class="text-danger">{{$message}}</span>
                            </div>
                            @enderror
                        </div>

                        <br>
                        <div class="form-group  mb-0">
                            <div class="col-md-6">
                                <button type="submit" class="btn btn-outline-success">
                                    Save
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
