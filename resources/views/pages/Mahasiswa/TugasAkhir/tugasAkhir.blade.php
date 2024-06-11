@extends('layout.master')
@section('title', 'Tugas Akhir')
@section('content')
    <div class="container mt-3">
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h4 class="card-title fw-semibold ">Daftar Judul TA</h4>
            <a href="{{ url('tugas-akhir-create') }}" class="btn btn-primary mt-3">Tambah Data</a>
        </div>
        <div class="card">
            <div class="card-body">
                @if ($tugasAkhir->isEmpty())

                    <p>Belum ada data tugas akhir.</p>
                @else
                    @php
                        $no = 1;
                    @endphp
                    <table id="example" class="cell-border" style="width:100%">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Judul</th>
                                <th>Konsentrasi</th>
                                <th>File</th>
                                <th>Status</th>
                                <th>Dibuat Pada</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($tugasAkhir as $ta)
                                <tr>
                                    <td>{{ $no++ }}</td>
                                    <td>{{ $ta->judul }}</td>
                                    <td>{{ $ta->tema->nama }}</td>
                                    <td><a href="{{ url('uploads/tugas-akhir/' . $ta->file) }}" target="_blank">Lihat
                                            File</a>
                                    </td>
                                    <td>
                                        @if ($ta->status == 'ditolak')
                                            <span class="badge bg-danger text-capitalize">{{ $ta->status }}</span>
                                        @elseif($ta->status == 'diproses')
                                            <span class="badge bg-secondary text-capitalize">{{ $ta->status }}</span>
                                        @elseif($ta->status == 'diterima')
                                            <span class="badge bg-success text-capitalize">{{ $ta->status }}</span>
                                        @endif
                                    </td>
                                    <td>{{ $ta->created_at->format('d M Y') }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @endif
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script>
        new DataTable('#example');
    </script>
@endsection
