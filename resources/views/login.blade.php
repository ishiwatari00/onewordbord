<html>
    <style>
        .background{
        background: #DCDCDC;
        }
    </style>
    <head>
        <a href = "{{ url('/register') }}" >register</a>
        <meta charset="UTF-8">
    </head>
    <body class = "background">
        <header>
            <h1>ログイン情報</h1>
        </header>
        <div>  
             @if ($errors->any())  
            <ul>  
                @foreach ($errors->all() as $error)  
                    <li>{{ $error }}</li>  
                @endforeach  
            </ul>  
            @endif  
        </div>
        @if (session('message'))
        <div class="alert alert-success text-center">
        {{ session('message') }}
        </div>
        @endif
        <br>
            <form method = "post" action = "loginkeep">
            @csrf
                <table>
                <tr>
                    <td>ID</td>
                    <td><input type = "text" name = "username"></input></td>
                </tr>
                <tr>
                    <td>password</td>
                    <td><input type = "text" name = "password"></input></td>
                </tr>
                </table>
                <input type = "submit" value = "ログイン"></input>
            </form>
    </body>
</html>