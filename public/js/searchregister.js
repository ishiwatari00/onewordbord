
    document.addEventListener("DOMContentLoaded", (event) => {
        if(sessionStorage.getItem('searchkey')){
            windowchange('search');
            sessionStorage.clear();
            };
    });

    function formchange(method,action){
        var formObject = document.getElementById('homeform');
        formObject.method = method;
        formObject.action = action;

        if(method == 'get'){
        sessionStorage.searchkey = 'on';
        }
        
        return true;
    }

    function windowchange(btnname){
        var searchbtn = document.getElementById('searchbtn');
        var tweetbtn = document.getElementById('tweetbtn');
        var searchon = document.getElementById('searchon');
        var tweeton = document.getElementById('tweeton');

        searchbtn.removeAttribute('style');
        tweetbtn.removeAttribute('style');
        searchon.removeAttribute('style');
        tweeton.removeAttribute('style');
        
        if(btnname == 'tweet'){
            
            searchbtn.style.display="none";
            tweeton.style.background = "plum";

        }else if(btnname == 'search'){

            tweetbtn.style.display="none";
            searchon.style.background = "plum";
        }
    }

    function commentonoff(threadid){
        var cmtform = document.getElementById('cmtform' + threadid);
        cmtform.classList.toggle('formnone');
    }
    
    window.addEventListener('load', function(){


        $('#memoform').on('submit',function(){

            $.ajax({
                method:'POST',
                url:'addmemo',
                dataType: 'json',
                headers: {
                    'X-CSRF-Token' : $('meta[name="csrf-token"]').attr('content')
                },
                data:$('#memoform').serialize(),

                }).done(function (result){    
                    
                    let test = `
                    <li>
                    <div id = "memo` + result['id'] + `" class = "form_memo">
                        <form id = "memoedit">                         
                            <button><i class="fa-solid fa-pen"></i></button>
                        </form>
                        <form id = "memodelete">
                            <button><i class="fa-solid fa-trash-can"></i></button>
                            <input type = "hidden" name = "id" value = "` + result['id'] + `"></input>
                            <input type = "hidden" name = "userid" value = "` + result['userid'] + `"></input>
                            >> ` + result['hostid'] + ' ' + result['oneword'] + `           
                        </form>
                    </div>
                    </li>
                    `

                    $('#memotable').append(test);
                    console.log(result['id']);
  
                }).fail(function (){
                    alert('メモの追加が出来ませんでした。');

                })
            return false;
        })

        $(document).on('submit', 'form#memoedit',function(){ //編集

            $.ajax({
                method:'POST',
                url:'memoedit',
                dataType: 'json',
                headers: {
                    'X-CSRF-Token' : $('meta[name="csrf-token"]').attr('content')
                },
                data:$(this).serialize(),

                }).done(function (result){
                    $('#memo' + result['id']);
  
                }).fail(function (){
                    alert('メモの編集が出来ませんでした。');

                })
            return false;
        })

        $(document).on('submit', 'form#memodelete',function(){

            $.ajax({
                method:'POST',
                url:'memodelete',
                dataType: 'json',
                headers: {
                    'X-CSRF-Token' : $('meta[name="csrf-token"]').attr('content')
                },
                data:$(this).serialize(),

                }).done(function (result){
                    $('#memo' + result['id']).remove();
  
                }).fail(function (){
                    alert('メモの削除が出来ませんでした。');

                })
            return false;
        })
            
    })

    //練習用
    $('#memoone').attr('span', 'textarea');
