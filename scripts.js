// <!-- <script type="text/javascript">
// $(funciton(){
//     $("#submitBtn").click(function disable(x){
//         var y = document.getElementById("continue");
//         var x = document.getElementById("submitBtn");
//         y.style.display = 'block';
//         x.style.display = "none";
//     });
// });
     
    
   
    // 
    // });
    //  const disable = () => {
    //     const name = document.querySelector("#email");
    //     name.value="";
    //     name.focus();
    //  };
    
    // $("#submitBtn").attr("disabled", true);
    
    // }
    //  $('.disable-form').on('submit', function(x){
            
    //             var self = $(this),
    //                 button = self.find('input[type="submit"], button'),
    //                 submitValue = button.data('submit-value');

    //             button.attr('disabled', 'disabled').val((submitValue) ? submitValue : 'Please Wait...');
    //             return false;
    //         });

//LOGIN PAGE------------------------------------------------------
    function myFunction(){
        var x = document.getElementById("pass");
        var y = document.getElementById("hide");
        var z = document.getElementById("unhide");

        if(x.type === 'password'){
            x.type = "text";
            z.style.display = "block";
            y.style.display = "none";
        }else{
            x.type = "password";
            y.style.display = "block";
            z.style.display = "none";
        }
    }  
//----------------------------------------------------------------

//CHANGE PASSWORD-------------------------------------------------
function myFunctionCP(){
    var x = document.getElementById("pass");
    var y = document.getElementById("changepass");
    if(x.type === 'password'){
        x.type = "text";
        y.type = "text";
    }else{
        x.type = "password";
        y.type = "password";
    }
}  
//-----------------------------------------------------------------

//HOME PAGE--------------------------------------------------------

//-----------------------------------------------------------------


