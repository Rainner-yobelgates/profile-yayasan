@extends('user.layouts')
@section('content')
<div class="container-fluid page-header py-6 my-6 mt-0 wow fadeIn" data-wow-delay="0.1s">
    <div class="container text-center">
        <h1 class="display-4 text-white animated slideInDown mb-4">{{ $berita->title }}</h1>
        <nav aria-label="breadcrumb animated slideInDown">
            <ol class="breadcrumb justify-content-center mb-0">
                <li class="breadcrumb-item"><a class="text-white" href="{{ route('home') }}">Beranda</a></li>
                <li class="breadcrumb-item"><a class="text-white" href="#">Berita</a></li>
                <li class="breadcrumb-item text-primary active" aria-current="page">{{ $berita->title }}</li>
            </ol>
        </nav>
    </div>
</div>
<!-- Page Header End -->


<!-- Features Start -->
<div class="container-xxl py-4">
    <div class="container">
        <div class="row g-5">
            <div class="col-lg-8 wow fadeInUp" data-wow-delay="0.1s">
                <h1 class="display-6">{{ $berita->title }}</h1>
                <div class="d-flex mb-4">
                    <h6 class="text-primary text-capitalize" style="margin-right: 10px;"><i class="fas fa-user"></i> {{ $berita->created_by }}</h6>
                    <h6 class="text-primary text-capitzlie"><i class="fa fa-calendar-alt"></i> {{ date('d M Y H:i',strtotime($berita->created_at)) }}</h6>
                </div>
                <div class="row gy-5 gx-4">
                    <div class="col-12 wow fadeIn" data-wow-delay="0.3s">
                        {!! $berita->content !!}
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

<div class="container-xxl py-6">
    <div class="container">
        <div class="text-center mx-auto mb-5 wow fadeInUp" data-wow-delay="0.1s" style="max-width: 500px;">
            <h1 class="display-6 mb-4">Berita Lainnya</h1>
        </div>
        <div class="row g-4 justify-content-center">
            @forelse ($data as $item)
                <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.{{ $loop->iteration }}s">
                    <div class="courses-item d-flex flex-column bg-white overflow-hidden h-100">
                        <div class="position-relative mt-auto">
                            <img class="img-fluid" src="{{ asset('storage/'.$item->thumbnail) }}" style="width: 100%;height: 17rem;" alt="">
                            <div class="courses-overlay">
                                <a class="btn btn-outline-primary border-2" href="{{ route('news.detail',$item->slug) }}">Read More</a>
                            </div>
                        </div>
                        <div class="text-center p-3 pt-0">
                            <div class="d-inline-block py-2  px-4 mb-1"></div>
                            <h5 class="mb-3">{{ substr($item->title,0,25) }}...</h5>
                            {{-- <p>Tempor erat elitr rebum at clita dolor diam ipsum sit diam amet diam et eos</p> --}}
                            <ol class="breadcrumb justify-content-center mb-0">                                   
                                <li class="breadcrumb-item small text-capitalize"><i class="fas fa-user text-primary me-2"></i> {{ $item->created_by }}</li>
                                <li class="breadcrumb-item small"><i class="fa fa-calendar-alt text-primary me-2"></i> {{ date('d M Y H:i',strtotime($item->created_at)) }}</li>
                            </ol>
                        </div>                            
                    </div>
                </div>                                   
            @empty
                
            @endforelse
        </div>
    </div>
</div>
@endsection
