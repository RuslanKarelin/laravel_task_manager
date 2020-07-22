@extends('layouts.taskmanager', ['title' => __('app.Show Project')])

@section('content')
    <a href="{{ route('projects.edit', $project->id) }}" class="btn btn-primary float-right mt-n1"><i
                class="align-middle"
                data-feather="edit-2"></i> {{__('app.Edit')}}
    </a>
    <h2>{{__('app.Show Project')}}</h2>
    <div class="form-group">
        <label class="form-label bold">{{__('app.Name')}}</label>
        <p>{{$project->name}}</p>
    </div>
    <div class="form-group">
        <label class="form-label bold">{{__('app.Source')}}</label>
        <p>{{$project->source->FullName}}</p>
    </div>
    <div class="form-group">
        <label class="form-label bold">{{__('app.Description')}}</label><br>
        {!! $project->description !!}
    </div>
@endsection