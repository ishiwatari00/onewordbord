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
        {{ Auth::user()->username; }}でログイン中
        <meta charset="UTF-8">
    </head>
    <body class = "background">
        <header>
            <h1>自分の投稿</h1>
                <table>
                    @foreach($threads as $thread)
                    <form method = "get">
                    @csrf
                    <dt>
                        {{ $thread->id }}&emsp;
                        名前 : <span class = "span">{{ $thread->bordname }}</span>&emsp;
                        {{ $thread->gender }}&emsp;
                        {{ $thread->address }}&emsp;
                        {{ $thread->created_at }}
                        <input type = "submit" value = "編集" formaction = "/edit"></input>
                        <input type = "submit" value = "削除" formaction = "/deletecheck"></input>
                        <input type = "hidden" value = "{{ $thread->id }}" name = "id"></input>
                    </dt>
                    <dd>
                        {{ $thread->oneword }}
                    </dd>
                    <br>
                    </form>
                    @endforeach
                </table>
                {{ $threads->links('vendor.pagination.default') }}
        </header>
    </body>
</html>