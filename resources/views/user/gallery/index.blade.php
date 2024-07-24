@extends('user.layouts')
@section('content')
    <!-- Page Header Start -->
    <div class="container-fluid page-header py-6 my-6 mt-0 wow fadeIn" data-wow-delay="0.1s">
        <div class="container text-center">
            <h1 class="display-4 text-white animated slideInDown mb-4">Galeri</h1>
            <nav aria-label="breadcrumb animated slideInDown">
                <ol class="breadcrumb justify-content-center mb-0">
                    <li class="breadcrumb-item"><a class="text-white" href="{{ route('home') }}">Beranda</a></li>
                    <li class="breadcrumb-item text-primary active" aria-current="page">Galeri</li>
                </ol>
            </nav>
        </div>
    </div>
    <!-- Page Header End -->


    <!-- Contact Start -->
    <div class="container-xxl py-6">
        <div class="container">
            <div class="text-center mx-auto mb-5 wow fadeInUp" data-wow-delay="0.1s" style="max-width: 500px;">
                <h6 class="text-primary text-uppercase mb-2">Galeri</h6>
                <h1 class="display-6 mb-4">Dokumentasi Kami</h1>
            </div>
            <div class="row g-0 team-items">
                @forelse ($data as $item)
                    <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.{{ $loop->iteration }}s">
                        <div class="team-item position-relative">
                            <div class="position-relative">
                                <img class="img-fluid" style="width: 100%;height: 17rem;object-fit: cover;" src="{{ asset('storage/'.$item->image) }}" alt="">
                                <div class="team-social text-center">
                                    <a class="btn btn-square btn-outline-primary border-2 m-1" href="{{ asset('storage/'.$item->image) }}" data-lightbox="image-{{ $item->id }}" data-title="{{ $item->preview }}"><i class="fas fa-search-plus"></i></a>
                                </div>
                            </div>
                            {{-- <div class="bg-light p-2 text-center">
                                <span>{{ $item->preview }}</span>
                            </div> --}}
                        </div>
                    </div>                                    
                @empty
                    
                @endforelse
            </div>
        </div>
    </div>
@endsection
@section('css')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.11.4/css/lightbox.min.css" integrity="sha512-ZKX+BvQihRJPA8CROKBhDNvoc2aDMOdAlcm7TUQY+35XYtrd3yh95QOOhsPDQY9QnKE0Wqag9y38OIgEvb88cA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    
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