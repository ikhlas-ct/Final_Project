@extends('layout.master')

@section('title', 'Edit Fakultas')

@section('content')
<div class="container">
    <h2>Edit Fakultas</h2>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('fakultas.update', $fakultas->id) }}" method="POST">
        @csrf
        @method('PUT') <!-- Method spoofing untuk PUT request -->
        <div class="mb-3">
            <label for="nama" class="form-label">Nama Fakultas</label>
            <input type="text" class="form-control" id="nama" name="nama" value="{{ $fakultas->nama }}" required>
        </div>
        <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
    </form>
</div>
@endsection
