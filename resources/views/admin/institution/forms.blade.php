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
        <div class="breadcrumb-item"><a href="{{route('admin.institution')}}">Data Lembaga</a></div>
        <div class="breadcrumb-item active"><a href="#">{{$title}}</a></div>
      </div>
    </div>

    <div class="section-body">
        <div class="card">
            @if($viewType == 'create')
                <form action="{{route('admin.institution.store')}}" method="post" enctype="multipart/form-data">
            @elseif($viewType == 'edit')
                <form action="{{route('admin.institution.update', $institution->id)}}" method="post" enctype="multipart/form-data">
                @method('patch')
            @endif
            @csrf
            <div class="card-header d-flex justify-content-betweend-flex justify-content-between">
                <h4>{{$title}}</h4>
            </div>
            <div class="card-body">
                <div class="form-group">
                    <label>Logo <span class="text-danger">*</span></label>
                    @isset($institution->logo)
                    <div class="mb-2 border" style="width: 200px">
                        <img src="{{asset('storage/'. $institution->logo)}}" class="img-fluid" style="object-fit: contain;" alt="galeri">
                    </div> 
                    @endisset
                    <input type="file" name="logo" class="form-control" {{$attr}}>
                    @error('logo')
                        <span class="text-danger ms-1">{{ $message }}</span>
                    @enderror
                </div>
                <div class="form-group">
                    <label>Nama <span class="text-danger">*</span></label>
                    <input type="text" name="name" class="form-control" value="{{ old('name', $institution->name ?? '') }}" {{$attr}}>
                    @error('name')
                        <span class="text-danger ml-1">{{ $message }}</span>
                    @enderror
                </div>
                <div class="form-group">
                    <label>Penjelasan <span class="text-danger">*</span></label>
                    <textarea name="description" class="summernote">{{$institution->description ?? ''}}</textarea>
                    @error('description')
                        <span class="text-danger ml-1">{{ $message }}</span>
                    @enderror
                </div>
                <div class="form-group">
                    <label>Urutan <span class="text-danger">*</span></label>
                    <input type="number" name="order" class="form-control" value="{{ old('order', $institution->order ?? '') }}" {{$attr}}>
                    @error('order')
                        <span class="text-danger ml-1">{{ $message }}</span>
                    @enderror
                </div>
                <div class="form-group">
                    <label>Status <span class="text-danger">*</span></label>
                    <select name="status" class="form-control" {{$attr}}>
                        @foreach (get_list_status() as $key => $item)
                        <option value="{{ $key }}" {{isset($institution->status) && $key == $institution->status ? 'selected' : ''}}>{{ $item }}</option>
                        @endforeach
                    </select>
                    @error('status')
                        <span class="text-danger ml-1">{{ $message }}</span>
                    @enderror
                </div>
            </div>
            <div class="card-footer">
                @if($viewType == 'create')
                    <button type="submit" class="mb-2 mr-2 btn btn-success" title="Save">
                        <i class="fas fa-save"></i><span> Save</span>
                    </button>
                @elseif ($viewType == 'edit')
                    <button type="submit" class="mb-2 mr-2 btn btn-primary" title="Update">
                        <i class="fas fa-save"></i><span> Update</span>
                    </button>
                @endif
                <a href="{{route('admin.institution')}}" class="mb-2 mr-2 btn btn-warning"
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
        var attrValue = '{{$attr}}'; 
        if (attrValue === 'disabled') {
            $('#summernote').summernote('disable');
        }
        $('#summernote').summernote();
    });
</script>
@stop