@extends('layout.master')
@section('title', 'Tambah Tema')
@section('content')
    <div class="container">
        <h3>Tambah Tema</h3>
        <form action="{{ route('SimpanTema') }}" method="POST">
            @csrf
            <div class="form-group mb-3">
                <label for="fakultas_id">Fakultas:</label>
                <select class="form-control" id="fakultas_id" name="fakultas_id" required>
                    <option value="">Pilih Fakultas</option>
                    @foreach($fakultas as $f)
                        <option value="{{ $f->id }}">{{ $f->nama }}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group mb-3">
                <label for="nama">Nama:</label>
                <input type="text" class="form-control" id="nama" name="nama" required>
            </div>
            <button type="submit" class="btn btn-primary">Simpan</button>
        </form>
    </div>
@endsection
