{!! '<!-- Автор сайта: Калиновский Юрий -->' !!}
{!! '<!-- Автор html-макета: Xiaoying Riley at 3rd Wave Media -->' !!}
<!DOCTYPE html>
<html lang="ru">
<head>
    <title>@yield('title')</title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="shortcut icon" href="{{ asset('favicon.ico') }}">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>
<body>

<header class="header">
    <div class="container">
            @guest
                <!--<li><a href="{{ route('login') }}" class="link_menu">Авторизация</a></li>
                <li><a href="{{ route('register') }}" class="link_menu">Регистрация</a></li>-->
            @else
                <!--<li class="dropdown">
                    <a href="#" class="dropdown-toggle link_menu" data-toggle="dropdown" role="button" aria-expanded="false" aria-haspopup="true" v-pre>
                        {{ Auth::user()->name }} <span class="caret"></span>
                    </a>
                    <ul class="dropdown-menu">
                        <li>
                            <a href="{{ route('admin.index') }}" title="">Админка</a>
                            <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Выход</a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">{{ csrf_field() }}</form>
                        </li>
                    </ul>
                </li>-->
            @endguest
        </ul>
    </div>
</header>

<div class="container sections-wrapper">
    <div class="row">
        <div class="primary col-md-8 col-sm-12 col-xs-12">
            @yield('content')
        </div>
        <div class="secondary col-md-4 col-sm-12 col-xs-12">
            @include('layouts.aside')
        </div>
    </div>
</div>
<footer class="footer">
    
</footer>
<!-- Scripts -->
<script src="{{ asset('js/app.js') }}"></script>
</body>
</html>
