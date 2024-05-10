@extends('layouts.formdash')
@section('content')
<div class="card">
    <div class="card-header d-flex justify-content-between">
        <div class="header-title d-flex justify-content-between w-100 align-items-center ">
            <h4 class="card-title">List disposisi</h4>
             <a href="{{route('disposisi.create')}}" class="btn btn-primary mt-2">
                <i class="ri-add-line"></i> Create
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
                        <th>tanggal dibalas</th>
                        <th>deskripsi</th>
                        <th>tipe surat</th>
                        <th>status</th>
                        <th>subjek</th>
                        <th>tipe surat</th>
                        <th>option</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($dis as $disposisi)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $disposisi->user['username'] }}</td>
                            <td>{{ $disposisi->reply_at }}</td>
                            <td>{{ $disposisi->description }}</td>
                            <td>{{ $disposisi->notification}}</td>
                            <td>{{ $disposisi->mailType['type']}}</td>
                            <td>{{ $disposisi->mail_id }}</td>
                            <td>
                                @if ($disposisi->status === 'diverifikasi')
                                    <div class="badge badge-warning">Pending</div>
                                @elseif ($disposisi->status === 'menunggu verifikas')
                                    <div class="badge badge-success">Confirmed</div>
                                @endif
                            </td>
                            <td>
                                <div class="d-flex align-items-center list-action">
                                    <a class="badge bg-success mr-2 d-flex align-items-center justify-content-center" data-toggle="tooltip" data-placement="top"
                                        title="" data-original-title="Edit" href="{{ route('mail.edit', $disposisi)}}"><i
                                            class="ri-pencil-line mr-0"></i></a>
                                    <form action="{{ route('mail.destroy', $disposisi->id) }}" method="POST" class="d-flex align-items-center">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="border-none outline-none badge bg-warning mr-2 d-flex align-items-center justify-content-center" data-toggle="tooltip" data-placement="top"
                                        title="" data-original-title="Delete"
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
                        <th>pembuat</th>
                        <th>tengat waktu</th>
                        <th>notifikasi</th>
                        <th>mail</th>
                        <th>kepada</th>
                        <th>status</th>
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
