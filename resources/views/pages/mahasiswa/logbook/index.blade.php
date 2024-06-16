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
                    @foreach ($pengajuan as $item)
                        @php
                            $no = 1;
                            $allBimbingan = $item->judulFinal->pembimbing1->dosen->bimbingan
                                ->merge($item->judulFinal->pembimbing2->dosen->bimbingan)
                                ->sortBy('tanggal');
                        @endphp
                        @foreach ($allBimbingan as $bimbingan)
                            <tr>
                                <td>{{ $no++ }}</td>
                                <td>
                                    @if ($bimbingan->dosen_id == $item->judulFinal->pembimbing1->dosen->id)
                                        {{ $item->judulFinal->pembimbing1->dosen->nama }}
                                    @elseif ($bimbingan->dosen_id == $item->judulFinal->pembimbing2->dosen->id)
                                        {{ $item->judulFinal->pembimbing2->dosen->nama }}
                                    @endif
                                </td>
                                <td>{{ $bimbingan->tanggal }}</td>
                                <td class="text-center"><span class="badge bg-danger">Belum Mengisi</span></td>
                                <td class="text-center">
                                    <button class="btn btn-primary btn-sm m-0">Isi Logbook</button>
                                </td>
                            </tr>
                        @endforeach
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/select2.min.js"></script>
@endsection
