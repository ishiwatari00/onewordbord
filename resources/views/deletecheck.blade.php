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
            <h1>削除するレコード</h1>
            <script src="{{ asset('/js/deletealert.js') }}"></script>
                    @foreach($threads as $thread)
                    <form method = "post" id ="deleteform" onsubmit="return alert()">
                    @csrf
                        {{ $thread->id }}&emsp;
                        名前 : <span class = "span">{{ $thread->bordname }}</span>&emsp;
                        
                        @if($thread->gender == "1")
                        ♂
                        @elseif($thread->gender == "2")
                        ♀
                        @endif&emsp;

                        {{ $thread->address }}&emsp;
                        @foreach(config('allpref') as $pref_id => $pref)
                        @if($thread->address == "$pref_id")
                        {{$pref}}
                        @endif
                        @endforeach&emsp;
                        {{ $thread->created_at }}

                        <dd>{{ $thread->oneword }}</dd>
                        <input type = "hidden" name = "id"  value = "{{ $thread->id }}"></input>
                        <button type="button" onclick= "location.href='{{ url('/mypage') }}'">戻る</button>
                        <input type = "submit" value = "削除"></input>
                    </form>
                    @endforeach
        </header>
    </body>
</html>