<!-- Vertical Navbar -->
<nav class="navbar show navbar-vertical h-lg-screen navbar-expand-lg px-0 py-3 navbar-light bg-white border-bottom border-bottom-lg-0 border-end-lg" id="navbarVertical">
    <div class="container-fluid">
        <!-- Toggler --><button class="navbar-toggler ms-n2" type="button" data-bs-toggle="collapse" data-bs-target="#sidebarCollapse" aria-controls="sidebarCollapse" aria-expanded="false" aria-label="Toggle navigation"> <span class="navbar-toggler-icon"></span> </button>
        <!-- Brand --><a class="navbar-brand py-lg-2 mb-lg-5 px-lg-6 me-0 logo" style="margin-bottom: 0.5rem !important;" href="{{route('home')}}"> PROJECT </a>
        <!-- User menu (mobile) -->
        <div class="navbar-user d-lg-none">
            <!-- Dropdown -->
            <div class="dropdown" style="padding-top: 2rem;">
                <!-- Toggle -->
                <a href="#" id="sidebarAvatar" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">

                    <div class="avatar-parent-child">
                        @auth
                        <img alt="{{auth()->user()->fullname}}" src="{{Storage::url(auth()->user()->image) }}" class="avatar img-responsive card-img avatar-rounded-circle">
                        <span class="avatar-child avatar-badge bg-success"></span>
                        @endauth
                        <div style="display: flex;
                            width: 100%;
                            justify-content: flex-end;
                            margin-top: 0.5rem;
                            float: left;">
                        <i class="fa-solid fa-caret-down"></i>
                        </div>
                    </div>


                </a>
                <!-- Menu -->

                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="sidebarAvatar">
                    @auth
                    <a href="{{route('user.profile')}}" class="dropdown-item">Thông tin cá nhân</a>
                    <hr class="dropdown-divider">
                    <a href="{{route('logout')}}" class="dropdown-item">Đăng xuất</a>
                    @else
                    <a href="{{route('getLogin')}}}" class="dropdown-item">Đăng nhập</a>
                    <hr class="dropdown-divider">
                    <a href="{{route('getRegister')}}" class="dropdown-item">Đăng kí tài khoản</a>
                    @endauth
                </div>


                </div>
        </div>
        <!-- Collapse -->
        <div class="collapse navbar-collapse" id="sidebarCollapse">
            <!-- Navigation -->
            @auth
            <div class="navbar-nav">
                <div class="nav-item">
                    <a href="{{route('user.profile')}}" class="nav-link">
                        <img alt="{{auth()->user()->fullname}}" src="{{ Storage::url(auth()->user()->image)}}" class="avatar avatar-rounded-circle" style=" image-rendering: piхelated; width:fit-content;">
                        <p class="label text-md-center text-bold" style="margin-left: 1rem;">{{auth()->user()->fullname}}</p>
                    </a>
                </div>
            </div>
            <hr style="margin: 0.5rem;">
            @endauth
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" href="{{route('home')}}"> <i class="fa-solid fa-house"></i> Trang chủ </a>
                </li>
                @auth
                <li class="nav-item">
                    <a class="nav-link" href="{{route('user.profile')}}"> <i class="fa-regular fa-address-card"></i> Thông tin cá nhân</a>
                </li>
                @endauth
                <li class="nav-item">
                    <a class="nav-link" href="{{route('tintuc.danhsach')}}"> <i class="fa-solid fa-blog"></i> Tin Tức </a>
                </li>
                @auth
                <li class="nav-item">
                    <a class="nav-link" href="{{route('list.get')}}"> <i class="fa-solid fa-address-book"></i> Danh sách người dùng </a>
                </li>
                @endauth
                <li class="nav-item">
                    <a class="nav-link" href="{{route('lsp.danhsach')}}"><i class="fa-brands fa-elementor"></i> Danh mục sản phẩm </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="{{route('sp.danhsach')}}"> <i class="fa-solid fa-store"></i> Sản phẩm </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="{{route('nsx.danhsach')}}"> <i class="fa-solid fa-building"></i>Nhà sản xuất</a>
                </li>
            </ul>
            <!-- Divider -->
            <hr class="navbar-divider my-4 opacity-20">
            <!-- Push content down -->
            <div class="mt-auto"></div>
            <!-- User (md) -->
            @auth
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" href="# " onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                         <i class="bi bi-box-arrow-left"></i> Đăng xuất
                    </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        {{ csrf_field() }}
                    </form>
                </li>
            </ul>
            @endauth
        </div>
    </div>
</nav>
