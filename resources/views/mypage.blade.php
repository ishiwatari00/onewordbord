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
        @if(Auth::check())
        {{ Auth::id() }}でログイン中
        @endif
        <meta charset="UTF-8">
    </head>
    <body class = "background">
    @if(Auth::check())
        <header>
            <h1>自分の投稿</h1>
                <table>
                    @foreach($threads as $thread)
                    <form method = "get">
                    @csrf
                    <p>
                        {{ $thread->id }}&emsp;
                        名前 : <span class = "span">{{ $thread->bordname }}</span>&emsp;
                        {{ $thread->gender }}&emsp;
                        {{ $thread->address }}
                        <input type = "submit" value = "編集" formaction = "/edit"></input>
                        <input type = "submit" value = "削除" formaction = "/deletecheck"></input>
                        <input type = "hidden" value = "{{ $thread->id }}" name = "id"></input>
                    </p>
                    <p>
                        {{ $thread->oneword }}
                    </p>
                    </form>
                    @endforeach
                </table>
                {{ $threads->links('vendor.pagination.default') }}
        </header>
        
        @endif

    </body>
</html>