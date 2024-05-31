
function tweetonclick(){
    var formObject = document.getElementById('homeform');
    formObject.method = 'post';
    formObject.action = 'tweet';
    ;btnclick()
}

function searchonclick(){
    var formObject = document.getElementById('homeform');
    formObject.method = 'get';
    formObject.action = 'search';
    btnclick();
}

function btnclick(){
    return true;
}

function tweetwindow(){
    var searchbtn2 = document.getElementById('searchbtn');
    var tweetbtn2 = document.getElementById('tweetbtn');
    var searchon2 = document.getElementById('searchon');
    var tweeton2 = document.getElementById('tweeton');
    searchbtn2.style.display="none";
    tweetbtn2.style.display="";
    searchon2.style.background = "";
    tweeton2.style.background = "plum";
}

function searchwindow(){
    var searchbtn2 = document.getElementById('searchbtn');
    var tweetbtn2 = document.getElementById('tweetbtn');
    var searchon2 = document.getElementById('searchon');
    var tweeton2 = document.getElementById('tweeton');
    searchbtn2.style.display="";
    tweetbtn2.style.display="none";
    searchon2.style.background = "plum";
    tweeton2.style.background = "";
}

