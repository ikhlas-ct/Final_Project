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
            <h4 class="card-title fw-semibold ">Pendaftaran Judul TA</h4>
        </div>
        <div class="card">
            <div class="card-body">
                @if ($pengajuan->isEmpty())
                    <div class="d-inline">
                        Belum Mengajukan Judul Tugas Akhir <a href="{{ url('create-tugas-akhir') }}"
                            class="btn btn-link p-0 m-0">Ajukan
                            judul</a>
                    </div>
                @else
                    <div style="color: white" id="table-container">
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script>
        function loadData() {
            $.ajax({
                type: 'GET',
                url: '/tugas-akhir/getData',
                success: function(response) {
                    $('#table-container').html(response);
                    $('#example').DataTable({
                        "bInfo": false,
                        "paging": false,
                        "lengthChange": false,
                        "ordering": false,
                        "searching": false
                    });
                    new DataTable('#example');
                    attachFormSubmitHandler(); // Attach the form submit handler after loading data
                },
                error: function(xhr, status, error) {
                    console.error("Error: " + error);
                    console.log(xhr.responseText);
                }
            });
        }

        function attachFormSubmitHandler() {
            $('.ambil-pembimbing-form').on('submit', function(event) {
                event.preventDefault(); // Prevent default form submission

                var form = $(this);

                // Tampilkan SweetAlert konfirmasi sebelum mengirimkan form
                Swal.fire({
                    title: 'Apakah Anda yakin?',
                    text: "Anda akan memilih pembimbing ini.",
                    icon: 'question',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Ya, Pilih!',
                    cancelButtonText: 'Batal'
                }).then((result) => {
                    if (result.isConfirmed) {
                        // Lanjutkan dengan pengiriman form jika pengguna mengonfirmasi
                        var formData = form.serialize(); // Serialize form data
                        $.ajax({
                            url: '{{ route('store.ambilPembimbingTugasAkhir') }}',
                            method: 'POST',
                            data: formData,
                            headers: {
                                'X-CSRF-TOKEN': '{{ csrf_token() }}' // Add CSRF token for security
                            },
                            success: function(response) {
                                Swal.fire({
                                    title: "Selamat!",
                                    text: `Anda telah memilih pembimbing ${response}. Detailnya, silahkan baca keterangan`,
                                    icon: "success"
                                });
                                loadData(); // Memuat ulang data setelah berhasil
                            },
                            error: function(xhr, status, error) {
                                console.log(error);
                                alert('Error submitting form');
                            }
                        });
                    }
                });
            });
        }
        loadData();
    </script>

@endsection
