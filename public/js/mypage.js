    
    document.addEventListener("DOMContentLoaded", (event) => {
        if(sessionStorage.getItem('cmtkey')){
            windowchange('comment');
            };
    });


    
    function windowchange(btnname){
        var tweeton = document.getElementById('tweeton');
        var commenton = document.getElementById('commenton');
        var formObject = document.getElementById('mypageform');

        tweeton.removeAttribute('style');
        commenton.removeAttribute('style');
        
        if(btnname == 'tweet'){
            tweeton.style.background = "plum";
            formObject.action = 'mypage';
            sessionStorage.clear();


        }else if(btnname == 'comment'){
            commenton.style.background = "plum";
            sessionStorage.setItem('cmtkey','cmt');
            formObject.action = 'mycmt';
        }
    }

    function sessionclear(){
        sessionStorage.clear();
    }