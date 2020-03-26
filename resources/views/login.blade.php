<!DOCTYPE html>
<html>

<head>
    <title>Demo Database</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="{{ asset('assets/css/login.css') }}" />
</head>

<body>

    <div class="container">
        <div id="title">Đăng nhập vào hệ thống</div>
        @if (isset($message))
        <p>{{ $message }}</p>
        @endif

        <form id="input" action="/login" method="POST">
            <div class="row">
                <label for="username">Username</label>
                <input type="text" id="username" name="username" class="username" placeholder="Tên đăng nhập" />
            </div>
            <div class="row">
                <label for="password">Password</label>
                <input type="password" id="password" name="password" class="password">
            </div>
            <input type="text" name="_token" value="{{ csrf_token() }}" style="display: none;">
            <div class="row">
                <input type="submit" value="Login">
            </div>
        </form>
    </div>

    <!-- <script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script> -->

</body>

</html>