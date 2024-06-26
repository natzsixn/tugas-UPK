@extends('layouts.formdash')

@section('content')
    <div class="card">
        <div class="card-header d-flex justify-content-between">
            <div class="header-title">
                <h4 class="card-title">Add desposisi</h4>
            </div>
        </div>
        <div class="card-body">
            <form action="{{ route('disposisi.store') }}" method="POST" data-toggle="validator">
                @csrf
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>tanggal di balas *</label>
                            <input type="date" name="reply_at" class="form-control" placeholder="masukan username">
                            @error('reply_at')
                                <div class="text-danger help-block with-errors">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label>perihal*</label>
                        <select name="mail_id" class="selectpicker form-control" data-style="py-0">
                            @foreach ($mails as $surat)
                                <option value="{{ $surat->id }}">{{ $surat->mail_subject }}</option>
                            @endforeach
                        </select>
                        @error('mail_id')
                            <div class="text-danger help-block with-errors">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-12">
                        <label>deskripsi singkat*</label>
                        <input type="text" name="notification" class="form-control"
                            placeholder="masukan deskripsi singkat">
                        @error('notification')
                            <div class="text-danger help-block with-errors">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label>deskripsi*</label>
                            <textarea class="form-control" name="description" rows="4" placeholder="masukan deskripsi lengkap"></textarea>
                            @error('description')
                                <div class="help-block with-errors">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                </div>
                <button type="submit" class="btn btn-primary mr-2">Add Supplier</button>
                <button type="reset" class="btn btn-danger">Reset</button>
            </form>
        </div>
    </div>
@endsection
