<html>
    <style>
        .background{
        background: #DCDCDC;
        }
    </style>
    <head>
        <a href = "{{ url('/emailregister') }}" >▶register</a>
        <meta charset="UTF-8">
    </head>
    <body class = "background">
        <header>
            <h1>ログイン情報</h1>
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
            <form method = "post" action = "loginkeep">
            @csrf
                <table>
                <tr>
                    <td>ID</td>
                    <td><input type = "text" name = "username" size = "25px"></input></td>
                </tr>
                <tr>
                    <td>password</td>
                    <td><input type = "text" name = "password" size = "25px"></input></td>
                </tr>
                </table>
                <input type = "submit" value = "ログイン"></input>
            </form>
    </body>
</html>