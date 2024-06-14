@extends('layout.master')
@section('title', 'Pilih Pembimbing')
@section('content')
    <div class="container mt-3">
        <h4>Mahasiswa Bimbingan</h4>

        @if($mahasiswaList->isEmpty())
            <div class="alert alert-info">
                Tidak ada mahasiswa bimbingan.
            </div>
        @else
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Mahasiswa</th>
                        <th>NIM</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($mahasiswaList as $index => $mahasiswa)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $mahasiswa->nama }}</td>
                        <td>{{ $mahasiswa->nim }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
    </div>
@endsection