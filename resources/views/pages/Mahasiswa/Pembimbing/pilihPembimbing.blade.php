@extends('layout.master')
@section('title', 'Pilih Pembimbing')
@section('content')
<div class="container mt-5">
    <h3>Pilih Pembimbing</h3>
    <div class="row">
        {{-- @foreach ($dosens as $dosen) --}}
            <div class="col-md-4">
                <div class="card mb-4 shadow-sm">
                    <img src="{{ asset('assets/images/profile/user-1.jpg')}}" class="card-img-top">
                    <div class="card-body">
                        <h5 class="card-title text-center">Yoga Adi Pratama</h5>
                        <p class="card-text">
                            <strong>Bidang Minat:</strong>
                            <ul>
                                {{-- @foreach (explode(',', $dosen->bidang_minat) as $minat) --}}
                                    {{-- <li>{{ $minat }}</li> --}}
                                    <li>Teknik Informatika</li>
                                {{-- @endforeach --}}
                            </ul>
                        </p>
                        <div class="d-flex justify-content-center">
                            <button class="btn btn-success">Pilih Menjadi Pembimbing Satu</button>
                        </div>
                    </div>
                </div>
            </div>
        {{-- @endforeach --}}
    </div>
</div>
@endsection
