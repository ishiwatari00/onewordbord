<html>
    <style>
        .background{
        background: #DCDCDC;
        }
    </style>
    <head>
        <a href = "{{ url('/login') }}" >▶login</a>
        <meta charset="UTF-8">
    </head>
    <body class = "background">
        <header>
            <h1>アカウント登録</h1>
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
                    @if($error)
                    @endif  
                @endforeach  
            </ul>
        @else
            <form method = "post"  action = "insert">
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
                    <input type = "hidden" name = "token" value = {{ $token }}></input>
                </table>
                <input type = "submit" value = "登録"></input>
            </form>
        @endif
        </div> 
    </body>
</html>