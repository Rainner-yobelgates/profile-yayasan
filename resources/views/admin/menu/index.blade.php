<ul class="sidebar-menu">
    <li class="menu-header">Dashboard</li>
    <li class="{{ $active == "dashboard" ? "active" : "" }}"><a class="nav-link" href="{{route('admin.dashboard')}}"><i class="fas fa-th"></i> <span>Dashboard</span></a></li>
    <li class="menu-header">Pages</li>
    <li class="{{ $active == "news" ? "active" : "" }}"><a class="nav-link" href="{{route('admin.news')}}"><i class="fas fa-newspaper"></i> <span>Berita</span></a></li>
    <li class="{{ $active == "gallery" ? "active" : "" }}"><a class="nav-link" href="{{route('admin.gallery')}}"><i class="fas fa-images"></i> <span>Galeri</span></a></li>
    {{-- <li class="{{ $active == "institution" ? "active" : "" }}"><a class="nav-link" href="{{route('admin.institution')}}"><i class="fas fa-th"></i> <span>Lembaga</span></a></li> --}}
    {{-- <li class="{{ $active == "banner" ? "active" : "" }}"><a class="nav-link" href="{{route('admin.banner')}}"><i class="fas fa-th"></i> <span>Banner</span></a></li> --}}
  </ul>