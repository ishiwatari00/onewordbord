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
        <a href = "{{ url('/home') }}" >▶Home</a>
        <a href = "{{ url('/mypage') }}" >▶mypage</a>
        <a href = "{{ url('/logout') }}" >▶logout</a>
        {{ Auth::user()->username; }}でログイン中
        <meta charset="UTF-8">
        <meta charset="UTF-8">
    </head>
    <body class = "background">
        <header>
            <h1>退会するユーザー</h1>

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

            <script src="{{ asset('/js/alert.js') }}"></script>
                <table>
                    <form method = "post" id ="leaveform" onsubmit="return alert('leaveform','leave','退会')">
                    @csrf
                        <tr>
                        <td>ID</td>
                        <td>{{ Auth::user()->username; }}</td>
                        <input type = "hidden" name = "username" value = "{{ Auth::user()->username; }}"></input>
                        </tr>

                        <tr>
                            <td>password</td>
                            <td><input type = "text" name = "password"></input></td>
                        </tr>
                        
                        <tr>
                            <td>
                            <button type="button" onclick= "location.href='{{ url('/mypage') }}'">戻る</button>
                            </td>
                            <td>
                            <input type = "submit" value = "削除"></input>
                            </td>
                        </tr>
                    </form>
                </table>
        </header>
    </body>
</html>