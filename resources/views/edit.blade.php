<html>
    <head>
        <a href = "{{ url('/home') }}" >Home</a>
        <a href = "{{ url('/mypage') }}" >mypage</a>
        <meta charset="UTF-8">
    </head>
    <body>
        <header>
            <h1>編集</h1>
        </header>
            <form method = "post" action = "editcomp">
            @csrf
                <input type = "text" name = "oneword"></input>
                <input type = "submit" value = "編集"></input>
                <input type = "hidden" name = "id" value = "{{ session('id') }}"></input>
            </form>
    </body>
</html>