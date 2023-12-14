@extends('admin.layouts')
@section('title', $title)
@section('content')
<section class="section">
    <div class="section-header">
      <h1>{{$title}}</h1>
    </div>

    <div class="section-body">
        <div class="card">
            <form action="{{route('admin.setting.update')}}" method="post" enctype="multipart/form-data">
            @method('patch')
            @csrf
            <div class="card-header d-flex justify-content-betweend-flex justify-content-between">
                <h4>{{$title}}</h4>
            </div>
            <div class="card-body">
                <div class="form-group">
                    <label>Nama Yayasan <span class="text-danger">*</span></label>
                    <input type="text" name="name" class="form-control" value="{{ old('name', $settings['name'] ?? '') }}">
                    @error('name')
                        <span class="text-danger ml-1">{{ $message }}</span>
                    @enderror
                </div>
                <div class="form-group">
                    <label>Logo Yayasan <span class="text-danger">*</span></label>
                    @isset($settings['logo'])
                    <div class="mb-2 border" style="width: 200px">
                        <img src="{{asset('storage/'. $settings['logo'])}}" class="img-fluid" style="object-fit: contain;" alt="logo">
                    </div> 
                    @endisset
                    <input type="file" name="logo" class="form-control">
                    @error('logo')
                        <span class="text-danger ms-1">{{ $message }}</span>
                    @enderror
                </div>
                <div class="form-group">
                    <label>Slogan Yayasan <span class="text-danger">*</span></label>
                    <input type="text" name="slogan" class="form-control" value="{{ old('slogan', $settings['slogan'] ?? '') }}">
                    @error('slogan')
                        <span class="text-danger ml-1">{{ $message }}</span>
                    @enderror
                </div>
                <div class="form-group">
                    <label>Alamat Yayasan <span class="text-danger">*</span></label>
                    <textarea name="address" class="summernote">{{$settings['address'] ?? ''}}</textarea>
                    @error('address')
                        <span class="text-danger ml-1">{{ $message }}</span>
                    @enderror
                </div>
                <div class="form-group">
                    <label>No Telp / Whatsapp</label>
                    <div class="input-group">
                      <div class="input-group-prepend">
                        <div class="input-group-text">
                          +62
                        </div>
                      </div>
                      <input type="number" name="phone" value="{{ old('phone', $settings['phone'] ?? '') }}" class="form-control phone-number">
                    </div>
                  </div>
                <div class="form-group">
                    <label>Instagram <span class="text-danger">*</span></label>
                    <input type="text" name="instagram" class="form-control" value="{{ old('instagram', $settings['instagram'] ?? '') }}">
                    @error('instagram')
                        <span class="text-danger ml-1">{{ $message }}</span>
                    @enderror
                </div>
                <div class="form-group">
                    <label>Youtube <span class="text-danger">*</span></label>
                    <input type="text" name="youtube" class="form-control" value="{{ old('youtube', $settings['youtube'] ?? '') }}">
                    @error('youtube')
                        <span class="text-danger ml-1">{{ $message }}</span>
                    @enderror
                </div>
                <div class="form-group">
                    <label>Email <span class="text-danger">*</span></label>
                    <input type="email" name="email" class="form-control" value="{{ old('email', $settings['email'] ?? '') }}">
                    @error('email')
                        <span class="text-danger ml-1">{{ $message }}</span>
                    @enderror
                </div>
                <div class="form-group">
                    <label>Foto Ketua Yayasan <span class="text-danger">*</span></label>
                    @isset($settings['image-chairman'])
                    <div class="mb-2 border" style="width: 200px">
                        <img src="{{asset('storage/'. $settings['image-chairman'])}}" class="img-fluid" style="object-fit: contain;" alt="Foto Ketua Yayasan">
                    </div> 
                    @endisset
                    <input type="file" name="image-chairman" class="form-control">
                    @error('image-chairman')
                        <span class="text-danger ms-1">{{ $message }}</span>
                    @enderror
                </div>
                <div class="form-group">
                    <label>Nama Ketua Yayasan <span class="text-danger">*</span></label>
                    <input type="text" name="name-chairman" class="form-control" value="{{ old('name-chairman', $settings['name-chairman'] ?? '') }}">
                    @error('name-chairman')
                        <span class="text-danger ml-1">{{ $message }}</span>
                    @enderror
                </div>
                <div class="form-group">
                    <label>Sambutan Ketua Yayasan <span class="text-danger">*</span></label>
                    <textarea name="welcome-chairman" class="summernote">{{$settings['welcome-chairman'] ?? ''}}</textarea>
                    @error('welcome-chairman')
                        <span class="text-danger ml-1">{{ $message }}</span>
                    @enderror
                </div>
                <div class="form-group">
                    <label>Visi <span class="text-danger">*</span></label>
                    <textarea name="vision" class="summernote">{{$settings['vision'] ?? ''}}</textarea>
                    @error('vision')
                        <span class="text-danger ml-1">{{ $message }}</span>
                    @enderror
                </div>
                <div class="form-group">
                    <label>Misi <span class="text-danger">*</span></label>
                    <textarea name="mission" class="summernote">{{$settings['mission'] ?? ''}}</textarea>
                    @error('mission')
                        <span class="text-danger ml-1">{{ $message }}</span>
                    @enderror
                </div>
                <div class="form-group">
                    <label>Profil Yayasan <span class="text-danger">*</span></label>
                    <textarea name="profile-foundation" class="summernote">{{$settings['profile-foundation'] ?? ''}}</textarea>
                    @error('profile-foundation')
                        <span class="text-danger ml-1">{{ $message }}</span>
                    @enderror
                </div>
            </div>
            <div class="card-footer">
                <button type="submit" class="mb-2 mr-2 btn btn-success" title="Save">
                    <i class="fas fa-save"></i><span> Save</span>
                </button>
            </div>
        </form>
        </div>
    </div>
  </section>
@stop