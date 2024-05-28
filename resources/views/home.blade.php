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
        @if(Auth::check())
        <a href = "{{ url('/home') }}" >Home</a>
        <a href = "{{ url('/mypage') }}" >mypage</a>
        <a href = "{{ url('/logout') }}" >logout</a>
        {{ Auth::id() }}でログイン中
        @else
        <a href = "{{ url('/login') }}" >login</a>
        <a href = "{{ url('/register') }}" >register</a>
        @endif
        <meta charset="UTF-8">
    </head>
    <body class = "background">
        <header>
        @if(Auth::check())
            <h1>掲示板</h1>
                <table>
                <form method = "post" action = "tweet">
                @csrf
                <tr>
                    <td>name :</td>
                    <td><input type = "text" name = "bordname" value  = "以下、名無しに代わりましてVIPがお送りします。" size = "48px"></input></td>
                </tr>

                <tr>
                    <td>gender :</td>
                    <td>
                        <input type = "radio" name = "gender" value = "♂">♂</input>
                        <input type = "radio" name = "gender" value = "♀">♀</input>
                    </td>
                </tr>

                <tr>
                    <td>address :</td>
                    <td>
                        <select name = "address">
                        <option value ="東日本">東日本</option>
                        <option value ="西日本">西日本</option>
                        <option value ="その他">その他</option>
                        </select>
                    </td>
                </tr>

                <tr>
                    <td>oneword :</td>
                    <td>
                        <textarea name = "oneword" rows="5" cols="50"></textarea>
                    </td>
                </tr>
                    
                <tr>
                    <td>
                        <input type = "submit"></input>
                    </td>
                </tr>
                </form>
                </table>

                @foreach($threads as $thread)
                    <p>
                        {{ $thread->id }}&emsp;
                        名前 : <span class = "span">{{ $thread->bordname }}</span>&emsp;
                        {{ $thread->gender }}&emsp;
                        {{ $thread->address }}&emsp;
                        {{ $thread->created_at }}
                    </p>
                    <p>
                        {{ $thread->oneword }}
                    </p>
                @endforeach
                {{ $threads->links('vendor.pagination.default') }}
            @endif
            
        </header>


    </body>
</html>