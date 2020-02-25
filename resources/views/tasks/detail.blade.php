@extends('layouts.master')
@section('content')
    <section class="content">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <ul class="nav nav-tabs">
                            <li class="nav-item">
                                <a class="nav-link active" href="#profile" role="tab" data-toggle="tab">Task</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#buzz" role="tab" data-toggle="tab">Thông tin task</a>
                            </li>
                        </ul>
                    </div>
                    <div class="card-body">
                        <h3>Dự án: {{ $task->project->name }}</h3>
                        <span><b>Leader:</b> {{ $task->project->leader->name }}</span><br>
                        <span><b>Task:</b> {{ $task->name }}</span><br>
                        <span><b>Ngày bắt đầu task:</b> {{ $task->began_at }}</span><br>
                        <span><b>Ngày kết thúc task:</b> {{ $task->finished_at }}</span>
                    </div>
                    <div class="card-body">
                        <div class="tab-content">
                            <div class="tab-pane active" id="profile">
                                <div class="row mb-4">
                                    <div class="col-4">
                                        <button type="button" class="btn btn-success mr-2" data-toggle="modal" data-target="#assign">
                                            Assign
                                        </button>
                                        <div class="modal fade" id="assign" tabindex="-1" role="dialog" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title">Cập nhật trạng thái</h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <form action="{{ route('tasks.assign', $task->id) }}" method="POST">
                                                            @method('PATCH')
                                                            @csrf
                                                            <div class="form-group">
                                                                <label>Nhân viên assign</label>
                                                                <select name="member_id" class="form-control">
                                                                    @foreach($members as $member)
                                                                        <option value="{{ $member->id }}" {{ ($member->id == old('member_id', $task->member->id)) ? 'selected': '' }}> {{ $member->name }}</option>
                                                                    @endforeach
                                                                </select>
                                                                @error('member_id')
                                                                <strong class="alert text-danger">{{ $message }}</strong>
                                                                @enderror
                                                            </div>
                                                            <a href="{{ route('tasks.index') }}" class="btn btn-secondary">Cancel</a>
                                                            <button type="submit" class="btn btn-primary">Save</button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="buzz">
                                <span><b>Nhân viên thực hiện: </b>{{ $task->member->name }}</span><br>
                                <p><b>Chi tiết:</b><br>{{ $task->description }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
