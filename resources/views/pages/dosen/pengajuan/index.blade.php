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
            <h4 class="card-title fw-semibold">Daftar Pengajuan Judul TA</h4>
        </div>
        <div class="card">
            <div class="card-body">
                <div id="table-container">
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        $(document).ready(function() {


            function loadData() {
                $.ajax({
                    type: 'GET',
                    url: '/pengajuan/getData',
                    success: function(response) {
                        $('#table-container').html(response);
                        new DataTable('#example');
                        attachFormSubmitHandler();
                    },
                    error: function(xhr, status, error) {
                        console.error("Error: " + error);
                        console.log(xhr.responseText);
                    }
                });
            }

            function attachFormSubmitHandler() {
                $('.terima-form').submit(function(e) {
                    e.preventDefault();

                    let pengajuanId = $(this).data('id');
                    $.ajax({
                        url: '/pengajuan/update-status/' + pengajuanId,
                        type: 'PUT',
                        data: {
                            status: 'Diterima',
                            _token: '{{ csrf_token() }}'
                        },
                        success: function(response) {
                            Swal.fire({
                                icon: "success",
                                title: "Selamat!",
                                text: 'Anda telah berhasil menerima pengajuan judul TA.',
                                showConfirmButton: false,
                                timer: 1500
                            });
                            loadData();
                        },
                        error: function(xhr) {
                            alert('Gagal memperbarui status');
                        }
                    });
                });
            }
            loadData();
            // Handle submit for Terima button
            $('.terima-form').submit(function(e) {
                e.preventDefault();

                let pengajuanId = $(this).data('id');
                $.ajax({
                    url: '/pengajuan/update-status/' + pengajuanId,
                    type: 'PUT',
                    data: {
                        status: 'Diterima',
                        _token: '{{ csrf_token() }}'
                    },
                    success: function(response) {
                        Swal.fire({
                            icon: "success",
                            title: "Selamat!",
                            text: 'Anda telah berhasil menerima pengajuan judul TA.',
                            showConfirmButton: false,
                            timer: 1500
                        });
                        $('#row-' + pengajuanId)
                            .remove(); // Optional: Remove the row after successful update
                    },
                    error: function(xhr) {
                        alert('Gagal memperbarui status');
                    }
                });
            });
        });
    </script>
@endsection
