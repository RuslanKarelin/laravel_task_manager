@extends('layouts.taskmanager', ['title' => __('app.Sources')])

@section('content')
    <div class="container-fluid p-0">
        <h1 class="h3 mb-3">{{__('app.Sources')}}</h1>
        <div class="row">
            <div class="col-12 col-xl-12">
                <div class="card">
                    <form action="{{route('sources.index')}}">
                        @csrf
                        <a href="{{ route('sources.create') }}" class="btn btn-primary float-right mt-n1"><i
                                    class="fas fa-plus"></i> {{__('app.Create')}}</a>
                        <button class="deleteChecked mr-2 btn btn-danger float-right mt-n1" type="submit"><i
                                    class="align-middle" data-feather="trash"></i></button>
                        <table id="datatables-clients" class="table table-striped mt-5">
                            <thead>
                            <tr>
                                <th><input class="checkAllItems" type="checkbox"></th>
                                <th>ID</th>
                                <th>{{__('app.Name')}}</th>
                                <th>{{__('app.Email')}}</th>
                                <th>{{__('app.Phone')}}</th>
                                <th>{{__('app.Price')}}</th>
                                <th>{{__('app.Action')}}</th>
                            </tr>
                            </thead>
                            <tbody>
                            @each('taskmanager.source._source_row', $sources, 'source')
                            </tbody>
                        </table>
                        <input type="hidden" name="factory"
                               value="@php echo \App\Interfaces\Factories\ISourceFactory::class @endphp">
                    </form>
                    {{$sources->links()}}
                </div>
            </div>
        </div>
    </div>
@endsection
