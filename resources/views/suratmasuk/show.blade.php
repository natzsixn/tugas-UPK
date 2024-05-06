@extends('layouts.dashboard')
@section('content')
    <div class="card">
        <div class="card-header d-flex justify-content-between">
            <div class="header-title">
                <h4 class="card-title">Detail Surat Masuk </h4><a href="{{ route('mail.index') }}" class="btn btn-primary mt-3">Kembali</a>
            </div>
        </div>
    </div>
    <div class="row ">
        <div class="col-lg-5">
            <div class="card card-block card-stretch card-height-helf">
                <div class="card-header d-flex justify-content-between">
                    <div class="header-title">
                        <h4 class="card-title">Detail Surat Masuk</h4>
                    </div>
                </div>
                <div class="card-body">
                    <p>Pembuat :{{ $mail->user['username'] }}</p>
                    <p>code surat :{{ $mail->mail_code }}</p>
                    <p>tanggal :{{ $mail->mail_date }}</p>
                    <p>jutuan :{{ $mail->mail_from }}</p>
                    <p>kepada :{{ $mail->mail_to }}</p>
                    <p>subjek :{{ $mail->mail_subject }}</p>
                    <p>deskripsi :{{ $mail->description }}</p>
                    <p>tipe surat :{{ $mail->mailType['type'] }}</p>
                </div>
            </div>
        </div>
        <div class="col-lg-7">
            <div class="card card-block card-stretch card-height">
                <div class="card-header d-flex justify-content-between">
                    <div class="header-title">
                        <h4 class="card-title">Surat</h4>
                    </div>
                </div>
                <div class="card-body">
                    <div class="d-flex flex-wrap align-items-center mt-2">
                        @if ($mail->file_upload)
                            @php
                                $extension = pathinfo($mail->file_upload, PATHINFO_EXTENSION);
                            @endphp

                            @if (in_array($extension, ['pdf']))
                                {{-- Tampilkan file PDF --}}
                                <embed src="{{ asset($mail->file_upload) }}" type="application/pdf" width="100%"
                                    height="600px">
                            @elseif (in_array($extension, ['png', 'jpg', 'jpeg']))
                                {{-- Tampilkan file gambar --}}
                                <img src="{{ asset('uploads/' . $mail->file_upload) }}" alt="File" width="100%"
                                    height="600px">
                            @else
                                {{-- Tipe file tidak didukung --}}
                                <p>File tidak dapat ditampilkan. Tipe file tidak didukung.</p>
                            @endif
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
