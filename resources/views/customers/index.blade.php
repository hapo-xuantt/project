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
                    <div class="card-header">
                        <h3 class="card-title">Danh sách khách hàng</h3>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-4 form-group">
                                <a href="{{ route('customers.create') }}" class="btn btn-primary mb-2">Thêm mới</a>
                            </div>
                            <div class="col-8 form-group">
                                <form action="{{ route('customers.index') }}" method="GET">
                                    <div class="input-group">
                                        <input type="search" name="searchName" placeholder="Tên" class="form-control mr-2" value="{{ old('searchName') }}" autocomplete="off">
                                        <input type="search" name="searchPhone" placeholder="Phone" class="form-control mr-2" value="{{ old('searchPhone') }}" autocomplete="off">
                                        <button type="submit" class="btn btn-primary">Tìm kiếm</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <table class="table table-bordered table-hover">
                            @if(isset($customers))
                                <thead>
                                <tr class="d-flex">
                                    <th class="col-1">STT</th>
                                    <th class="col-2">Khách hàng</th>
                                    <th class="col-2">Người quản lý</th>
                                    <th class="col-1">Avatar</th>
                                    <th class="col-1">Email</th>
                                    <th class="col-1">Số điện thoại</th>
                                    <th class="col-2">Địa chỉ</th>
                                    <th class="col-2">Hành động</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($customers as $customer)
                                    <tr class="d-flex">
                                        <th class="col-1">{{ $customer->id }}</th>
                                        <td class="col-2">{{ $customer->name }}</td>
                                        <td class="col-2">{{ $customer->manager }}</td>
                                        <td class="col-1"><img src="{{ $customer->image }}" class="w-100"></td>
                                        <td class="col-1">{{ $customer->email }}</td>
                                        <td class="col-1">{{ $customer->phone }}</td>
                                        <td class="col-2">{{ $customer->address }}</td>
                                        <td class="col-2">
                                            <div class="d-flex flex-row justify-content-center align-items-center">
                                                <a href="{{ route('customers.edit', $customer->id) }}" class="btn btn-success mr-2">Sửa</a>
                                                <form action="{{ route('customers.destroy', $customer->id) }}" method="POST" accept-charset="utf-">
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
                            {{ $customers->appends($_GET)->links() }}
                            @else
                                {{ $message }}
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
