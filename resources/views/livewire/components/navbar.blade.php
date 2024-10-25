<div>
    @auth
    <nav class="py-2 bg-body-tertiary border-bottom">
        <div class="container d-flex flex-wrap align-items-center">
            <!-- Logo -->
            <a href="#" class="navbar-brand d-flex align-items-center me-3">
                <img src="{{ asset('assets/img/jagr.png') }}" alt="Logo" width="100">
            </a>

            <!-- Navbar links -->
            <ul class="nav me-auto ms-5">
                <li class="nav-item">
                    <a href="{{ route('beranda') }}" class="nav-link link-body-emphasis px-2 active" aria-current="page">Beranda</a>
                </li>
                <li class="nav-item ms-3">
                    <a href="{{ route('project.index') }}" class="nav-link link-body-emphasis px-2">Project</a>
                </li>  
            </ul>

            <!-- Search Form -->
            <button class="btn me-2" id="search-icon" data-bs-toggle="modal" data-bs-target="#searchModal">
                <i class="fas fa-search fs-5"></i>
            </button>

            <!-- User Dropdown -->
            <div class="dropdown text-end">
                <a href="#" class="link-body-emphasis text-decoration-none dropdown-toggle"
                    data-bs-toggle="dropdown" aria-expanded="false">
                    <i class="fa-solid fa-circle-user fs-4"></i>
                </a>
                <ul class="dropdown-menu text-small">
                    <li>
                        <div class="dropdown-item">
                            <div class="align-items-center me-2">
                                <img src="{{ asset('assets/img/profile.jpg') }}" alt="Foto Profil"
                                     class="rounded-circle me-2" width="30" height="30">
                                <span class="user-name">{{ Auth::user()->name }}</span>
                            </div>
                        </div>
                    </li>
                    <li>
                        <a class="dropdown-item" href="{{ route('profile.index') }}">
                            <i class="fa-regular fa-user me-2"></i>
                            Profil Akun
                        </a>
                    </li>
                    <li>
                        <hr class="dropdown-divider">
                    </li>
                    <li>
                        <!-- Tombol Logout menggunakan Livewire -->
                        <button type="button" class="dropdown-item" wire:click="logout">
                            <i class="fa-solid fa-arrow-right-from-bracket me-2"></i>
                            Keluar
                        </button>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    @endauth
</div>
