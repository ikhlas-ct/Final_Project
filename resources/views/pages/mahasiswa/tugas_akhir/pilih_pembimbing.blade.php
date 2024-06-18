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
            <h4 class="card-title fw-semibold ">Pilih Pembimbing</h4>
        </div>
        <div class="card">
            <div class="card-body">
                <form id="form-pilih-pembimbing" action="{{ route('store.pilihPembimbingTugasAkhir') }}" method="POST">
                    <!-- Ganti route dengan yang sesuai -->
                    @csrf <!-- Tambahkan ini untuk keamanan Laravel -->
                    <table id="example" class="table-bordered" style="width:100%">
                        <thead>
                            <tr>
                                <th class="text-center" style="width: 2%">No</th>
                                <th class="text-center" style="width: 28%">Nama</th>
                                <th class="text-center" style="width: 23%">NIDN</th>
                                <th class="text-center" style="width: 23%">No HP</th>
                                <th class="text-center" style="width: 20%">Profile</th>
                                <th class="text-center" style="width: 4%">Pilih</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($listPembimbing as $key => $value)
                                <tr>
                                    <td>{{ $key + 1 }}</td>
                                    <td class="text-start">{{ $value->dosen->nama }}</td>
                                    <td class="text-start">{{ $value->dosen->nidn }}</td>
                                    <td class="text-start">{{ $value->dosen->no_hp }}</td>
                                    <td class="text-center">
                                        <img class="img-fluid rounded-2"
                                            src="{{ asset('assets/images/profile/user-1.jpg') }}" alt="">
                                    </td>
                                    <td>
                                        <input class="form-check-input pembimbing-checkbox" type="checkbox"
                                            name="selected_pembimbing[]" value="{{ $value->dosen->id }}"
                                            id="pembimbing{{ $key }}">
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <div class="mt-3 d-flex justify-content-end gap-1">
                        <input type="hidden" name="pengajuan_id" value="{{ $pengajuanId }}">
                        <button class="btn btn-outline-primary" type="reset">Reset</button>
                        <button class="btn btn-primary" type="submit">Kirim</button>
                    </div>
                </form>
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
                "lengthChange": false,
                "ordering": false,
                "searching": false
            });
            $('#form-pilih-pembimbing').on('submit', function(event) {
                // Cegah form untuk submit secara default
                event.preventDefault();

                // Ambil jumlah pembimbing yang dipilih
                var selectedCount = $('.pembimbing-checkbox:checked').length;

                // Jika kurang dari 2 pembimbing yang dipilih, tampilkan alert
                if (selectedCount < 2) {
                    Swal.fire({
                        icon: "error",
                        title: "Error...",
                        text: "Minimal harus memilih 2 pembimbing!"
                    });
                    return;
                }

                // Lanjutkan submit form jika sudah memilih minimal 2 pembimbing
                this.submit();
            });
        });
    </script>
@endsection
