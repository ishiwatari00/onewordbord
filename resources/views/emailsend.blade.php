<html>
    <style>
        .background{
        background: #DCDCDC;
        }
    </style>
    <head>
        <a href = "{{ url('/login') }}" >▶login</a>
        <meta charset="UTF-8">
    </head>
    <body class = "background">
        <header>
            <h1>メールを送りました</h1>
        </header>

            <p>受信したメールから登録を続けてください</p>
            <a href = "{{ $url }}">ここ</a>
    </body>
</html>