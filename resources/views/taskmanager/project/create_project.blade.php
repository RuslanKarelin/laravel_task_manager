@extends('layouts.taskmanager', ['title' => __('app.Create Project')])

@section('content')
    <h2>{{__('app.Create Project')}}</h2>
    <form action="{{ route('projects.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <label class="form-label">{{__('app.Name')}}</label>
            <input type="input" name="name" class="form-control" placeholder="{{__('app.Name')}}"
                   value="{{ old('name') }}">
        </div>
        <div class="form-group">
            <label>{{__('app.Source')}}</label>
            <select name="source_id" class="form-control">
                @each('taskmanager.partials._source_select_option', $sources, 'source')
            </select>
        </div>
        <div class="form-group">
            <label class="form-label">{{__('app.Description')}}</label>
            <textarea id="editor1" name="description" class="form-control" placeholder="{{__('app.Description')}}"
                      rows="4">{{ old('description') }}</textarea>
        </div>
        <button type="submit" class="btn btn-primary">{{__('app.Submit')}}</button>
    </form>
    <script>
        CKEDITOR.replace('editor1', {
            filebrowserUploadUrl: "{{route('ckeditor.upload', ['_token' => csrf_token() ])}}",
            filebrowserUploadMethod: 'form'
        });
    </script>
@endsection