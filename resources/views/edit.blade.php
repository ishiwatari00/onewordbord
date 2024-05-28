<html>
    <style>
        .background{
        background: #DCDCDC;
        }
    </style>
    <head>
        <a href = "{{ url('/home') }}" >Home</a>
        @if(Auth::check())
        <a href = "{{ url('/mypage') }}" >mypage</a>
        {{ Auth::id() }}でログイン中
        @endif
        <meta charset="UTF-8">
    </head>
    <body class = "background">
        @if(Auth::check())
        <header>
            <h1>編集</h1>
        </header>
        <table>
                <form method = "post" action = "editcomp">
                @csrf
                <tr>
                    <td>name :</td>
                    <td><input type = "text" name = "bordname"></input></td>
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
                        <textarea name = "oneword" rows="5" cols="40"></textarea>
                    </td>
                </tr>
                    
                <tr>
                    <td>
                        <input type = "submit" value = "編集"></input>
                    </td>
                </tr>
                <input type = "hidden" name = "id" value = "{{ session('id') }}"></input>
            </form>
        @endif
    </body>
</html>