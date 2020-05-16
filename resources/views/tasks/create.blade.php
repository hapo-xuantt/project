@extends('layouts.master')
@section('content')
    <input id="oldMemberId" type="hidden" value="{{ old('member_id') }}">
    <section class="content">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Thêm dự án</h3>
            </div>
            <div class="card-body">
                <form action="{{ route('tasks.store') }}" method="POST" enctype="multipart/form-data" id="submitForm">
                    @csrf
                    <div class="row">
                        <div class="col-4">
                            <div class="form-group">
                                <label>Tên dự án</label>
                                <select name="project_id" class="form-control" id="project">
                                    <option value="">Chọn dự án</option>
                                    @foreach($projects as $project)
                                        <option value="{{ $project->id }}" {{ ($project->id == old('project_id')) ? 'selected': '' }}> {{ $project->name }}</option>
                                    @endforeach
                                </select>
                                @error('project_id')
                                <strong class="alert text-danger check-error">{{ $message }}</strong>
                                @enderror
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="form-group">
                                <label>Tên task</label>
                                <input type="text" class="form-control" id="name" name="name" value="{{ old('name') }}" autocomplete="off">
                                @error('name')
                                <strong class="alert text-danger check-error">{{ $message }}</strong>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-4">
                            <div class="form-group">
                                <label>Nhân viên thực hiện</label>
                                <select name="member_id" class="form-control" id="member">
                                </select>
                                @error('member_id')
                                <strong class="alert text-danger check-error">{{ $message }}</strong>
                                @enderror
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="form-group">
                                <label>Trạng thái</label>
                                <select name="status_id" class="form-control">
                                    @foreach($statuses as $status)
                                        <option value="{{ $status->id }}" {{ ($status->id == old('status_id')) ? 'selected': '' }}> {{ $status->name }}</option>
                                    @endforeach
                                </select>
                                @error('status_id')
                                <strong class="alert text-danger check-error">{{ $message }}</strong>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-4">
                            <div class="form-group">
                                <label>Thời gian bắt đầu</label>
                                <input class="form-control" data-date-format="yyyy-mm-dd" id="began_at" name="began_at" value="{{ old('began_at') }}" autocomplete="off">
                                @error('began_at')
                                <strong class="alert text-danger check-error">{{ $message }}</strong>
                                @enderror
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="form-group">
                                <label>Thời gian kết thúc</label>
                                <input class="form-control" data-date-format="yyyy-mm-dd"  id="finished_at" name="finished_at" value="{{ old('finished_id') }}" autocomplete="off">
                                @error('finished_at')
                                <strong class="alert text-danger check-error">{{ $message }}</strong>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-8">
                            <div class="form-group">
                                <label>Mô tả task</label>
                                <textarea type="text" class="form-control" name="description" autocomplete="off" placeholder="Enter description">
                                    {{ old('description') }}
                                </textarea>
                                @error('description')
                                <strong class="alert text-danger check-error">{{ $message }}</strong>
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
    <script type="text/javascript">
       $(document).ready(function () {
           $('#began_at').datepicker({
               format: 'yyyy-mm-dd',
           });
           $('#finished_at').datepicker({
               format: 'yyyy-mm-dd',
           });
           if($('.check-error').length != 0) {
               let project_id = $("#project").val();
               $.ajax({
                   url: 'show_member_project/' + project_id,
                   method: 'GET',
                   data: {
                       project_id: project_id,
                   },
                   success: function (data) {
                       let html = '';
                       $.each(data, function (key, value) {
                           let selected = '';
                           if (value.id == $('#oldMemberId').val()) {
                               selected = "selected";
                           }
                           html += "<option " + selected + " value="+ value.id+ ">" + value.name + "</option>";
                       });
                       $("#member").html(html);
                   },
               });
           }
       });
       $('#project').change(function(){
           var project_id = $(this).val();
           $.ajax({
               url: 'show_member_project/'+project_id,
               method: 'GET',
               data: {
                   project_id: project_id,
               },
               success: function(data) {
                   $("#member").empty();
                   $.each(data, function (key, value) {
                       $("#member").append(
                           "<option value=" + value.id + ">" + value.name + "</option>"
                       );
                   });
               },
           });
       });
    </script>
@endsection
