@extends('layout.master')
@section('title', 'Tugas Akhir')
@section('content')
    <div class="container mt-3">
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif
        <h4 class="card-title fw-semibold mb-4">Tambah Judul TA</h4>
        <div class="card">
            <div class="card-body">
                <form action="{{ route('store.TugasAkhir') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group mb-3">
                        <label for="tema" class="fw-bold">Tema</label>
                        <select id="tema" name="tema" class="form-control @error('tema') is-invalid @enderror"
                            required>
                            <option selected value="0">-----------------Pilih Tema-----------------</option>
                            @foreach ($tema as $item)
                                <option value="{{ $item->id }}" {{ old('tema') == $item->id ? 'selected' : '' }}>
                                    {{ $item->nama }}</option>
                            @endforeach
                        </select>
                        @error('tema')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="form-group mb-3">
                        <label for="judul" class="fw-bold">Judul</label>
                        <input type="text" id="judul" name="judul"
                            class="form-control @error('judul') is-invalid @enderror" placeholder="Masukan judul" required
                            value="{{ old('judul') }}">
                        <small class="form-text text-muted font-italic">Silakan konsultasikan ke dosen sebelum mendaftarkan
                            judul tugas akhir.</small>
                        @error('judul')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="form-group mb-3">
                        <label class="fw-bold" for="file">Upload Proposal</label>
                        <input type="file" id="proposal" name="proposal"
                            class="form-control @error('proposal') is-invalid @enderror" required>
                        @error('proposal')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="d-flex justify-content-end gap-2">
                        <button type="reset" class="btn btn-outline-primary">Reset</button>
                        <button type="submit" class="btn btn-primary">Daftar</button>
                    </div>
                </form>
            </div>
        </div>
    @endsection
