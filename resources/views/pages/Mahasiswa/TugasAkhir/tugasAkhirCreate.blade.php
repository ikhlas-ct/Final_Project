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
                <form action="{{ route('StoreTugasAkhir') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group mb-4">
                        <label for="judul" class="fw-bold">Judul</label>
                        <input type="text" id="judul" name="judul" class="form-control" placeholder="Isi judul"
                            required>
                        <small class="form-text text-muted">Silakan konsultasikan ke dosen sebelum mendaftarkan judul tugas
                            akhir.</small>
                    </div>
                    <div class="form-group mb-4">
                        <label for="konsentrasi" class="fw-bold">Konsentrasi</label>
                        <select id="konsentrasi" name="konsentrasi" class="form-control" required>
                            <option selected value="0">Pilih Konsentrasi</option>
                            <option value="Lab 1">Lab 1 Sistem Cerdas</option>
                            <option value="Lab 2">Lab 2 Teknik Informatika</option>
                            <option value="Lab 3">Lab 2 Teknik Elektro</option>
                            <option value="Lab 4">Lab 4 Sistem Informasi</option>
                        </select>
                    </div>
                    <div class="form-group mb-4">
                        <label for="file">Upload File</label>
                        <input type="file" id="file" name="file" class="form-control-file" required>
                    </div>
                    <div class="d-flex justify-content-end gap-2">
                        <button type="reset" class="btn btn-warning">Reset</button>
                        <button type="submit" class="btn btn-primary">Daftar</button>
                    </div>
                </form>
            </div>
        </div>
    @endsection
