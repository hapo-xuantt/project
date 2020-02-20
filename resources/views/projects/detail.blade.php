@extends('layouts.master')
@section('content')
<section class="content">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <ul class="nav nav-tabs">
                        <li class="nav-item">
                            <a class="nav-link active" href="#profile" role="tab" data-toggle="tab">Dự án</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#buzz" role="tab" data-toggle="tab">Thông tin dự án</a>
                        </li>
                    </ul>
                </div>
                <div class="card-body">
                    <h3>Dự án: {{ $project->name }}</h3>
                    <span><b>Ngày bắt đầu:</b> {{ $project->began_at }}</span><br>
                    <span><b>Ngày kết thúc:</b> {{ $project->finished_at }}</span><br>
                    <span><b>Leader:</b> {{ $project->leader->name }}</span>
                </div>
                <div class="card-body">
                    <div class="tab-content">
                        <div class="tab-pane active" id="profile">
                            <div class="row mb-4">
                                <div class="col-4">
                                    <a class="btn btn-primary" href="{{ route('projects.add', $project->id) }}">Thêm nhân viên</a>
                                </div>
                            </div>
                            @if(isset($members))
                            <h5 class="card-text mb-3 text-center"><strong>Danh sách thành viên tham gia</strong></h5>
                                <table class="table table-bordered">
                                    <thead>
                                    <tr>
                                        <th>Tên nhân viên</th>
                                        <th>Thời gian bắt đầu</th>
                                        <th>Thời gian hoàn thành</th>
                                        <th>Hành động</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($members as $member)
                                        <tr>
                                            <td>{{ $member->name }}</td>
                                            <td><input type="date" class="form-control" name="began_at"></td>
                                            <td><input type="date" class="form-control" name="finish_at"></td>
                                            <td>
                                                <div>
                                                    <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#deleteStatus">
                                                        Xóa
                                                    </button>
                                                    <div class="modal fade" id="deleteStatus" tabindex="-1" role="dialog" aria-hidden="true">
                                                        <div class="modal-dialog" role="document">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title">Xóa thành viên</h5>
                                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                        <span aria-hidden="true">&times;</span>
                                                                    </button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <form action="{{ route('projects.destroyMember', [$project->id, $member->id]) }}" method="POST">
                                                                        @method('DELETE')
                                                                        @csrf
                                                                        <p>Có xóa thành viên này?</p>
                                                                        <a href="{{ route('projects.index') }}" class="btn btn-secondary">Cancel</a>
                                                                        <button type="submit" class="btn btn-primary">Save</button>
                                                                    </form>
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
                            @else
                                <p class="text-center">Chưa có thành viên nào tham gia dự án</p>
                            @endif
                        </div>
                        <div class="tab-pane fade" id="buzz">
                            <p>{{ $project->description }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
