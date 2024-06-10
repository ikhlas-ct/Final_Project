@extends('layout.master')
@section('title', 'Tugas-Akhir')
@section('content')
    <h4 class="card-title fw-semibold mb-4">Cari Pembimbing</h4>
    <div class="card">
        <div class="card-body">
            <table id="example" class="cell-border" style="width:100%">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama</th>
                        <th>Judul</th>
                        <th>Pembimbing I</th>
                        <th>Pembimbing II</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>1</td>
                        <td>Udin</td>
                        <td>Lorem ipsum dolor sit amet consectetur adipisicing elit. Autem, tenetur.</td>
                        <td>
                            cari
                        </td>
                        <td>
                            cari
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
@endsection
@section('scripts')
    <script>
        new DataTable('#example');
    </script>
@endsection
