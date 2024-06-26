@php
    use App\Helpers\FiturHelper;
@endphp


@if (FiturHelper::showKaprodi())
    <div>
        <div class="brand-logo d-flex align-items-center justify-content-between">
            <a href="./index.html" class="text-nowrap logo-img">
                <img src="{{ asset('assets/images/logos/logo1.png') }}" width="180" alt=""
                    style="margin-top: -10px; margin-bottom: -50px" />
            </a>
            <div class="close-btn d-xl-none d-block sidebartoggler cursor-pointer" id="sidebarCollapse">
                <i class="ti ti-x fs-8"></i>
            </div>
        </div>
        <!-- Sidebar navigation-->
        <nav class="sidebar-nav scroll-sidebar" data-simplebar="">
            <ul id="sidebarnav">
                <li class="nav-small-cap">
                    <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
                    <span class="hide-menu">Home</span>
                </li>
                <li class="sidebar-item">
                    <a class="sidebar-link {{ Request::is('dashboard') ? 'active' : '' }}" href="{{ url('dashboard') }}"
                        aria-expanded="false">
                        <span>
                            <i class="fas fa-dashboard"></i>
                        </span>
                        <span class="hide-menu">Dashboard</span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a class="sidebar-link {{ Request::is('persetujuan') ? 'active' : '' }}"
                        href="{{ url('persetujuan') }}" aria-expanded="false">
                        <span>
                            <i class="fas fa-check"></i>
                        </span>
                        <span class="hide-menu">Persetujuan</span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a class="sidebar-link {{ Request::is('tema-pengajuan') || Request::is('addTema') || Request::is('editTema/*') ? 'active' : '' }}"
                        href="{{ url('tema-pengajuan') }}" aria-expanded="false">
                        <span>
                            <i class="fas fa-palette"></i>
                        </span>
                        <span class="hide-menu">Tema</span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a class="sidebar-link {{ Request::is('profile') ? 'active' : '' }}" href="{{ url('profile') }}"
                        aria-expanded="false">
                        <span>
                            <i class="fas fa-user"></i>
                        </span>
                        <span class="hide-menu">Profile</span>
                    </a>
                </li>
                <hr>
                <li class="sidebar-item  bg-danger rounded-1">
                    <a class="sidebar-link text-white d-flex justify-content-center w-100" href="{{ url('logout') }}"
                        aria-expanded="false">
                        <span>Logout</span>
                    </a>
                </li>
            </ul>
        </nav>
        <!-- End Sidebar navigation -->
    </div>
@endif

@if (FiturHelper::showAdmin())
    <div>
        <div class="brand-logo d-flex align-items-center justify-content-between">
            <a href="{{ route('dashboard') }}" class="text-nowrap logo-img">
                <img src="{{ asset('assets/images/logos/logo1.png') }}" width="180" alt=""
                    style="margin-top: -10px; margin-bottom: -50px" />
            </a>

            <div class="close-btn d-xl-none d-block sidebartoggler cursor-pointer" id="sidebarCollapse">
                <i class="ti ti-x fs-8"></i>
            </div>
        </div>
        <!-- Sidebar navigation-->
        <nav class="sidebar-nav scroll-sidebar" data-simplebar="">
            <ul id="sidebarnav">
                <li class="nav-small-cap">
                    <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
                    <span class="hide-menu">Home</span>
                </li>
                <li class="sidebar-item">
                    <a class="sidebar-link {{ Request::is('dashboard') ? 'active' : '' }}"
                        href="{{ url('dashboard') }}" aria-expanded="false">
                        <span>
                            <i class="fas fa-dashboard"></i>
                        </span>
                        <span class="hide-menu">Dashboard</span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a class="sidebar-link" href="{{ route('admin.users') }}" aria-expanded="false">
                        <span>
                            <i class="fas fa-users"></i>
                        </span>
                        <span class="hide-menu">Pengguna</span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a class="sidebar-link" href="{{ route('fakultas.index') }}" aria-expanded="false">
                        <span>
                            <i class="fas fa-building"></i>
                        </span>
                        <span class="hide-menu">Fakultas</span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a class="sidebar-link {{ Request::is('profile') ? 'active' : '' }}" href="{{ url('profile') }}"
                        aria-expanded="false">
                        <span>
                            <i class="fas fa-user"></i>
                        </span>
                        <span class="hide-menu">Profile</span>
                    </a>
                </li>
                <hr>
                <li class="sidebar-item bg-danger rounded-1">
                    <a class="sidebar-link text-white d-flex justify-content-center w-100" href="{{ url('logout') }}"
                        aria-expanded="false">
                        <span>Logout</span>
                    </a>
                </li>
            </ul>
        </nav>
        <!-- End Sidebar navigation -->
    </div>
@endif

@if (FiturHelper::showMahasiswa())
    <div>
        <div class="brand-logo d-flex align-items-center justify-content-between">
            <a href="./index.html" class="text-nowrap logo-img">
                <img src="{{ asset('assets/images/logos/logo1.png') }}" width="180" alt=""
                    style="margin-top: -10px; margin-bottom: -50px" />
            </a>

            <div class="close-btn d-xl-none d-block sidebartoggler cursor-pointer" id="sidebarCollapse">
                <i class="ti ti-x fs-8"></i>
            </div>
        </div>
        <!-- Sidebar navigation-->
        <nav class="sidebar-nav scroll-sidebar" data-simplebar="">
            <ul id="sidebarnav">
                <li class="nav-small-cap">
                    <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
                    <span class="hide-menu">Home</span>
                </li>
                <li class="sidebar-item">
                    <a class="sidebar-link {{ Request::is('dashboard') ? 'active' : '' }}"
                        href="{{ url('dashboard') }}" aria-expanded="false">
                        <span>
                            <i class="fas fa-dashboard"></i>
                        </span>
                        <span class="hide-menu">Dashboard</span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a class="sidebar-link {{ Request::is('tugas-akhir') || Request::is('create-tugas-akhir') || Request::is('pilih-pembimbing-tugas-akhir/*') ? 'active' : '' }}"
                        href="{{ url('tugas-akhir') }}" aria-expanded="false">
                        <span>
                            <i class="fas fa-file-alt"></i>
                        </span>
                        <span class="hide-menu">TA</span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a class="sidebar-link {{ Request::is('pilih-pembimbing') ? 'active' : '' }}"
                        href="{{ url('bimbingan') }}" aria-expanded="false">
                        <span>
                            <i class="fas fa-chalkboard-teacher"></i>
                        </span>
                        <span class="hide-menu">Bimbingan</span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a class="sidebar-link {{ Request::is('logbook') ? 'active' : '' }}" href="{{ url('logbook') }}"
                        aria-expanded="false">
                        <span>
                            <i class="fas fa-book"></i>
                        </span>
                        <span class="hide-menu">Logbook</span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a class="sidebar-link {{ Request::is('profile') ? 'active' : '' }}" href="{{ url('profile') }}"
                        aria-expanded="false">
                        <span>
                            <i class="fas fa-user"></i>
                        </span>
                        <span class="hide-menu">Profile</span>
                    </a>
                </li>
                <hr>
                <li class="sidebar-item  bg-danger rounded-1">
                    <a class="sidebar-link text-white d-flex justify-content-center w-100" href="{{ url('logout') }}"
                        aria-expanded="false">
                        <span>Logout</span>
                    </a>
                </li>
            </ul>
        </nav>
        <!-- End Sidebar navigation -->
    </div>
@endif

@if (FiturHelper::showDosen())
    <div>
        <div class="brand-logo d-flex align-items-center justify-content-between">
            <a href="./index.html" class="text-nowrap logo-img">
                <img src="{{ asset('assets/images/logos/logo1.png') }}" width="180" alt=""
                    style="margin-top: -10px; margin-bottom: -50px" />
            </a>

            <div class="close-btn d-xl-none d-block sidebartoggler cursor-pointer" id="sidebarCollapse">
                <i class="ti ti-x fs-8"></i>
            </div>
        </div>
        <!-- Sidebar navigation-->
        <nav class="sidebar-nav scroll-sidebar" data-simplebar="">
            <ul id="sidebarnav">
                <li class="nav-small-cap">
                    <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
                    <span class="hide-menu">Home</span>
                </li>
                <li class="sidebar-item">
                    <a class="sidebar-link {{ Request::is('dashboard') ? 'active' : '' }}"
                        href="{{ url('dashboard') }}" aria-expanded="false">
                        <span>
                            <i class="fas fa-dashboard"></i>
                        </span>
                        <span class="hide-menu">Dashboard</span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a class="sidebar-link {{ Request::is('tgl_penting') ? 'active' : '' }}"
                        href="{{ url('pengajuan') }}" aria-expanded="false">
                        <span>
                            <i class="fas fa-paper-plane"></i>
                        </span>
                        <span class="hide-menu">Pengajuan</span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a class="sidebar-link {{ Request::is('membimbing') || Request::is('dosen/membimbing/*') ? 'active' : '' }}"
                        href="{{ url('membimbing') }}" aria-expanded="false">
                        <span>
                            <i class="fas fa-chalkboard-teacher"></i>
                        </span>
                        <span class="hide-menu">Membimbing</span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a class="sidebar-link {{ Request::is('profile') ? 'active' : '' }}" href="{{ url('profile') }}"
                        aria-expanded="false">
                        <span>
                            <i class="fas fa-user"></i>
                        </span>
                        <span class="hide-menu">Profile</span>
                    </a>
                </li>
                <hr>
                <li class="sidebar-item  bg-danger rounded-1">
                    <a class="sidebar-link text-white d-flex justify-content-center w-100" href="{{ url('logout') }}"
                        aria-expanded="false">
                        <span>Logout</span>
                    </a>
                </li>
            </ul>
        </nav>
        <!-- End Sidebar navigation -->
    </div>
@endif
