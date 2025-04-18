<header class="py-3">
    <div class="container d-flex align-items-center justify-content-between p-0">
        <div class="d-flex align-items-center">
            <img src="{{ asset('img/logo2.png') }}" alt="Logo" class="me-2" style="width: 70px; height: 70px;">
            <a href="#" class="text-white fw-bold text-decoration-none">GearVenture</a>
        </div>

        <nav class="navbar navbar-expand-lg">
            <div class="container-fluid">
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav">
                        <li class="nav-item m-0 {{ $type_menu == 'index' ? 'active' : '' }} "><a href="{{ route('index') }}" class="nav-link text-white active">HOME</a></li>
                        <li class="nav-item m-0 {{ $type_menu == 'catalog' ? 'active' : '' }}"><a href="{{ route('catalog') }}" class="nav-link text-white">RENTAL/SEWA</a></li>
                        <li class="nav-item m-0 {{ $type_menu == 'event' ? 'active' : '' }}"><a href="{{ route('event') }}" class="nav-link text-white">INFO/EVENT</a></li>
                        <li class="nav-item m-0 {{ $type_menu == 'about' ? 'active' : '' }}"><a href="{{ route('about') }}" class="nav-link text-white">ABOUT</a></li>
                    </ul>
                </div>
            </div>
        </nav>

        <!-- Search Box -->
        <div class="search input-group border border-2 border-white rounded w-auto" style=" overflow: hidden;">
            <input type="text" class="border-0 mb-1 ps-3" style="background-color: #383d1f;" placeholder="Apa alat yang kamu butuhkan?" aria-label="Search">
            <button class="btn border-0 text-white d-flex"><i class='bx bx-search-alt-2 fs-5'></i></button>
        </div>

        <!-- Icons -->
        <div>
            <a href="#" class="cart-header text-white me-3"><i class='bx bx-cart fs-4'></i></a>
            <a href="{{ route ('profileuser')}}" class="profile-header text-white"><i class='bx bx-user-circle fs-4'></i></a>
        </div>
    </div>
</header>
