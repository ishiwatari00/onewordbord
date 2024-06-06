<html>
    <style>
        .background{
        background: #DCDCDC;
        }
    </style>
    <head>
        <a href = "{{ url('/home') }}" >▶Home</a>
        <a href = "{{ url('/mypage') }}" >▶mypage</a>
        <a href = "{{ url('/logout') }}" >▶logout</a>
        {{ Auth::user()->username; }}でログイン中
        <meta charset="UTF-8">
    </head>
    <body class = "background">
        <header>
            <h1>アカウント情報編集</h1>
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
            <form method = "post" action = "useredit">
            @csrf
                <table>
                <tr>
                    <td>ID</td>
                    <td><input type = "text" name = "username" size = "25px" value = "{{ Auth::user()->username; }}"></input></td>
                    <input type = "hidden" name = "id" value = "{{ Auth::id(); }}"></input>
                </tr>
                <tr>
                    <td>email</td>
                    <td><input type = "text" name = "email" size = "25px"></input></td>
                </tr>
                <tr>
                    <td>password</td>
                    <td><input type = "text" name = "password" size = "25px"></input></td>
                </tr>
                </table>
                <input type = "submit" value = "編集"></input>
            </form>
    </body>
</html>