@extends('layouts.master')
@section('content')
    <section class="content">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    @if(session()->get('success'))
                        <div class="alert alert-success">
                            {{ session()->get('success') }}
                        </div><br/>
                    @endif
                        @if(session()->get('alert'))
                            <div class="alert alert-danger">
                                {{ session()->get('alert') }}
                            </div><br/>
                        @endif
                    <div class="card-header">
                        <h3 class="card-title">Danh sách thành viên</h3>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-4 form-group">
                                <a href="{{ route('members.create') }}" class="btn btn-primary mb-2">Thêm mới</a>
                            </div>
                        </div>
                        <table class="table table-bordered table-hover">
                                <thead>
                                <tr class="d-flex">
                                    <th class="col-1">STT</th>
                                    <th class="col-2">Họ và tên</th>
                                    <th class="col-2">Tài khoản</th>
                                    <th class="col-2">Avatar</th>
                                    <th class="col-2">Email</th>
                                    <th class="col-1">Quyền</th>
                                    <th class="col-2">Hành động</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($members as $member)
                                    <tr class="d-flex">
                                        <th class="col-1">{{ $member->id }}</th>
                                        <td class="col-2">{{ $member->name }}</td>
                                        <td class="col-2">{{ $member->account }}</td>
                                        <td class="col-2"><img src="{{ asset("$member->image") }}" class="w-100"></td>
                                        <td class="col-2">{{ $member->email }}</td>
                                        <td class="col-1">
                                            {{ $member->is_admin_label }}
                                        </td>
                                        <td class="col-2">
                                            <div class="d-flex flex-row justify-content-center align-items-center">
                                                <form action="{{ route('projects.storeMember', [$project, $member->id]) }}" method="POST" accept-charset="utf-" class="mr-2">
                                                    @method('PUT')
                                                    @csrf
                                                    <button type="submit" class="btn btn-warning">Thêm</button>
                                                </form>
                                                <form action="{{ route('members.destroy', $member->id) }}" method="POST" accept-charset="utf-">
                                                    @method('DELETE')
                                                    @csrf
                                                    <button type="submit" class="btn btn-danger">Xóa</button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                        </table>
                        <div class="float-right mt-2">
                            {{ $members->appends($_GET)->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

