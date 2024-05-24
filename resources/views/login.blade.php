<html>
    <head>
        <a href = "{{ url('/home') }}" >Home</a>
        <meta charset="UTF-8">
    </head>
    <body>
        <header>
            <h1>ログイン情報</h1>
        </header>
            <form method = "post" action = "loginkeep">
            @csrf
                <table>
                <tr>
                    <td>ID</td>
                    <td><input type = "text" name = "username"></input></td>
                </tr>
                <tr>
                    <td>pass</td>
                    <td><input type = "text" name = "pass"></input></td>
                </tr>
                </table>
                <input type = "submit" value = "ログイン"></input>
            </form>
    </body>
</html>