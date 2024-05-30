
function change(){
    var formObject = document.getElementById('deleteform');
    formObject.action = 'delete';
    }
  
function alert(){

        if(window.confirm('本当に削除してよろしいですか？')){
            change();
            return true;
        } else{
            return false;
        }
    }
