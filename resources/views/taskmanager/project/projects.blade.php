@extends('layouts.taskmanager', ['title' => __('app.Projects')])

@section('content')
    <div class="container-fluid p-0">
        <h1 class="h3 mb-3">{{__('app.Projects')}}</h1>
        <div class="row">
            <div class="col-12 col-xl-12">
                <div class="card">
                    <form action="{{route('projects.index')}}">
                        @csrf
                        <a href="{{ route('projects.create') }}" class="btn btn-primary float-right mt-n1"><i
                                    class="fas fa-plus"></i> {{__('app.Create')}}</a>
                        <button class="deleteChecked mr-2 btn btn-danger float-right mt-n1" type="submit"><i
                                    class="align-middle" data-feather="trash"></i></button>
                        <table id="datatables-clients" class="table table-striped mt-5">
                            <thead>
                            <tr>
                                <th><input class="checkAllItems" type="checkbox"></th>
                                <th>ID</th>
                                <th>{{__('app.Name')}}</th>
                                <th>{{__('app.Action')}}</th>
                            </tr>
                            </thead>
                            <tbody>
                            @each('taskmanager.project._project_row', $projects, 'project')
                            </tbody>
                        </table>
                        <input type="hidden" name="factory"
                               value="@php echo \App\Interfaces\Factories\IProjectFactory::class @endphp">
                    </form>
                    {{$projects->links()}}
                </div>
            </div>
        </div>
    </div>
@endsection
