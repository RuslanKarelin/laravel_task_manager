@extends('layouts.taskmanager', ['title' => __('app.Statistics')])

@section('content')
    <div class="container-fluid p-0">
        <div class="row">
            <div class="col-12 col-sm-4 col-xl d-flex">
                <div class="card flex-fill">
                    <div class="card-body py-4">
                        <div class="media">
                            <div class="d-inline-block mt-2 mr-3">
                                <i class="feather-lg text-primary" data-feather="list"></i>
                            </div>
                            <div class="media-body">
                                <h3 class="mb-2">{{$issueCount}}</h3>
                                <div class="mb-0">{{__('app.Issues')}}</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 col-sm-4 col-xl d-flex">
                <div class="card flex-fill">
                    <div class="card-body py-4">
                        <div class="media">
                            <div class="d-inline-block mt-2 mr-3">
                                <i class="feather-lg text-primary" data-feather="globe"></i>
                            </div>
                            <div class="media-body">
                                <h3 class="mb-2">{{$sourceCount}}</h3>
                                <div class="mb-0">{{__('app.Sources')}}</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 col-sm-4 col-xl d-flex">
                <div class="card flex-fill">
                    <div class="card-body py-4">
                        <div class="media">
                            <div class="d-inline-block mt-2 mr-3">
                                <i class="feather-lg text-primary" data-feather="grid"></i>
                            </div>
                            <div class="media-body">
                                <h3 class="mb-2">{{$projectCount}}</h3>
                                <div class="mb-0">{{__('app.Projects')}}</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12 col-lg-8 d-flex">
                <div class="card flex-fill w-100">
                    <div class="card-header">
                        <h5 class="card-title mb-0">{{__('app.Statistics')}}</h5>
                    </div>
                    <div class="card-body">
                        <div class="chart chart-lg">
                            <canvas id="chartjs-dashboard-line"></canvas>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 col-lg-4 d-flex">
                <div class="card flex-fill w-100">
                    <div class="card-header">
                        <h5 class="card-title mb-0">{{__('app.Comments')}}</h5>
                    </div>
                    <div class="card-body">
                        @foreach ($comments as $comment)
                            <div class="media">
                                @if (auth()->user() && auth()->user()->profile->image)
                                    <img src="{{ asset('avatars/' . auth()->user()->profile->image->filename) }}"
                                         width="36" height="36" class="rounded-circle mr-2">
                                @endif
                                <div class="media-body">
                                    <div>
                                        <a href="{{route('issues.show', $comment->commentable->issue_id)}}">{{Str::limit($comment->commentable->issue->name, 40)}}</a>
                                    </div>
                                    <div>{!! Str::limit(strip_tags($comment->body), 40) !!}</div>
                                    <small class="text-muted">{{$comment->created_at}}</small>
                                    <br>
                                </div>
                            </div>
                            <hr>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>

    </div>
    <script>
        $(function () {
            // Line chart
            new Chart(document.getElementById("chartjs-dashboard-line"), {
                type: "line",
                data: {
                    labels: ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"],
                    datasets: [{
                        label: "{{__('app.The_cost_in_fact')}}",
                        fill: true,
                        backgroundColor: "transparent",
                        borderColor: window.theme.primary,
                        data: '@php echo $sumTime @endphp'.split(',')
                    }, {
                        label: "{{__('app.Cost')}}",
                        fill: true,
                        backgroundColor: "transparent",
                        borderColor: window.theme.tertiary,
                        borderDash: [4, 4],
                        data: '@php echo $sumEstimate @endphp'.split(',')
                    }]
                },
                options: {
                    maintainAspectRatio: false,
                    legend: {
                        display: false
                    },
                    tooltips: {
                        intersect: false
                    },
                    hover: {
                        intersect: true
                    },
                    plugins: {
                        filler: {
                            propagate: false
                        }
                    },
                    scales: {
                        xAxes: [{
                            reverse: true,
                            gridLines: {
                                color: "rgba(0,0,0,0.05)"
                            }
                        }],
                        yAxes: [{
                            ticks: {
                                stepSize: 5000
                            },
                            display: true,
                            borderDash: [5, 5],
                            gridLines: {
                                color: "rgba(0,0,0,0)",
                                fontColor: "#fff"
                            }
                        }]
                    }
                }
            });
        });
    </script>
@endsection
