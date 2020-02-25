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
                        <h3 class="card-title">Danh sách task trong dự án</h3>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            @if(Auth::user()->is_admin == 1)
                            <div class="col-4 form-group">
                                <a href="{{ route('tasks.create') }}" class="btn btn-primary mb-2">Thêm mới</a>
                            </div>
                            @endif
                            <div class="col-8 form-group">
                                <form action="{{ route('tasks.index') }}" method="GET">
                                    <div class="input-group">
                                        <input type="search" name="searchByProject" placeholder="Dự án" class="form-control mr-2" value="{{ old('searchByProject') }}" autocomplete="off">
                                        <input type="search" name="searchByMember" placeholder="Nhân viên" class="form-control mr-2" value="{{ old('searchByMember') }}" autocomplete="off">
                                        <button type="submit" class="btn btn-primary">Tìm kiếm</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                        @if(isset($tasks))
                            <table class="table table-bordered table-hover">
                                <thead>
                                <tr>
                                    <th>STT</th>
                                    <th>Tên task</th>
                                    <th>Dự án</th>
                                    <th>Thời gian bắt đầu</th>
                                    <th>Thời gian kết thúc</th>
                                    <th>Trạng thái</th>
                                    <th>Nhân viên thực hiện</th>
                                    <th>Hành động</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($tasks as $task)
                                    @if($task->member->id == Auth::id() || Auth::user()->is_admin == 1 || $task->project->leader_id == Auth::id())
                                    <tr>
                                        <th>{{ $task->id }}</th>
                                        <td><a href="{{ route('tasks.show', $task->id) }}">{{ $task->name }}</a></td>
                                           <td> @if(Auth::user()->is_admin == 1 || ($task->project->leader_id == Auth::id()))
                                                <a href="{{ route('tasks.add', $task->project_id) }}" class="text-decoration-none">{{ $task->project->name }}</a>
                                                @else
                                            {{ $task->project->name }}
                                                @endif
                                           </td>
                                        <td>{{ $task->began_at }}</td>
                                        <td>{{ $task->finished_at}}</td>
                                        <td>{{ $task->taskStatuses->name }}</td>
                                        <td>{{ $task->member->name }}</td>
                                        <td>
                                            <div class="d-flex flex-row justify-content-center align-items-center">
                                                @if(Auth::user()->is_admin == 1 || ($task->project->leader_id == Auth::id()))
                                                    <a href="{{ route('tasks.edit', $task->id) }}" class="btn btn-success mr-2">Sửa</a>
                                                    <form action="{{ route('tasks.destroy', $task->id) }}" method="POST" accept-charset="utf-">
                                                        @method('DELETE')
                                                        @csrf
                                                        <button type="submit" class="btn btn-danger">Xóa</button>
                                                    </form>
                                                @else
                                                    <button class="btn btn-success mr-2" disabled>Sửa</button>
                                                    <button type="submit" class="btn btn-danger" disabled>Xóa</button>
                                                    @endif

                                            </div>
                                        </td>
                                    </tr>
                                    @endif
                                @endforeach
                                </tbody>
                            </table>
                            <div class="float-right mt-2">
                                {{ $tasks->appends($_GET)->links() }}
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
