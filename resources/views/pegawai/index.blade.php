@extends('layouts.dashboard')
@section('content')
    <div class="card">
        <div class="card-header d-flex justify-content-between">
            <div class="header-title d-flex justify-content-between w-100 align-items-center ">
                <h4 class="card-title">List Mail</h4>
                <a href="" type="button" class="btn btn-primary mt-2">
                    <i class="ri-add-line"></i>Create
                </a>
            </div>
        </div>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table id="datatable" class="table data-tables table-striped">
                <thead>
                    <tr class="ligth">
                        <th>No</th>
                        <th>username</th>
                        <th>jabatan</th>
                        <th>option</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($users as $user)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $user->username }}</td>
                            <td>{{ $user->level }}</td>
                            <td>
                                <div class="d-flex align-items-center list-action">
                                    <a class="badge bg-success mr-2 d-flex align-items-center justify-content-center"
                                        data-toggle="tooltip" data-placement="top" title="" data-original-title="Edit"
                                        href="{{ route('karyawan.edit', $user) }}"><i class="ri-pencil-line mr-0"></i></a>
                                    <form action="{{ route('karyawan.destroy', $user->id) }}" method="POST"
                                        class="d-flex align-items-center">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                            class="border-none outline-none badge bg-warning mr-2 d-flex align-items-center justify-content-center"
                                            data-toggle="tooltip" data-placement="top" title=""
                                            data-original-title="Delete"
                                            onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')"><i
                                             class="ri-delete-bin-line mr-0"></i></button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
                <tfoot>
                    <tr>
                        <th>No</th>
                        <th>username</th>
                        <th>jabatan</th>
                        <th>option</th>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>
    </div>
@endsection
