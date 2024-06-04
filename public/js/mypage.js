
function tweetwindow(){
    var commentthread2 = document.getElementById('commentthread');
    var tweetthread2 = document.getElementById('tweetthread');
    var commenton2 = document.getElementById('commenton');
    var tweeton2 = document.getElementById('tweeton');
    commentthread2.style.display="none";
    tweetthread2.style.display="";
    commenton2.style.background = "";
    tweeton2.style.background = "plum";
}

function commentwindow(){
    var commentthread2 = document.getElementById('commentthread');
    var tweetthread2 = document.getElementById('tweetthread');
    var commenton2 = document.getElementById('commenton');
    var tweeton2 = document.getElementById('tweeton');
    commentthread2.style.display="";
    tweetthread2.style.display="none";
    commenton2.style.background = "plum";
    tweeton2.style.background = "";
}
