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
        <a href = "{{ url('/mypage') }}" >mypage</a>
        <a href = "{{ url('/logout') }}" >logout</a>
        {{ Auth::user()->username; }}でログイン中
        <meta charset="UTF-8">
    </head>
    <body class = "background">
        <header>
            <h1>掲示板</h1>
            <div>  
             @if ($errors->any())  
            <ul>  
                @foreach ($errors->all() as $error)  
                    <li>{{ $error }}</li>  
                @endforeach  
            </ul>  
            @endif  
            </div>
                <table style="margin-bottom:30px">
                <form method = "post" action = "tweet">
                @csrf
                <tr>
                    <td>名前 :</td>
                    <td><input type = "text" name = "bordname" value  = "以下、名無しに代わりましてVIPがお送りします。" size = "48px"></input></td>
                </tr>

                <tr>
                    <td>性別 :</td>
                    <td>
                        <input type = "radio" name = "gender" value = "♂">♂</input>
                        <input type = "radio" name = "gender" value = "♀">♀</input>
                    </td>
                </tr>

                <tr>
                    <td>住所 :</td>
                    <td>
                        <select name = "address">
                        <option value ="">-- 選択 --</option>
                        <option value ="東日本">東日本</option>
                        <option value ="西日本">西日本</option>
                        <option value ="その他">その他</option>
                        </select>
                    </td>
                </tr>

                <tr>
                    <td>一言 :</td>
                    <td>
                        <textarea name = "oneword" rows="5" cols="50"></textarea>
                    </td>
                </tr>
                    
                <tr>
                    <td></td>
                    <td>
                        <input type = "submit" value = "書き込む"></input>
                    </td>
                </tr>
                </form>
                </table>

                @foreach($threads as $thread)
                    <dt>
                        {{ $thread->id }}&emsp;
                        名前 : <span class = "span">{{ $thread->bordname }}</span>&emsp;
                        {{ $thread->gender }}&emsp;
                        {{ $thread->address }}&emsp;
                        {{ $thread->created_at }}
                    </dt>
                    <dd>
                        {{ $thread->oneword }}
                    </dd>
                    <br>
                @endforeach
                {{ $threads->links('vendor.pagination.default') }}
            
        </header>


    </body>
</html>