@extends('layout.master')
@section('title', 'Tugas-Akhir')
@section('content')

    <h4 class="card-title fw-semibold mb-4">Halaman Persutujuan</h4>
    <div class="card">
        <div class="card-body">
            <div id="table-container">
            </div>
        </div>
    </div>
    <!-- Modal -->
    <form id="form-pembimbing">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Cari Pembimbing</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-0">
                            <label for="states" class="form-label">Pembimbing</label>
                            <select class="js-example-basic-multiple form-control" name="pembimbing[]" multiple="multiple">
                                @foreach ($dosen as $item)
                                    <option value="{{ $item->id }}">{{ $item->nama }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <input placeholder="Masukan Nama Email" name="email" type="hidden"
                                class="form-control form-control-sm" id="pengajuan-hide" aria-describedby="emailHelp"
                                value="{{ old('email') }}">
                            <div class="invalid-feedback" id="pengajuan-hide-err"></div>
                        </div>
                        <input name="pengajuan_id" id="pengajuan_id_modal" type="hidden" value="">
                    </div>
                    <div class="modal-footer">
                        <button id="hide-modal" type="button" class="btn btn-outline-primary"
                            data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </div>
            </div>
        </div>
    </form>
@endsection
@section('scripts')
    <script>
        $(document).ready(function() {
            // toastr.success("Pesan sukses Anda di sini!", "Judul Sukses");
            // 
            $('.js-example-basic-multiple').select2({
                width: '100%',
                minimumResultsForSearch: -1
            });
            $('#exampleModal').on('shown.bs.modal', function() {
                $('.js-example-basic-multiple').select2({
                    dropdownParent: $('#exampleModal'),
                    width: '100%',
                    placeholder: '-----------------Pilih Pembimbing-----------------',
                    minimumResultsForSearch: -1
                });
            });
            // AJAX
            function loadData() {
                $.ajax({
                    type: 'GET',
                    url: '/persetujuan/getData',
                    success: function(response) {
                        $('#table-container').html(response);
                        new DataTable('#example');

                        $('#pengajuan_id_modal').val($('#cari-pembimbing').val());
                        $('.btn-terima').on('click', function() {
                            var form = $(this).closest(
                                '.terima-form'); // Ambil form terdekat dari tombol "Terima"
                            var pengajuanId = form.data(
                                'id'); // Ambil ID pengajuan dari data-id form

                            // Tampilkan SweetAlert untuk konfirmasi
                            Swal.fire({
                                title: 'Apakah Anda yakin?',
                                text: "Anda akan menerima pengajuan ini!",
                                icon: 'warning',
                                showCancelButton: true,
                                confirmButtonColor: '#3085d6',
                                cancelButtonColor: '#d33',
                                confirmButtonText: 'Ya, Terima!',
                                cancelButtonText: 'Batal'
                            }).then((result) => {
                                if (result.isConfirmed) {
                                    // Lanjutkan submit form jika dikonfirmasi
                                    form.submit();
                                }
                            });
                        });
                    },
                    error: function(xhr, status, error) {
                        console.error("Error: " + error);
                        console.log(xhr.responseText);
                    }
                });
            }
            loadData();
            // 

            $('#form-pembimbing').on('submit', function(e) {
                e.preventDefault();
                let csrfToken = $('input[name="_token"]').val();
                $.ajax({
                    type: 'POST',
                    url: '{{ route('simpan.persetujuan') }}',
                    data: $('#form-pembimbing').serialize(),
                    headers: {
                        'X-CSRF-TOKEN': csrfToken
                    },
                    success: function(response) {
                        Swal.fire({
                            icon: "success",
                            title: "Selamat!",
                            text: 'Anda telah berhasil memilihkan pembimbing.',
                            showConfirmButton: false,
                            timer: 1500
                        });

                        $('#hide-modal').trigger('click');
                        loadData();
                    },
                    error: function(xhr) {
                        var errInput = $('#pengajuan-hide');
                        var errText = $('#pengajuan-hide-err');
                        errInput.removeClass('is-invalid');
                        errText.text('')
                        if (xhr.status === 422) {
                            let errors = xhr.responseJSON.errors;
                            if (errors.pembimbing) {
                                errInput.addClass('is-invalid');
                                errText.text(errors.pembimbing[0]);
                            } else {
                                alert(
                                    'Terjadi error saat mengirim permintaan, silahkan hubungi pihak terkait'
                                );
                            }
                        } else {
                            alert(
                                'Terjadi error saat mengirim permintaan, silahkan hubungi pihak terkait'
                            );
                        }
                    }
                });
            });
        });
    </script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/select2.min.js"></script>
@endsection
