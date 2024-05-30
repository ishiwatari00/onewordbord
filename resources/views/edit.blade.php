<html>
    <style>
        .background{
        background: #DCDCDC;
        }
    </style>
    <head>
        <a href = "{{ url('/home') }}" >Home</a>
        <a href = "{{ url('/mypage') }}" >mypage</a>
        {{ Auth::user()->username; }}でログイン中
        <meta charset="UTF-8">
    </head>
    <body class = "background">
        <header>
            <h1>編集</h1>
        </header>
        @if (session('message'))
        <div>
        {{ session('message') }}
        </div>
        @endif
        <div>  
             @if ($errors->any())  
            <ul>  
                @foreach ($errors->all() as $error)  
                    <li>{{ $error }}</li>  
                @endforeach  
            </ul>  
            @endif  
        </div>
        <script src="{{ asset('/js/editalert.js') }}"></script>
        <table style="margin-bottom:30px">
            <form method = "post"  id ="editform" onsubmit="return alert()">
                @csrf
                <tr>
                    <td>名前 :</td>
                    <td><input type = "text" name = "bordname" value  = "以下、名無しに代わりましてVIPがお送りします。" size = "48px"></input></td>
                </tr>

                <tr>
                    <td>性別 :</td>
                    <td>
                        <input type = "radio" name = "gender" value = "1">♂</input>
                        <input type = "radio" name = "gender" value = "2">♀</input>
                    </td>
                </tr>

                <tr>
                    <td>住所 :</td>
                    <td>
                    <select name = "address">
                    @foreach(config('allpref') as $pref_id => $pref)
                    <option value = "{{ $pref_id }}">{{ $pref }}</option>
                    @endforeach
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
                        <button type="button" onclick= "location.href='{{ url('/mypage') }}'">戻る</button>
                        <input type = "submit" value = "編集"></input>
                    </td>
                </tr>
                <input type = "hidden" name = "id" value = "{{ $id }}"></input>
            </form>
        </table>
    </body>
</html>