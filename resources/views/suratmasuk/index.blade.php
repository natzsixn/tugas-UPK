@extends('layouts.dashboard')
@section('content')
    <div class="card">
        <div class="card-header d-flex justify-content-between">
            <div class="header-title d-flex justify-content-between w-100 align-items-center ">
                <h4 class="card-title">List Mail</h4>
                <a href="{{ route('mail.create') }}" type="button" class="btn btn-primary mt-2">
                    <i class="ri-add-line"></i>Create
                </a>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table id="datatable" class="table data-tables table-striped">
                    <thead>
                        <tr class="ligth">
                            <th>No</th>
                            <th>pembuat</th>
                            <th>code surat</th>
                            <th>pengirim</th>
                            <th>subjek</th>
                            <th>tipe surat</th>
                            <th>option</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($mails as $hehemail)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $hehemail->user['username'] }}</td>
                                <td>{{ $hehemail->mail_code }}</td>
                                <td>{{ $hehemail->mail_from }}</td>
                                <td>{{ $hehemail->mail_subject }}</td>
                                <td>{{ $hehemail->mailType['type'] }}</td>
                                <td>
                                    <div class="d-flex align-items-center list-action">
                                        <a class="badge badge-info mr-2" data-toggle="tooltip" data-placement="top"
                                            title="" data-original-title="View"
                                            href="{{ route('mail.show', ['mail' => $hehemail->id]) }}"><i
                                                class="ri-eye-line mr-0"></i></a>
                                        @can('admin')
                                            <a class="badge bg-success mr-2 d-flex align-items-center justify-content-center"
                                                data-toggle="tooltip" data-placement="top" title=""
                                                data-original-title="Edit" href="{{ route('mail.edit', $hehemail) }}"><i
                                                    class="ri-pencil-line mr-0"></i></a>
                                            <form action="{{ route('mail.destroy', $hehemail->id) }}" method="POST"
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
                                        @endcan
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            <th>No</th>
                            <th>pembuat</th>
                            <th>code surat</th>
                            <th>pengirim</th>
                            <th>subjek</th>
                            <th>tipe surat</th>
                            <th>option</th>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
@endsection
