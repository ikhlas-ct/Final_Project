@extends('layout.master')
@section('title', 'Logbook Mahasiswa')
@section('content')
    <h1>Logbook Mahasiswa</h1>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <div class="d-flex justify-content-end mb-3">
        <a href="{{ route('tambahLogbook') }}" class="btn btn-primary">Tambah Logbook</a>
    </div>

    <h4 class="mt-4">RIWAYAT LOGBOOK</h4>

    <div class="table-responsive">
        <table class="table table-striped table-bordered">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Tanggal</th>
                    <th>Kegiatan</th>
                    <th>Detail Kegiatan</th>
                    <th>Keterangan</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($logbooks as $logbook)
                    <tr>
                        <td class="text-center" style="white-space: nowrap;">{{ $loop->iteration }}</td>
                        <td style="white-space: nowrap;">{{ $logbook->tanggal }}</td>
                        <td style="white-space: nowrap;">{{ $logbook->kegiatan }}</td>
                        <td style="white-space: nowrap;">{{ $logbook->detail }}</td>
                        <td style="white-space: nowrap;">
                            @if($logbook->keterangan == 'DIPROSES')
                                <span class="bg-secondary text-dark py-2 px-2">{{ $logbook->keterangan }}</span>
                            @elseif($logbook->keterangan == 'ACC')
                                <span class="bg-success text-dark">{{ $logbook->keterangan }}</span>
                            @elseif($logbook->keterangan == 'REVISI')
                                <span class="bg-danger text-dark">{{ $logbook->keterangan }}</span> 
                            @endif
                        </td>
                        <td style="white-space: nowrap;">
                            <a href="{{ route('halamanEdit', $logbook->id) }}" class="btn btn-warning btn-sm py-2 px-2" style="margin-top: -7px">
                                <i class="fa fa-pencil-alt"></i> Edit
                            </a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
