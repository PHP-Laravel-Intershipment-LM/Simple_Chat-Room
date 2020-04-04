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
            <?php
                // var_dump($messages[0]['contents']);
                for ($i = 0; $i < sizeof($messages[0]['contents']); $i++) {
                    $content = $messages[0]['contents'][$i];
                    if ($content['name_user'] == session('nameUser')) {
                        echo '<div class="msg right-msg">';
                    } else {
                        echo '<div class="msg left-msg">';
                    }
                    echo '<div class="msg-img" style="background-image: url('. Avatar::create($content['name_user'])->toBase64() .')"></div>';
                    echo '<div class="msg-bubble">';
                        echo '<div class="msg-info">';
                            echo '<div class="msg-info-name">'. $content['name_user'] .'</div>';
                            echo '<div class="msg-info-time">'. (new DateTime($content['created_at']))->format('G:i') .'</div>';
                        echo '</div>';

                        echo '<div class="msg-text">'. $content['message'] .'</div>';
                    echo '</div>';
                echo '</div>';
                }
            ?>
        </main>

        <form class="msger-inputarea">
            <input type="text" class="msger-input" placeholder="Enter your message...">
            <input type="text" class="msger-room" value="{{ session('idActive') }}" style="display: none;">
            <input type="text" class="msger-name" value="{{ session('nameUser') }}" style="display: none;" disable>
            <input type="text" class="msger-avatar" value="url('{{ Avatar::create(session('nameUser'))->toBase64() }}')" style="display: none" disable>
            <button type="submit" class="msger-send-btn">Send</button>
        </form>
    </section>

    <script src="{{ asset('assets/js/app.js') }}" type="text/javascript"></script>
    <script src="{{ asset('assets/js/main.js') }}" type="text/javascript"></script>
</body>

</html>