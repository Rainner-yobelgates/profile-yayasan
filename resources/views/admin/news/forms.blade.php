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
        <div class="breadcrumb-item"><a href="{{route('admin.news')}}">Data Berita</a></div>
        <div class="breadcrumb-item active"><a href="#">{{$title}}</a></div>
      </div>
    </div>

    <div class="section-body">
        <div class="card">
            @if($viewType == 'create')
                <form action="{{route('admin.news.store')}}" method="post" enctype="multipart/form-data">
            @elseif($viewType == 'edit')
                <form action="{{route('admin.news.update', $news->id)}}" method="post" enctype="multipart/form-data">
                @method('patch')
            @endif
            @csrf
            <div class="card-header d-flex justify-content-betweend-flex justify-content-between">
                <h4>{{$title}}</h4>
            </div>
            <div class="card-body">
                <div class="form-group">
                    <label>Gambar <span class="text-danger">*</span></label>
                    @isset($news->thumbnail)
                    <div class="mb-2 border" style="width: 200px">
                        <img src="{{asset('storage/'. $news->thumbnail)}}" class="img-fluid" style="object-fit: contain;" alt="thumbnail">
                    </div> 
                    @endisset
                    <input type="file" name="thumbnail" class="form-control" {{$attr}}>
                    @error('thumbnail')
                        <span class="text-danger ms-1">{{ $message }}</span>
                    @enderror
                </div>
                <div class="form-group">
                    <label>Judul <span class="text-danger">*</span></label>
                    <input type="text" name="title" class="form-control" value="{{ old('title', $news->title ?? '') }}" {{$attr}}>
                    @error('title')
                        <span class="text-danger ml-1">{{ $message }}</span>
                    @enderror
                </div>
                <div class="form-group">
                    <label>Konten <span class="text-danger">*</span></label>
                    <textarea name="content" class="summernote">{{$news->content ?? ''}}</textarea>
                    @error('content')
                        <span class="text-danger ml-1">{{ $message }}</span>
                    @enderror
                </div>
                <div class="form-group">
                    <label>Pengarang <span class="text-danger">*</span></label>
                    <input type="text" name="created_by" class="form-control" value="{{ old('created_by', $news->created_by ?? '') }}" {{$attr}}>
                    @error('created_by')
                        <span class="text-danger ml-1">{{ $message }}</span>
                    @enderror
                </div>
                <div class="form-group">
                    <label>Urutan <span class="text-danger">*</span></label>
                    <input type="number" name="order" class="form-control" value="{{ old('order', $news->order ?? '') }}" {{$attr}}>
                    @error('order')
                        <span class="text-danger ml-1">{{ $message }}</span>
                    @enderror
                </div>
                <div class="form-group">
                    <label>Status <span class="text-danger">*</span></label>
                    <select name="status" class="form-control" {{$attr}}>
                        @foreach (get_list_status() as $key => $item)
                        <option value="{{ $key }}" {{isset($news->status) && $key == $news->status ? 'selected' : ''}}>{{ $item }}</option>
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
                <a href="{{route('admin.news')}}" class="mb-2 mr-2 btn btn-warning"
                   title="Back">
                    <i class="fas fa-arrow-left"></i><span> Back</span>
                </a>
            </div>
        </form>
        </div>
    </div>
  </section>
@stop