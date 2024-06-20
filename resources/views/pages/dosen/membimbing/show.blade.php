@extends('layout.master')
@section('title', 'Tugas Akhir')
@section('content')
    @php
        use Carbon\Carbon;
        Carbon::setLocale('id');
    @endphp
    <div class="container">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h4 class="card-title fw-semibold">Halaman Detail Membimbing</h4>
        </div>
        <div class="card">
            <div class="card-body">
                <div class="h5 text-muted">Profile:</div>
                <table>
                    @foreach ($mergeData as $item)
                        <tr>
                            <td class="fw-bolder">Nama Mahasiswa</td>
                            <td class="px-2 py-1">:</td>
                            <td>{{ $item['nama_mahasiswa'] }}</td>
                        </tr>
                        <tr>
                            <td class="fw-bolder">Tema</td>
                            <td class="px-2 py-1">:</td>
                            <td>{{ $item['tema'] }}</td>
                        </tr>
                        <tr>
                            <td class="fw-bolder">Judul</td>
                            <td class="px-2 py-1">:</td>
                            <td>{{ $item['judul'] }}</td>
                        </tr>
                    @break
                @endforeach
            </table>
            <hr>
            <div class="h5 text-muted">Logbook:</div>
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th scope="col">No</th>
                        <th scope="col">Tanggal Bimbingan</th>
                        <th scope="col">Kegiatan</th>
                        <th scope="col">Detail Kegiatan</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $no = 1;
                    @endphp
                    @foreach ($mergeData as $item)
                        @if ($item['type1'] != $item['type2'])
                            @continue
                        @endif
                        <tr>
                            <th class="text-start">{{ $no++ }}</th>
                            <td class="text-start">{{ $item['tanggal_bimbingan'] ?? 'Belum mengisi' }}</td>
                            <td class="text-start">
                                {{ isset($item['logbook'][0]['kegiatan']) ? $item['logbook'][0]['kegiatan'] : 'Belum mengisi' }}
                            </td>
                            <td class="text-start">
                                {{ isset($item['logbook'][0]['detail_kegiatan']) ? $item['logbook'][0]['detail_kegiatan'] : 'Belum mengisi' }}
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <hr>
            <div class="h5 text-muted">Keterangan:</div>
            <div class="container mt-3">
                <ul style="list-style-type: disc; padding-left: 20px;">

                    <li style="margin-bottom: 10px;">
                        Mahasiswa yang bersangkutan telah melakukan total <b>
                            {{ $as == 'P1' ? $totalBimbinganP1 : $totalBimbinganP2 }} kali
                            bimbingan</b> bersama
                        <b>Anda</b>
                        sebagai {{ $as == 'P1' ? 'Pembimbing Utama' : 'Pembimbing Kedua' }}.
                    </li>
                    <li style="margin-bottom: 10px;">
                        Untuk informasi mengenai proses bimbingan mahasiswa tersebut bersama Pembimbing Kedua,
                        silakan
                        hubungi <b> {{ $as == 'P1' ? $dosen_p2 : $dosen_p1 }}</b> selaku
                        {{ $as == 'P1' ? 'Pembimbing Kedua' : 'Pembimbing Utama' }}.
                    </li>
                    @if (empty($status_p1) && $as === 'P1')
                        <li style="margin-bottom: 10px;">
                            Jika Anda merasa bimbingan tersebut sudah cukup, silakan klik tombol
                            <b>Terpenuhi</b>
                            yang ada dibawah.
                        </li>
                    @endif
                    @if (!empty($status_p1) && $as == 'P1')
                        <li style="margin-bottom: 10px;">
                            Bimbingan sudah
                            <b>Terpenuhi</b>
                        </li>
                    @endif
                    @if (empty($status_p2) && $as === 'P2')
                        <li style="margin-bottom: 10px;">
                            Jika Anda merasa bimbingan tersebut sudah cukup, silakan klik tombol
                            <b>Terpenuhi</b>
                            yang ada dibawah.
                        </li>
                    @endif
                    @if (!empty($status_p2) && $as == 'P2')
                        <li style="margin-bottom: 10px;">
                            Bimbingan sudah
                            <b>Terpenuhi</b>
                        </li>
                    @endif
                </ul>
            </div>
            @if (empty($status_p1) && $as === 'P1')
                <hr>
                <div class="mt-3 d-grid">
                    <form method="POST" action="{{ route('selesai.membimbing', ['id' => $pembimbingId]) }}">
                        @csrf
                        @method('PUT')
                        <div class="mt-3 d-grid">
                            <button type="submit" class="btn btn-success">Terpenuhi</button>
                        </div>
                    </form>
                </div>
            @endif
            @if (empty($status_p2) && $as === 'P2')
                <hr>
                <div class="mt-3 d-grid">
                    <form method="POST" action="{{ route('selesai.membimbing', ['id' => $pembimbingId]) }}">
                        @csrf
                        @method('PUT')
                        <div class="mt-3 d-grid">
                            <button type="submit" class="btn btn-success">Terpenuhi</button>
                        </div>
                    </form>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection

@section('scripts')

@endsection