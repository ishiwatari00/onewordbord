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
        <table>
                <form method = "post">
                @csrf
                <tr>
                    <td>名前 :</td>
                    <td><input type = "text" name = "bordname"></input></td>
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
                        <option value ="東日本">東日本</option>
                        <option value ="西日本">西日本</option>
                        <option value ="その他">その他</option>
                        </select>
                    </td>
                </tr>

                <tr>
                    <td>一言 :</td>
                    <td>
                        <textarea name = "oneword" rows="5" cols="40"></textarea>
                    </td>
                </tr>
                    
                <tr>
                    <td>
                        <input type = "submit" value = "戻る" formaction = "edit"></input>
                        <input type = "submit" value = "編集" formaction = "editcomp"></input>
                    </td>
                </tr>
                <input type = "hidden" name = "id" value = "{{ session('id') }}"></input>
            </form>
    </body>
</html>