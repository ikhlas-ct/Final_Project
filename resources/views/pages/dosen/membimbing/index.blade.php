@extends('layout.master')
@section('title', 'Tugas Akhir')
@section('content')
    @php
        use Carbon\Carbon;
        Carbon::setLocale('id');
    @endphp
    <div class="container">
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h4 class="card-title fw-semibold">Halaman Membimbing</h4>
        </div>
        <div class="card">
            <div class="card-body">
                <table id="example" class="table-bordered">
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
                        @foreach ($mergeData as $index => $item)
                            <tr>
                                <td style="vertical-align: middle;" class="text-start">{{ $index + 1 }}</td>
                                <td style="vertical-align: middle;" class="text-start">{{ $item['nama'] }}</td>
                                <td style="vertical-align: middle;" class="text-start">{{ $item['judul'] }}</td>
                                <td style="align-items: center;vertical-align: middle;">
                                    @if ($item['status'] == 'diproses')
                                        <div style="text-align: justify" class="d-inline"> {!! 'Mengajukan Bimbingan pada tanggal <b>' . \Carbon\Carbon::parse($item['tanggal']) . '</b>' !!}
                                            <button type="button" class="btn btn-link m-0 p-0 btn-ajax"
                                                data-pengajuan-id="{{ $item['id'] }}" data-action="updateStatus"
                                                data-status="diterima" data-type="{{ $item['pembimbing'] }}">Terima</button>
                                        </div>
                                    @endif
                                    @if ($item['status'] == 'diterima' && empty($item['tanggal_reschedule']))
                                        <div style="text-align: justify" class="d-inline"> {!! 'Bimbingan yang akan datang pada tanggal <b>' . \Carbon\Carbon::parse($item['tanggal']) . '</b>' !!}
                                            <div class="d-flex gap-1">
                                                <button type="button" class="btn btn-link m-0 p-0 btn-ajax"
                                                    data-pengajuan-id="{{ $item['id'] }}"
                                                    data-type="{{ $item['pembimbing'] }}" data-action="reschedule"
                                                    data-bs-toggle="modal"
                                                    data-bs-target="#exampleModal">Reschedule</button>
                                                <div>|</div>
                                                <button type="button" class="btn btn-link m-0 p-0 btn-ajax"
                                                    data-pengajuan-id="{{ $item['id'] }}" data-action="updateStatus"
                                                    data-status="selesai"
                                                    data-type="{{ $item['pembimbing'] }}">Selesai</button>
                                            </div>
                                        </div>
                                    @endif
                                    @if ($item['status'] == 'diterima' && !empty($item['tanggal_reschedule']))
                                        <div style="text-align: justify" class="d-inline">
                                            <p style="text-align: justify">{!! 'Bimbingan yang akan datang pada tanggal <b>' .
                                                $item['tanggal'] .
                                                '</b>' .
                                                ' Anda <b>reschedule</b> menjadi tanggal <b>' .
                                                \Carbon\Carbon::parse($item['tanggal_reschedule']) !!} <button type="button"
                                                    class="btn btn-link m-0 p-0 btn-ajax"
                                                    data-pengajuan-id="{{ $item['id'] }}" data-action="updateStatus"
                                                    data-status="selesai"
                                                    data-type="{{ $item['pembimbing'] }}">Selesai</button></p>

                                        </div>
                                    @endif
                                    @if ($item['status'] == 'selesai')
                                        <div style="text-align: justify" class="d-inline">
                                            <p style="text-align: justify">{!! 'Bimbingan terakhir pada tanggal <b>' .
                                                ($item['tanggal_reschedule'] ? $item['tanggal_reschedule'] : $item['tanggal']) .
                                                '</b>' !!}</p>
                                        </div>
                                    @endif
                                </td>
                                <td style="vertical-align: middle;" class="text-center">
                                    <a href="{{ route('membimbing.show', ['id' => $item['mahasiswa_id'] . '.' . $item['pembimbing']]) }}"
                                        class="btn btn-sm btn-info mb-0">Lihat</a>
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
                        <label for="tanggal" class="form-label">Tanggal</label>
                        <input type="datetime-local" class="form-control" id="tanggal">
                        <div class="invalid-feedback" id="tanggal-err"></div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button id="hide-modal" type="button" class="btn btn-outline-primary"
                        data-bs-dismiss="modal">Batal</button>
                    <button type="button" class="btn btn-primary" id="submitDate">Kirim</button>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        $(document).ready(function() {
            let today = new Date().toISOString().split("T")[
                0];
            $('#tanggal').attr('min', today);
            $('#example').DataTable({
                "ordering": false,
            });
            let bimbinganId;
            let type;
            $('.btn-ajax').click(function() {
                let action = $(this).data('action');
                let getType = $(this).data('type');
                let getBimbinganId = $(this).data('pengajuan-id');
                if (action === 'updateStatus') {
                    let status = $(this).data('status');
                    handleAjax(getBimbinganId, action, {
                        status: status,
                        type: getType
                    });
                } else if (action === 'reschedule') {
                    bimbinganId = getBimbinganId;
                    type = getType;
                }
            });
            $('#submitDate').click(function() {
                let tanggal = $('#tanggal').val();
                handleAjax(bimbinganId, 'reschedule', {
                    tanggal: tanggal,
                    type: type
                });
            });

            function handleAjax(bimbinganId, action, data) {
                let url = '/bimbingan/update/' + bimbinganId;
                let method = 'PUT';
                data._token = '{{ csrf_token() }}';
                if (action == 'updateStatus') {
                    $.ajax({
                        url: url,
                        type: method,
                        data: data,
                        success: function(response) {
                            // alert(response);
                            if (action === 'reschedule') {
                                $('#hide-modal').trigger('click');
                            }
                            window.location.reload();
                        },
                        error: function(xhr) {
                            alert('Gagal memproses permintaan');
                        }
                    });
                } else {
                    let selectedDate = new Date($('#tanggal').val());
                    let today = new Date();
                    var errInput = $('#tanggal');
                    var errText = $('#tanggal-err');
                    errInput.removeClass('is-invalid');
                    errText.text('');
                    if ($(errInput).val() == "") {
                        errInput.addClass('is-invalid');
                        errText.text('Isi Tanggal dan waktu');
                        return;
                    } else if (selectedDate < today) {
                        errInput.addClass('is-invalid');
                        errText.text('Waktu yang Anda pilih harus setidaknya hari ini atau hari mendatang.');
                        return;
                    } else {
                        $.ajax({
                            url: url,
                            type: method,
                            data: data,
                            success: function(response) {
                                // alert(response);
                                if (action === 'reschedule') {
                                    $('#hide-modal').trigger('click');
                                }
                                window.location.reload();
                            },
                            error: function(xhr) {
                                alert('Gagal memproses permintaan');
                            }
                        });
                    }
                }

            }
        });
    </script>
@endsection
