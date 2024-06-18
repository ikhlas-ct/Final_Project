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
            <h4 class="card-title fw-semibold ">Daftar Judul TA</h4>
            <a href="{{ url('create-tugas-akhir') }}" class="btn btn-primary">Ajukan judul</a>
        </div>
        <div class="card">
            <div class="card-body">
                @if ($pengajuan->isEmpty())
                    <p>Belum ada data tugas akhir.</p>
                @else
                    {{-- <table id="example" class="table" style="width:100%">
                        <thead>
                            <tr>
                                <th class="text-center" style="width: 3%">No</th>
                                <th class="text-center" style="width: 17%">Tema</th>
                                <th class="text-center" style="width: 40%">Judul</th>
                                <th class="text-center" style="width: 40%">Keterangan</th>
                            </tr>
                        </thead>
                        <tbody>
                            <!-- Contoh baris data -->
                            <tr style="background-color: #13deb9">
                                <td class="text-white">1</td>
                                <td class="text-white">Tema Contoh</td>
                                <td class="text-justify text-white">
                                    Judul Contoh
                                </td>
                                <td style="text-align: justify" class="text-justify text-white">
                                    <div class="my-2">
                                        <div class="text-white">Anda telah memilih <b>Dosen Pembimbing Utama</b> sebagai
                                            pembimbing utama
                                            dan <b>Dosen Pembimbing Kedua</b> dijadikan sebagai pembimbing kedua.
                                            Selanjutnya silahkan berpindah ke halaman bimbingan untuk melanjutkan proses
                                            tugas
                                            akhir Anda.</div>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table> --}}
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
                            icon: "info"
                        });
                        loadData();
                    },
                    error: function(xhr, status, error) {
                        // Handle error here
                        console.log(error);
                        alert('Error submitting form');
                    }
                });
            });
        }

        // Initial data load
        loadData();

        // Use event delegation for form submission
        $(document).on('submit', '.ambil-pembimbing-form', function(event) {
            event.preventDefault(); // Prevent default form submission
            var form = $(this);
            var formData = form.serialize(); // Serialize form data
            $.ajax({
                url: '{{ route('store.ambilPembimbingTugasAkhir') }}',
                method: 'POST',
                data: formData,
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}' // Add CSRF token for security
                },
                success: function(response) {
                    loadData();
                },
                error: function(xhr, status, error) {
                    // Handle error here
                    console.log(error);
                    alert('Error submitting form');
                }
            });
        });
    </script>

@endsection
