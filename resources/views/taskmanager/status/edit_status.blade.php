@extends('layouts.taskmanager', ['title' => __('app.Edit Status')])

@section('content')
    <h2>{{__('app.Edit Status')}}</h2>
    <form action="{{ route('issue-statuses.update', $status->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label class="form-label">{{__('app.Name')}}</label>
            <input type="input" name="name" class="form-control" placeholder="{{__('app.Name')}}"
                   value="{{ old('name', $status->name) }}">
        </div>
        <button type="submit" class="btn btn-primary">{{__('app.Submit')}}</button>
    </form>
@endsection