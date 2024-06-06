
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
        cmtform.classList.toggle('cmtform');
    }

    