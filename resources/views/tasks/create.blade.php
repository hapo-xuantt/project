@extends('layouts.master')
@section('content')

    <section class="content">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Thêm dự án</h3>
            </div>
            <div class="card-body">
                <form action="{{ route('tasks.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-4">
                            <div class="form-group">
                                <label>Tên dự án</label>
                                <select name="project_id" class="form-control">
                                    @foreach($projects as $project)
                                        <option value="{{ $project->id }}"> {{ $project->name }}</option>
                                    @endforeach
                                </select>
                                @error('project_id')
                                <strong class="alert text-danger">{{ $message }}</strong>
                                @enderror
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="form-group">
                                <label>Tên task</label>
                                <input type="text" class="form-control" name="name" value="{{ old('name') }}" autocomplete="off">
                                @error('name')
                                <strong class="alert text-danger">{{ $message }}</strong>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-4">
                            <div class="form-group">
                                <label>Nhân viên thực hiện</label>
                                <select name="member_id" class="form-control">
                                    @foreach($members as $member)
                                        <option value="{{ $member->id }}"> {{ $member->name }}</option>
                                    @endforeach
                                </select>
                                @error('member_id')
                                <strong class="alert text-danger">{{ $message }}</strong>
                                @enderror
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="form-group">
                                <label>Trạng thái</label>
                                <select name="status_id" class="form-control">
                                    @foreach($statuses as $status)
                                        <option value="{{ $status->id }}"> {{ $status->name }}</option>
                                    @endforeach
                                </select>
                                @error('status_id')
                                <strong class="alert text-danger">{{ $message }}</strong>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-4">
                            <div class="form-group">
                                <label>Thời gian bắt đầu</label>
                                <input type="date" class="form-control" name="began_at" value="{{ old('began_at') }}" autocomplete="off">
                                @error('began_at')
                                <strong class="alert text-danger">{{ $message }}</strong>
                                @enderror
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="form-group">
                                <label>Thời gian kết thúc</label>
                                <input type="date" class="form-control" name="finished_at" value="{{ old('finished_id') }}" autocomplete="off">
                                @error('finished_at')
                                <strong class="alert text-danger">{{ $message }}</strong>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-8">
                            <div class="form-group">
                                <label>Mô tả task</label>
                                <textarea type="text" class="form-control" name="description" autocomplete="off" placeholder="Enter description" value="{{ old('description') }}">
                                </textarea>
                                @error('description')
                                <strong class="alert text-danger">{{ $message }}</strong>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <a href="{{ route('tasks.index') }}" class="btn btn-secondary">Cancel</a>
                    <button type="submit" class="btn btn-primary">Save</button>
                </form>
            </div>
        </div>
    </section>
@endsection
