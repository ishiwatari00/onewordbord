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
                @endforeach  
            </ul>  
        @endif  
        </div>
            <form method = "post"  action = "emailsend">
                @csrf
                <table>
                <tr>
                    <td>email</td>
                    <td><input type = "text" name = "email" size = "25px"></input></td>
                </tr>
                </table>
                <input type = "submit" value = "登録"></input>
            </form>
    </body>
</html>