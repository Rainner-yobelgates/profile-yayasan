<?php 
    $attr = '';
    if($viewType == 'show'){
        $attr = 'disabled';
    }
?>
@extends('admin.layouts')
@section('title', $title)
@section('content')
<section class="section">
    <div class="section-header">
      <h1>{{$title}}</h1>
      <div class="section-header-breadcrumb">
        <div class="breadcrumb-item"><a href="{{route('admin.message')}}">Data Pesan</a></div>
        <div class="breadcrumb-item active"><a href="#">{{$title}}</a></div>
      </div>
    </div>

    <div class="section-body">
        <div class="card">
            @if($viewType == 'create')
                <form action="{{route('admin.message.store')}}" method="post" enctype="multipart/form-data">
            @elseif($viewType == 'edit')
                <form action="{{route('admin.message.update', $message->id)}}" method="post" enctype="multipart/form-data">
                @method('patch')
            @endif
            @csrf
            <div class="card-header d-flex justify-content-betweend-flex justify-content-between">
                <h4>{{$title}}</h4>
            </div>
            <div class="card-body">
                <div class="form-group">
                    <label>Nama <span class="text-danger">*</span></label>
                    <input type="text" name="name" class="form-control" value="{{ old('name', $message->name ?? '') }}" {{$attr}}>
                    @error('name')
                        <span class="text-danger ml-1">{{ $message }}</span>
                    @enderror
                </div>
                <div class="form-group">
                    <label>Email <span class="text-danger">*</span></label>
                    <input type="text" name="email" class="form-control" value="{{ old('email', $message->email ?? '') }}" {{$attr}}>
                    @error('email')
                        <span class="text-danger ml-1">{{ $message }}</span>
                    @enderror
                </div>
                <div class="form-group">
                    <label>Pesan <span class="text-danger">*</span></label>
                    <textarea name="message" class="summernote">{{$message->message ?? ''}}</textarea>
                    @error('message')
                        <span class="text-danger ml-1">{{ $message }}</span>
                    @enderror
                </div>
            </div>
            <div class="card-footer">
                <a href="{{route('admin.message')}}" class="mb-2 mr-2 btn btn-warning"
                   title="Back">
                    <i class="fas fa-arrow-left"></i><span> Back</span>
                </a>
            </div>
        </form>
        </div>
    </div>
  </section>
@stop
@section('script')
    <script>
        $(document).ready(function() {
            if ('{{$attr}}' == 'disabled') {
			    $('.summernote').summernote('disable') 
            }
			$('.summernote').summernote();
		});
    </script>
@endsection