
function change(){
    var formObject = document.getElementById('leaveform');
    formObject.action = 'leave';
    }
  
function alert(){

        if(window.confirm('本当に退会してよろしいですか？')){
            change();
            return true;
        } else{
            return false;
        }
    }
