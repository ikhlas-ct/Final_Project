@extends('layout.master')
@section('title', 'Tugas Akhir')
@section('content')
    @php
        use Carbon\Carbon;
        Carbon::setLocale('id');
    @endphp
    <div class="container">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h4 class="card-title fw-semibold">Halaman Bimbingan</h4>
        </div>
        <div class="row g-3">
            {{-- P1 --}}
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
                                    <div class="w-100">
                                        <div class="h5 fw-bolder">
                                            {{ $item->judulFinal->pembimbing1->dosen->nama }}
                                        </div>
                                        <div class="h6 fw-bolder text-muted fst-italic">Pembimbing Kesatu</div>
                                        <hr>
                                        @if ($item->judulFinal->pembimbing1->bimbinganp1->isEmpty())
                                            <p class="d-inline fs-7">Bimbingan yang akan datang <br> silahkan <button
                                                    id="btn-bimbingan-1" class="btn btn-link m-0 p-0" data-bs-toggle="modal"
                                                    data-bs-target="#exampleModal" data-type="1"
                                                    data-id="{{ $item->judulFinal->pembimbing1->id }}"
                                                    data-nama="{{ $item->judulFinal->pembimbing1->dosen->nama }}">Ajukan</button>
                                            </p>
                                            <div
                                                class="d-flex
                                                    gap-1 mt-1">
                                                <div class="fs-7 text-muted">Reschedule:</div>
                                                <div>-</div>
                                            </div>
                                        @else
                                            @foreach ($item->judulFinal->pembimbing1->bimbinganp1 as $bimbingan)
                                                @if ($bimbingan->status === 'diproses' || $bimbingan->status === 'diterima')
                                                    <p class="d-inline fs-7">Bimbingan yang akan datang <br>
                                                        {!! '<b>' . \Carbon\Carbon::parse($bimbingan->tanggal)->translatedFormat('d F Y H:i') . '</b>' !!} <span
                                                            class="badge  {{ $bimbingan->status === 'diproses' ? 'bg-danger text-dark' : 'bg-warning text-white' }}"><span
                                                                class="text-capitalize">{{ $bimbingan->status }}</span></span>
                                                    </p>
                                                    <div
                                                        class="d-flex
                                                    gap-1 mt-1">
                                                        <div class="fs-7 text-muted">Reschedule:
                                                        </div>
                                                        <div>
                                                            @if (!empty($bimbingan->tanggal_reschedule))
                                                                {!! '<b>' . \Carbon\Carbon::parse($bimbingan->tanggal_reschedule)->translatedFormat('d F Y H:i') . '</b>' !!}
                                                            @else
                                                                -
                                                            @endif
                                                        </div>
                                                    </div>
                                                @else
                                                    <p class="d-inline fs-7">Bimbingan pada tanggal: <br>
                                                        {!! '<b>' .
                                                            \Carbon\Carbon::parse(
                                                                $bimbingan->tanggal_reschedule ? $bimbingan->tanggal_reschedule : $bimbingan->tanggal,
                                                            )->translatedFormat('d F Y H:i') .
                                                            '</b>' !!}
                                                        <span class="badge bg-success text-white' }}">
                                                            <span class="text-capitalize">{{ $bimbingan->status }}</span>
                                                        </span>
                                                    </p>
                                                    <div class="d-inline">
                                                        @if ($bimbingan->logbookB1->isEmpty())
                                                            Silahkan isi
                                                            <a href="/logbook" class="btn btn-link m-0 p-0 ">
                                                                Logbook</a>
                                                        @else
                                                            @if (empty($item->judulFinal->pembimbing1->status))
                                                                silahkan ajukan <button id="btn-bimbingan-1"
                                                                    class="btn btn-link m-0 p-0" data-bs-toggle="modal"
                                                                    data-bs-target="#exampleModal" data-type="1"
                                                                    data-id="{{ $item->judulFinal->pembimbing1->id }}"
                                                                    data-nama="{{ $item->judulFinal->pembimbing1->dosen->nama }}">Bimbingan</button>
                                                            @else
                                                                dan sudah <br> terpenuhi.
                                                            @endif
                                                        @endif
                                                    </div>
                                                @endif
                                            @endforeach
                                        @endif
                                    </div>
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
            {{-- END --}}
            {{-- P1 --}}
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
                                    <div class="w-100">
                                        <div class="h5 fw-bolder">
                                            {{ $item->judulFinal->pembimbing2->dosen->nama }}
                                        </div>
                                        <div class="h6 fw-bolder text-muted fst-italic">Pembimbing Kedua</div>
                                        <hr>
                                        @if ($item->judulFinal->pembimbing2->bimbinganp2->isEmpty())
                                            <p class="d-inline fs-7">Bimbingan yang akan datang <br> silahkan <button
                                                    id="btn-bimbingan-2" class="btn btn-link m-0 p-0" data-bs-toggle="modal"
                                                    data-bs-target="#exampleModal" data-type="2"
                                                    data-id="{{ $item->judulFinal->pembimbing2->id }}"
                                                    data-nama="{{ $item->judulFinal->pembimbing2->dosen->nama }}">Ajukan</button>
                                            </p>
                                            <div
                                                class="d-flex
                                                    gap-1 mt-1">
                                                <div class="fs-7 text-muted">Reschedule:</div>
                                                <div>-</div>
                                            </div>
                                        @else
                                            @foreach ($item->judulFinal->pembimbing2->bimbinganp2 as $bimbingan)
                                                @if ($bimbingan->status == 'diproses' || $bimbingan->status == 'diterima')
                                                    <p class="d-inline fs-7">Bimbingan yang akan datang <br>
                                                        {!! '<b>' . \Carbon\Carbon::parse($bimbingan->tanggal)->translatedFormat('d F Y H:i') . '</b>' !!} <span
                                                            class="badge  {{ $bimbingan->status === 'diproses' ? 'bg-danger text-dark' : 'bg-warning text-white' }}"><span
                                                                class="text-capitalize">{{ $bimbingan->status }}</span></span>
                                                    </p>
                                                    <div
                                                        class="d-flex
                                                    gap-1 mt-1">
                                                        <div class="fs-7 text-muted">Reschedule:
                                                        </div>
                                                        <div>
                                                            @if (!empty($bimbingan->tanggal_reschedule))
                                                                {!! '<b>' . \Carbon\Carbon::parse($bimbingan->tanggal_reschedule)->translatedFormat('d F Y H:i') . '</b>' !!}
                                                            @else
                                                                -
                                                            @endif
                                                        </div>
                                                    </div>
                                                @else
                                                    <p class="d-inline fs-7">Bimbingan pada tanggal <br>
                                                        {!! '<b>' .
                                                            \Carbon\Carbon::parse(
                                                                $bimbingan->tanggal_reschedule ? $bimbingan->tanggal_reschedule : $bimbingan->tanggal,
                                                            )->translatedFormat('d F Y H:i') .
                                                            '</b>' !!}
                                                        <span class="badge bg-success text-white">
                                                            <span class="text-capitalize">{{ $bimbingan->status }}</span>
                                                        </span>
                                                    </p>
                                                    <div class="d-inline">
                                                        @if ($bimbingan->logbookB2->isEmpty())
                                                            Silahkan isi
                                                            <a href="/logbook" class="btn btn-link m-0 p-0 ">
                                                                Logbook</a>
                                                        @else
                                                            @if (empty($item->judulFinal->pembimbing2->status))
                                                                silahkan ajukan <button id="btn-bimbingan-1"
                                                                    class="btn btn-link m-0 p-0" data-bs-toggle="modal"
                                                                    data-bs-target="#exampleModal" data-type="1"
                                                                    data-id="{{ $item->judulFinal->pembimbing1->id }}"
                                                                    data-nama="{{ $item->judulFinal->pembimbing1->dosen->nama }}">Bimbingan</button>
                                                            @else
                                                                dan sudah <br> terpenuhi.
                                                            @endif
                                                        @endif
                                                    </div>
                                                @endif
                                            @endforeach
                                        @endif
                                    </div>
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
            {{-- P2 --}}

        </div>
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
                                <label for="tanggal" class="form-label">Tanggal</label>
                                <input name="tanggal" type="datetime-local" class="form-control" id="tanggal-input">
                                <div class="invalid-feedback" id="tanggal-err"></div>
                            </div>
                            <input name="type" type="hidden" class="form-control" id="type">
                            <input name="id" type="hidden" class="form-control" id="id">
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button id="hide-modal" type="button" class="btn btn-outline-primary"
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
            let today = new Date().toISOString().split("T")[
                0];
            $('#tanggal-input').attr('min', today);
            $('#exampleModal').on('show.bs.modal', function(event) {
                let button = $(event.relatedTarget);
                let type = button.data('type');
                let id = button.data('id');
                let nama = button.data('nama');

                let modal = $(this);
                modal.find('.modal-body input#type').val(type);
                modal.find('.modal-body input#id').val(id);
                modal.find('.modal-body input#nama-pembimbing').val(nama);

            });
            $('#form-bimbingan').on('submit', function(e) {
                e.preventDefault();
                let selectedDate = new Date($('#tanggal-input').val());
                let today = new Date();
                var errInput = $('#tanggal-input');
                var errText = $('#tanggal-err');
                errInput.removeClass('is-invalid');
                errText.text('')
                if ($('#tanggal-input').val() == "") {
                    errInput.addClass('is-invalid');
                    errText.text('Isi Tanggal dan waktu');
                    return;
                } else if (selectedDate < today) {
                    errInput.addClass('is-invalid');
                    errText.text('Waktu yang Anda pilih harus setidaknya hari ini atau hari mendatang.');
                    return;
                } else {
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
                            window.location.reload();
                        },
                        error: function(error) {
                            console.log(error);
                        }
                    });
                }

            });

        });
    </script>
@endsection
