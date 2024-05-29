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
        <a href = "{{ url('/home') }}" >Home</a>
        {{ Auth::user()->username; }}でログイン中
        <meta charset="UTF-8">
    </head>
    <body class = "background">
        <header>
            <h1>削除してよろしいですか？</h1>
                    @foreach($threads as $thread)
                    <form method = "post" action = "delete">
                    @csrf
                        {{ $thread->id }}&emsp;
                        名前 : <span class = "span">{{ $thread->bordname }}</span>&emsp;
                        
                        @if($thread->gender == "1")
                        男
                        @elseif($thread->gender == "2")
                        女
                        @endif&emsp;

                        {{ $thread->address }}&emsp;
                        @foreach(config('allpref') as $pref_id => $pref)
                        @if($thread->address == "$pref_id")
                        {{$pref}}
                        @endif
                        @endforeach&emsp;
                        {{ $thread->created_at }}

                        <dd>{{ $thread->oneword }}</dd>
                        <input type = "hidden" name = "id" value = "{{ $thread->id }}"></input>
                        <input type = "submit" value = "削除"></input>
                    </form>
                    <button type = "button" onclick = "location.href='{{ url('/mypage') }}'">戻る</button>
                    @endforeach
        </header>
    </body>
</html>