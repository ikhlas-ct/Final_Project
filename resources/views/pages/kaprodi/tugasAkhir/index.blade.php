@extends('layout.master')
@section('title', 'Tugas-Akhir')
@section('content')

    <h4 class="card-title fw-semibold mb-4">Cari Pembimbing</h4>
    <div class="card">
        <div class="card-body">
            <table id="example" class="cell-border" style="width:100%">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama</th>
                        <th>Judul</th>
                        <th>Pembimbing I</th>
                        <th>Pembimbing II</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($mahasiswas as $index => $mahasiswa)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $mahasiswa->nama }}</td>
                            <td>
                                @if ($mahasiswa->pengajuan && $mahasiswa->pengajuan->judul)
                                    <ul>
                                        @foreach ($mahasiswa->pengajuan->judul as $judul)
                                            <li class="text-capitalize">{{ $judul->judul }}</li>
                                        @endforeach
                                    </ul>
                                @else
                                    Tidak ada judul
                                @endif
                            </td>
                            <td>
                                <button class="btn btn-primary mt-3">Cari</button>
                            </td>
                            <td>
                                <button class="btn btn-primary mt-3">Cari</button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
@section('scripts')
    <script>
        new DataTable('#example');
    </script>
@endsection
