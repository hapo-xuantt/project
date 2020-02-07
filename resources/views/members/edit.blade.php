@extends('layouts.master')
@section('content')

    <section class="content">
      <div class="row">
        <div class="col-12">
          <div class="card">
            @if ($errors->any())
              <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                      <li>{{ $error }}</li>
                    @endforeach
                </ul>
              </div><br/>
            @endif
            <div class="card-header">
              <h3 class="card-title">Cập nhật thành viên</h3>
            </div>
            <div class="card-body">
                <form action="{{ route('members.update', $member->id) }}" method="POST" enctype="multipart/form-data">
                   @method('PUT')
                   @csrf
                    <div class="form-group">
                        <label>Họ và tên</label>
                        <input type="text" class="form-control" name="name" autocomplete="off" placeholder="Enter name" value="{{ $member->name }}">
                    </div>
                    <div class="form-group">
                        <label>Password</label>
                        <input type="password" class="form-control" name="password" autocomplete="current-password" placeholder="Enter password" value="{{ $member->password }}">
                    </div>
                    <div class="form-group">
                        <label>Tài khoản</label>
                        <input type="text" class="form-control" name="account" autocomplete="off" placeholder="Enter account" value="{{ $member->account }} ">
                    </div>
                    <div class="form-group">
                        <label>Avatar</label>
                        <input type="file" class="form-control" name="image" value="{{ $member->image }}">
                    </div>
                    <div class="form-group">
                        <label>Email</label>
                        <input type="email" class="form-control" name="email" autocomplete="off" placeholder="Enter email" value="{{ $member->email }}">
                    </div>
                    <div class="form-group">
                        <label>Quyền</label>
                        <select name="is_admin">
                            <option value="0">User</option>
                            <option value="1">Admin</option>
                        </select>
                    </div>
                    <a href="{{ route('members.index') }}" class="btn btn-secondary">Cancel</a>
                    <button type="submit" class="btn btn-primary">Save</button>
                </form>
            </div>
          </div>
          <!-- /.card -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->
@endsection

