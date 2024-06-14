@php
    use App\Helpers\FiturHelper;
@endphp
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
                        <i class="ti ti-layout-dashboard"></i>
                    </span>
                    <span class="hide-menu">Dashboard</span>
                </a>
            </li>
            @if (FiturHelper::showMahasiswa())
                <li class="sidebar-item">
                    <a class="sidebar-link {{ Request::is('pilih-pembimbing') ? 'active' : '' }}"
                        href="{{ url('pilih-pembimbing') }}" aria-expanded="false">
                        <span>
                            <i class="ti ti-layout-dashboard"></i>
                        </span>
                        <span class="hide-menu">Pembimbing</span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a class="sidebar-link {{ Request::is('tugas-akhir') || Request::is('tugas-akhir-create') ? 'active' : '' }}"
                        href="{{ url('tugas-akhir') }}" aria-expanded="false">
                        <span>
                            <i class="ti ti-layout-dashboard"></i>
                        </span>
                        <span class="hide-menu">Tugas Akhir</span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a class="sidebar-link {{ Request::is('logbook-mhs') ? 'active' : '' }}"
                        href="{{ url('logbook-mhs') }}" aria-expanded="false">
                        <span>
                            <i class="ti ti-layout-dashboard"></i>
                        </span>
                        <span class="hide-menu">Logbook</span>
                    </a>
                </li>
            @endif
            @if (FiturHelper::showDosen())
                <li class="sidebar-item">
                    <a class="sidebar-link {{ Request::is('mhs-bimbingan') ? 'active' : '' }}"
                        href="{{ url('mhs-bimbingan') }}" aria-expanded="false">
                        <span>
                            <i class="ti ti-layout-dashboard"></i>
                        </span>
                        <span class="hide-menu">Mhs Bimbingan</span>
                    </a>
                </li>
            @endif
            @if (FiturHelper::showKaprodi())
                <li class="sidebar-item">
                    <a class="sidebar-link {{ Request::is('persetujuan') ? 'active' : '' }}"
                        href="{{ url('persetujuan') }}" aria-expanded="false">
                        <span>
                            <i class="ti ti-layout-dashboard"></i>
                        </span>
                        <span class="hide-menu">Persetujuan</span>
                    </a>
                </li>
                {{-- <li class="sidebar-item">
                    <a class="sidebar-link {{ Request::is('persetujuan') ? 'active' : '' }}"
                        href="{{ url('persetujuan') }}" aria-expanded="false">
                        <span>
                            <i class="ti ti-layout-dashboard"></i>
                        </span>
                        <span class="hide-menu">Fakultas</span>
                    </a>
                </li> --}}
                {{-- <li class="sidebar-item">
                    <a class="sidebar-link {{ Request::is('kaprodi-tugas-akhir') || Request::is('tugas-akhir-create') ? 'active' : '' }}"
                        href="{{ url('kaprodi-tugas-akhir') }}" aria-expanded="false">
                        <span>
                            <i class="ti ti-layout-dashboard"></i>
                        </span>
                        <span class="hide-menu">Tugas Akhir</span>
                    </a>
                </li> --}}
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
                                        <i class="ti ti-layout-dashboard"></i>
                                    </span>
                                    <span class="hide-menu">Dashboard</span>
                                </a>
                            </li>
                            <li class="sidebar-item">
                                <a class="sidebar-link {{ Request::is('profile') ? 'active' : '' }}"
                                    href="{{ url('profile') }}" aria-expanded="false">
                                    <span>
                                        <i class="ti ti-layout-dashboard"></i>
                                    </span>
                                    <span class="hide-menu">Profile</span>
                                </a>
                            </li>
                            <li class="sidebar-item">
                                <a class="sidebar-link {{ Request::is('pilih-pembimbing') ? 'active' : '' }}"
                                    href="{{ url('pilih-pembimbing') }}" aria-expanded="false">
                                    <span>
                                        <i class="ti ti-layout-dashboard"></i>
                                    </span>
                                    <span class="hide-menu">Pengguna</span>
                                </a>
                            </li>
                            <li class="sidebar-item">
                                <a class="sidebar-link {{ Request::is('tugas-akhir') ? 'active' : '' }}"
                                    href="{{ url('tugas-akhir') }}" aria-expanded="false">
                                    <span>
                                        <i class="ti ti-layout-dashboard"></i>
                                    </span>
                                    <span class="hide-menu">Kaprodi</span>
                                </a>
                            </li>
                            <li class="sidebar-item">
                                <a class="sidebar-link {{ Request::is('konsultasi') ? 'active' : '' }}"
                                    href="{{ url('konsultasi') }}" aria-expanded="false">
                                    <span>
                                        <i class="ti ti-layout-dashboard"></i>
                                    </span>
                                    <span class="hide-menu">Dosen</span>
                                </a>
                            </li>
                            <li class="sidebar-item">
                                <a class="sidebar-link {{ Request::is('tgl_penting') ? 'active' : '' }}"
                                    href="{{ url('tgl_penting') }}" aria-expanded="false">
                                    <span>
                                        <i class="ti ti-layout-dashboard"></i>
                                    </span>
                                    <span class="hide-menu">Mahasiswa</span>
                                </a>
                            </li>

                            <hr>
                            <li class="sidebar-item  bg-danger rounded-1">
                                <a class="sidebar-link text-white d-flex justify-content-center w-100"
                                    href="{{ url('logout') }}" aria-expanded="false">
                                    <span>Logout</span>
                                </a>
                            </li>
                        </ul>
                    </nav>
                    <!-- End Sidebar navigation -->
                </div>
            @endif
            <li class="sidebar-item">
                <a class="sidebar-link {{ Request::is('profile') ? 'active' : '' }}" href="{{ url('profile') }}"
                    aria-expanded="false">
                    <span>
                        <i class="ti ti-layout-dashboard"></i>
                    </span>
                    <span class="hide-menu">Profile</span>
                </a>
            </li>
            {{-- <li class="sidebar-item">
                <a class="sidebar-link {{ Request::is('konsultasi') ? 'active' : '' }}" href="{{ url('konsultasi') }}"
                    aria-expanded="false">
                    <span>
                        <i class="ti ti-layout-dashboard"></i>
                    </span>
                    <span class="hide-menu">Konsultasi</span>
                </a>
            </li>
            <li class="sidebar-item">
                <a class="sidebar-link {{ Request::is('tgl_penting') ? 'active' : '' }}"
                    href="{{ url('tgl_penting') }}" aria-expanded="false">
                    <span>
                        <i class="ti ti-layout-dashboard"></i>
                    </span>
                    <span class="hide-menu">Tanggal Penting</span>
                </a>
            </li> --}}
            {{-- <li class="sidebar-item">
                <a class="sidebar-link {{ Request::is('profile') ? 'active' : '' }}" href="{{ url('profile') }}"
                    aria-expanded="false">
                    <span>
                        <i class="ti ti-layout-dashboard"></i>
                    </span>
                    <span class="hide-menu">Biodata Mahasiswa</span>
                </a>
            </li> --}}
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
                            <i class="ti ti-layout-dashboard"></i>
                        </span>
                        <span class="hide-menu">Dashboard</span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a class="sidebar-link {{ Request::is('profile') ? 'active' : '' }}" href="{{ url('profile') }}"
                        aria-expanded="false">
                        <span>
                            <i class="ti ti-layout-dashboard"></i>
                        </span>
                        <span class="hide-menu">Profile</span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a class="sidebar-link {{ Request::is('pilih-pembimbing') ? 'active' : '' }}"
                        href="{{ url('pilih-pembimbing') }}" aria-expanded="false">
                        <span>
                            <i class="ti ti-layout-dashboard"></i>
                        </span>
                        <span class="hide-menu">Pengguna</span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a class="sidebar-link {{ Request::is('tugas-akhir') ? 'active' : '' }}"
                        href="{{ url('tugas-akhir') }}" aria-expanded="false">
                        <span>
                            <i class="ti ti-layout-dashboard"></i>
                        </span>
                        <span class="hide-menu">Kaprodi</span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a class="sidebar-link {{ Request::is('konsultasi') ? 'active' : '' }}"
                        href="{{ url('konsultasi') }}" aria-expanded="false">
                        <span>
                            <i class="ti ti-layout-dashboard"></i>
                        </span>
                        <span class="hide-menu">Dosen</span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a class="sidebar-link {{ Request::is('tgl_penting') ? 'active' : '' }}"
                        href="{{ url('tgl_penting') }}" aria-expanded="false">
                        <span>
                            <i class="ti ti-layout-dashboard"></i>
                        </span>
                        <span class="hide-menu">Mahasiswa</span>
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
                            <i class="ti ti-layout-dashboard"></i>
                        </span>
                        <span class="hide-menu">Dashboard</span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a class="sidebar-link {{ Request::is('pilih-pembimbing') ? 'active' : '' }}"
                        href="{{ url('pilih-pembimbing') }}" aria-expanded="false">
                        <span>
                            <i class="ti ti-layout-dashboard"></i>
                        </span>
                        <span class="hide-menu">Pembimbing</span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a class="sidebar-link {{ Request::is('tugas-akhir') ? 'active' : '' }}"
                        href="{{ url('tugas-akhir') }}" aria-expanded="false">
                        <span>
                            <i class="ti ti-layout-dashboard"></i>
                        </span>
                        <span class="hide-menu">Tugas Akhir</span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a class="sidebar-link {{ Request::is('profile') ? 'active' : '' }}" href="{{ url('profile') }}"
                        aria-expanded="false">
                        <span>
                            <i class="ti ti-layout-dashboard"></i>
                        </span>
                        <span class="hide-menu">Profile</span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a class="sidebar-link {{ Request::is('konsultasi') ? 'active' : '' }}"
                        href="{{ url('konsultasi') }}" aria-expanded="false">
                        <span>
                            <i class="ti ti-layout-dashboard"></i>
                        </span>
                        <span class="hide-menu">Konsultasi</span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a class="sidebar-link {{ Request::is('tgl_penting') ? 'active' : '' }}"
                        href="{{ url('tgl_penting') }}" aria-expanded="false">
                        <span>
                            <i class="ti ti-layout-dashboard"></i>
                        </span>
                        <span class="hide-menu">Tanggal Penting</span>
                    </a>
                </li>
                {{-- <li class="sidebar-item">
                <a class="sidebar-link {{ Request::is('profile') ? 'active' : '' }}" href="{{ url('profile') }}"
                    aria-expanded="false">
                    <span>
                        <i class="ti ti-layout-dashboard"></i>
                    </span>
                    <span class="hide-menu">Biodata Mahasiswa</span>
                </a>
            </li> --}}
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
                            <i class="ti ti-layout-dashboard"></i>
                        </span>
                        <span class="hide-menu">Dashboard</span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a class="sidebar-link {{ Request::is('mhs-bimbingan') ? 'active' : '' }}"
                        href="{{ url('mhs-bimbingan') }}" aria-expanded="false">
                        <span>
                            <i class="ti ti-layout-dashboard"></i>
                        </span>
                        <span class="hide-menu">Mhs Bimbingan</span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a class="sidebar-link {{ Request::is('tugas-akhir') ? 'active' : '' }}"
                        href="{{ url('tugas-akhir') }}" aria-expanded="false">
                        <span>
                            <i class="ti ti-layout-dashboard"></i>
                        </span>
                        <span class="hide-menu">Tugas Akhir</span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a class="sidebar-link {{ Request::is('profile') ? 'active' : '' }}" href="{{ url('profile') }}"
                        aria-expanded="false">
                        <span>
                            <i class="ti ti-layout-dashboard"></i>
                        </span>
                        <span class="hide-menu">Profile</span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a class="sidebar-link {{ Request::is('konsultasi') ? 'active' : '' }}"
                        href="{{ url('konsultasi') }}" aria-expanded="false">
                        <span>
                            <i class="ti ti-layout-dashboard"></i>
                        </span>
                        <span class="hide-menu">Konsultasi</span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a class="sidebar-link {{ Request::is('tgl_penting') ? 'active' : '' }}"
                        href="{{ url('tgl_penting') }}" aria-expanded="false">
                        <span>
                            <i class="ti ti-layout-dashboard"></i>
                        </span>
                        <span class="hide-menu">Tanggal Penting</span>
                    </a>
                </li>
                {{-- <li class="sidebar-item">
                <a class="sidebar-link {{ Request::is('profile') ? 'active' : '' }}" href="{{ url('profile') }}"
                    aria-expanded="false">
                    <span>
                        <i class="ti ti-layout-dashboard"></i>
                    </span>
                    <span class="hide-menu">Biodata Mahasiswa</span>
                </a>
            </li> --}}
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
