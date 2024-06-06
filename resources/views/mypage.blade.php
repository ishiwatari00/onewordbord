<html>
    <style>
        .background{
        background: #DCDCDC;
        }
        .span {
        color: green;
        }
        .thread {
        border: solid 3px #c4c2c2;/*線色*/
        padding: 0.5em;/*文字周りの余白*/
        border-radius: 0.4em;/*角丸*/
        margin-bottom : 5px;
        padding-top : 15px;
        padding-bottom : 10px;
        }
        .thread2 {
        border: solid 3px #c4c2c2;/*線色*/
        padding: 0.5em;/*文字周りの余白*/
        border-radius: 0.4em;/*角丸*/
        margin-bottom : 5px;
        margin-left:50px;
        padding-top : 15px;
        padding-bottom : 20px;
        }
    </style>
    
    <head>
        <a href = "{{ url('/home') }}" onclick = "sessionclear()">▶Home</a>
        <a href = "{{ url('/usereditcheck') }}" onclick = "sessionclear()">▶edit</a>
        <a href = "{{ url('/leavecheck') }}" onclick = "sessionclear()">▶Leave</a>
        {{ Auth::user()->username; }}でログイン中
        <meta charset="UTF-8">
    </head>
    <body class = "background">
        <script src="{{ asset('/js/mypage.js') }}"></script>
        <header>

            <h1>自分の投稿</h1>
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

        </header>

        <form method = "get" id = "mypageform">
            <input type = "submit" value = "📝" id = "tweeton" onclick = "windowchange('tweet')" style = "background:plum"></input>
            <input type = "submit" value = "💬" id = "commenton" onclick = "windowchange('comment')"></input>
        </form>

            <!------------スレッド一覧----------------->
            <div id = "tweetthread">
                @foreach($threads as $thread)
                    <div class = "thread">
                    <form method = "get">
                    @csrf
                        <dt>
                            {{ $thread->id }}&emsp;
                            名前 : <span class = "span">{{ $thread->bordname }}</span>&emsp;
                        
                            @if($thread->gender && $thread->address )
                                @if($thread->gender == "1")
                                ♂
                                @elseif($thread->gender == "2")
                                ♀
                                @endif&emsp;

                                @foreach(config('allpref') as $pref_id => $pref)
                                @if($thread->address == "$pref_id")
                                {{$pref}}
                                @endif
                                @endforeach&emsp;
                            @endif

                            {{ $thread->created_at }}
                            <input type = "submit" value = "編集" formaction = "/edit" onclick = "sessionclear()"></input>
                            <input type = "submit" value = "削除" formaction = "/deletecheck" onclick = "sessionclear()"></input>
                            <input type = "hidden" value = "{{ $thread->id }}" name = "id"></input>
                        </dt>
                        <dd>
                            {{ $thread->oneword }}
                        </dd>
                    </form>
                    </div>
                    
                    @if($thread->gender && $thread->address )
                        @foreach($threadcmts as $threadcmt)
                            @if($thread->id == $threadcmt->hostid)
                            <div class = "thread2">
                            <dd>
                                名前 : <span class = "span">{{ $threadcmt->bordname }}</span>&emsp;
                            </dd>
                            <dd>
                                {{$threadcmt->oneword}}
                            </dd>
                            </div>
                            @endif                            
                        @endforeach
                    @endif

                    @endforeach

                {{ $threads->links('vendor.pagination.default') }}
            </div>
                <!------------スレッド一覧----------------->
    </body>
</html>