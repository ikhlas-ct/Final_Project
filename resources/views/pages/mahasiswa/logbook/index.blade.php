@extends('layout.master')
@section('title', 'Tugas-Akhir')
@section('content')
    @php
        use Carbon\Carbon;
        Carbon::setLocale('id');
    @endphp
    <h4 class="card-title fw-semibold mb-4">Halaman Logbook</h4>
    <div class="card">
        <div class="card-body">
            <table id="example" class="table-bordered">
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
                            <td class="text-start">{{ $key + 1 }}</td>
                            <td>
                                {{ $item['nama_dosen'] }}
                            </td>
                            <td> {{ \Carbon\Carbon::parse($item['tanggal_bimbingan'])->translatedFormat('d F Y') }}</td>
                            <td class="text-center">
                                @if (empty($item['logbook']))
                                    <span class="badge bg-danger">Belum Mengisi</span>
                                @else
                                    <span class="badge bg-success">Sudah Mengisi</span>
                                @endif
                            </td>
                            <td class="text-center">
                                @if (empty($item['logbook']))
                                    <button class="btn btn-primary btn-sm m-0" data-bs-toggle="modal"
                                        data-bs-target="#modalCreate" data-id="{{ $item['id'] }}"
                                        data-type="{{ $item['type'] }}">Isi Logbook</button>
                                @else
                                    <button class="btn btn-primary btn-sm m-0" data-bs-toggle="modal"
                                        data-bs-target="#modalCreate" data-keterangan="TEST" data-detail="TEST"
                                        data-type="lihat">Lihat
                                        Logbook</button>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <hr>
            <div class="d-flex justify-content-between align-items-center mt-3">
                <div class="fst-italic fs-7 text-muted">*Fitur download akan aktif setelah proses bimbingan dinyatakan
                    terpenuhi
                    oleh
                    kedua
                    pembimbing
                </div>
                @php
                    $isDisabled = empty($status_p1) || empty($status_p2);
                @endphp
                <a href="{{ route('generate-pdf', ['id' => $mahasiswaId]) }}" {{ $isDisabled ? 'disabled' : '' }}
                    class="btn btn-primary">Download</a>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade modal-lg" id="modalCreate" tabindex="-1" aria-labelledby="modalCreateLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalCreateLabel">Isi Logbook</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="form-logbook" onsubmit="submitLogbook(event)">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        {{--  --}}
                        <input id="id" type="hidden" name="id">
                        <input id="type" type="hidden" name="type">
                        <div class="mb-3">
                            <label for="kegiatan" class="form-label">Kegiatan</label>
                            <input require type="text" class="form-control" id="kegiatan" name="kegiatan"
                                placeholder="Masukan kegiatan">
                            <div class="invalid-feedback">Kegiatan tidak boleh kosong.</div>
                        </div>
                        <div class="mb-3">
                            <label for="detail_kegiatan" class="form-label">Detail Kegiatan</label>
                            <textarea require class="form-control" id="detail_kegiatan" name="detail_kegiatan" rows="5"></textarea>
                            <div class="invalid-feedback">Detail kegiatan tidak boleh kosong dan minimal 20 kata.</div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button id="hide-modal" type="button" class="btn btn-outline-primary"
                        data-bs-dismiss="modal">Batal</button>
                    <button id="btn-simpan" type="submit" class="btn btn-primary" form="form-logbook">Simpan</button>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        $(document).ready(function() {
            $('#example').DataTable({
                "bInfo": false,
                "paging": false,
                "lengthChange": false
            });
            $('#modalCreate').on('hidden.bs.modal', function() {
                // Mengosongkan nilai input dan menghapus atribut readonly
                $('#modalCreateLabel').text('Isi Logbook');
                $('#btn-simpan').show()
                $('#hide-modal')
                    .text('Batal')
                    .removeClass('btn-primary') // Hapus kelas btn-outline-primary
                    .addClass('btn-outline-primary');
                $('#kegiatan')
                    .val('')
                    .prop('readonly', false)
                    .css({
                        'pointer-events': '', // Mengembalikan ke nilai default (bisa diubah)
                        'background-color': '', // Mengembalikan ke nilai default
                        'color': '' // Mengembalikan ke nilai default
                    });

                $('#detail_kegiatan')
                    .val('')
                    .prop('readonly', false)
                    .css({
                        'pointer-events': '', // Mengembalikan ke nilai default (bisa diubah)
                        'background-color': '', // Mengembalikan ke nilai default
                        'color': '' // Mengembalikan ke nilai default
                    });
            });

            // Menangani saat modal ditampilkan
            $('#modalCreate').on('show.bs.modal', function(event) {
                let modal = $(this);
                let button = $(event.relatedTarget);
                let type = button.data('type');
                if (type === 'lihat') {
                    $('#modalCreateLabel').text('Lihat Logbook');
                    $('#btn-simpan').hide();
                    $('#hide-modal')
                        .text('Tutup')
                        .removeClass('btn-outline-primary') // Hapus kelas btn-outline-primary
                        .addClass('btn-primary');
                    $('#kegiatan')
                        .val(button.data('keterangan'))
                        .prop('readonly', true)
                        .css({
                            'pointer-events': 'none', // Menonaktifkan event mouse dan keyboard
                            'background-color': '#f0f0f0', // Memberikan latar belakang abu-abu
                            'color': '#888888' // Mengubah warna teks menjadi abu-abu
                        });
                    $('#detail_kegiatan')
                        .val(button.data('detail'))
                        .prop('readonly', true)
                        .css({
                            'pointer-events': 'none', // Menonaktifkan event mouse dan keyboard
                            'background-color': '#f0f0f0', // Memberikan latar belakang abu-abu
                            'color': '#888888' // Mengubah warna teks menjadi abu-abu
                        });
                } else {
                    let id = button.data('id');
                    modal.find('#id').val(id);
                    modal.find('#type').val(type);
                }
            });
        });

        function submitLogbook(event) {
            event.preventDefault();
            $('.form-control').removeClass('is-invalid');
            $('.invalid-feedback').hide();

            let kegiatan = $('#kegiatan').val();
            if (!kegiatan) {
                $('#kegiatan').addClass('is-invalid');
                $('#kegiatan').siblings('.invalid-feedback').show();
                return; // Menghentikan pengiriman formulir jika kegiatan kosong
            }

            let detailKegiatan = $('#detail_kegiatan').val();
            if (!detailKegiatan) {
                $('#detail_kegiatan').addClass('is-invalid');
                $('#detail_kegiatan').siblings('.invalid-feedback').show();
                return;
            }
            let form = $('#form-logbook');
            let csrfToken = $('input[name="_token"]').val();
            $.ajax({
                type: 'POST',
                url: '{{ route('simpan.logbook') }}', // Ganti dengan URL yang sesuai
                data: form.serialize(),
                headers: {
                    'X-CSRF-TOKEN': csrfToken
                },
                success: function(response) {
                    $('#hide-modal').trigger('click'); // Tutup modal
                    window.location.reload(); // Muat ulang halaman
                },
                error: function(error) {
                    console.error('Error:', error);
                }
            });
        }
    </script>
@endsection
