@extends('layouts.formdash')

@section('content')
<div class="card">
    <div class="card-header d-flex justify-content-between">
        <div class="header-title d-flex align-items-center w-100 justify-content-between">
            <h4 class="card-title">tambah surat</h4>
            <a href="{{route('mail.index')}}" class="btn btn-primary mt-2">
                kembali
            </a>
        </div>
    </div>
    <div class="card-body">
        <form action="{{route('mail.store')}}" method="POST" enctype="multipart/form-data" data-toggle="validator">
            @csrf
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label>code surat *</label>
                        <input type="text" name="mail_code" class="form-control" placeholder="masukan code surat" required>
                        @error('mail_code')
                        <div class="help-block with-errors">{{$message}}</div>
                        @enderror
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label>tanggal surat*</label>
                        <input type="date" name="mail_date" class="form-control" placeholder="masukan tanggal" required>
                        @error('mail_date')
                        <div class="help-block with-errors">{{$message}}</div>
                        @enderror
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label>tujuan tujuan*</label>
                        <input type="text" class="form-control" name="mail_to" placeholder="masukan tujuan" required>
                        @error('mail_to')
                        <div class="help-block with-errors">{{$message}}</div>
                        @enderror
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label>pengirim surat (berupa instansi atau Perusahaan) *</label>
                        <input type="text" class="form-control" name="mail_from" placeholder="nama pengirim" required>
                        @error('mail_from')
                        <div class="help-block with-errors">{{$message}}</div>
                        @enderror
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label>tipe surat</label>
                        <select name="mail_type_id" class="selectpicker form-control" data-style="py-0">
                            @foreach ($mailtypes as $tipe)
                                <option value="{{$tipe->id}}">{{$tipe->type}}</option>
                            @endforeach
                        </select>
                        @error('mail_type_id')
                        <div class="help-block with-errors">{{$message}}</div>
                        @enderror
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <label>file upload </label>
                        <input type="file" class="form-control image-file" name="file_upload" accept="image/*">
                        @error('file_upload')
                        <div class="help-block with-errors">{{$message}}</div>
                        @enderror
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        <label>subjek surat *</label>
                        <input type="text" name="mail_subject" class="form-control" placeholder="masukan tujuan" required>
                        @error('mail_subject')
                        <div class="help-block with-errors">{{$message}}</div>
                        @enderror
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        <label>deskripsi</label>
                        <textarea class="form-control" name="description" rows="4"></textarea>
                        @error('description')
                        <div class="help-block with-errors">{{$message}}</div>
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
