<html>
    <style>
        .background{
        background: #DCDCDC;
        }
    </style>
    <head>
        <a href = "{{ url('/home') }}" >Home</a>
        <meta charset="UTF-8">
    </head>
    <body class = "background">
        <header>
            <h1>アカウント登録</h1>
        </header>
            <form method = "post"  action = "insert">
                @csrf
                <table>
                <tr>
                    <td>ID</td>
                    <td><input type = "text" name = "username"></input></td>
                </tr>
                <tr>
                    <td>pass</td>
                    <td><input type = "text" name = "password"></input></td>
                </tr>
                </table>
                <input type = "submit" value = "登録"></input>
            </form>
    </body>
</html>