@extends('user.layouts')
@section('content')
    <!-- Page Header Start -->
    <div class="container-fluid page-header py-6 my-6 mt-0 wow fadeIn" data-wow-delay="0.1s">
        <div class="container text-center">
            <h1 class="display-4 text-white animated slideInDown mb-4">Berita</h1>
            <nav aria-label="breadcrumb animated slideInDown">
                <ol class="breadcrumb justify-content-center mb-0">
                    <li class="breadcrumb-item"><a class="text-white" href="{{ route('home') }}">Beranda</a></li>
                    <li class="breadcrumb-item text-primary active" aria-current="page">Berita</li>
                </ol>
            </nav>
        </div>
    </div>
    <!-- Page Header End -->


    <!-- Contact Start -->
    <div class="container-xxl py-6">
        <div class="container">
            <div class="text-center mx-auto mb-5 wow fadeInUp" data-wow-delay="0.1s" style="max-width: 500px;">
                <h6 class="text-primary text-uppercase mb-2">Berita</h6>
                <h1 class="display-6 mb-4">Berita Informasi</h1>
            </div>
            <div class="row g-4 justify-content-center">
                @forelse ($data as $item)
                    <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.{{ $loop->iteration }}s">
                        <div class="courses-item d-flex flex-column bg-white overflow-hidden h-100">
                            <div class="position-relative mt-auto">
                                <img class="img-fluid" src="{{ asset('user-template') }}/img/courses-1.jpg" alt="">
                                <div class="courses-overlay">
                                    <a class="btn btn-outline-primary border-2" href="">Read More</a>
                                </div>
                            </div>
                            <div class="text-center p-3 pt-0">
                                <div class="d-inline-block py-2  px-4 mb-1"></div>
                                <h5 class="mb-3">{{ substr($item->title,0,25) }}...</h5>
                                {{-- <p>Tempor erat elitr rebum at clita dolor diam ipsum sit diam amet diam et eos</p> --}}
                                <ol class="breadcrumb justify-content-center mb-0">                                   
                                    <li class="breadcrumb-item small"><i class="fas fa-user text-primary me-2"></i> {{ date('d M Y H:i',strtotime($item->created_at)) }}</li>
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