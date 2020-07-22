@extends('layouts.taskmanager', ['title' => __('app.Edit Issue')])

@section('content')
    <a href="{{ route('issues.show', $issue->id) }}" class="btn btn-primary float-right mt-n1"><i
                class="align-middle mr-2 fas fa-fw fa-eye"></i> {{__('app.Show')}}</a>
    <h2>{{__('app.Edit Issue')}}</h2>
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
                                <input type="input" name="name" class="form-control" placeholder="{{__('app.Name')}}"
                                       value="{{ old('name', $issue->name) }}">
                            </div>
                            <div class="form-group">
                                <label for="inputState">{{__('app.Status')}}</label>
                                <select name="status_id" class="form-control">
                                    @foreach ($statuses as $status)
                                        <option @if($status->id == $issue->status_id) selected
                                                @endif value="{{ $status->id }}">{{ $status->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="inputState">{{__('app.Project')}}</label>
                                <select name="project_id" class="form-control">
                                    @foreach ($projects as $project)
                                        <option @if($project->id == $issue->project_id) selected
                                                @endif value="{{ $project->id }}">{{ $project->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label class="form-label">{{__('app.Take_the_time')}}</label>
                                <input type="input" name="time" class="form-control"
                                       placeholder="{{__('app.Take_the_time')}}"
                                       value="{{ old('time', 0.00) }}">
                            </div>
                            <div class="form-group">
                                <label class="form-label">{{__('app.Estimate')}}</label>
                                <input type="input" name="estimate" class="form-control"
                                       placeholder="{{__('app.Estimate')}}"
                                       value="{{ old('estimate', $issue->estimate ?? 0.00) }}">
                            </div>
                            <div class="form-group">
                                <label class="form-label">{{__('app.Description')}}</label>
                                <textarea id="editor1" name="description" class="form-control"
                                          placeholder="{{__('app.Description')}}"
                                          rows="4">{{ old('description', $issue->description) }}</textarea>
                            </div>
                            <div class="form-group">
                                <label class="form-label">{{__('app.Comment')}}</label>
                                <textarea id="editor2" name="comment" class="form-control"
                                          placeholder="{{__('app.Comment')}}"
                                          rows="4"></textarea>
                            </div>
                            <div class="form-group">
                                <div id="file" class="dropzone"></div>
                            </div>
                            <input type="hidden" name="dirty_status_id" value="{{ $issue->status_id }}">
                            <input type="hidden" name="dirty_estimate" value="{{ $issue->estimate }}">
                            <button type="submit" class="btn btn-primary">{{__('app.Submit')}}</button>
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
        var drop = new Dropzone('#file', {
            createImageThumbnails: false,
            addRemoveLinks: true,
            url: "{{ route('upload-file') }}",
            params: {'issue_id': '{{ $issue->id }}'},
            headers: {
                'X-CSRF-TOKEN': '{{csrf_token()}}'
            }
        });
        CKEDITOR.replace('editor1', {
            filebrowserUploadUrl: "{{route('ckeditor.upload', ['_token' => csrf_token() ])}}",
            filebrowserUploadMethod: 'form'
        });
        CKEDITOR.replace('editor2', {
            filebrowserUploadUrl: "{{route('ckeditor.upload', ['_token' => csrf_token() ])}}",
            filebrowserUploadMethod: 'form'
        });
        $('.remove-file').click(function (event) {
            event.preventDefault();
            file = $(this);
            $.ajax({
                type: "POST",
                url: "{{route('remove-file')}}",
                data: "id=" + file.attr('data-id') + "&filename=" + file.attr('data-filename'),
                success: function (msg) {
                    file.closest('li').remove();
                },
                headers: {
                    'X-CSRF-TOKEN': '{{csrf_token()}}'
                }
            });
        });
    </script>
@endsection