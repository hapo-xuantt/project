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
                        <h3 class="card-title">Danh sách dự án</h3>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-4 form-group">
                                <a href="{{ route('projects.create') }}" class="btn btn-primary mb-2">Thêm mới</a>
                            </div>
                            <div class="col-8 form-group">
                                <form action="{{ route('projects.index') }}" method="GET">
                                    <div class="input-group">
                                        <input type="search" name="searchByName" placeholder="Tên" class="form-control" value="{{ old('searchByName') }}" autocomplete="off">
                                        <button type="submit" class="btn btn-primary">Tìm kiếm</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                        @if(isset($projects))
                            <table class="table table-bordered table-hover">
                                <thead>
                                <tr>
                                    <th>STT</th>
                                    <th>Tên dự án</th>
                                    <th>Thời gian bắt đầu</th>
                                    <th>Thời gian kết thúc</th>
                                    <th>Trạng thái</th>
                                    <th>Khách hàng</th>
                                    <th>Leader</th>
                                    <th>Hành động</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($projects as $project)
                                    <tr>
                                        <th>{{ $project->id }}</th>
                                        <td><a href="{{ route('projects.show', $project->id) }}">{{ $project->name }}</a></td>
                                        <td>{{ $project->began_at }}</td>
                                        <td>{{ $project->finished_at }}</td>
                                        <td>{{ $project->projectStatus->name }}</td>
                                        <td>{{ $project->customer->name}}</td>
                                        <td>{{ $project->leader->name }}</td>
                                        <td>
                                            <div class="d-flex flex-row justify-content-center align-items-center">
                                                <a href="{{ route('projects.edit', $project->id) }}" class="btn btn-success mr-2">Sửa</a>
                                                <form action="{{ route('projects.destroy', $project->id) }}" method="POST" accept-charset="utf-">
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
                                {{ $projects->appends($_GET)->links() }}
                            </div>
                        @else
                            {{ $message }}
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
