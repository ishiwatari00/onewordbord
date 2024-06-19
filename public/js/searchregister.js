
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

        $('#memoform').on('submit',function(){      //メモ登録

            $.ajax({
                method:'POST',
                url:'addmemo',
                dataType: 'json',
                headers: {
                    'X-CSRF-Token' : $('meta[name="csrf-token"]').attr('content')
                },
                data:$('#memoform').serialize(),

                }).done(function (result){    
                    
                    let test = 
                    `
                    <li>
                        <div id = "memo` + result['id'] + `" class = "form_memo">
                            <form id = "memoform">                         
                                <button class="fa-solid fa-floppy-disk btnhover" value = "edit" name = "` + result['id'] + `"></button>
                                <button class="fa-solid fa-trash-can btnhover" value = "delete" name = "` + result['id'] + `"></button>
                                <input type = "hidden" id="memobtn" value="" name = ""></input>
                                <input type = "hidden" name = "id" value = "` + result['id'] + `"></input>
                                <input type = "hidden" name = "userid" value = "` + result['userid'] + `"></input>
                                >> ` + result['hostid'] + ` <span id = "memoone{` + result['id'] + `" contentEditable="true">` + result['oneword'] + `</span>
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
 //-----------------------------------------------------------------------------------------------       

        $(document).on('click', '#memoform button', function(event) {
            $('#memobtn').attr('value',$(this).attr('value'))
            $('#memobtn').attr('name',$(this).attr('name'))
            return true;
            });
 
        $(document).on('submit', '#memoform', function(event) {

            if(document.getElementById("memobtn").value == "delete"){

                var $form = $(this);

                $.ajax({
                    method:'POST',
                    url:'memodelete',
                    dataType: 'json',
                    headers: {
                        'X-CSRF-Token' : $('meta[name="csrf-token"]').attr('content')
                    },
                    data:$form.serialize(),

                    }).done(function (result){
                        $('#memo' + result['id']).remove();
                        alert('削除しました');
    
                    }).fail(function (){
                        alert('メモの削除が出来ませんでした。');

                    })
                    return false;

            }else if (document.getElementById('memobtn').value == "edit"){

                let memonum = document.getElementById('memobtn').name;
                let memoone = document.getElementById('memoone'+ memonum);

                var $form = $(this);
    
                    $.ajax({
                        method:'POST',
                        url:'memoedit',
                        dataType: 'json',
                        headers: {
                            'X-CSRF-Token' : $('meta[name="csrf-token"]').attr('content')
                        },
                        data:$form.serialize() + '&oneword=' + memoone.textContent,
        
                        }).done(function (result){
                            memoone.textContent =  result['oneword'];
                            alert('上書き保存しました');
          
                        }).fail(function (){
                            alert('メモの編集が出来ませんでした。');
        
                        })
                    return false;

                }
            })
        })

        
