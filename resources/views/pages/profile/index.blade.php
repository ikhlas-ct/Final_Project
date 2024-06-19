@extends('layout.master')

@section('title', 'Dashboard')

@section('content')
    @php
        use App\Helpers\FiturHelper;
    @endphp

    <div class="container-fluid">
        <h4 class="card-title fw-semibold mb-4">Profile</h4>
        <div class="card">
            @if (FiturHelper::showKaprodi())
                <div class="card-body">
                    <form action="{{ route('kaprodi.profile.update') }} " method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="row">
                            <div class="col-4 d-flex align-items-center">
                                <div class="position-relative d-inline-block">
                                    <img id="current-profile-image" class="img-fluid img-thumbnail rounded-5"
                                        src="{{ $user->kaprodi->poto }}" alt="Kosong">
                                    <span class="position-absolute top-0 end-0 p-4">
                                        <div id="profile-image" class="bg-white p-2 rounded-2 cursor-pointer">
                                            <i class="fas fa-camera fs-5"></i>
                                        </div>
                                    </span>
                                </div>
                                <input type="file" class="d-none" name="poto" id="poto">
                            </div>
                            <div class="col-8 d-flex align-items-center">
                                <div class="w-100">
                                    <div class="row">
                                        <div class="col-6">
                                            <div class="mb-3">
                                                <label for="nama" class="form-label text-muted">Nama</label>
                                                <input type="text" class="form-control" id="nama" name="nama"
                                                    value="{{ old('nama', $user->kaprodi->nama) }}">
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="mb-3">
                                                <label for="nim" class="form-label text-muted">NIDN</label>
                                                <input type="text" class="form-control" id="nim" name="nim"
                                                    value="{{ old('nim', $user->kaprodi->nidn) }}">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-6">
                                            <div class="mb-3">
                                                <label for="fakultas" class="form-label text-muted">Fakultas</label>
                                                <input
                                                    style="pointer-events: none; background-color: #f0f0f0; color: #888888;"
                                                    type="text" class="form-control readonly-input" id="fakultas"
                                                    name="fakultas"
                                                    value="{{ old('fakultas', $user->kaprodi->fakultas->nama) }}" readonly>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="mb-3">
                                                <label for="no_hp" class="form-label text-muted">No HP</label>
                                                <input type="number" class="form-control" id="no_hp" name="no_hp"
                                                    value="{{ old('no_hp', $user->kaprodi->no_hp) }}">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="row ">
                                                <div class="col-12">
                                                    <button type="submit" class="btn btn-primary mt-3 w-100">Update
                                                        Profile</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            @endif
            @if (FiturHelper::showDosen())
                <div class="card-body">
                    <form action="{{ route('dosen.profile.update') }} " method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="row">
                            <div class="col-4 d-flex align-items-center">
                                <div class="position-relative d-inline-block">
                                    <img id="current-profile-image" class="img-fluid img-thumbnail rounded-5"
                                        src="{{ $user->dosen->poto }}" alt="Kosong">
                                    <span class="position-absolute top-0 end-0 p-4">
                                        <div id="profile-image" class="bg-white p-2 rounded-2 cursor-pointer">
                                            <i class="fas fa-camera fs-5"></i>
                                        </div>
                                    </span>
                                </div>
                                <input type="file" class="d-none" name="poto" id="poto">
                            </div>
                            <div class="col-8 d-flex align-items-center">
                                <div class="w-100">
                                    <div class="row">
                                        <div class="col-6">
                                            <div class="mb-3">
                                                <label for="nama" class="form-label text-muted">Nama</label>
                                                <input type="text" class="form-control" id="nama" name="nama"
                                                    value="{{ old('nama', $user->dosen->nama) }}">
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="mb-3">
                                                <label for="nim" class="form-label text-muted">NIDN</label>
                                                <input type="text" class="form-control" id="nim" name="nim"
                                                    value="{{ old('nim', $user->dosen->nidn) }}">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-6">
                                            <div class="mb-3">
                                                <label for="fakultas" class="form-label text-muted">Fakultas</label>
                                                <input
                                                    style="pointer-events: none; background-color: #f0f0f0; color: #888888;"
                                                    type="text" class="form-control readonly-input" id="fakultas"
                                                    name="fakultas"
                                                    value="{{ old('fakultas', $user->dosen->fakultas->nama) }}" readonly>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="mb-3">
                                                <label for="no_hp" class="form-label text-muted">No HP</label>
                                                <input type="number" class="form-control" id="no_hp" name="no_hp"
                                                    value="{{ old('no_hp', $user->dosen->no_hp) }}">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="row ">
                                                <div class="col-12">
                                                    <button type="submit" class="btn btn-primary mt-3 w-100">Update
                                                        Profile</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            @endif
            @if (FiturHelper::showAdmin())
                <div class="card-body">
                    @if (session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif
                    <form action="{{ route('admin.profile.update') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="row">
                            <div class="col-4 d-flex align-items-center">
                                <div class="position-relative d-inline-block">
                                    <img id="current-profile-image" class="img-fluid img-thumbnail rounded-5"
                                        src="{{ Auth::user()->admin->gambar ? asset(Auth::user()->admin->gambar) : asset('assets/images/profile/user-1.jpg') }}"
                                        alt="Current Kosong">
                                    <span class="position-absolute top-0 end-0 p-4">
                                        <div id="profile-image" class="bg-white p-2 rounded-2 cursor-pointer">
                                            <i class="fas fa-camera fs-5"></i>
                                        </div>
                                    </span>
                                </div>
                                <input type="file" class="d-none" name="gambar" id="gambar">
                            </div>
                            <div class="col-8">
                                <div class="row">
                                    <div class="col-12">
                                        <div class="mb-3">
                                            <label for="nama" class="form-label">Nama</label>
                                            <input type="text" class="form-control" id="nama" name="nama"
                                                value="{{ Auth::user()->admin->nama }}">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-12">
                                        <div class="mb-3">
                                            <label for="no_hp" class="form-label">No HP</label>
                                            <input type="text" class="form-control" id="no_hp" name="no_hp"
                                                value="{{ Auth::user()->admin->no_hp }}">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-12">
                                        <div class="mb-3">
                                            <label for="alamat" class="form-label">Alamat</label>
                                            <textarea class="form-control" id="alamat" name="alamat" rows="2">{{ Auth::user()->admin->alamat }}</textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="d-grid">
                                    <button type="submit" class="btn btn-primary mt-3">Update Profile</button>
                                </div>
                            </div>
                        </div>
                    </form>
                    <hr>
                    <div class="row">
                        <div class="col-12">
                            <h2>Ganti Password dan Username</h2>
                            @if (session('password'))
                                <div class="alert alert-success">
                                    {{ session('password') }}
                                </div>
                            @endif

                            @if ($errors->any())
                                <div class="alert alert-danger">
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif
                            <form action="{{ route('admin.update.password') }}" method="POST">
                                @csrf
                                @method('PUT')

                                <div class="mb-3">
                                    <label for="username" class="form-label">Username</label>
                                    <input type="text" class="form-control @error('username') is-invalid @enderror"
                                        id="username" name="username"
                                        value="{{ old('username', Auth::user()->username) }}">
                                    @error('username')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="password_lama" class="form-label">Password Lama</label>
                                    <input type="password"
                                        class="form-control @error('password_lama') is-invalid @enderror"
                                        id="password_lama" name="password_lama">
                                    @error('password_lama')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="password" class="form-label">Password</label>
                                    <input id="password" type="password" class="form-control" name="password" required>
                                </div>
                                <div class="mb-3">
                                    <label for="password-confirm" class="form-label">Confirm Password</label>
                                    <input id="password-confirm" type="password" class="form-control"
                                        name="password_confirmation" required>
                                    <div id="password-error" class="text-danger mt-2" style="display:none;">Passwords do
                                        not match!</div>
                                </div>
                                <div class="d-grid">
                                    <button type="submit" class="btn btn-primary mt-3">Simpan Perubahan</button>
                                </div>
                            </form>
                        </div>

                    </div>
                </div>
            @endif
            @if (FiturHelper::showMahasiswa())
                <div class="card-body">
                    <form action="{{ route('mahasiswa.profile.update') }} " method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="row">
                            <div class="col-4 d-flex align-items-center">
                                <div class="position-relative d-inline-block">
                                    <img id="current-profile-image" class="img-fluid img-thumbnail rounded-5"
                                        src="{{ $user->mahasiswa->poto }}" alt="Kosong">
                                    <span class="position-absolute top-0 end-0 p-4">
                                        <div id="profile-image" class="bg-white p-2 rounded-2 cursor-pointer">
                                            <i class="fas fa-camera fs-5"></i>
                                        </div>
                                    </span>
                                </div>
                                <input type="file" class="d-none" name="poto" id="poto">
                            </div>
                            <div class="col-8 d-flex align-items-center">
                                <div class="w-100">
                                    <div class="row">
                                        <div class="col-6">
                                            <div class="mb-3">
                                                <label for="nama" class="form-label text-muted">Nama</label>
                                                <input type="text" class="form-control" id="nama" name="nama"
                                                    value="{{ old('nama', $user->mahasiswa->nama) }}">
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="mb-3">
                                                <label for="nim" class="form-label text-muted">NIM</label>
                                                <input type="text" class="form-control" id="nim" name="nim"
                                                    value="{{ old('nim', $user->mahasiswa->nim) }}">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-6">
                                            <div class="mb-3">
                                                <label for="fakultas" class="form-label text-muted">Fakultas</label>
                                                <input
                                                    style="pointer-events: none; background-color: #f0f0f0; color: #888888;"
                                                    type="text" class="form-control readonly-input" id="fakultas"
                                                    name="fakultas"
                                                    value="{{ old('fakultas', $user->mahasiswa->fakultas->nama) }}"
                                                    readonly>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="mb-3">
                                                <label for="no_hp" class="form-label text-muted">No HP</label>
                                                <input type="number" class="form-control" id="no_hp" name="no_hp"
                                                    value="{{ old('no_hp', $user->mahasiswa->no_hp) }}">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="row ">
                                                <div class="col-12">
                                                    <button type="submit" class="btn btn-primary mt-3 w-100">Update
                                                        Profile</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            @endif
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        $(document).ready(function() {
            $("#profile-image").click(function() {
                $("#poto").click();
            });

            $("#poto").change(function(event) {
                let reader = new FileReader();
                reader.onload = function() {
                    let output = document.getElementById('current-profile-image');
                    output.src = reader.result;
                };
                reader.readAsDataURL(event.target.files[0]);
            });
        });
    </script>
@endsection
