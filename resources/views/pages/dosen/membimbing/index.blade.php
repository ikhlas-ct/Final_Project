@extends('layout.master')
@section('title', 'Tugas Akhir')
@section('content')
    <div class="container">
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h4 class="card-title fw-semibold">Halaman Bimbingan</h4>
        </div>
        <div class="card">
            <div class="card-body">
                <table class="table">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th style="width: 15%">Nama</th>
                            <th>Judul</th>
                            <th style="width: 30%">Keterangan</th>
                            <th class="text-center">Logbook</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($pengajuan as $index => $item)
                            <tr>
                                <td style="vertical-align: middle;">{{ $index + 1 }}</td>
                                <td style="vertical-align: middle;">{{ $item->mahasiswa->nama }}</td>
                                <td style="vertical-align: middle;">{{ $item->judul }}</td>
                                <td style="align-items: center;vertical-align: middle;">
                                    @php
                                        $bimbinganId = null;
                                        $tanggalBimbingan = null;
                                        $tanggalReschedule = null;
                                        $status = '';
                                        if ($item->judulFinal->pembimbing1 && $item->judulFinal->pembimbing1->dosen) {
                                            $bimbinganPembimbing1 = $item->judulFinal->pembimbing1->dosen
                                                ->bimbingan()
                                                ->where('status', 'diproses')
                                                ->orderBy('tanggal', 'desc')
                                                ->first();
                                            if ($bimbinganPembimbing1) {
                                                $bimbinganId = $bimbinganPembimbing1->id;
                                                $tanggalBimbingan = $bimbinganPembimbing1->tanggal;
                                                $status = 'diproses';
                                            }
                                        }
                                        if ($item->judulFinal->pembimbing1 && $item->judulFinal->pembimbing1->dosen) {
                                            $bimbinganPembimbing1 = $item->judulFinal->pembimbing1->dosen
                                                ->bimbingan()
                                                ->where('status', 'diterima')
                                                ->orderBy('tanggal', 'desc')
                                                ->first();
                                            if ($bimbinganPembimbing1) {
                                                $bimbinganId = $bimbinganPembimbing1->id;
                                                $tanggalBimbingan = $bimbinganPembimbing1->tanggal;
                                                $status = 'diterima';
                                            }
                                        }
                                        if ($item->judulFinal->pembimbing1 && $item->judulFinal->pembimbing1->dosen) {
                                            $bimbinganPembimbing1 = $item->judulFinal->pembimbing1->dosen
                                                ->bimbingan()
                                                ->where('status', 'diterima')
                                                ->with('reschedule')
                                                ->orderBy('tanggal', 'desc') // Urutkan berdasarkan tanggal terbaru
                                                ->first();
                                            if (!empty($bimbinganPembimbing1->reschedule)) {
                                                $bimbinganId = $bimbinganPembimbing1->id;
                                                $tanggalReschedule = $bimbinganPembimbing1->reschedule->tanggal;
                                                $status = 'diterima';
                                            }
                                        }
                                        // ---------------------------------------------------------------------------
                                        if (
                                            !$tanggalBimbingan &&
                                            $item->judulFinal->pembimbing2 &&
                                            $item->judulFinal->pembimbing2->dosen
                                        ) {
                                            $bimbinganPembimbing2 = $item->judulFinal->pembimbing2->dosen->bimbingan
                                                ->where('status', 'diproses')
                                                ->first();
                                            if ($bimbinganPembimbing2) {
                                                $tanggalBimbingan = $bimbinganPembimbing2->tanggal;
                                                $status = 'diproses';
                                            }
                                        }
                                        if (
                                            !$tanggalBimbingan &&
                                            $item->judulFinal->pembimbing2 &&
                                            $item->judulFinal->pembimbing2->dosen
                                        ) {
                                            $bimbinganPembimbing2 = $item->judulFinal->pembimbing2->dosen->bimbingan
                                                ->where('status', 'diterima')
                                                ->first();
                                            if ($bimbinganPembimbing2) {
                                                $tanggalBimbingan = $bimbinganPembimbing2->tanggal;
                                                $status = 'diterima';
                                            }
                                        }
                                    @endphp
                                    @if ($tanggalBimbingan)
                                        @if ($status == 'diproses')
                                            <div style="text-align: justify" class="d-inline"> {!! 'Mengajukan Bimbingan pada tanggal <b>' . $tanggalBimbingan . '</b>' !!}
                                                <button type="button" class="btn btn-link m-0 p-0 btn-ajax"
                                                    data-pengajuan-id="{{ $bimbinganId }}" data-action="updateStatus"
                                                    data-status="Diterima">Terima</button>
                                            </div>
                                        @endif
                                        @if ($status == 'diterima' && empty($tanggalReschedule))
                                            <div style="text-align: justify" class="d-inline"> {!! 'Bimbingan yang akan datang pada tanggal <b>' . $tanggalBimbingan . '</b>' !!}
                                                <button type="button" class="btn btn-link m-0 p-0 btn-ajax"
                                                    data-pengajuan-id="{{ $bimbinganId }}" data-action="reschedule"
                                                    data-bs-toggle="modal"
                                                    data-bs-target="#exampleModal">Reschedule</button>
                                            </div>
                                        @endif
                                        @if ($status == 'diterima' && !empty($tanggalReschedule))
                                            <div class="d-inline">
                                                <p style="text-align: justify">{!! 'Bimbingan yang akan datang pada tanggal <b>' .
                                                    $tanggalBimbingan .
                                                    '</b>' .
                                                    ' Anda <b>reschedule</b> menjadi tanggal <b>' .
                                                    $tanggalReschedule !!}</p>
                                                {{-- <button type="button"
                                                    class="btn btn-link m-0 p-0 btn-ajax"
                                                    data-pengajuan-id="{{ $item->id }}" data-action="reschedule"
                                                    data-bs-toggle="modal"
                                                    data-bs-target="#exampleModal">Reschedule</button></div> --}}
                                        @endif
                                    @else
                                        <!-- Tampilkan keterangan atau pesan alternatif jika tidak ada bimbingan yang diproses -->
                                    @endif
                                </td>
                                <td style="vertical-align: middle;" class="text-center">
                                    <button class="btn btn-sm btn-info mb-0">Lihat</button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Reschedule Jadwal</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="exampleFormControlInput1" class="form-label">Tanggal</label>
                        <input type="date" class="form-control" id="exampleFormControlInput1">
                    </div>
                </div>
                <div class="modal-footer">
                    <button id="hide-modal" type="button" class="btn btn-warning" data-bs-dismiss="modal">Batal</button>
                    <button type="button" class="btn btn-primary" id="submitDate">Kirim</button>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        $(document).ready(function() {
            var pengajuanIdReschedule;

            // Handle clicks on buttons with class 'btn-ajax'
            $('.btn-ajax').click(function() {

                var action = $(this).data('action');
                var pengajuanId = $(this).data('pengajuan-id');

                if (action === 'updateStatus') {
                    var status = $(this).data('status');
                    handleAjax(pengajuanId, action, {
                        status: status
                    });
                } else if (action === 'reschedule') {
                    pengajuanIdReschedule = pengajuanId;
                }
            });

            // Handle the reschedule date submission
            $('#submitDate').click(function() {
                var date = $('#exampleFormControlInput1').val();
                // alert(date + pengajuanIdReschedule);
                handleAjax(pengajuanIdReschedule, 'reschedule', {
                    date: date
                });
            });

            function handleAjax(pengajuanId, action, data) {
                var url;
                var method;
                if (action === 'updateStatus') {
                    url = '/bimbingan/update/' + pengajuanId;
                    method = 'PUT';
                } else if (action === 'reschedule') {
                    url = '/bimbingan/reschedule/' + pengajuanId;
                    method = 'POST';
                }
                // alert(url);
                data._token = '{{ csrf_token() }}';
                $.ajax({
                    url: url,
                    type: method,
                    data: data,
                    success: function(response) {
                        // alert(response);
                        if (action === 'reschedule') {
                            $('#exampleModal').modal('hide');
                            $('#hide-modal').trigger('click');
                        }

                        window.location.reload();
                    },
                    error: function(xhr) {
                        // alert('Gagal memproses permintaan');
                    }
                });
            }
        });
    </script>
@endsection
