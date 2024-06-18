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
