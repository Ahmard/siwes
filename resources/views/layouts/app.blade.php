@php
dd(\App\Helpers\Alert::create()->getAlerts());
@endphp
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta http-equiv="Content-Language" content="en">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>

    <title>{{env('APP_NAME')}}</title>

    <meta name="viewport"
          content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no, shrink-to-fit=no"/>
    <meta name="description" content="This is an example dashboard created using build-in elements and components.">
    <meta name="msapplication-tap-highlight" content="no">

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{asset('css/fontawesome-all.min.css')}}">
    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <!-- Material Design Bootstrap -->
    <link rel="stylesheet" href="{{asset('css/mdb.min.css')}}">

    <!-- Your custom styles (optional) -->
</head>

<!--Big blue-->
<body class="fixed-sn animated lighten-3">
<div id="app">
    <!-- Navbar -->
    <nav class="navbar unique-color fixed-top navbar-expand-lg scrolling-navbar double-nav">
        <!-- Breadcrumb -->
        <div class="breadcrumb-dn mr-auto">
            <a href="/" class="text-white pt-4">
                <b>{{env('APP_NAME')}}</b>
            </a>
        </div>

        <div class="d-flex change-mode">
            <!-- Navbar links -->
            <ul class="nav navbar-nav nav-flex-icons ml-auto">
                <!-- Dropdown -->
                @auth
                    @unless(auth()->user()->isLecturer())
                    @endunless
                    @unless (auth()->user()->isStudent())

                            <li class="nav-item dropdown">
                                <a class="nav-link btn btn-sm btn-default z-depth-0 dropdown-toggle waves-effect" href="#"
                                   data-toggle="dropdown"
                                   aria-haspopup="true" aria-expanded="false">
                                    <i class="fas fa-chalkboard-teacher"></i>
                                    <span class="clearfix d-none d-sm-inline-block">Lecturer</span>
                                </a>

                                <div class="dropdown-menu dropdown-menu-right z-depth-2 border-default"
                                     aria-labelledby="userDropdown">
                                    <a class="dropdown-item" href="{{route('lecturer.index')}}">
                                        <i class="fa fa-user-alt"></i>
                                        Lecturer
                                    </a>
                                    <a class="dropdown-item" href="">
                                        <i class="fa fa-school"></i>
                                        Rooms
                                    </a>
                                </div>
                            </li>
                            <li class="nav-item dropdown">
                            <a class="nav-link btn btn-sm btn-default z-depth-0 dropdown-toggle waves-effect" href="#"
                               data-toggle="dropdown"
                               aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-list"></i>
                                <span class="clearfix d-none d-sm-inline-block">Logs</span>
                            </a>

                            <div class="dropdown-menu dropdown-menu-right z-depth-2 border-default"
                                 aria-labelledby="userDropdown">
                                <a class="dropdown-item" href="">
                                    <i class="fa fa-list-alt"></i>
                                    Random 1
                                </a>
                                <a class="dropdown-item" href="">
                                    <i class="fa fa-list-alt"></i>
                                    Random 2
                                </a>
                            </div>
                        </li>
                    @endunless
                    <li class="nav-item dropdown">
                        <a class="nav-link btn btn-sm btn-dark z-depth-0 dropdown-toggle waves-effect" href="#"
                           data-toggle="dropdown"
                           aria-haspopup="true" aria-expanded="false">
                            <i class="fas fa-user"></i>
                            <span class="clearfix d-none d-sm-inline-block">{{auth()->user()->getFullName()}}</span>
                        </a>

                        <div class="dropdown-menu dropdown-menu-right z-depth-2" aria-labelledby="userDropdown">
                            <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                  style="display: none;">
                                @csrf
                            </form>

                            <a class="dropdown-item" href="#" onclick="event.preventDefault();
                            document.getElementById('logout-form').submit();">
                                <i class="fa fa-sign-out-alt"></i>
                                Log Out
                            </a>
                        </div>
                    </li>
                @endauth
            </ul>
        </div>
    </nav>
    <!-- Navbar -->

    <!-- Main layout -->
    <main style="padding-top:80px">@yield('content')</main>
    <!-- Main layout -->

    <!-- Footer -->
    <footer class="page-footer mt-5 unique-color">

        <!-- Copyright -->
        <div class="footer-copyright py-3 text-center">
            <div class="container-fluid">
                © <?=date('Y')?> Copyright: <a href="/" target="_blank">{{env('APP_NAME')}}</a>
            </div>
        </div>
        <!-- Copyright -->

    </footer>
    <!-- Footer -->

    <div class="modal fade" id="modal_general" data-backdrop="static" data-keyboard="false" tabindex="-1"
         aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Modal title</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    ...
                </div>
                <div class="modal-footer"></div>
            </div>
        </div>
    </div>

@auth
    <!--<script type="text/javascript" src="{{asset('assets/js/site/person.js')}}"></script>-->
        <script>
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                    'Authorization': 'Bearer {{$apiToken ?? null}}'
                }
            });

            $W.Auth.login({token: "{{$apiToken ?? null}}"});
        </script>
    @endauth
</div>
</body>
</html>
