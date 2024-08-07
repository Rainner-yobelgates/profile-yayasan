<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>{{ $title }} - {{ isset(getSetting()['name']) ? getSetting()['name']['value'] : '' }}</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    {{ isset(getSetting()['meta-seo']) ? getSetting()['meta-seo']['value'] : '' }}

    <!-- Favicon -->
    <link href="{{ isset(getSetting()['logo']) ? asset('storage/'.getSetting()['logo']['value']) : '' }}" rel="icon">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Work+Sans:wght@400;500;600;700&display=swap" rel="stylesheet"> 

    <!-- Icon Font Stylesheet -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="{{ asset('user-template') }}/lib/animate/animate.min.css" rel="stylesheet">
    <link href="{{ asset('user-template') }}/lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">

    <!-- Customized Bootstrap Stylesheet -->
    <link href="{{ asset('user-template') }}/css/bootstrap.min.css" rel="stylesheet">

    <!-- Template Stylesheet -->
    <link href="{{ asset('user-template') }}/css/style.css" rel="stylesheet">
    <style>
        .page-header {
            background: linear-gradient(rgba(0, 0, 0, .75), rgba(0, 0, 0, .75)), url("{{ !empty(getBann()) ? asset('storage/'.getBann()->image) : '' }}") center center no-repeat;
            background-size: cover;
        }
        .btn-whatsapp{
            position: fixed;
            left: 20px;
            bottom: 30px;
            z-index: 99;
        }
        .btn-whatsapp:hover{
            opacity: 0.8;
            transition: 0.6s
        }
    </style>
    @yield('css')
</head>

<body>
    <!-- Spinner Start -->
    <div id="spinner" class="show bg-white position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
        <div class="spinner-grow text-primary" role="status"></div>
    </div>
    <!-- Spinner End -->


    <!-- Topbar Start -->
    <div class="container-fluid bg-dark text-light p-0">
        <div class="row gx-0 d-none d-lg-flex py-3">
            <div class="col-lg-7 px-5 text-start">
                <div class="h-100 d-inline-flex align-items-center me-4">
                    <small class="fa fa-map-marker-alt text-primary me-2"></small>
                    <small>{{ isset(getSetting()['address']) ? getSetting()['address']['value'] : '' }}</small>
                </div>
            </div>
            <div class="col-lg-5 px-5 text-end">
                <div class="h-100 gap-3 d-inline-flex align-items-center me-4">
                    <small class="fa fa-phone-alt text-primary me-2"></small>
                    <small>+62{{ isset(getSetting()['phone']) ? getSetting()['phone']['value'] : '' }}</small>
                </div>                
            </div>
        </div>
    </div>
    <!-- Topbar End -->


    <!-- Navbar Start -->
    <nav class="navbar navbar-expand-lg bg-white navbar-light sticky-top p-0">
        <a href="{{ route('home') }}" class="navbar-brand d-flex align-items-center border-end px-4 px-lg-5">
            <img src="{{ isset(getSetting()['logo']['value']) ? asset('storage/'.getSetting()['logo']['value']) : '' }}" class="d-none d-lg-block" style="width: 2.5rem;height: 2.5rem;object-fit: cover;margin-right: 10px;" alt="">
            <h2 class="mb-0">{{ isset(getSetting()['name']['value']) ? getSetting()['name']['value'] : 'Al-Miffa' }}</h2>
        </a>
        <button type="button" class="navbar-toggler me-4" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarCollapse">
            <div class="navbar-nav ms-auto p-4 p-lg-0">
                <a href="{{ route('home') }}" class="nav-item nav-link {{ $active == "home" ? "active" : "" }}">Beranda</a>
                <div class="nav-item dropdown">
                    <a href="#" class="nav-link dropdown-toggle {{ ($active == "profile" || $active == "vismis") ? "active" : "" }}" data-bs-toggle="dropdown">Tentang</a>
                    <div class="dropdown-menu bg-light m-0">
                        <a href="{{ route('about.profile') }}" class="dropdown-item {{ $active == "profile" ? "active" : "" }}">Profil Yayasan</a>
                        <a href="{{ route('about.visimisi') }}" class="dropdown-item {{ $active == "vismis" ? "active" : "" }}">Visi dan Misi</a>
                    </div>
                </div>
                <div class="nav-item dropdown">
                    <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">Lembaga dan Kegiatan</a>
                    <div class="dropdown-menu bg-light m-0">
                        @foreach (getLembaga() as $item)
                            <a href="{{ route('institution',$item->slug) }}" class="dropdown-item {{ (isset($institution) AND $institution->slug == $item->slug) ? "active" : "" }}">{{ $item->name }}</a>                            
                        @endforeach
                        @foreach (getKegiatan() as $item)
                            <a href="{{ route('activity',$item->slug) }}" class="dropdown-item {{ (isset($activity) AND $activity->slug == $item->slug) ? "active" : "" }}">{{ $item->activity }}</a>                            
                        @endforeach
                    </div>
                </div>
                <a href="{{ route('news') }}" class="nav-item nav-link {{ $active == "news" ? "active" : "" }}">Berita</a>
                <a href="{{ route('gallery') }}" class="nav-item nav-link {{ $active == "gallery" ? "active" : "" }}">Galeri</a>
                <a href="{{ route('contact') }}" class="nav-item nav-link {{ $active == "contact" ? "active" : '' }}">Hubungi Kami</a>
            </div>
        </div>
    </nav>
    <!-- Navbar End -->


    @yield('content')


    <!-- Footer Start -->
    <div class="container-fluid bg-dark text-light footer my-6 mb-0 py-6 wow fadeIn" data-wow-delay="0.1s">
        <div class="container">
            <div class="row g-5">
                <div class="col-lg-4 col-md-6">
                    {{-- <h4 class="text-white mb-4">Get In Touch</h4> --}}
                    <h2 class="text-primary mb-4">{{ isset(getSetting()['name']) ? getSetting()['name']['value'] : 'Brand' }}</h2>
                    <p class="mb-2"><i class="fa fa-map-marker-alt me-3"></i>{{ isset(getSetting()['address']) ? getSetting()['address']['value'] : 'address' }}</p>
                    <p class="mb-2"><i class="fa fa-phone-alt me-3"></i>+{{ isset(getSetting()['phone']) ? getSetting()['phone']['value'] : '62' }}</p>
                    <p class="mb-2"><i class="fa fa-envelope me-3"></i>{{ isset(getSetting()['email']) ? getSetting()['email']['value'] : 'mail@mail.com' }}</p>
                </div>
                <div class="col-lg-4 col-md-6">
                    <h4 class="text-light mb-4">Alternatif Link</h4>
                    <a class="btn btn-link" href="{{ route('about.profile') }}">Profil Kami</a>
                    <a class="btn btn-link" href="{{ route('about.visimisi') }}">Visi Misi</a>
                    <a class="btn btn-link" href="{{ route('news') }}">Berita</a>
                    <a class="btn btn-link" href="{{ route('gallery') }}">Galeri</a>
                    <a class="btn btn-link" href="{{ route('contact') }}">Hubungi Kami</a>
                </div>                
                <div class="col-lg-4 col-md-6">                    
                    <h4 class="text-light mb-4">Ikuti Kami</h4>
                    <div class="d-flex pt-2">
                        <a class="btn btn-square btn-outline-light me-1" href="https://youtube.com/{{ isset(getSetting()['youtube']) ? getSetting()['youtube']['value'] : '' }}"><i class="fab fa-youtube"></i></a>
                        <a class="btn btn-square btn-outline-light me-1" href="https://instagram.com/{{ isset(getSetting()['instagram']) ? getSetting()['instagram']['value'] : '' }}"><i class="fab fa-instagram"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Footer End -->


    <!-- Copyright Start -->
    <div class="container-fluid copyright bg-white text-light py-4 wow fadeIn" data-wow-delay="0.1s">
        <div class="container">
            <div class="row">
                <div class="col-md-6 text-center text-dark text-md-start mb-3 mb-md-0">
                    &copy; <a href="#">{{ isset(getSetting()['name']) ? getSetting()['name']['value'] : '' }}</a>, All Right Reserved.
                </div>                
            </div>
        </div>
    </div>
    <!-- Copyright End -->
    
    <a href="https://wa.me/62{{ isset(getSetting()['phone']) ? getSetting()['phone']['value'] : '' }}" class="btn btn-success bg-success px-3  rounded-pill btn-whatsapp"><i class="fab fa-whatsapp"></i> Hubungi Kami</a>
    <!-- Back to Top -->
    <a href="#" class="btn btn-lg btn-primary btn-lg-square back-to-top"><i class="bi bi-arrow-up"></i></a>


    <!-- JavaScript Libraries -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('user-template') }}/lib/wow/wow.min.js"></script>
    <script src="{{ asset('user-template') }}/lib/easing/easing.min.js"></script>
    <script src="{{ asset('user-template') }}/lib/waypoints/waypoints.min.js"></script>
    <script src="{{ asset('user-template') }}/lib/owlcarousel/owl.carousel.min.js"></script>

    <!-- Template Javascript -->
    <script src="{{ asset('user-template') }}/js/main.js"></script>
    @yield('js')
</body>

</html>