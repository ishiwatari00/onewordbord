    function windowchange(btnname){
        var tweetthread = document.getElementById('tweetthread');
        var commentthread = document.getElementById('commentthread');
        var tweeton = document.getElementById('tweeton');
        var commenton = document.getElementById('commenton');

        tweetthread.removeAttribute('style');
        commentthread.removeAttribute('style');
        tweeton.removeAttribute('style');
        commenton.removeAttribute('style');
        
        if(btnname == 'tweet'){
            
            commentthread.style.display="none";
            tweeton.style.background = "plum";

        }else if(btnname == 'comment'){

            tweetthread.style.display="none";
            commenton.style.background = "plum";
        }
    }