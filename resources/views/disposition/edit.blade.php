@extends('layouts.formdash')

@section('content')
    <div class="card">
        <div class="card-header d-flex justify-content-between">
            <div class="header-title">
                <h4 class="card-title">Add desposisi</h4>
            </div>
        </div>
        <div class="card-body">
            <form action="{{ route('disposisi.update', $disposition->id) }}" method="POST" data-toggle="validator">
                @csrf
                @method('PUT')
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>tanggal di balas *</label>
                            <input type="date" value="{{$disposition->reply_at}}" class="form-control" placeholder="masukan username" name="disposition_at">
                            @error('disposition_at')
                                <div class="text-danger help-block with-errors">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>confirm *</label>
                            <input type="date" value="{{$disposition->reply_at}}" class="form-control" placeholder="masukan username" name="reply_at">
                            @error('reply_at')
                                <div class="text-danger help-block with-errors">{{ $message }}</div>
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
