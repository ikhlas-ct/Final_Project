@extends('layout.master')
@section('title', 'Tambah Logbook Mahasiswa')
@section('content')
    <h1>Tambah Logbook Mahasiswa</h1>

    <form action="{{ route('storeLogbook') }}" class="mb-5" method="POST">
        @csrf
        <div class="form-group mb-3">
            <label for="tanggal">Tanggal</label>
            <input type="date" name="tanggal" id="tanggal" class="form-control" required>
        </div>

        <div class="form-group mb-3">
            <label for="kegiatan">Kegiatan</label>
            <input type="text" name="kegiatan" id="kegiatan" class="form-control" required>
        </div>

        <div class="form-group mb-3">
            <label for="detail">Detail Kegiatan</label>
            <input type="text" name="detail" id="detail" class="form-control" required>
        </div>
        
        <button type="submit" class="btn btn-primary">Simpan</button>
    </form>
@endsection
