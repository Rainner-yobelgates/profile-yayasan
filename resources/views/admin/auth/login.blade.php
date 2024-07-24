@extends('admin.layouts')
@section('title', 'Masuk')
@section('content-login')
<section class="section">
    <div class="container mt-5">
      <div class="row">
        <div class="col-12 col-sm-8 offset-sm-2 col-md-6 offset-md-3 col-lg-6 offset-lg-3 col-xl-4 offset-xl-4">
          <div class="card card-primary mt-5">
            <div class="card-header"><h4>Halaman Masuk</h4></div>

            <div class="card-body">
              @if (session('fail'))
                  <div class="alert alert-danger">{{ session('fail') }}</div>
              @endif
              <form method="POST" action="{{route('goLogin')}}" class="needs-validation" novalidate="">
                @csrf
                <div class="form-group">
                  <label for="username">Nama</label>
                  <input id="username" type="text" class="form-control" name="name" tabindex="1" required autofocus>
                  @error('name') <span class="text-danger"></span>@enderror
                </div>

                <div class="form-group">
                  <div class="d-block">
                      <label for="password" class="control-label">Kata Sandi</label>
                  </div>
                  <input id="password" type="password" class="form-control" name="password" tabindex="2" required>
                  @error('password') <span class="text-danger"></span>@enderror
                </div>

                <div class="form-group">
                  <button type="submit" class="btn btn-primary btn-lg btn-block" tabindex="4">
                    Masuk
                  </button>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
@stop