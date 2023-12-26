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
        <div class="breadcrumb-item"><a href="{{route('admin.activity')}}">Data Kegiatan</a></div>
        <div class="breadcrumb-item active"><a href="#">{{$title}}</a></div>
      </div>
    </div>

    <div class="section-body">
        <div class="card">
            @if($viewType == 'create')
                <form action="{{route('admin.activity.store')}}" method="post" enctype="multipart/form-data">
            @elseif($viewType == 'edit')
                <form action="{{route('admin.activity.update', $activity->id)}}" method="post" enctype="multipart/form-data">
                @method('patch')
            @endif
            @csrf
            <div class="card-header d-flex justify-content-betweend-flex justify-content-between">
                <h4>{{$title}}</h4>
            </div>
            <div class="card-body">
                <div class="form-group">
                    <label>Nama Kegiatan <span class="text-danger">*</span></label>
                    <input type="text" name="activity" class="form-control" value="{{$activity->activity ?? ''}}">
                    @error('activity')
                        <span class="text-danger ml-1">{{ $message }}</span>
                    @enderror
                </div>
                <div class="form-group">
                    <label>Penjelasan <span class="text-danger">*</span></label>
                    <textarea name="description" class="summernote">{{$activity->description ?? ''}}</textarea>
                    @error('description')
                        <span class="text-danger ml-1">{{ $message }}</span>
                    @enderror
                </div>
                <div class="form-group">
                    <label>Urutan <span class="text-danger">*</span></label>
                    <input type="number" name="order" class="form-control" value="{{ old('order', $activity->order ?? '') }}" {{$attr}}>
                    @error('order')
                        <span class="text-danger ml-1">{{ $message }}</span>
                    @enderror
                </div>
                <div class="form-group">
                    <label>Status <span class="text-danger">*</span></label>
                    <select name="status" class="form-control" {{$attr}}>
                        @foreach (get_list_status() as $key => $item)
                        <option value="{{ $key }}" {{isset($activity->status) && $key == $activity->status ? 'selected' : ''}}>{{ $item }}</option>
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
                <a href="{{route('admin.activity')}}" class="mb-2 mr-2 btn btn-warning"
                   title="Back">
                    <i class="fas fa-arrow-left"></i><span> Back</span>
                </a>
            </div>
        </form>
        </div>
    </div>
  </section>
@stop