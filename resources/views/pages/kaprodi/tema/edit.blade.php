@extends('layout.master')
@section('title', 'Edit Tema')
@section('content')
    <div class="container">
        <h3>Edit Tema</h3>
        <form action="{{ route('updateTema', $tema->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="form-group mt-3 mb-3">
                <label for="fakultas_id">Fakultas:</label>
                <select class="form-control" id="fakultas_id" name="fakultas_id" required>
                    <option value="">Pilih Fakultas</option>
                    @foreach($fakultas as $f)
                        <option value="{{ $f->id }}" {{ $f->id == $tema->fakultas_id ? 'selected' : '' }}>{{ $f->nama }}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group mb-3">
                <label for="nama">Nama:</label>
                <input type="text" class="form-control" id="nama" name="nama" value="{{ $tema->nama }}" required>
            </div>
            <button type="submit" class="btn btn-primary">Update</button>
        </form>
    </div>
@endsection
