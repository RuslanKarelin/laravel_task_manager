<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Responsive Bootstrap 4 Admin &amp; Dashboard Template">
    <meta name="author" content="Bootlab">

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{$title}}</title>

    <link rel="preconnect" href="//fonts.gstatic.com/" crossorigin="">
    <link href="{{ asset('css/classic.css') }}" rel="stylesheet">

    <style>
        body {
            opacity: 0;
        }
    </style>
    <script src="{{ asset('js/taskmanager.js') }}"></script>
    <script src="{{ asset('js/admin.js') }}"></script>
    <script src="https://cdn.ckeditor.com/4.12.1/standard/ckeditor.js"></script>
    <link href="{{ asset('css/tm.css') }}" rel="stylesheet">
    <?php
    if (env('APP_DEBUG')) {
        $renderer = Debugbar::getJavascriptRenderer();
        echo $renderer->renderHead();
    }
    ?>
</head>
<body>
<div class="wrapper">
    <nav id="sidebar" class="sidebar">
        <div class="sidebar-content ">
            <a class="sidebar-brand" href="{{ route('home') }}">
                <i class="align-middle" data-feather="box"></i>
                <span class="align-middle">Task Manager</span>
            </a>

            <ul class="sidebar-nav">
                <li class="sidebar-item">
                    <a href="{{ route('home') }}" class="sidebar-link">
                        <i class="align-middle" data-feather="sliders"></i> <span
                                class="align-middle">{{__('app.Statistics')}}</span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a href="{{ route('issues.index') }}" class="sidebar-link">
                        <i class="align-middle fas fa-fw fa-tasks"></i> <span
                                class="align-middle">{{__('app.Issues')}}</span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a href="{{ route('sources.index') }}" class="sidebar-link">
                        <i class="align-middle fas fa-fw fa-globe"></i> <span
                                class="align-middle">{{__('app.Sources')}}</span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a href="{{ route('projects.index') }}" class="sidebar-link">
                        <i class="align-middle fas fa-fw fa-project-diagram"></i> <span
                                class="align-middle">{{__('app.Projects')}}</span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a href="{{ route('issue-statuses.index') }}" class="sidebar-link">
                        <i class="align-middle fas fa-fw fa-check-double"></i> <span
                                class="align-middle">{{__('app.Statuses')}}</span>
                    </a>
                </li>
            </ul>

            <div class="sidebar-bottom d-none d-lg-block">
                <div class="media">
                    @if (auth()->user() && auth()->user()->profile->image)
                        <img class="rounded-circle mr-3"
                             src="{{ asset('avatars/' . auth()->user()->profile->image->filename) }}" alt="Chris Wood"
                             width="40" height="40">
                    @endif
                    <div class="media-body">
                        @if (auth()->user())
                            <h5 class="mb-1">{{auth()->user()->profile->FullName}}</h5>
                        @endif
                        <div>
                            <i class="fas fa-circle text-success"></i> Online
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </nav>
    <div class="main">
        <nav class="navbar navbar-expand navbar-light bg-white">
            <a class="sidebar-toggle d-flex mr-2">
                <i class="hamburger align-self-center"></i>
            </a>

            <div class="navbar-collapse collapse">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item dropdown">
                        <a class="nav-icon dropdown-toggle d-inline-block d-sm-none" href="#" data-toggle="dropdown">
                            <i class="align-middle" data-feather="settings"></i>
                        </a>

                        <a class="nav-link dropdown-toggle d-none d-sm-inline-block" href="#" data-toggle="dropdown">
                            @if (auth()->user() && auth()->user()->profile->image)
                                <img src="{{ asset('avatars/' . auth()->user()->profile->image->filename) }}"
                                     class="avatar img-fluid rounded-circle mr-1" alt="Chris Wood">
                            @endif
                            @if (auth()->user())
                                <span class="text-dark">{{auth()->user()->profile->FullName}}</span>
                            @endif
                        </a>
                        <div class="dropdown-menu dropdown-menu-right">
                            @if (auth()->user())
                                <a class="dropdown-item" href="{{route('profile.edit', auth()->user()->id)}}"><i
                                            class="align-middle mr-1" data-feather="user"></i> Profile</a>
                            @endif
                            <a class="dropdown-item" href="{{route('logout')}}" onclick="event.preventDefault();
document.getElementById('logout-form').submit();">
                                {{ __('Logout') }}</a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                        </div>
                    </li>
                </ul>
            </div>
        </nav>

        <main class="content">
            @if (!empty($errors) && $errors->any())
                <div class="alert alert-danger p-2">
                    <ul class="p-0 m-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            @if (session('status'))
                <div class="alert alert-success p-2">
                    {{ session('status') }}
                </div>
            @endif
            @yield('content')
        </main>
        <footer class="footer"></footer>
    </div>
</div>
<script>
    $('.checkAllItems').change(function () {
        if ($(this).prop("checked")) {
            $('.checkItem').each(function (i, e) {
                $(e).prop('checked', true);
            });
        } else {
            $('.checkItem').each(function (i, e) {
                $(e).prop('checked', false);
            });
        }
    });
</script>
<?php
if (env('APP_DEBUG')) {
    echo $renderer->render();
}
?>
</body>
</html>