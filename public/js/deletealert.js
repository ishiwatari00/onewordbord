
function change(){
    var formObject = document.getElementById('deleteform');
    formObject.action = 'delete';
    }

function changecmt(){
        var formObject = document.getElementById('deleteform');
        formObject.action = 'deletecmt';
    }
  
function alert(){

        if(window.confirm('本当に削除してよろしいですか？')){
            change();
            return true;
        } else{
            return false;
        }
    }

function alertcmt(){

        if(window.confirm('本当に削除してよろしいですか？')){
            changecmt();
            return true;
        } else{
            return false;
        }
    }
