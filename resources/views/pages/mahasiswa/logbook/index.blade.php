@extends('layout.master')
@section('title', 'Tugas-Akhir')
@section('content')

    <h4 class="card-title fw-semibold mb-4">Halaman Logbook</h4>
    <div class="card">
        <div class="card-body">
            <table class="table">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Pembimbing</th>
                        <th>Tanggal Bimbingan</th>
                        <th class="text-center">Status</th>
                        <th class="text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($mergeData as $key => $item)
                        <tr>
                            <td>{{ $key + 1 }}</td>
                            <td>
                                {{ $item['nama_dosen'] }}
                            </td>
                            <td> {{ $item['tanggal_bimbingan'] }}</td>
                            <td class="text-center"><span class="badge bg-danger">Belum Mengisi</span></td>
                            <td class="text-center">
                                <button class="btn btn-primary btn-sm m-0">Isi Logbook</button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/select2.min.js"></script>
@endsection
