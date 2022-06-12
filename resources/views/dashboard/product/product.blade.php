@extends('layouts.dashboard')

@section('content')
{{--<section class="p-5">--}}
   <div class="container p-t-50">
       @if (session('status'))
           <div class="alert alert-success col-md-12">
               {{ session('status') }}
           </div>
       @endif
       <div class="row">
           <div class="col-sm-12">
               {!! Form::open(['id'=> 'form' , 'url' => 'dashboard/product/destroy' , 'method' => 'get'])  !!}
               {!! $dataTable->table(['class' =>' table table-striped table-hover table-bordered p-t-10']) !!}
               {!! Form::close() !!}
           </div>
       </div>
   </div>
</section>

{!! $dataTable->scripts() !!}

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-body">
               Are you sure to delete this items?
            </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-danger subdel"> Delete</button>
                </div>
        </div>
    </div>
</div>
@endsection

@push('script')
@endpush
