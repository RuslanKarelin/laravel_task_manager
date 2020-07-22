@extends('layouts.taskmanager', ['title' => __('app.Issues')])

@section('content')
    <div class="container-fluid p-0">
        <h1 class="h3 mb-3">{{__('app.Issues')}}</h1>
        <div class="row">
            <div class="col-12 col-xl-12">
                <form action="{{route('issues-filter.index')}}">
                    @csrf
                    <div class="row mb-4">
                        <div class="col-12 col-xl-2">
                            <div class="form-group mb-xl-0">
                                <label class="form-label">{{__('app.Date Ranges')}}</label>
                                <div id="reportrange" class="overflow-hidden form-control">
                                    <i class="far fa-calendar"></i>&nbsp;
                                    <span class="rangeSpan"></span> <i class="fas fa-caret-down"></i>
                                    <input id="dateField" type="hidden" name="date"
                                           value="{{request()->input('date')}}">
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-xl-2">
                            <div class="form-group mb-xl-0">
                                <div>
                                    <input name="dateType" type="radio"
                                           @if(request()->input('dateType') == 'created_at') checked
                                           @endif value="created_at">
                                    <label class="form-label m-0">{{__('app.Creation_date')}}</label>
                                </div>
                                <div>
                                    <input name="dateType" type="radio"
                                           @if(request()->input('dateType') == 'beginning') checked
                                           @endif value="beginning">
                                    <label class="form-label m-0">{{__('app.Start_date')}}</label>
                                </div>
                                <div>
                                    <input name="dateType" type="radio"
                                           @if(request()->input('dateType') == 'completion') checked
                                           @endif value="completion">
                                    <label class="form-label m-0">{{__('app.Completion_date')}}</label>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-xl-2">
                            <div class="form-group mb-xl-0">
                                <label class="form-label">{{__('app.Project')}}</label>
                                <select name="project_id" class="form-control">
                                    <option value=""></option>
                                    @foreach ($projects as $project)
                                        <option @if($project->id == request()->input('project_id')) selected
                                                @endif value="{{ $project->id }}">{{ $project->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-12 col-xl-2">
                            <div class="form-group mb-xl-0">
                                <label class="form-label">{{__('app.Status')}}</label>
                                <select name="status_id" class="form-control">
                                    <option value=""></option>
                                    @foreach ($statuses as $status)
                                        <option @if($status->id == request()->input('status_id')) selected
                                                @endif value="{{ $status->id }}">{{ $status->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-12 col-xl-2" style="align-self: flex-end; top: -3px; position: relative;">
                            <button class="mr-2 btn btn-primary mt-n1" type="submit"><i
                                        class="align-middle fas fa-fw fa-filter"></i></button>
                        </div>
                    </div>

                </form>
                <div class="card">
                    <form action="{{route('issues.index')}}">
                        @csrf
                        <a href="{{ route('issues.create') }}" class="btn btn-primary float-right mt-n1"><i
                                    class="fas fa-plus"></i> {{__('app.Create')}}</a>
                        <button class="deleteChecked mr-2 btn btn-danger float-right mt-n1" type="submit"><i
                                    class="align-middle" data-feather="trash"></i></button>
                        <table class="table mt-5">
                            <thead>
                            <tr>
                                <th><input class="checkAllItems" type="checkbox"></th>
                                <th>ID</th>
                                <th>{{__('app.Name')}}</th>
                                <th>
                                    {{__('app.Project')}}
                                </th>
                                <th>
                                    {{__('app.Creation_date')}}
                                </th>
                                <th>
                                    {{__('app.Start_date')}}
                                </th>
                                <th>
                                    {{__('app.Completion_date')}}
                                </th>
                                <th>{{__('app.Estimate')}}</th>
                                <th>{{__('app.Take_the_time')}}</th>
                                <th>{{__('app.Cost')}}</th>
                                <th>{{__('app.The_cost_in_fact')}}</th>
                                <th>
                                    {{__('app.Status')}}
                                </th>
                                <th>{{__('app.Action')}}</th>
                            </tr>
                            </thead>
                            <tbody>
                            @each('taskmanager.issue._issue_row', $issues, 'issue')
                            </tbody>
                        </table>
                        <input type="hidden" name="repository"
                               value="@php echo \App\Interfaces\Repositories\IIssueRepository::class @endphp">
                    </form>
                    <div class="alert alert-primary alert-dismissible" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        <div class="alert-message">
                            <h4 class="alert-heading">{{__('app.Subtotal')}}:</h4>
                            <div class="bold">{{__('app.Number of tasks')}}: {{$issueCount}}</div>
                            <div class="bold">{{__('app.The_cost_in_fact')}}
                                : {{$sumTime}} {!! __('app.Currency') !!}</div>
                            <div class="bold">{{__('app.Cost')}}: {{$sumEstimate}} {!! __('app.Currency') !!}</div>
                        </div>
                    </div>

                    {{$issues->links()}}
                </div>

            </div>
        </div>
    </div>
    <script>
        var start = moment().subtract(29, "days");
        var end = moment();
        var firstLoad = true;

        function cb(start, end) {
            if (!firstLoad) {
                $("#reportrange span").html(start.format("YYYY-MM-DD") + " - " + end.format("YYYY-MM-DD"));
                $("#dateField").val(start.format("YYYY-MM-DD") + " - " + end.format("YYYY-MM-DD"));
            } else {
                $("#reportrange span").html('{{request()->input('date')}}');
            }
            firstLoad = false;
        }

        $("#reportrange span").daterangepicker({
            startDate: start,
            endDate: end,
            ranges: {
                "Today": [moment(), moment()],
                "Yesterday": [moment().subtract(1, "days"), moment().subtract(1, "days")],
                "Last 7 Days": [moment().subtract(6, "days"), moment()],
                "Last 30 Days": [moment().subtract(29, "days"), moment()],
                "This Month": [moment().startOf("month"), moment().endOf("month")],
                "Last Month": [moment().subtract(1, "month").startOf("month"), moment().subtract(1, "month").endOf("month")]
            }
        }, cb);
        cb(start, end);
    </script>
@endsection
