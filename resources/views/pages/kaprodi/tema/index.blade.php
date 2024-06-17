@extends('layout.master')
@section('title', 'Daftar Tema')
@section('content')
    <div class="container">
        <h1>Daftar Tema</h1>

        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <div class="d-flex justify-content-end mb-3">
            <a href="{{ route('halamanTambahTema') }}" class="btn btn-primary">Tambah Tema</a>
        </div>

        <table class="table">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Fakultas</th>
                    <th>Nama</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($temas as $tema)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $tema->fakultas->nama }}</td>
                        <td>{{ $tema->nama }}</td>
                        <td>
                            <button type="button" class="btn btn-info" data-toggle="modal" data-target="#detailModal{{ $tema->id }}">
                                Detail
                            </button>
                            <a href="{{ route('halamanEditTema', $tema->id) }}" class="btn btn-warning">Edit</a>
                            <form action="{{ route('DeleteTema', $tema->id) }}" method="POST" style="display:inline-block;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger" onclick="return confirm('Apakah Anda yakin?')">Hapus</button>
                            </form>
                        </td>
                    </tr>

                    <!-- Modal -->
                    <div class="modal fade" id="detailModal{{ $tema->id }}" tabindex="-1" role="dialog" aria-labelledby="detailModalLabel{{ $tema->id }}" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="detailModalLabel{{ $tema->id }}">Detail Tema</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <p><strong>Fakultas:</strong> {{ $tema->fakultas->nama }}</p>
                                    <p><strong>Nama Tema:</strong> {{ $tema->nama }}</p>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </tbody>
        </table>
    </div>

    <!-- Script JavaScript -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>

    <script>
        $(document).ready(function () {
            // Tampilkan modal otomatis saat halaman dimuat
            $('#detailModal').modal('show');
        });
    </script>
@endsection