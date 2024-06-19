@extends('layout.master')
@section('title', 'Daftar Tema')
@section('content')
    <div class="container">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h4 class="card-title fw-semibold mb-4">Halaman Daftar Tema TA</h4>
            <a href="{{ route('halamanTambahTema') }}" class="btn btn-primary">Tambah Tema</a>
        </div>
        <table id="example" class="table-bordered">
            <thead>
                <tr>
                    <th class="text-start">No</th>
                    <th class="text-start">Fakultas</th>
                    <th class="text-start">Nama</th>
                    <th class="text-center">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($temas as $tema)
                    <tr>
                        <td class="text-start">{{ $loop->iteration }}</td>
                        <td class="text-start">{{ $tema->fakultas->nama }}</td>
                        <td class="text-start">{{ $tema->nama }}</td>
                        <td class="text-center">
                            <a href="{{ route('halamanEditTema', $tema->id) }}" class="btn btn-warning btn-sm">Edit</a>
                            <button type="button" class="btn btn-danger btn-sm delete-btn"
                                data-id="{{ $tema->id }}">Hapus</button>
                            <form id="delete-form-{{ $tema->id }}" action="{{ route('DeleteTema', $tema->id) }}"
                                method="POST" style="display: none;">
                                @csrf
                                @method('DELETE')
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection

@section('scripts')
    <script>
        $(document).ready(function() {
            $('#example').DataTable();
            $('.delete-btn').on('click', function() {
                let id = $(this).data('id');
                Swal.fire({
                    title: 'Apakah Anda yakin?',
                    text: "Anda tidak akan dapat mengembalikan ini!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Ya, hapus!',
                    cancelButtonText: 'Batal'
                }).then((result) => {
                    if (result.isConfirmed) {
                        $('#delete-form-' + id).submit();
                    }
                });
            });
        });
    </script>
@endsection
