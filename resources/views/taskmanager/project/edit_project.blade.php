@extends('layouts.taskmanager', ['title' => __('app.Edit Project')])

@section('content')
    <a href="{{ route('projects.show', $project->id) }}" class="btn btn-primary float-right mt-n1"><i
                class="align-middle mr-2 fas fa-fw fa-eye"></i> {{__('app.Show')}}</a>
    <h2>{{__('app.Edit Project')}}</h2>
    <form action="{{ route('projects.update', $project->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label class="form-label">{{__('app.Name')}}</label>
            <input type="input" name="name" class="form-control" placeholder="{{__('app.Name')}}"
                   value="{{ old('name', $project->name) }}">
        </div>
        <div class="form-group">
            <label for="inputState">{{__('app.Source')}}</label>
            <select name="source_id" class="form-control">
                @foreach ($sources as $source)
                    <option @if($source->id == $project->source_id) selected
                            @endif value="{{ $source->id }}">{{ $source->FullName }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label class="form-label">{{__('app.Description')}}</label>
            <textarea id="editor1" name="description" class="form-control" placeholder="{{__('app.Description')}}"
                      rows="4">{{ old('description', $project->description) }}</textarea>
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