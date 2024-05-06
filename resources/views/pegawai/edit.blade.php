@extends('layouts.formdash')

@section('content')
    <div class="card">
        <div class="card-header d-flex justify-content-between">
            <div class="header-title">
                <h4 class="card-title">edit karyawan</h4>
            </div>
        </div>
        <div class="card-body">

            <form action="{{ route('karyawan.update', $user->id ) }}" method="POST"
                data-toggle="validator">
                @csrf
                @method('PUT')
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>username *</label>
                            <input type="text" name="username"  class="form-control" placeholder="masukan nama baru disini"
                                required>
                                @error('username')
                                <div class="text-danger help-block with-errors">{{ $message }}</div>
                                @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>password *</label>
                            <input type="password" name="password" class="form-control" placeholder="masukan password baru">
                            @if ($errors->has('password'))
                            <div class="text-danger help-block with-errors">{{ $errors->first('password') }}</div>
                            @endif
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>fullname *</label>
                            <input type="text" class="form-control" name="fullname"  placeholder="masukan nama panjang baru" required>
                            @error('fullname')
                            <div class="text-danger help-block with-errors">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>level</label>
                            <select name="level" class="selectpicker form-control" data-style="py-0" required>
                                @foreach ($level as $user)
                                    <option value="{{$user->level}}" {{ $user->level == 'user' ? 'selected' : '' }}>{{$user->level}}</option>
                                @endforeach
                            </select>
                            @error('level')
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
