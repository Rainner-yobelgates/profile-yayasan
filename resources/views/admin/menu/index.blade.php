<ul class="sidebar-menu">
    <li class="menu-header">Dashboard</li>
    <li class="{{ $active == "dashboard" ? "active" : "" }}"><a class="nav-link" href="{{route('admin.dashboard')}}"><i class="fas fa-th"></i> <span>Dashboard</span></a></li>
    <li class="menu-header">Pages</li>
    <li class="{{ $active == "news" ? "active" : "" }}"><a class="nav-link" href="{{route('admin.news')}}"><i class="fas fa-newspaper"></i> <span>Berita</span></a></li>
    <li class="{{ $active == "gallery" ? "active" : "" }}"><a class="nav-link" href="{{route('admin.gallery')}}"><i class="fas fa-images"></i> <span>Galeri</span></a></li>
    <li class="{{ $active == "institution" ? "active" : "" }}"><a class="nav-link" href="{{route('admin.institution')}}"><i class="fas fa-globe"></i> <span>Lembaga</span></a></li>
    <li class="{{ $active == "banner" ? "active" : "" }}"><a class="nav-link" href="{{route('admin.banner')}}"><i class="fas fa-camera"></i> <span>Spanduk</span></a></li>
    <li class="{{ $active == "running-text" ? "active" : "" }}"><a class="nav-link" href="{{route('admin.running-text')}}"><i class="fas fa-font"></i> <span>Tulisan Berjalan</span></a></li>
    <li class="{{ $active == "message" ? "active" : "" }}"><a class="nav-link" href="{{route('admin.message')}}"><i class="fas fa-comments"></i> <span>Pesan</span></a></li>
    <li class="menu-header">Setting</li>
    {{-- <li class="{{ $active == "setting" ? "active" : "" }}"><a class="nav-link" href="{{route('admin.setting')}}"><i class="fas fa-camera"></i> <span>Pengaturan</span></a></li> --}}
  </ul>