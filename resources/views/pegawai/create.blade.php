@extends('layouts.formdash')

@section('content')
<div class="card">
    <div class="card-header d-flex justify-content-between">
        <div class="header-title">
            <h4 class="card-title">buat user karyawan</h4>
        </div>
    </div>
    <div class="card-body">
        <form action="{{route('karyawan.store')}}" method="POST" enctype="multipart/form-data" data-toggle="validator" >
            @csrf
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label>username *</label>
                        <input type="text" name="username" class="form-control" placeholder="masukan username" >
                        @error('username')
                        <div class="text-danger help-block with-errors">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label>fullname*</label>
                        <input type="text" name="fullname" class="form-control" placeholder="masukan name" >
                        @error('fullname')
                        <div class="text-danger help-block with-errors">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label>level</label>
                        <select name="level" class="selectpicker form-control" data-style="py-0" >
                            @foreach ($level as $user)
                                <option value="{{$user->level}}" {{ $user->level == 'user' ? 'selected' : '' }}>{{$user->level}}</option>
                            @endforeach
                        </select>
                        @error('level')
                        <div class="text-danger help-block with-errors">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label>password *</label>
                        <input type="text" class="form-control" name="password" placeholder="masukan password">
                        @error('password')
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
