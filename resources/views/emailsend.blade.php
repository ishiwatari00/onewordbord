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
            <h1>メールを送りました</h1>
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
            
            <p>受信したメールから登録を続けてください</p>
    </body>
</html>