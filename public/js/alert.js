
    function alert(form,link,msg){

        var formObject = document.getElementById(form);

            if(window.confirm('本当に'+ msg +'してよろしいですか？')){
                formObject.action = link;
                return true;
            } else{
                return false;
            }
    }
