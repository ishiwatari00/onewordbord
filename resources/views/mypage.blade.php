<html>
    <head>
        <a href = "{{ url('/home') }}" >Home</a>
        {{ session('username') }}でログイン中
        <meta charset="UTF-8">
    </head>
    <body>
        <header>
            <h1>自分の投稿</h1>
                <table>
                    @foreach($threads as $thread)
                    <form method = "get">
                    @csrf
                    <tr>
                    <td>{{ $thread->id }}</td>
                    <td>{{ $thread->oneword }}</td>
                    <td><input type = "submit" value = "編集" formaction = "/edit"></input></td>
                    <td><input type = "submit" value = "削除" formaction = "/deletecheck"></input></td>
                    <td><input type = "hidden" name = "id" value = "{{ $thread->id }}"></input><td>
                    </tr>
                    </form>
                    @endforeach
                </table>
                {{ $threads->links('vendor.pagination.default') }}
        </header>
        


    </body>
</html>