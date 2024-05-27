<html>
    <style>
        .background{
        background: #DCDCDC;
        }
        .span {
        color: green;
        }
    </style>
    <head>
        <a href = "{{ url('/home') }}" >Home</a>
        {{ session('username') }}でログイン中
        <meta charset="UTF-8">
    </head>
    <body class = "background">
        <header>
            <h1>削除してよろしいですか？</h1>
                <table>
                    @foreach($threads as $thread)
                    <form method = "get">
                    @csrf
                    <p>
                        {{ $thread->id }}&emsp;
                        名前 : <span class = "span">{{ $thread->bordname }}</span>&emsp;
                        {{ $thread->gender }}&emsp;
                        {{ $thread->address }}
                    </p>
                    <p>
                        {{ $thread->oneword }}
                    </p>
                    <tr>
                    <td><input type = "submit" value = "戻る" formaction = "/mypage"></input></td>
                    <td><input type = "submit" value = "削除" formaction = "/delete"></input></td>
                    <td><input type = "hidden" name = "id" value = "{{ $thread->id }}"></input><td>
                    </tr>
                    </form>
                    @endforeach
                </table>
        </header>
        


    </body>
</html>