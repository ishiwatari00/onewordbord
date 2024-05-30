
function change(){
    var formObject = document.getElementById('editform');
    formObject.action = 'editcomp';
    }
  
function alert(){

        if(window.confirm('本当に編集してよろしいですか？')){
            change();
            return true;
        } else{
            return false;
        }
    }
