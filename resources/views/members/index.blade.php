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
              <h3 class="card-title">Danh sách thành viên</h3>
            </div>
            <div class="card-body">
              <div class="row">
                <div class="col-4 form-group">
                    <a href="{{ route('members.create') }}" class="btn btn-primary mb-2">Thêm mới</a>
                </div>
              <div class="col-4 offset-4 form-group">
                <div class="input-group">
                  <input type="text" name="search" placeholder="Tìm kiếm" class="form-control">
                  <button type="submit" class="btn btn-primary">Tìm kiếm</button>
                </div>

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
                    <td class="col-2"><img src="{{ $member->image }}" class="w-100"></td>
                    <td class="col-2">{{ $member->email }}</td>
                    <td class="col-1">{{ $member->is_admin }}</td>
                    <td class="col-2">
                      <div class="d-flex flex-row justify-content-center align-items-center">
                        <a href="{{ route('members.edit', $member->id) }}" class="btn btn-success mr-2">Sửa</a>
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
                {{ $members->links() }}
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
@endsection
