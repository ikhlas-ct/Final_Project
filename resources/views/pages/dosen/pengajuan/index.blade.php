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
            <h4 class="card-title fw-semibold">Daftar pengajuan Judul TA</h4>
        </div>
        <div class="card">
            <div class="card-body">
                <table id="example" class="cell-border" style="width:100%">
                    <thead>
                        <tr>
                            <th class="text-center" style="width: 3%">No</th>
                            <th class="text-center" style="width: 17%">Tema</th>
                            <th class="text-center" style="width: 40%">Judul</th>
                            <th class="text-center" style="width: 20%">Proposal</th>
                            <th class="text-center" style="width: 20%">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($mahasiswa as $key => $value)
                            @foreach ($value->pengajuan as $pengajuan)
                                <tr id="row-{{ $pengajuan->id }}">
                                    <td>{{ $key + 1 }}</td>
                                    <td class="">{{ $pengajuan->Tema->nama }}</td>
                                    <td class="text-justify">{{ $pengajuan->judul }}</td>
                                    <td class=""><a href="">Lihat</a></td>
                                    <td class="text-center">
                                        {{-- <button id="tolak-judul" type="button" class="btn btn-danger">Tolak</button> --}}
                                        <form class="terima-form" data-id="{{ $pengajuan->id }}">
                                            <button type="submit" class="btn btn-success">Terima</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        $(document).ready(function() {
            new DataTable('#example');

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
