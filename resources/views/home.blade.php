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
        <a href = "{{ url('/mypage') }}" >mypage</a>
        <a href = "{{ url('/logout') }}" >logout</a>
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
                        <button id = "tweeton" onclick = "tweetwindow()">📝</button>
                        <button id = "searchon" onclick = "searchwindow()">🔍</button>
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
                    <option value = "">-未選択-</option>
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
                
                <div style = "display:none;">
                <tr>
                    <td></td>
                    <td>
                        <input type = "submit" value = "投稿📝" id = "tweetbtn" onclick = 'tweetonclick()' style = "display: none"></input>
                        <input type = "submit" value = "検索🔍" id = "searchbtn" onclick = 'searchonclick()' style = "display: none"></input>
                    </td>
                </tr>
                </div>
                </form>
                </table>


<!------------------------------------スレッド一覧---------------------------->
                @foreach($threads as $thread)
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
                    </dt>
                    <dd>
                        {{ $thread->oneword }}
                    </dd>
                    <br>
                @endforeach
                {{ $threads->appends(request()->query())->links('vendor.pagination.default')}}
        </header>
           
    </body>
</html>