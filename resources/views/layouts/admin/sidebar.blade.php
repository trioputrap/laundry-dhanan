<nav class="sidebar">
    <div class="sidebar-header">
        <a href="#" class="sidebar-brand">
            Ceria<span>Laundry</span>
        </a>
        <div class="sidebar-toggler not-active">
            <span></span>
            <span></span>
            <span></span>
        </div>
    </div>
    <div class="sidebar-body">
        <ul class="nav">
        
            <li class="nav-item">
                <a href="{{route('pengerjaan.index')}}" class="nav-link">
                    <i class="link-icon" data-feather="archive"></i>
                    <span class="link-title">Pengerjaan</span>
                </a>
            </li>

            <li class="nav-item">
                <a href="{{route('konsumen.index')}}" class="nav-link">
                    <i class="link-icon" data-feather="users"></i>
                    <span class="link-title">Konsumen</span>
                </a>
            </li>

            
            <li class="nav-item">
                <a href="{{route('layanan.index')}}" class="nav-link">
                    <i class="link-icon" data-feather="zap"></i>
                    <span class="link-title">Layanan Laundry</span>
                </a>
            </li>
        </ul>
    </div>
</nav>