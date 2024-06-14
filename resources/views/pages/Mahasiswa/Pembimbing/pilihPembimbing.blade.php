@extends('layout.master')
@section('title', 'Pilih Pembimbing')
@section('content')

<div class="container mt-3">
    <h4>Pilih Pembimbing</h4>

    @if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
    @endif

    <form method="POST" action="{{ route('storePembimbing') }}">
        @csrf
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama Pembimbing</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($pembimbingList as $index => $pembimbing)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $pembimbing->dosen->nama }}</td>
                    <td>
                        <input type="checkbox" name="selectedPembimbing[]" value="{{ $pembimbing->dosen->id }}"
                            {{ in_array($pembimbing->dosen->id, $selectedPembimbing) ? 'checked' : '' }}
                            {{ count($selectedPembimbing) >= 2 && !in_array($pembimbing->dosen->id, $selectedPembimbing) ? 'disabled' : '' }}>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        <button type="submit" class="btn btn-primary">Simpan Pembimbing</button>
    </form>
</div>

@endsection
