@extends('user.layouts')
@section('content')
<div class="container-fluid page-header py-6 my-6 mt-0 wow fadeIn" data-wow-delay="0.1s">
    <div class="container text-center">
        <h1 class="display-4 text-white animated slideInDown mb-4">{{ $activity->activity }}</h1>
        <nav aria-label="breadcrumb animated slideInDown">
            <ol class="breadcrumb justify-content-center mb-0">
                <li class="breadcrumb-item"><a class="text-white" href="{{ route('home') }}">Beranda</a></li>
                <li class="breadcrumb-item"><a class="text-white" href="#">Kegiatan</a></li>
                <li class="breadcrumb-item text-primary active" aria-current="page">{{ $activity->activity }}</li>
            </ol>
        </nav>
    </div>
</div>
<!-- Page Header End -->


<!-- Features Start -->
<div class="container-xxl py-6">
    <div class="container">
        <div class="row g-5">
            <div class="col-lg-8 wow fadeInUp" data-wow-delay="0.1s">
                <h1 class="display-6 mb-4">{{ $activity->activity }}</h1>
                <div class="row gy-5 gx-4">
                    <div class="col-12 wow fadeIn" data-wow-delay="0.3s">
                        {!! $activity->description !!}
                    </div>                
                </div>
            </div>
            <div class="col-lg-4 wow fadeInUp" data-wow-delay="0.5s">
                <img src="{{ isset(getSetting()['image-chairman']) ? asset('storage/'.getSetting()['image-chairman']['value']) : '' }}" style="width: 100%;height: 15rem;object-fit: contain;" class="img-fluid" alt="">
                <hr>
                <h6 class="text-center">{{ isset(getSetting()['name-chairman']) ? getSetting()['name-chairman']['value'] : '' }}</h6>
                <div class="p-3 bg-light" style="text-align: justify;">
                    {{ isset(getSetting()['welcome-chairman']) ? getSetting()['welcome-chairman']['value'] : '' }}
                </div>               
            </div>
        </div>
    </div>
</div>
@endsection
