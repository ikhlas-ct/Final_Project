@extends('layout.master')
@section('title', 'Tambah Tema')
@section('content')
    <div class="container">
        <h4 class="card-title fw-semibold mb-4">Tambah Tema</h4>
        <div class="card">
            <div class="card-body">
                <form action="{{ route('SimpanTema') }}" method="POST">
                    @csrf
                    <div class="form-group mb-3">
                        <label for="fakultas_id">Fakultas:</label>
                        <select class="form-control" id="fakultas_id" name="fakultas_id" required>
                            <option value="">Pilih Fakultas</option>
                            @foreach ($fakultas as $f)
                                <option value="{{ $f->id }}">{{ $f->nama }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group mb-3">
                        <label for="nama">Nama:</label>
                        <input placeholder="Masukan nama tema" type="text" class="form-control" id="nama"
                            name="nama" required>
                    </div>
                    <div class="d-grid">
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
