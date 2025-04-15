<header class="py-2 ">
    <div class="container d-flex align-items-center justify-content-between">
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
                        <li class="nav-item"><a href="index" class="nav-link text-white active">Home</a></li>
                        <li class="nav-item"><a href="catalog" class="nav-link text-white">Rental/Sewa</a></li>
                        <li class="nav-item"><a href="event" class="nav-link text-white">Info/Event</a></li>
                        <li class="nav-item"><a href="about" class="nav-link text-white">About</a></li>
                    </ul>
                </div>
            </div>
        </nav>

        <!-- Search Box -->
        <div class="input-group border border-white rounded-pill" style="width: 22%; overflow: hidden;">
            <input type="text" class=" border-0 text-white rounded-pill ps-3" style="background-color: #383d1f;" placeholder="Apa alat yang kamu butuhkan?" aria-label="Search">
            <button class="btn border-0 text-white"><i class='bx bx-search-alt-2 fs-5'></i></button>
        </div>

        <!-- Icons -->
        <div>
            <a href="keranjang" class="text-white me-3"><i class='bx bx-cart fs-4'></i></a>
            <a href="profileuser" class="text-white"><i class='bx bx-user-circle fs-4'></i></a>
        </div>
    </div>
</header>
