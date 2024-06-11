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
                        <small class="form-text text-muted font-italic">Silakan konsultasikan ke dosen sebelum mendaftarkan
                            judul tugas
                            akhir.</small>
                    </div>
                    <div class="form-group mb-4">
                        <label for="konsentrasi" class="fw-bold">Tema</label>
                        <select id="konsentrasi" name="tema" class="form-control" required>
                            <option selected value="0">-----------------Pilih Tema-----------------</option>
                            @foreach ($tema as $item)
                                <option value="{{ $item->id }}">{{ $item->nama }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group mb-4">
                        <label class="fw-bold" for="file">Upload Profosal</label>
                        <input type="file" id="file" name="file" class="form-control-file" required>
                    </div>
                    <div class="d-flex justify-content-end gap-2">
                        <button type="reset" class="btn btn-outline-primary">Reset</button>
                        <button type="submit" class="btn btn-primary">Daftar</button>
                    </div>
                </form>
            </div>
        </div>
    @endsection
