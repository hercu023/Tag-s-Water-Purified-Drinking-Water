
// //////////////////////////////////////////////////////////////////////////////////////////
    checkbox.addEventListener( 'change', function() {
        localStorage.setItem('dark',this.checked);
        if(this.checked) {
             body.classList.add('dark')
        } else {
             body.classList.remove('dark')     
        }
        });
    
        if(localStorage.getItem('dark')) {
            body.classList.add('dark');
        }

    checkbox.addEventListener('click', checkMode);
    
    function checkMode(){
        if(checkbox.checked){
            darkModeOn();
        }
        else{
            darkModeOff();
        }
    }
    function darkModeOn(){
        document.body.classList.add("dark-theme");
    }
    function darkModeOff(){
        document.body.classList.remove("dark-theme");
    }
/////////////////////////////////////////////////////////////////////////////////////////////////////
    function menuToggle(){
        const toggleMenu = document.querySelector('.drop-menu');
        toggleMenu.classList.toggle('user2')
    }
   

//LOGIN PAGE------------------------------------------------------
function myFunction(){
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
//----------------------------------------------------------------
//Code Verification-------------------------------------------------
function isNumberKey(evt){
    var charCode = (evt.which) ? evt.which : evt.keyCode
    if (charCode > 31 && (charCode < 48 || charCode > 57))
        return false;
    return true;
}
//-----------------------------------------------------------------

//HOME PAGE--------------------------------------------------------
// function tableSearch(){
//     let input, filter, table, tr, lastname,
//      firstname, middlename, email, address, role, i, txtValue;

//     input = document.getElementById("searchInput");
//     filter = input.value.toUpperCase();
//     table = document.getElementById("myTable");
//     tr = table.getElementsByTagName("tr");

//     for(let i = 0; i < tr.length; i++){
//         lastname = tr[i].getElementsByTagName("td")[1];
//         firstname = tr[i].getElementsByTagName("td")[2];
//         middlename = tr[i].getElementsByTagName("td")[3];
//         email = tr[i].getElementsByTagName("td")[4];
//         address = tr[i].getElementsByTagName("td")[5];
//         role = tr[i].getElementsByTagName("td")[6];
//         if(lastname || firstname || middlename || email || address || role){
//             var lastname_value = lastname.textContent || lastname.innerText;
//             var firstname_value = firstname.textContent || firstname.innerText;
//             var middlename_value = middlename.textContent || middlename.innerText;
//             var email_value = email.textContent || email.innerText;
//             var address_value = address.textContent || address.innerText;
//             var role_value = role.textContent || role.innerText;

//             if(role_value.toUpperCase().indexOf(filter) > -1 ||
//                address_value.toUpperCase().indexOf(filter) > -1 ||
//                email_value.toUpperCase().indexOf(filter) > -1 ||
//                middlename_value.toUpperCase().indexOf(filter) > -1 ||
//                lastname_value.toUpperCase().indexOf(filter) > -1 ||
//                firstname_value.toUpperCase().indexOf(filter) > -1){
//                 tr[i].style.display ="";
//             }
//             else{
//                 tr[i].style.display = "none";
//             }
//         }
//     }
// }


//-----------------------------------------------------------------


