@extends('user.layouts')
@section('content')
    <!-- Carousel Start -->
    <div class="container-fluid p-0 wow fadeIn" data-wow-delay="0.1s">
        <div id="header-carousel" class="carousel slide" data-bs-ride="carousel">
            <div class="carousel-inner">
                @foreach ($banner as $key => $item)
                    <div class="carousel-item {{ $key == 0 ? 'active' : '' }}">
                        <img class="w-100" style="height: 90vh !important;" src="{{ asset('storage/' . $item->image) }}" alt="Image">
                        {{-- <div class="carousel-caption">
                            <div class="container">
                                <div class="row justify-content-center">
                                    <div class="col-lg-7">
                                        <h1 class="display-2 text-light mb-5 animated slideInDown">Learn To Drive With Confidence</h1>
                                        <a href="" class="btn btn-primary py-sm-3 px-sm-5">Learn More</a>
                                        <a href="" class="btn btn-light py-sm-3 px-sm-5 ms-3">Our Courses</a>
                                    </div>
                                </div>
                            </div>
                        </div> --}}
                    </div>
                @endforeach
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#header-carousel" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#header-carousel" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
        </div>
    </div>
    <!-- Carousel End -->


    <!-- Facts Start -->
    <div class="container-fluid facts pt-5">
        <div class="container pb-5">
            <div class="row gx-0 d-flex align-items-center">
                <div class="col-4 col-lg-2 wow fadeIn" data-wow-delay="0.3s">
                    <div class="bg-primary py-2 text-center" style="border-top-right-radius: 50px;border-bottom-right-radius: 50px;"><h6 class="mb-0 text-white">Informasi</h6></div>
                </div>
                <div class="col-8 col-lg-10 wow fadeIn" data-wow-delay="0.3s">
                    <div class="bg-white d-flex align-items-center p-0" style="min-height: max-content;overflow: hidden;">
                        <div class="d-flex ticker">
                            <div class="ticker__list d-flex">
                                @foreach ($runningtext as $item)
                                    <div class="ticker__item py-2 px-3" style="border-left: 1px solid #000000;border-right: 1px solid #000000;">
                                        <h6 class="mb-0">{{ $item->sentence }}</h6>                                        
                                    </div>                                    
                                @endforeach                                
                            </div>
                        </div>
                    </div>
                </div>
                {{-- <div class="col-lg-4 wow fadeIn" data-wow-delay="0.3s">
                    <div class="bg-white shadow d-flex align-items-center h-100 p-4" style="min-height: 150px;">
                        <div class="d-flex">
                            <div class="flex-shrink-0 btn-lg-square bg-primary">
                                <i class="fa fa-users text-white"></i>
                            </div>
                            <div class="ps-4">
                                <h5>National Instructor</h5>
                                <span>Clita erat ipsum lorem sit sed stet duo justo erat amet</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 wow fadeIn" data-wow-delay="0.5s">
                    <div class="bg-white shadow d-flex align-items-center h-100 p-4" style="min-height: 150px;">
                        <div class="d-flex">
                            <div class="flex-shrink-0 btn-lg-square bg-primary">
                                <i class="fa fa-file-alt text-white"></i>
                            </div>
                            <div class="ps-4">
                                <h5>Get licence</h5>
                                <span>Clita erat ipsum lorem sit sed stet duo justo erat amet</span>
                            </div>
                        </div>
                    </div>
                </div> --}}
            </div>
        </div>
    </div>
    <!-- Facts End -->


    <!-- About Start -->
    <div class="container-xxl pb-6">
        <div class="container">
            <div class="row g-5">
                <div class="col-lg-6 wow fadeInUp" data-wow-delay="0.1s">
                    <div class="position-relative overflow-hidden ps-5 pt-5 h-100" style="min-height: 400px;">
                        <img class="position-absolute w-100 h-100" src="{{ isset(getSetting()['image-chairman']) ? asset('storage/'.getSetting()['image-chairman']['value']) : '' }}" alt="" style="object-fit: contain;">                        
                    </div>
                </div>
                <div class="col-lg-6 wow fadeInUp" data-wow-delay="0.5s">
                    <div class="h-100">
                        <h6 class="text-primary text-uppercase mb-2">Sambutan Ketua Yayasan</h6>
                        <h1 class="display-6 mb-4">{{ isset(getSetting()['name-chairman']) ? getSetting()['name-chairman']['value'] : 'Ketua Yayasan' }}</h1>
                        <div class="mb-3 g-2 pb-2">
                            <p style="text-align: justify;">
                                {{  isset(getSetting()['welcome-chairman']) ? substr(getSetting()['welcome-chairman']['value'],0,280) : ''  }}....
                            </p>
                        </div>
                        
                        <div class="row g-4">
                            <div class="col-sm-6">
                                <a class="btn btn-primary py-2 px-5" href="{{ route('about.profile') }}">Baca Selengkapnya</a>
                            </div>                            
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- About End -->

    <div class="container-xxl py-6">
        <div class="container">
            <div class="text-center mx-auto mb-5 wow fadeInUp" data-wow-delay="0.1s" style="max-width: 500px;">
                <h1 class="display-6 mb-4">Lembaga Kami</h1>
            </div>
            <div class="row justify-content-center">
                <div class="col-lg-8 wow fadeInUp" data-wow-delay="0.3s">
                    <div class="owl-carousel testimonial-carousel">
                        @forelse (getLembaga() as $item)
                            <a href="{{ route('institution',$item->slug) }}">
                                <div class="testimonial-item text-center">
                                    <div class="position-relative">
                                        <img class="img-fluid mx-auto"src="{{ asset('storage/'.$item->logo) }}" alt="">
                                        
                                    </div>
                                    <hr class="w-25 mx-auto">
                                    <h5>{{ $item->name }}</h5>
                                </div>                            
                            </a>
                        @empty
                        @endforelse
                        </div>
                    </div>                    
                    
            </div>
        </div>
    </div>

    <!-- Courses Start -->    
    <div class=" courses my-6 py-6 pb-0" style="background: linear-gradient(rgba(255, 255, 255, .9), rgba(255, 255, 255, .9)), url({{ isset($bannerfirst->image) ? asset('storage/'.$bannerfirst->image) : '' }}); min-height: 100vh;background-attachment: fixed;background-size: cover;">
        <div class="container">
            <div class="text-center mx-auto mb-5 wow fadeInUp" data-wow-delay="0.1s" style="max-width: 500px;">
                {{-- <h6 class="text-primary text-uppercase mb-2">Tranding Courses</h6> --}}
                <h1 class="display-6">Berita Terkini</h1>
            </div>
            <div class="row g-4">
                @forelse ($news as $item)
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
    <!-- Courses End -->


    <!-- Team Start -->
    <div class="container-xxl py-6">
        <div class="container">
            <div class="text-center mx-auto mb-5 wow fadeInUp" data-wow-delay="0.1s" style="max-width: 500px;">
                <h1 class="display-6 mb-4">Galeri</h1>
            </div>
            <div class="row g-0 team-items">
                @forelse ($gallery as $item)
                    <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.{{ $loop->iteration }}s">
                        <div class="team-item position-relative">
                            <div class="position-relative">
                                <img class="img-fluid" style="width: 100%;height: 17rem;object-fit: cover;" src="{{ asset('storage/'.$item->image) }}" alt="">
                                <div class="team-social text-center">
                                    <a class="btn btn-square btn-outline-primary border-2 m-1" href="{{ asset('storage/'.$item->image) }}" data-lightbox="image-{{ $item->id }}" data-title="{{ $item->preview }}"><i class="fas fa-search-plus"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>                                    
                @empty
                    
                @endforelse
            </div>
        </div>
    </div>
    <!-- Team End -->


    <!-- Testimonial Start -->
    
    <!-- Testimonial End -->
@endsection
@section('css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.11.4/css/lightbox.min.css" integrity="sha512-ZKX+BvQihRJPA8CROKBhDNvoc2aDMOdAlcm7TUQY+35XYtrd3yh95QOOhsPDQY9QnKE0Wqag9y38OIgEvb88cA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <style>        
        .ticker{
            width: 100%;
        }
        .ticker__list {
            animation: ticker 15s infinite linear;
        }

        .ticker:hover .ticker__list {
            animation-play-state: paused;
        }

        .ticker__item {
            width: max-content !important;
            margin-right: 20px !important;
        }

        @-moz-keyframes ticker {
            100% {
                transform: translateX(-100%);
            }
        }

        @-webkit-keyframes ticker {
            100% {
                transform: translateX(-100%);
            }
        }

        @-o-keyframes ticker {
            100% {
                transform: translateX(-100%);
            }
        }

        @keyframes ticker {
            100% {
                transform: translateX(-100%);
            }
        }
    </style>
@endsection
@section('js')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.11.4/js/lightbox.min.js" integrity="sha512-Ixzuzfxv1EqafeQlTCufWfaC6ful6WFqIz4G+dWvK0beHw0NVJwvCKSgafpy5gwNqKmgUfIBraVwkKI+Cz0SEQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script>
        var ticker = document.querySelector('.ticker'),
            list = document.querySelector('.ticker__list'),
            clone = list.cloneNode(true)

        ticker.append(clone)
        $(document).ready(function(){
            lightbox.option({
                'resizeDuration': 200,
                'wrapAround': true,
            })
        })
    </script>
@endsection
