@extends('layout.master')
@section('title', 'Daftar Tema')
@section('content')
    <div class="container">
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h4 class="card-title fw-semibold mb-4">Halaman Daftar Tema TA</h4>
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
                @foreach ($temas as $tema)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $tema->fakultas->nama }}</td>
                        <td>{{ $tema->nama }}</td>
                        <td>

                            <a href="{{ route('halamanEditTema', $tema->id) }}" class="btn btn-warning">Edit</a>
                            <form action="{{ route('DeleteTema', $tema->id) }}" method="POST" style="display:inline-block;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger"
                                    onclick="return confirm('Apakah Anda yakin?')">Hapus</button>
                            </form>
                        </td>
                    </tr>

                    <!-- Modal -->
                @endforeach
            </tbody>
        </table>
    </div>

    <!-- Script JavaScript -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>

    <script>
        $(document).ready(function() {
            // Tampilkan modal otomatis saat halaman dimuat
            $('#detailModal').modal('show');
        });
    </script>
@endsection
