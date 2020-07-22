@extends('layouts.taskmanager', ['title' => __('app.Create Status')])

@section('content')
    <h2>{{__('app.Create Status')}}</h2>
    <form action="{{ route('issue-statuses.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <label class="form-label">{{__('app.Name')}}</label>
            <input type="input" name="name" class="form-control" placeholder="{{__('app.Name')}}"
                   value="{{ old('name') }}">
        </div>
        <button type="submit" class="btn btn-primary">{{__('app.Submit')}}</button>
    </form>
@endsection