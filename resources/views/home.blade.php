<html>
    <style>
        .background{
            background: linear-gradient(rgb(204, 204, 204), rgb(238, 237, 237));
        }
        .span {
            color: green;
        }
        .formnone{
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

        .ul_li{
            list-style: none;
            display:flex;
            -webkit-justify-content:flex-start;
            justify-content: flex-start;
        }
        .ul_li li:nth-of-type(n + 2) {
            margin-left: 10px;
            margin-right: 10px;
        }
        .ul_li li:nth-of-type(2) {
            margin-left: auto;
            margin-right: 10px;
        }
        
        .aqua{
            background: rgb(151, 211, 211);
            padding: 0.1em;
            margin-bottom : 20px;
        }

        .container{
            display: flex;
        }
        .main{
            width:70%;
        }
        .side{
            width:30%;
            border: solid 3px #c4c2c2;/*線色*/
            padding: 0.5em;/*文字周りの余白*/
            border-radius: 0.4em;/*角丸*/
            margin-left:10px;
        }
        
        .ul_memo{
            list-style: none;
        }
        .form_memo{
            display: flex;
        }

        .btnhover:hover {
        background-color:plum;
        cursor: pointer;
        }

    </style>
    
    <head>
        <script src="{{ asset('/js/searchregister.js') }}"></script>
        <script src="https://kit.fontawesome.com/62cac18309.js" crossorigin="anonymous"></script>
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <meta charset="UTF-8">
    </head>
   
    <body class = "background">

        <header>
            <div class = "aqua">
                <ul class = "ul_li">
                    <li style = "font-size: 150%"><i class="fa-solid fa-kiwi-bird"></i>&nbsp;掲示板</li>
                    <li>{{ Auth::user()->username; }}でログイン中</li>
                    <li><a href = "{{ url('/home') }}" ><i class="fa-solid fa-house"></i>Home</a></li>
                    <li><a href = "{{ url('/mypage') }}" ><i class="fa-solid fa-user"></i>mypage</a></li>
                    <li><a href = "{{ url('/logout') }}" ><i class="fa-solid fa-share-from-square"></i>logout</a></li>
                </ul>
            </div>
        </header>
            
            <!-- エラーメッセージ -->
                @if (session('message'))
                {{ session('message') }}
                @endif  
                    @if ($errors->any())  
                    <ul>  
                        @foreach ($errors->all() as $error)  
                            <li>{{ $error }}</li>  
                        @endforeach  
                    </ul>  
                    @endif
            <!-- エラーメッセージend -->

            <div class = "container">
            <div class = "main">
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
                        <input type = "submit" class = "btnhover" value = "投稿📝" id = "tweetbtn" onclick = 'formchange("post","tweet")' style = "display: none"></input>
                        <input type = "submit" class = "btnhover" value = "検索🔍" id = "searchbtn" onclick = 'formchange("get","search")' style = "display: none"></input>
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
                            <button class = "btnhover" onclick = "commentonoff({{ $thread->id }})">💬</button>

                            @if($thread->userid == Auth::id())
                            @endif
                        </dt>
                        <dd>
                            {{ $thread->oneword }}
                        </dd>
                    </div>

    <!-- -------------------コメント表示----------------------------->
            <div id = "cmtform{{ $thread->id }}" class = "formnone">

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
                                        <button class = "btnhover">送信💬</button>
                                    </td>
                                    <input type = "hidden" name = "hostid" value = "{{ $thread->id }}"></input>
                                </tr>
                            </table>
                        </dd>
                        </div>
                    </form>
            </div>
            @endforeach
        
     <!-- -------------------コメント表示↑----------------------------->
            {{ $threads->appends(request()->query())->links('vendor.pagination.default')}}
        </div>
        
    <!-- -------------------サイドバー↓----------------------------->
        <div id = "sidebar" class = "side">
            
                <p style ="text-align: center">メモ</p>

                    <form id = "memoform">
                        @csrf
                        <table>
                            <tr>
                                <td>ID :</td>
                                <td>
                                <textarea name = "hostid" rows="1" cols="10"></textarea>
                                </td>
                            </tr>
                            <tr>
                                <td>メモ :</td>
                                <td>
                                    <textarea name = "oneword" rows="5" cols="50"></textarea>
                                </td>
                                <td>
                                    <button class = "btnhover">保存<i class="fa-solid fa-pen"></i></button>
                                </td>
                            </tr>
                            <input type = "hidden" name = "userid" value = "{{ Auth::id() }}"></input>
                        </table>
                    </form>

                    <ul id = "memotable" class = "ul_memo">
                    @foreach($memos as $memo)
                        <li>
                        <div id = "memo{{$memo->id}}" class = "form_memo">
                            <form id = "memoform">                         
                                <button class="fa-solid fa-floppy-disk btnhover" value = "edit" name = "{{ $memo->id }}"></button>
                                <button class="fa-solid fa-trash-can btnhover" value = "delete" name = "{{ $memo->id }}"></button>
                                <input type = "hidden" id="memobtn" value="" name = ""></input>
                                <input type = "hidden" name = "id" value = "{{ $memo->id }}"></input>
                                <input type = "hidden" name = "userid" value = "{{ $memo->userid }}"></input>
                                >> {{ $memo->hostid }} <span id = "memoone{{ $memo->id }}" contentEditable="true">{{ $memo->oneword }}</span>
                            </form>
                        </div>
                        </li>
                    @endforeach
                    <ul>     
        </div>
    </body>
</html>