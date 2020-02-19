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
                        <h3 class="card-title">Trạng thái</h3>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <button type="button" class="btn btn-primary mb-2" data-toggle="modal" data-target="#addStatus">
                                Thêm trạng thái
                            </button>
                            <div class="modal fade" id="addStatus" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title">Thêm trạng thái</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <form action="{{ route('taskStatus.store') }}" method="POST">
                                                @csrf
                                                <div class="form-group">
                                                    <label>Tên trạng thái</label>
                                                    <input type="text" class="form-control" name="name" autocomplete="off" placeholder="Enter name" value="{{ old('name') }}" required>
                                                    @error('name')
                                                    <strong class="alert text-danger">{{ $message }}</strong>
                                                    @enderror
                                                </div>
                                                <a href="{{ route('taskStatus.index') }}" class="btn btn-secondary">Cancel</a>
                                                <button type="submit" class="btn btn-primary">Save</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <table class="table table-bordered table-hover">
                            <thead>
                            <tr>
                                <th>STT</th>
                                <th>Trạng thái</th>
                                <th>Hành động</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($taskStatuses as $taskStatus)
                                <tr>
                                    <th>{{ $taskStatus->id }}</th>
                                    <td>{{ $taskStatus->name }}</td>
                                    <td>
                                        <div class="d-flex flex-row justify-content-center align-items-center">
                                            <div>
                                                <button type="button" class="btn btn-success mr-2" data-toggle="modal" data-target="#editStatus">
                                                    Sửa
                                                </button>
                                                <div class="modal fade" id="editStatus" tabindex="-1" role="dialog" aria-hidden="true">
                                                    <div class="modal-dialog" role="document">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title">Cập nhật trạng thái</h5>
                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <form action="{{ route('taskStatus.update', $taskStatus->id) }}" method="POST">
                                                                    @method('PUT')
                                                                    @csrf
                                                                    <div class="form-group">
                                                                        <label>Tên trạng thái</label>
                                                                        <input type="text" class="form-control" name="name" autocomplete="off" placeholder="Enter name" value="{{ old('name', $taskStatus->name) }}" required>
                                                                        @error('name')
                                                                        <strong class="alert text-danger">{{ $message }}</strong>
                                                                        @enderror
                                                                    </div>
                                                                    <a href="{{ route('taskStatus.index') }}" class="btn btn-secondary">Cancel</a>
                                                                    <button type="submit" class="btn btn-primary">Save</button>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div>
                                                <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#deleteStatus">
                                                    Xóa
                                                </button>
                                                <div class="modal fade" id="deleteStatus" tabindex="-1" role="dialog" aria-hidden="true">
                                                    <div class="modal-dialog" role="document">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title">Xóa trạng thái</h5>
                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <form action="{{ route('taskStatus.destroy', $taskStatus->id) }}" method="POST">
                                                                    @method('DELETE')
                                                                    @csrf
                                                                    <p>Có xóa trạng thái này?</p>
                                                                    <a href="{{ route('taskStatus.index') }}" class="btn btn-secondary">Cancel</a>
                                                                    <button type="submit" class="btn btn-primary">Save</button>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
