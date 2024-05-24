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
        @if(session('userid') == null)
        <a href = "{{ url('/login') }}" >login</a>
        <a href = "{{ url('/register') }}" >register</a>
        @else
        <a href = "{{ url('/home') }}" >Home</a>
        <a href = "{{ url('/mypage') }}" >mypage</a>
        <a href = "{{ url('/logout') }}" >logout</a>
        {{ session('username') }}でログイン中
        @endif
        <meta charset="UTF-8">
    </head>
    <body class = "background">
        <header>
            <h1>掲示板</h1>
            @if(session('userid') != null)
                <form method = "post" action = "tweet">
                @csrf
                <input type = "text" name = "oneword"></input>
                <input type = "submit"></input>
                <input type = "hidden" name = "userid" value = "{{ session('userid') }}"></input>
                </form>

                @foreach($threads as $thread)
                    <p>{{ $thread->id }}&emsp;名前 : <span class = "span">以下、名無しにかわりましてVIPがお送りします。</span></p>
                    <p>{{ $thread->oneword }}</p>
                    </tr>
                @endforeach
            @endif
            
        </header>

            {{ $threads->links('vendor.pagination.default') }}


    </body>
</html>