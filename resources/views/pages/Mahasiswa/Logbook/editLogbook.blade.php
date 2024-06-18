@extends('layout.master')
@section('title', 'Edit Logbook Mahasiswa')
@section('content')
    <h1>Edit Logbook Mahasiswa</h1>

    <form action="{{ route('updateLogbook', $logbook->id) }}" class="mb-5" method="POST">
        @csrf
        @method('PUT')
        <div class="form-group mb-3">
            <label for="tanggal">Tanggal</label>
            <input type="date" name="tanggal" id="tanggal" class="form-control" value="{{ $logbook->tanggal }}" required>
        </div>

        <div class="form-group mb-3">
            <label for="kegiatan">Kegiatan</label>
            <input type="text" name="kegiatan" id="kegiatan" class="form-control" value="{{ $logbook->kegiatan }}" required>
        </div>

        <div class="form-group mb-3">
            <label for="detail">Detail Kegiatan</label>
            <input type="text" name="detail" id="detail" class="form-control" value="{{ $logbook->detail }}" required>
        </div>
        
        <button type="submit" class="btn btn-primary">Simpan</button>
    </form>
@endsection
