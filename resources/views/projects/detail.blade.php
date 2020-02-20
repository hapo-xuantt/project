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
                    <h3>Dự án: {{ $projects->name }}</h3>
                    <span><b>Ngày bắt đầu:</b> {{ $projects->began_at }}</span><br>
                    <span><b>Ngày kết thúc:</b> {{ $projects->finished_at }}</span><br>
                    <span><b>Leader:</b> {{ $projects->leader->name }}</span>
                </div>
                <div class="card-body">
                    <div class="tab-content">
                        <div class="tab-pane active" id="profile">
                            <div class="row mb-4">
                                <div class="col-4">
                                    <a class="btn btn-primary" href="{{ route('projects.add', $projects->id) }}">Thêm nhân viên</a>
                                </div>
                            </div>
                            @if(isset($project))
                            <h5 class="card-text mb-3 text-center"><strong>Danh sách thành viên tham gia</strong></h5>
                                <table class="table table-bordered">
                                    <thead>
                                    <tr>
                                        <th>Tên nhân viên</th>
                                        <th>Thời gian bắt đầu</th>
                                        <th>Thời gian hoàn thành</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($project as $pro)
                                        <tr>
                                            <td>{{ $pro->name }}</td>
                                            <td><input type="date" class="form-control" name="began_at"></td>
                                            <td><input type="date" class="form-control" name="finish_at"></td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            @else
                                <p class="text-center">Chưa có thành viên nào tham gia dự án</p>
                            @endif
                        </div>
                        <div class="tab-pane fade" id="buzz">
                            <p>{{ $projects->description }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
