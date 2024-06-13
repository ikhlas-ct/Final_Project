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
                <form action="{{ route('store.pilihPembimbingTugasAkhir') }}" method="POST">
                    <!-- Ganti route dengan yang sesuai -->
                    @csrf <!-- Tambahkan ini untuk keamanan Laravel -->
                    <table id="example" class="cell-border" style="width:100%">
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
                                        <input class="form-check-input" type="checkbox" name="selected_pembimbing[]"
                                            value="{{ $value->dosen->id }}" id="pembimbing{{ $key }}">
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <div class="mt-2 d-flex justify-content-end gap-1">
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
                "lengthChange": false
            });
        });
    </script>
@endsection
