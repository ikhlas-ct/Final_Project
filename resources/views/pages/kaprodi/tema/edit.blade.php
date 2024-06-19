@extends('layout.master')
@section('title', 'Tambah Tema')
@section('content')
    <div class="container">
        <h4 class="card-title fw-semibold mb-4">Edit Tema</h4>
        <div class="card">
            <div class="card-body">
                <form action="{{ route('updateTema', $tema->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="form-group mt-3 mb-3">
                        <label for="fakultas_id">Fakultas:</label>
                        <select class="form-control" id="fakultas_id" name="fakultas_id" required>
                            <option value="">Pilih Fakultas</option>
                            @foreach ($fakultas as $f)
                                <option value="{{ $f->id }}" {{ $f->id == $tema->fakultas_id ? 'selected' : '' }}>
                                    {{ $f->nama }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group mb-3">
                        <label for="nama">Nama:</label>
                        <input type="text" class="form-control" id="nama" name="nama" value="{{ $tema->nama }}"
                            required>
                    </div>
                    <div class="d-grid">
                        <button type="submit" class="btn btn-primary">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
