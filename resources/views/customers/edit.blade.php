@extends('layouts.master')
@section('content')

    <section class="content">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Cập nhật thành viên</h3>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('customers.update', $customer->id) }}" method="POST" enctype="multipart/form-data">
                            @method('PUT')
                            @csrf
                            <div class="form-group">
                                <label>Khách hàng</label>
                                <input type="text" class="form-control" name="name" autocomplete="off" placeholder="Enter name" value="{{ $customer->name }}">
                                @error('name')
                                <strong class="alert text-danger">{{ $message }}</strong>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label>Người quản lý</label>
                                <input type="text" class="form-control" name="manager" autocomplete="off" placeholder="Enter manager" value="{{ $customer->manager }}">
                                @error('manager')
                                <strong class="alert text-danger">{{ $message }}</strong>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label>Avatar</label>
                                <input type="file" class="form-control" name="image" value="{{ $customer->image }}">
                                @error('image')
                                <strong class="alert text-danger">{{ $message }}</strong>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label>Email</label>
                                <input type="email" class="form-control" name="email" autocomplete="off" placeholder="Enter email" value="{{ $customer->email }}">
                                @error('email')
                                <strong class="alert text-danger">{{ $message }}</strong>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label>Số điện thoại</label>
                                <input type="text" class="form-control" name="phone" autocomplete="off" placeholder="Enter account" value="{{ $customer->phone }} ">
                                @error('phone')
                                <strong class="alert text-danger">{{ $message }}</strong>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label>Địa chỉ</label>
                                <input type="text" class="form-control" name="address" autocomplete="off" placeholder="Enter address" value="{{ $customer->address }} ">
                                @error('address')
                                <strong class="alert text-danger">{{ $message }}</strong>
                                @enderror
                            </div>
                            <a href="{{ route('customers.index') }}" class="btn btn-secondary">Cancel</a>
                            <button type="submit" class="btn btn-primary">Save</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
