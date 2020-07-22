@extends('layouts.taskmanager', ['title' => __('app.Issues')])

@section('content')
    <div class="container-fluid p-0">

        <h1 class="h3 mb-3">{{__('app.Profile')}}</h1>

        <div class="row">
            <div class="col-md-3 col-xl-2">

                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title mb-0">{{__('app.Profile Settings')}}</h5>
                    </div>

                    <div class="list-group list-group-flush" role="tablist">
                        <a class="list-group-item list-group-item-action active" data-toggle="list" href="#account"
                           role="tab">
                            {{__('app.Account')}}
                        </a>
                        <a class="list-group-item list-group-item-action" data-toggle="list" href="#password"
                           role="tab">
                            {{__('app.Password')}}
                        </a>
                    </div>
                </div>
            </div>

            <div class="col-md-9 col-xl-10">
                <div class="tab-content">
                    <div class="tab-pane fade show active" id="account" role="tabpanel">

                        <div class="card">

                            <div class="card-body">
                                <form action="{{ route('user-info.update', $user->id) }}" method="POST"
                                      enctype="multipart/form-data">
                                    @csrf
                                    @method('PUT')
                                    <div class="row">
                                        <div class="col-md-8">
                                            <div class="form-group">
                                                <label for="inputUsername">{{__('app.Username')}}</label>
                                                <input name="name" type="text" class="form-control" id="inputUsername"
                                                       placeholder="{{__('app.Username')}}"
                                                       value="{{ old('name', $user->name) }}">
                                            </div>
                                            <div class="form-row">
                                                <div class="form-group col-md-6">
                                                    <label for="inputFirstName">{{__('app.First_Name')}}</label>
                                                    <input name="first_name" type="text" class="form-control"
                                                           id="inputFirstName"
                                                           placeholder="{{__('app.First_Name')}}"
                                                           value="{{ old('first_name', $user->profile->first_name) }}">
                                                </div>
                                                <div class="form-group col-md-6">
                                                    <label for="inputLastName">{{__('app.Last_Name')}}</label>
                                                    <input name="last_name" type="text" class="form-control"
                                                           id="inputLastName"
                                                           placeholder="{{__('app.Last_Name')}}"
                                                           value="{{ old('last_name', $user->profile->last_name) }}">
                                                </div>
                                            </div>
                                            <div class="form-row">
                                                <div class="form-group col-md-6">
                                                    <label for="inputEmail4">{{__('app.Email')}}</label>
                                                    <input name="email" type="email" class="form-control"
                                                           id="inputEmail4"
                                                           placeholder="{{__('app.Email')}}"
                                                           value="{{ old('email', $user->email) }}">
                                                </div>
                                                <div class="form-group col-md-6">
                                                    <label for="inputPhone">{{__('app.Phone')}}</label>
                                                    <input name="phone" type="email" class="form-control"
                                                           id="inputPhone"
                                                           placeholder="{{__('app.Phone')}}"
                                                           value="{{ old('email', $user->profile->phone) }}">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="text-center">
                                                @if (auth()->user()->profile->image)
                                                    <img
                                                            src="{{ asset('avatars/' . auth()->user()->profile->image->filename) }}"
                                                            class="rounded-circle img-responsive mt-2" width="128"
                                                            height="128">
                                                @endif
                                                <div class="mt-2">
                                                    <label class="btn btn-primary">
                                                        <input type="file" name="avatar" style="display:none;"
                                                               value="{{ old('avatar') }}">
                                                        <i class="fas fa-upload"></i> {{__('app.Upload')}}</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <button type="submit" class="btn btn-primary">{{__('app.Save changes')}}</button>
                                </form>

                            </div>
                        </div>

                    </div>
                    <div class="tab-pane fade" id="password" role="tabpanel">
                        <div class="card">
                            <div class="card-body">

                                <form action="{{ route('user-password.update', $user->id) }}" method="POST">
                                    @csrf
                                    @method('PUT')
                                    <div class="form-group">
                                        <label for="inputPasswordCurrent">{{__('app.Current password')}}</label>
                                        <input name="current_password" type="password" class="form-control"
                                               id="inputPasswordCurrent">
                                    </div>
                                    <div class="form-group">
                                        <label for="inputPasswordNew">{{__('app.New password')}}</label>
                                        <input name="new_password" type="password" class="form-control"
                                               id="inputPasswordNew">
                                    </div>
                                    <div class="form-group">
                                        <label for="inputPasswordNew2">{{__('app.Verify password')}}</label>
                                        <input name="new_confirm_password" type="password" class="form-control"
                                               id="inputPasswordNew2">
                                    </div>
                                    <button type="submit" class="btn btn-primary">{{__('app.Save changes')}}</button>
                                </form>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
