@extends('layouts.taskmanager', ['title' => __('app.Create Issue')])

@section('content')
    <h2>{{__('app.Create Issue')}}</h2>
    <form action="{{ route('issues.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <label class="form-label">{{__('app.Name')}}</label>
            <input type="input" name="name" class="form-control" placeholder="{{__('app.Name')}}"
                   value="{{ old('name') }}">
        </div>
        <div class="form-group">
            <label>{{__('app.Project')}}</label>
            <select name="project_id" class="form-control">
                @each('taskmanager.partials._project_select_option', $projects, 'project')
            </select>
        </div>
        <div class="form-group">
            <label class="form-label">{{__('app.Estimate')}}</label>
            <input type="input" name="estimate" class="form-control" placeholder="{{__('app.Estimate')}}"
                   value="{{ old('estimate', 0.00) }}">
        </div>
        <div class="form-group">
            <label class="form-label">{{__('app.Description')}}</label>
            <textarea id="editor1" name="description" class="form-control" placeholder="{{__('app.Description')}}"
                      rows="4">{{ old('description') }}</textarea>
        </div>
        <div class="form-group">
            <label class="form-label">{{__('app.Comment')}}</label>
            <textarea id="editor2" name="comment" class="form-control" placeholder="{{__('app.Comment')}}"
                      rows="4">{{ old('comment') }}</textarea>
        </div>
        <input type="hidden" name="status_id" value="1">
        <button type="submit" class="btn btn-primary">{{__('app.Submit')}}</button>
    </form>
    <script>
        CKEDITOR.replace('editor1', {
            filebrowserUploadUrl: "{{route('ckeditor.upload', ['_token' => csrf_token() ])}}",
            filebrowserUploadMethod: 'form'
        });
        CKEDITOR.replace('editor2', {
            filebrowserUploadUrl: "{{route('ckeditor.upload', ['_token' => csrf_token() ])}}",
            filebrowserUploadMethod: 'form'
        });
    </script>
@endsection