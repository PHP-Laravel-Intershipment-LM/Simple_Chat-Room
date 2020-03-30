<!DOCTYPE html>
<html>

<head>
    <title>Simple Chatroom</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link href="{{ asset('assets/css/style.css') }}" rel="stylesheet">
</head>

<body>
    <div class="logout">
        <a href="/logout" style="background-image: url('{{ asset('assets/images/back.svg') }}')"></a>
    </div>

    <section class="msger">
        <header class="msger-header">
            <div class="msger-header-title">
                Xin chào {{ session('nameUser') }}
            </div>
            <div class="msger-header-options">
                <span><i class="fas fa-cog"></i></span>
            </div>
        </header>

        <main class="msger-chat">
            <div class="msg left-msg">
                <div class="msg-img" style="background-image: url(https://image.flaticon.com/icons/svg/327/327779.svg)"></div>

                <div class="msg-bubble">
                    <div class="msg-info">
                        <div class="msg-info-name">BOT</div>
                        <div class="msg-info-time">12:45</div>
                    </div>

                    <div class="msg-text">
                        Hi, welcome to SimpleChat! Go ahead and send me a message. 😄
                    </div>
                </div>
            </div>

            <div class="msg right-msg">
                <div class="msg-img" style="background-image: url('{{ Avatar::create(session('nameUser'))->toBase64() }}')"></div>

                <div class="msg-bubble">
                    <div class="msg-info">
                        <div class="msg-info-name">{{ session('nameUser') }}</div>
                        <div class="msg-info-time">12:46</div>
                    </div>

                    <div class="msg-text">
                        You can change your name in JS section!
                    </div>
                </div>
            </div>
        </main>

        <form class="msger-inputarea">
            <input type="text" class="msger-input" placeholder="Enter your message...">
            <input type="text" class="msger-id" value="{{ session('idUser') }}" style="display: none;">
            <input type="text" class="msger-name" value="{{ session('nameUser') }}" style="display: none;">
            <button type="submit" class="msger-send-btn">Send</button>
        </form>
    </section>

    <script src="{{ asset('assets/js/main.js') }}" type="text/javascript"></script>
</body>

</html>