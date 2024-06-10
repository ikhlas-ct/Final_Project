@extends('layout.master')
@section('title', 'Tugas Akhir')
@section('content')
    <div class="container mt-3">
        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <div class="card">
            <div class="card-header">
                <h2>Daftar Judul TA</h2>
            </div>
            <div class="card-body">
                <form action="{{ route('StoreTugasAkhir') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group mb-4">
                        <label for="judul" class="fw-bold">Judul</label>
                        <input type="text" id="judul" name="judul" class="form-control" placeholder="Isi judul" required>
                        <small class="form-text text-muted">Silakan konsultasikan ke dosen sebelum mendaftarkan judul tugas akhir.</small>
                    </div>
                    <div class="form-group mb-4">
                        <label for="konsentrasi" class="fw-bold">Konsentrasi</label>
                        <select id="konsentrasi" name="konsentrasi" class="form-control" required>
                            <option selected value="0">Pilih Konsentrasi</option>
                            <option value="Lab 1">Lab 1 Sistem Cerdas</option>
                            <option value="Lab 2">Lab 2 Teknik Informatika</option>
                            <option value="Lab 3">Lab 2 Teknik Elektro</option>
                            <option value="Lab 4">Lab 4 Sistem Informasi</option>
                        </select>
                    </div>
                    <div class="form-group mb-4">
                        <label for="file">Upload File</label>
                        <input type="file" id="file" name="file" class="form-control-file" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Daftar</button>
                </form>
            </div>
        </div>

        <div class="mt-5">
            <h3>Status Tugas Akhir</h3>
            @if($tugasAkhir->isEmpty())
                <p>Belum ada data tugas akhir.</p>
            @else
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Judul</th>
                            <th>Konsentrasi</th>
                            <th>File</th>
                            <th>Status</th>
                            <th>Dibuat Pada</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($tugasAkhir as $ta)
                            <tr>
                                <td>{{ $ta->judul }}</td>
                                <td>{{ $ta->konsentrasi }}</td>
                                <td><a href="{{ url('uploads/tugas-akhir/' . $ta->file) }}" target="_blank">Lihat File</a></td>
                                <td>
                                    @if($ta->status == 'ditolak')
                                        <span class="text-danger">{{ $ta->status }}</span>
                                    @elseif($ta->status == 'diproses')
                                        <span class="text-secondary">{{ $ta->status }}</span>
                                    @elseif($ta->status == 'diterima')
                                        <span class="text-success">{{ $ta->status }}</span>
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
@endsection
