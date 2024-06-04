    function change(){
        var formObject = document.getElementById('editform');
        formObject.action = 'editcomp';
        }
    
    function changecmt(){
        var formObject = document.getElementById('editform');
            formObject.action = 'editcmtcomp';
        }
      
    function alert(){
    
            if(window.confirm('本当に編集してよろしいですか？')){
                change();
                return true;
            } else{
                return false;
            }
        }
    
    function alertcmt(){
    
            if(window.confirm('本当に編集してよろしいですか？')){
                changecmt();
                return true;
            } else{
                return false;
            }
        }