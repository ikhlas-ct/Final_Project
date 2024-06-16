@extends('layout.master')
@section('title', 'Tugas Akhir')
@section('content')
    <div class="container">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h4 class="card-title fw-semibold">Halaman Bimbingan</h4>
        </div>
        <div class="row g-3">
            <div class="col-6">
                @foreach ($pengajuan as $item)
                    <div class="card mb-3">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-4">
                                    <img class="img-fluid img-thumbnail rounded-2" src="{{ asset('user-1.jpg') }}"
                                        alt="">
                                </div>
                                <div class="col-8 d-flex align-items-center">
                                    @if (empty($item->judulFinal->pembimbing1->dosen->bimbingan))
                                        <div>
                                            <div class="h5 fw-bolder">
                                                {{ $item->judulFinal->pembimbing2->dosen->nama }}
                                            </div>
                                            <div class="h6 fw-bolder text-muted">Pembimbing Kedua</div>
                                            <hr>
                                            <p class="d-inline fs-7">Bimbingan yang akan datang <br> silahkan <button
                                                    id="btn-bimbingan-1" class="btn btn-link m-0 p-0" data-bs-toggle="modal"
                                                    data-bs-target="#exampleModal" data-type="1"
                                                    data-nama="{{ $item->judulFinal->pembimbing1->dosen->nama }}"
                                                    data-id="{{ $item->judulFinal->pembimbing1->dosen->id }}">Ajukan</button>
                                            </p>
                                            <div
                                                class="d-flex
                                                    gap-1 mt-1">
                                                <div class="fs-7 text-muted">Reschedule:</div>
                                                <div>-</div>
                                            </div>
                                        </div>
                                    @else
                                        @foreach ($item->judulFinal->pembimbing1->dosen->bimbingan as $bimbingan)
                                            @if ($bimbingan->status == 'diproses' || $bimbingan->status == 'diterima')
                                                <div>
                                                    <div class="h5 fw-bolder">
                                                        {{ $item->judulFinal->pembimbing1->dosen->nama }}
                                                    </div>
                                                    <div class="h6 fw-bolder text-muted font-italic">Pembimbing Kedua</div>
                                                    <hr>
                                                    <p class="d-inline fs-7">Bimbingan yang akan datang <br>
                                                        {!! '<b>' . $bimbingan->tanggal . '</b>' !!} <span
                                                            class="badge  {{ $bimbingan->status === 'diproses' ? 'bg-warning text-dark' : 'bg-success text-white' }}"><span
                                                                class="text-capitalize">{{ $bimbingan->status }}</span></span>
                                                    </p>
                                                    <div
                                                        class="d-flex
                                                    gap-1 mt-1">
                                                        <div class="fs-7 text-muted">Reschedule:
                                                        </div>
                                                        <div>
                                                            @if (!empty($bimbingan->reschedule->tanggal))
                                                                {!! '<b>' . $bimbingan->reschedule->tanggal . '</b>' !!}
                                                            @else
                                                                -
                                                            @endif
                                                        </div>
                                                    </div>
                                                </div>
                                            @else
                                                <div>
                                                    <div class="h5 fw-bolder">
                                                        {{ $item->judulFinal->pembimbing2->dosen->nama }}
                                                    </div>
                                                    <div class="h6 fw-bolder text-muted">Pembimbing Kedua</div>
                                                    <hr>
                                                    <p class="d-inline fs-7">Bimbingan yang akan datang <br> silahkan
                                                        <button id="btn-bimbingan-1" class="btn btn-link m-0 p-0"
                                                            data-bs-toggle="modal" data-bs-target="#exampleModal"
                                                            data-type="1"
                                                            data-nama="{{ $item->judulFinal->pembimbing1->dosen->nama }}"
                                                            data-id="{{ $item->judulFinal->pembimbing1->dosen->id }}">Ajukan</button>
                                                    </p>
                                                    <div
                                                        class="d-flex
                                                    gap-1 mt-1">
                                                        <div class="fs-7 text-muted">Reschedule:</div>
                                                        <div>-</div>
                                                    </div>
                                                </div>
                                            @endif
                                        @endforeach
                                    @endif

                                    {{-- <div>
                                        <div class="h5">
                                            {{ $item->judulFinal->pembimbing1->dosen->nama }}
                                        </div>
                                        <div class="h6">Pembimbing Utama</div>
                                        <hr>
                                        <p>Bimbingan yang akan datang <br> 20 juni 2024 <span
                                                class="badge bg-warning text-dark">Diproses</span></p>
                                        <p>Reschedule: -</p>
                                    </div> --}}
                                </div>
                            </div>
                            <hr>
                            <div class="d-flex justify-content-end gap-2">
                                <button class="btn btn-primary">Hubungi</button>
                                {{-- <button id="btn-bimbingan-1" class="btn btn-primary" data-bs-toggle="modal"
                                    data-bs-target="#exampleModal" data-type="1"
                                    data-nama="{{ $item->judulFinal->pembimbing1->dosen->nama }}"
                                    data-id="{{ $item->judulFinal->pembimbing1->dosen->id }}">Bimbingan</button> --}}
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            <div class="col-6">
                @foreach ($pengajuan as $item)
                    <div class="card mb-3">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-4">
                                    <img class="img-fluid img-thumbnail rounded-2" src="{{ asset('user-1.jpg') }}"
                                        alt="">
                                </div>
                                <div class="col-8 d-flex align-items-center">
                                    <div>
                                        <div class="h5">
                                            {{ $item->judulFinal->pembimbing2->dosen->nama }}
                                        </div>
                                        <div class="h6">Pembimbing Kedua</div>
                                        <hr>
                                        <p>Bimbingan yang akan datang <br> silahkan </p>
                                    </div>
                                </div>
                            </div>
                            <hr>
                            <div class="d-flex justify-content-end gap-2">
                                <button class="btn btn-outline-primary">Hubungi</button>
                                <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal"
                                    data-type="2" data-nama="{{ $item->judulFinal->pembimbing2->dosen->nama }}"
                                    data-id="{{ $item->judulFinal->pembimbing2->dosen->id }}">Bimbingan</button>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
        <hr>
    </div>

    <!-- Modal -->
    <form id="form-bimbingan">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Pengajuan Bimbingan</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form>
                            <div class="mb-3">
                                <label for="nama-pembimbing" class="form-label disabled-input">Nama
                                    Pembimbing</label>
                                <input readonly type="text" class="form-control" id="nama-pembimbing" readonly>
                            </div>
                            <div class="mb-3">
                                <label for="exampleFormControlInput1" class="form-label">Tanggal</label>
                                <input name="tanggal" type="date" class="form-control" id="exampleFormControlInput1">
                            </div>
                            <input name="id" type="hidden" class="form-control" id="id">
                            <input name="type" type="hidden" class="form-control" id="type">
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button id="hide-modal" type="button" class="btn btn-secondary"
                            data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary">Kirim</button>
                    </div>
                </div>
            </div>
        </div>
    </form>
@endsection

@section('scripts')
    <script>
        $(document).ready(function() {
            $('#exampleModal').on('show.bs.modal', function(event) {
                let button = $(event.relatedTarget);
                let id = button.data('id');
                let type = button.data('type');
                let nama = button.data('nama');
                let modal = $(this);
                modal.find('.modal-body input#id').val(id);
                modal.find('.modal-body input#type').val(type);
                modal.find('.modal-body input#nama-pembimbing').val(nama);

            });

            $('#form-bimbingan').on('submit', function(e) {
                e.preventDefault();
                let csrfToken = $('input[name="_token"]').val();
                $.ajax({
                    type: 'POST',
                    url: '{{ route('store.bimbingan') }}',
                    data: $('#form-bimbingan').serialize(),
                    headers: {
                        'X-CSRF-TOKEN': csrfToken
                    },
                    success: function(response) {
                        $('#hide-modal').trigger('click');

                        Swal.fire({
                            title: "Selamat!",
                            text: `
Permintaan bimbingan Anda sudah kami teruskan ke dosen yang bersangkutan. Mohon tunggu respons dari beliau atau jika Anda ingin mempercepat proses ini, Anda bisa langsung menghubunginya dengan mengklik tombol 'Hubungi' yang sudah disediakan.
`,
                            icon: "info"
                        });


                        // Swal.fire({
                        //     icon: "success",
                        //     title: "Selamat!",
                        //     text: 'Anda telah berhasil memilihkan pembimbing.',
                        //     showConfirmButton: false,
                        //     timer: 1500
                        // });

                        // $('#hide-modal').trigger('click');
                        // loadData();
                    },
                    error: function(error) {
                        console.log(error);
                    }
                });
            });

        });
    </script>
@endsection
