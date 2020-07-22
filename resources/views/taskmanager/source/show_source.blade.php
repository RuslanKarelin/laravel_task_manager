@extends('layouts.taskmanager', ['title' => __('app.Show Source')])

@section('content')
    <a href="{{ route('sources.edit', $source->id) }}" class="btn btn-primary float-right mt-n1"><i class="align-middle"
                                                                                                    data-feather="edit-2"></i> {{__('app.Edit')}}
    </a>
    <h2>{{__('app.Show Source')}}</h2>
    <div class="form-group">
        <label class="form-label bold">{{__('app.First_Name')}}</label>
        <p>{{$source->first_name}}</p>
    </div>
    <div class="form-group">
        <label class="form-label bold">{{__('app.Last_Name')}}</label>
        <p>{{$source->last_name}}</p>
    </div>
    <div class="form-group">
        <label class="form-label bold">{{__('app.Email')}}</label>
        <p>{{$source->email}}</p>
    </div>
    <div class="form-group">
        <label class="form-label bold">{{__('app.Phone')}}</label>
        <p>{{$source->phone}}</p>
    </div>
    <div class="form-group">
        <label class="form-label bold">{{__('app.Price')}}</label>
        <p>{{$source->price}} {!! __('app.Currency') !!}</p>
    </div>
    <div class="form-group">
        <label class="form-label bold">{{__('app.Description')}}</label>
        {!! $source->description !!}
    </div>
@endsection