<html>
    <style>
        .background{
        background: #DCDCDC;
        }
    </style>
    <head>
        <a href = "{{ url('/home') }}" >Home</a>
        <a href = "{{ url('/mypage') }}" >mypage</a>
        {{ Auth::user()->username; }}でログイン中
        <meta charset="UTF-8">
    </head>
    <body class = "background">
        <header>
            <h1>編集</h1>
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
        <script src="{{ asset('/js/editalert.js') }}"></script>
        <table style="margin-bottom:30px">
            @foreach($threads as $thread)
            @if($thread->gender && $thread->address )
                <form method = "post" id ="editform" onsubmit="return alert()">
            @else
                <form method = "post" id ="editform" onsubmit="return alertcmt()">
            @endif
                @csrf
                <tr>
                    <td>名前 :</td>
                    <td><input type = "text" name = "bordname" value  = "{{ old('bordname',$thread->bordname) }}" size = "48px"></input></td>
                </tr>

                @if($thread->gender && $thread->address )
                <tr>
                    <td>性別 :</td>
                    <td>
                        <input type = "radio" name = "gender" value = "1" @if(old('gender',$thread->gender) == 1)checked @endif>♂</input>
                        <input type = "radio" name = "gender" value = "2" @if(old('gender',$thread->gender) == 2)checked @endif>♀</input>
                    </td>
                </tr>

                <tr>
                    <td>住所 :</td>
                    <td>
                    <select name = "address">
                    @foreach(config('allpref') as $pref_id => $pref)
                    @if($pref_id == old('address',$thread->address))
                    <option value = "{{ $pref_id }}" selected>{{ $pref }}</option>
                    @else
                    <option value = "{{ $pref_id }}">{{ $pref }}</option>
                    @endif
                    @endforeach
                    </select>
                    </td>
                </tr>
                @endif

                <tr>
                    <td>一言 :</td>
                    <td>
                        <textarea name = "oneword" rows="5" cols="50">{{ old('oneword',$thread->oneword) }}</textarea>
                    </td>
                </tr>
                <tr>
                    <td></td>
                    <td>
                        <input type = "submit" value = "編集"></input>
                    </td>
                </tr>
                <input type = "hidden" name = "id" value = "{{ $thread->id }}"></input>
                <input type = "hidden" name = "userid" value = "{{ $thread->userid }}"></input>
            </form>
            @endforeach
        </table>
    </body>
</html>