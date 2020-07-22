@extends('layouts.taskmanager', ['title' => __('app.Show Issue')])

@section('content')
    <a href="{{ route('issues.edit', $issue->id) }}" class="btn btn-primary float-right mt-n1"><i class="align-middle"
                                                                                                  data-feather="edit-2"></i> {{__('app.Edit')}}
    </a>
    <h2>{{__('app.Show Issue')}}</h2>
    <div class="row align-items-start">
        <div class="badge badge-info col-md-2 mb-4">
            <p class="mt-3 mb-3">{{__('app.Take_the_time')}}: {{$issue->FullTime}}</p>
            <p class="mb-3">{{__('app.The_cost_in_fact')}}: {{$issue->FullTimePrice}} {!! __('app.Currency') !!}
            </p>
            <p class="mb-3">{{__('app.Cost')}}: {{$issue->EstimateTimePrice}} {!! __('app.Currency') !!}</p>
        </div>
        <div class="col-md-10">
            <div class="tab">
                <ul class="nav nav-tabs" role="tablist">
                    <li class="nav-item"><a class="nav-link active" href="#tab-1" data-toggle="tab"
                                            role="tab">{{__('app.General')}}</a></li>
                    <li class="nav-item"><a class="nav-link" href="#tab-2" data-toggle="tab"
                                            role="tab">{{__('app.History')}}</a></li>
                    <li class="nav-item"><a class="nav-link" href="#tab-3" data-toggle="tab"
                                            role="tab">{{__('app.Project')}}</a></li>
                </ul>
                <div class="tab-content">
                    <div class="tab-pane active" id="tab-1" role="tabpanel">
                        <form action="{{ route('issues.update', $issue->id) }}" method="POST"
                              enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="form-group">
                                <label class="form-label">{{__('app.Name')}}</label>
                                <p>{{$issue->name}}</p>
                            </div>
                            <div class="form-group">
                                <label for="inputState">{{__('app.Status')}}</label>
                                <p>{{$issue->status->name}}</p>
                            </div>
                            <div class="form-group">
                                <label for="inputState">{{__('app.Project')}}</label>
                                <p>{{$issue->project->name}}</p>
                            </div>
                            <div class="form-group">
                                <label class="form-label">{{__('app.Estimate')}}</label>
                                <p>{{$issue->estimate ?? 0.00}}</p>
                            </div>
                            <div class="form-group">
                                <label class="form-label">{{__('app.Description')}}</label>
                                <p>{!! $issue->description !!}</p>
                            </div>
                        </form>
                        @if ($issue->files->count() > 0)
                            <div class="form-group mt-4 mb-4">
                                <label class="form-label bold">{{__('app.Files')}}</label>
                                <ul class="pl-0">
                                    @each('taskmanager.partials._file', $issue->files, 'file')
                                </ul>
                            </div>
                        @endif
                    </div>
                    <div class="tab-pane" id="tab-2" role="tabpanel">
                        @each('taskmanager.partials._event', $issue->events, 'event')
                    </div>
                    <div class="tab-pane" id="tab-3" role="tabpanel">
                        <h3>{{ $issue->project->name }}</h3>
                        {!! $issue->project->description !!}
                    </div>
                </div>
            </div>
        </div>

    </div>
    <script>
        $('.remove-file').click(function (event) {
            event.preventDefault();
        });
    </script>
@endsection