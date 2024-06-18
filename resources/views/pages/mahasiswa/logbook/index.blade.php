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
                                        data-bs-target="#exampleModal" data-id="{{ $item['id'] }}"
                                        data-type="{{ $item['type'] }}">Isi Logbook</button>
                                @else
                                    <button class="btn btn-primary btn-sm m-0" data-bs-toggle="modal"
                                        data-bs-target="#exampleModal" data-id="{{ $item['id'] }}"
                                        data-type="{{ $item['type'] }}">Lihat Logbook</button>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade modal-lg" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Isi Logbook</h5>
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
                        </div>
                        <div class="mb-3">
                            <label for="detail_kegiatan" class="form-label">Detail Kegiatan</label>
                            <textarea require class="form-control" id="detail_kegiatan" name="detail_kegiatan" rows="5"></textarea>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button id="hide-modal" type="button" class="btn btn-outline-primary"
                        data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary" form="form-logbook">Simpan</button>
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

            // Menangani saat modal ditampilkan
            $('#exampleModal').on('show.bs.modal', function(event) {
                let button = $(event.relatedTarget);
                let id = button.data('id');
                let type = button.data('type');
                let modal = $(this);
                modal.find('#id').val(id);
                modal.find('#type').val(type);
            });
        });

        function submitLogbook(event) {
            event.preventDefault(); // Mencegah pengiriman form secara default

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
                    // alert(response);
                    $('#hide-modal').trigger('click');
                    window.location.reload();
                },
                error: function(error) {
                    console.error('Error:', error);
                }
            });
        }
    </script>
@endsection
