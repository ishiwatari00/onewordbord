<html>
    <style>
        .background{
            background: #DCDCDC;
        }
        .span {
            color: green;
        }
        .cmtform{
            display: none;
        }
        .thread {
            border: solid 3px #c4c2c2;/*線色*/
            padding: 0.5em;/*文字周りの余白*/
            border-radius: 0.4em;/*角丸*/
            margin-bottom : 5px;
            padding-top : 15px;
            padding-bottom : 20px;
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
        .sortbtn{
            border: solid 1px
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
        <script src="{{ asset('/js/searchregister.js') }}"></script>
        <header>
            <h1>掲示板</h1>
            <!-- エラーメッセージ -->
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
                <!-- エラーメッセージend -->

                <table style="margin-bottom:30px">
                
                    <tr>
                        <td></td>
                        <td>
                            <button id = "tweeton" onclick = "windowchange('tweet')">📝</button>
                            <button id = "searchon" onclick = "windowchange('search')">🔍</button>
                            <button type= "button" onclick= "location.href='{{ url('/home') }}'">🔄</button>
                        </td>
                    </tr>

                <form  id ="homeform" onsubmit="return btnclick()" >
                @csrf
                <tr>
                    <td>名前 :</td>
                    <td><input type = "text" name = "bordname" size = "48px" value="{{ old('bordname') }}"></input></td>
                </tr>

                <tr>
                    <td>性別 :</td>
                    <td>
                        <input type = "radio" name = "gender" value = "1" @if(old('gender') == "1") checked @endif checked>♂</input>
                        <input type = "radio" name = "gender" value = "2" @if(old('gender') == "2") checked @endif>♀</input>
                    </td>
                </tr>

                <tr>
                    <td>住所 :</td>
                    <td>
                    <select name = "address">
                    <option value = "">🏠未選択</option>
                        @foreach(config('allpref') as $pref_id => $pref)
                        <option value = "{{ $pref_id }}" @if(old('address') == $pref_id) selected @endif>{{ $pref }}</option>
                        @endforeach
                    </select>
                    </td>
                </tr>

                <tr>
                    <td>一言 :</td>
                    <td>
                        <textarea name = "oneword" rows="5" cols="50">{{ old('oneword') }}</textarea>
                    </td>
                </tr>
                <tr>
                    <td>ソート：</td>
                    <td style = "sortbtn">
                    @sortablelink('bordname', '📛名前')
                    @sortablelink('created_at', '📅日付')
                    </td>                 
                </tr>
                <tr>
                    <td></td>
                    <td>
                        <input type = "submit" value = "投稿📝" id = "tweetbtn" onclick = 'formchange("post","tweet")' style = "display: none"></input>
                        <input type = "submit" value = "検索🔍" id = "searchbtn" onclick = 'formchange("get","search")' style = "display: none"></input>
                    </td>
                </tr>
                </form>
                </table>


<!------------------------------------スレッド一覧---------------------------->
                @foreach($threads as $thread)
                    <div class = "thread">
                        <dt>
                            {{ $thread->id }}&emsp;
                            名前 : <span class = "span">{{ $thread->bordname }}</span>&emsp;
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
                            
                            {{ $thread->created_at }}
                            <button onclick = "commentonoff({{ $thread->id }})">💬</button>
                        </dt>
                        <dd>
                            {{ $thread->oneword }}
                        </dd>
                    </div>

    <!-- -------------------コメント表示----------------------------->
            <div id = "cmtform{{ $thread->id }}" class = "cmtform">

                <!--コメントがあったらここに-->
                        @foreach($threadcmts as $threadcmt)
                            @if($thread->id == $threadcmt->hostid)
                            <div class = "thread2">
                            <dd>
                                名前 : <span class = "span">{{ $threadcmt->bordname }}</span>&emsp;
                            </dd>
                            <dd>
                                {{$threadcmt->oneword}}
                                <br>
                            </dd>
                            </div>
                            @endif                            
                        @endforeach

                    <!--コメント送信form-->
                    <form method = "post" action = "/comment">
                        @csrf
                        <div class = "thread2">
                        <dd>
                            <table>
                                <tr>
                                    <td>名前：</td>
                                    <td>
                                        <input type = "text" name = "bordname" size = "10px"></input>
                                    </td>
                                </tr>
                                
                                <tr>
                                    <td>返信：</td>
                                    <td>
                                        <textarea name = "oneword" rows="5" cols="35"></textarea>
                                    </td>
                                    <td>
                                        <button id = "commentbtn">送信💬</button>
                                    </td>
                                    <input type = "hidden" name = "hostid" value = "{{ $thread->id }}"></input>
                                </tr>
                            </table>
                        </dd>
                        </div>
                    </form>

            </div>
     <!-- -------------------コメント表示↑----------------------------->
                      
                @endforeach
                {{ $threads->appends(request()->query())->links('vendor.pagination.default')}}
        </header>
           
    </body>
</html>