<html>
    <head>
        <a href = "{{ url('/home') }}" >Home</a>
        {{ session('username') }}でログイン中
        <meta charset="UTF-8">
    </head>
    <body>
        <header>
            <h1>削除してよろしいですか？</h1>
                <table>
                    @foreach($threads as $thread)
                    <form method = "get">
                    @csrf
                    <tr>
                    <td>{{ $thread->oneword }}</td>
                    </tr>
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