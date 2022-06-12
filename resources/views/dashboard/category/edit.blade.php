@extends('layouts.dashboard')
@section('content')
<div class="container">

    @if (session('status'))
        <div class="alert alert-success col-md-6">
            {{ session('status') }}
        </div>
    @endif
    <div class="row justify-content-center p-t-50">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">Edit Category</div>
                @foreach($data as $category)
                <div class="card-body">
                    <form method="POST" action="{{route('category.update' ,$category->id)}}" enctype="multipart/form-data">
                        @csrf

                        <div class="form-group ">
                            <label for="name" class="col-form-label text-md-right">Category name</label>

                            <div class="col-md-6">
                                <input id="name" type="text" value="{{$category->name}}" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>
                            </div>
                            @error('name')
                            <div class="alert alert-danger">
                                <span class="text-danger">{{$message}}</span>
                            </div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="name_ar" class="col-form-label text-md-right">Category name Ar</label>

                            <div class="col-md-6">
                                <input id="name_ar" type="text" value="{{$category->name_ar}}" class="form-control @error('name_ar') is-invalid @enderror" name="name_ar" value="{{ old('name_ar') }}" required autocomplete="name_ar" autofocus >
                            </div>
                            @error('name_ar')
                            <div class="alert alert-danger">
                                <span class="text-danger">{{$message}}</span>
                            </div>
                            @enderror
                        </div>
                        @endforeach
                        <div class="form-group">
                            <label for="image" class="col-form-label text-md-right">image</label>

                            <div class="col-md-6">
                                <input id="image" type="file" class="form-control @error('image') is-invalid @enderror" name="image">
                            </div>
                            @error('image')
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
