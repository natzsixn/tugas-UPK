@extends('layouts.dashboard')

@section('content')
    <div class="card">
        <div class="card-header d-flex justify-content-between">
            <div class="header-title">
                <h4 class="card-title">Welcome {{Auth::user()->fullname}}</h4>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-4">
            <div class="card card-block card-stretch card-height p-4 bg-warning">
                <h4 class="my-auto">Jumlah Pesan Belum Di Konfirmasi <span>{{$confirm}}</span></h4>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="card card-block card-stretch card-height p-4 bg-success">
                <h4 class="my-auto">Jumlah Pesan sudah di Konfirmasi <span>{{$unconfirm}}</span></h4>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="card card-block  card-stretch card-height p-4 bg-primary">
                <h4 class="my-auto">pesan yang belum di baca <span>{{$unconfirm}}</span></h4>
            </div>
        </div>
    </div>
@endsection
