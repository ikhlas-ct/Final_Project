@extends('layout.master')
@section('title', 'Dashboard')
@section('content')
    @php
        use App\Helpers\FiturHelper;
    @endphp
    <div class="container-fluid">
        <!--  Row 1 -->

        @if (FiturHelper::showDosen())
            <div class="card overflow-hidden w-auto">
                <div class="card-body p-4">
                    <h5 class="card-title mb-9 fw-semibold">Selemat datang dan selamat bertugas!</h5>
                </div>
            </div>
        @endif
        @if (FiturHelper::showKaprodi())
            <div class="card overflow-hidden w-auto">
                <div class="card-body p-4">
                    <h5 class="card-title mb-9 fw-semibold">Selemat datang dan selamat bertugas!</h5>
                </div>
            </div>
        @endif
        @if (FiturHelper::showMahasiswa())
            <div class="card overflow-hidden w-auto">
                <div class="card-body p-4">
                    <h5 class="card-title mb-9 fw-semibold">Selamat mengerjakan TA</h5>
                </div>
            </div>
        @endif

    </div>
@endsection
