@extends('layout.master')

@section('title', 'Daftar Fakultas')

@section('content')
<div class="container">
    <h2>Daftar Fakultas</h2>
    <hr>

    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
        <div class="mb-3">
    <!-- Button trigger modal for create -->
    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#createModal">
        <i class="fa fa-plus"></i> Tambah Fakultas
    </button>
</div>
    <!-- Table to display fakultas -->
    <table id="fakultasTable" class="table table-bordered table-hover">
        <thead>
            <tr>
                <th>No</th>
                <th>ID</th>
                <th>Nama</th>
                <th class="text-center">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @php $counter = 1; @endphp
            @foreach ($fakultas as $item)
                <tr>
                    <td>{{ $counter }}</td>
                    <td>{{ $item->id }}</td>
                    <td>{{ $item->nama }}</td>
                    <td class="text-center">
                        <a href="{{ route('fakultas.edit', $item->id) }}" class="btn btn-primary btn-sm">
                            <i class="fa fa-edit"></i> Edit
                        </a>
                        <form action="{{ route('fakultas.destroy', $item->id) }}" method="POST" style="display: inline-block;">
                            @csrf
                            @method('DELETE')
                            <button type="button" class="btn btn-danger btn-sm deleteBtn" data-id="{{ $item->id }}">
                                <i class="fa fa-trash"></i> Hapus
                            </button>
                        </form>
                    </td>
                </tr>
                @php $counter++; @endphp
            @endforeach
        </tbody>
    </table>
</div>

<!-- Modal for create -->
<div class="modal fade" id="createModal" tabindex="-1" aria-labelledby="createModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="createModalLabel">Tambah Fakultas</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('fakultas.store') }}" method="POST" id="createForm">
                    @csrf
                    <div class="mb-3">
                        <label for="nama" class="form-label">Nama Fakultas</label>
                        <input type="text" class="form-control" id="nama" name="nama" required>
                    </div>
                    <button type="submit" class="btn btn-primary">
                        <i class="fa fa-save"></i> Simpan
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Modal for delete confirmation -->
<div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteModalLabel">Konfirmasi Hapus</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>Apakah Anda yakin ingin menghapus fakultas ini?</p>
            </div>
            <div class="modal-footer ">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                <button type="button" class="btn btn-danger" id="confirmDelete">
                    <i class="fa fa-trash"></i> Hapus
                </button>
            </div>
        </div>
    </div>
</div>
@endsection

@section('styles')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
<style>
    .dataTables_wrapper .dataTables_paginate .paginate_button.current,
    .dataTables_wrapper .dataTables_paginate .paginate_button:hover {
        background-color: #007bff;
        border-color: #007bff;
    }
</style>
@endsection

@section('scripts')
<script>
$(document).ready(function() {
    // Inisialisasi DataTable
    $('#fakultasTable').DataTable({
        "pagingType": "full_numbers",
        "language": {
            "search": "Cari:",
            "paginate": {
                "first": "Awal",
                "last": "Akhir",
                "next": "Berikutnya",
                "previous": "Sebelumnya"
            }
        },
        "dom": '<"top"lf>rt<"bottom"ip><"clear">'
    });

    // Show create modal
    $('#createModal').on('show.bs.modal', function() {
        $('#createForm').trigger('reset'); // Reset form on open
    });

    // Submit form for create
    $('#createForm').submit(function(e) {
        e.preventDefault();
        var formData = $(this).serialize();
        $.ajax({
            url: '{{ route('fakultas.store') }}',
            type: 'POST',
            data: formData,
            success: function() {
                $('#createModal').modal('hide');
                location.reload();
            },
            error: function(xhr) {
                var errors = xhr.responseJSON.errors;
                $.each(errors, function(key, value) {
                    alert(value);
                });
            }
        });
    });

    // Show delete confirmation modal
    $(document).on('click', '.deleteBtn', function() {
        var id = $(this).data('id');
        var form = $(this).closest('form');
        $('#deleteModal').modal('show');

        $('#confirmDelete').click(function() {
            form.submit();
        });
    });
});
</script>
@endsection
