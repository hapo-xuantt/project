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
                    @if(Auth::user()->is_admin ==1)
                    <a href="{{ route('members.create') }}" class="btn btn-primary mb-2">Thêm mới</a>
                        @else
                    <button class="btn btn-primary mb-2" disabled>Thêm mới</button>
                        @endif
                </div>
              <div class="col-12 form-group">
                  <form action="{{ route('members.index') }}" method="GET">
                      <div class="input-group">
                          <input type="search" name="searchName" placeholder="Tên" class="form-control mr-2" value="{{ request()->input('searchName') }}">
                          <input type="search" name="searchEmail" placeholder="Email" class="form-control mr-2" value="{{ request()->input('searchEmail') }}">
                          <select name="searchPermission" class="form-control mr-2">
                              @foreach(App\Models\Member::IS_ADMIN as $key => $value)
                                  <option value="{{ $key }}" {{ $key == request()->input('searchPermission') ? 'selected' : '' }}>{{ $value }}</option>
                              @endforeach
                          </select>
                          <button type="submit" class="btn btn-primary">Tìm kiếm</button>
                      </div>
                  </form>
              </div>
              </div>
              <table class="table table-bordered table-hover">
                  @if(isset($members))
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
                    <td class="col-1">
                        {{ $member->is_admin_label }}
                    </td>
                    <td class="col-2">
                      <div class="d-flex flex-row justify-content-center align-items-center">
                          @if(Auth::user()->is_admin == 1 )
                        <a href="{{ route('members.edit', $member->id) }}" class="btn btn-success mr-2">Sửa</a>
                        <form action="{{ route('members.destroy', $member->id) }}" method="POST" accept-charset="utf-">
                          @method('DELETE')
                          @csrf
                          <button type="submit" class="btn btn-danger">Xóa</button>
                        </form>
                              @else
                             <button class="btn btn-success mr-2" disabled>Sửa</button>
                              <button class="btn btn-danger mr-2" disabled>Xóa</button>
                              @endif
                      </div>
                    </td>
                </tr>
                @endforeach
                </tbody>
              </table>
                <div class="float-right mt-2">
                    {{ $members->appends($_GET)->links() }}
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
