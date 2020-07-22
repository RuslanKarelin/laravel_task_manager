@extends('layouts.taskmanager', ['title' => __('app.Create Source')])

@section('content')
    <h2>{{__('app.Create Source')}}</h2>
    <form action="{{ route('sources.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <label class="form-label">{{__('app.First_Name')}}</label>
            <input type="input" name="first_name" class="form-control" placeholder="{{__('app.First_Name')}}"
                   value="{{ old('first_name') }}">
        </div>
        <div class="form-group">
            <label class="form-label">{{__('app.Last_Name')}}</label>
            <input type="input" name="last_name" class="form-control" placeholder="{{__('app.Last_Name')}}"
                   value="{{ old('last_name') }}">
        </div>
        <div class="form-group">
            <label class="form-label">{{__('app.Email')}}</label>
            <input type="input" name="email" class="form-control" placeholder="{{__('app.Email')}}"
                   value="{{ old('email') }}">
        </div>
        <div class="form-group">
            <label class="form-label">{{__('app.Phone')}}</label>
            <input type="input" name="phone" class="form-control" placeholder="{{__('app.Phone')}}"
                   value="{{ old('phone') }}">
        </div>
        <div class="form-group">
            <label class="form-label">{{__('app.Price')}}</label>
            <input type="input" name="price" class="form-control" placeholder="{{__('app.Price')}}"
                   value="{{ old('price') }}">
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