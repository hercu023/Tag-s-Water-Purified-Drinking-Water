//SHOW PASSWORD-------------------------------------------------
function myFunctionCP(){
    var x = document.getElementById("newpass");
    var y = document.getElementById("cpass");
    var z = document.getElementById("oldpass");
    if(x.type === 'password'){
        x.type = "text";
        y.type = "text";
        z.type = "text";
    }else{
        x.type = "password";
        y.type = "password";
        z.type = "password";
    }
}
// EDIT ACCOUNT--------------------------------------------------
document.querySelector("#myTable"),addEventListener("click", (e)=>{
    target = e.target;
    if(target.classList.contains("action-btn")){
        selectedRow = target.parentElement.parentElement;
        document.querySelector("#lastname").value = selectedRow.children[1].textContent;
        document.querySelector("#firstname").value = selectedRow.children[2].textContent;
        document.querySelector("#middlename").value = selectedRow.children[3].textContent;
        document.querySelector("#email").value = selectedRow.children[4].textContent;
        document.querySelector("#contactnum").value = selectedRow.children[5].textContent;
        // document.querySelector("#usertype").value = selectedRow.children[6].textContent;
        // document.querySelector("#image-profile").value = selectedRow.children[7].textContent;
    }
});

const regForm = document.querySelector(".form-registered");
const regBtn = document.querySelector(".AddButton");
var bgform = $('#form-registered1');
var addform = $('#cpass-container');
var addbtn = $("#cpassuserBtn");
var message = $(".message");

$(document).ready(function(){
    $('#cpassuserFrm').submit(function(e){
        e.preventDefault();
        $.ajax({
            type: 'post',
            url: 'controllerUserdata_account.php',
            // data: {password:password, id:id, oldpassword:oldpassword}
            data: new FormData(this),
            contentType: false,
            cache: false,
            processData: false,
            // 'submit=1&'+$form.serialize(),
            dataType: 'json',
            success: function(response){
                $(".message").css("display", "block");
                // if(response.status == 1){
                //     $("#form-registered1").css("display", "block");
                //     addform.hide();
                //     message.hide();
                //     $('#cpassuserFrm')[0].reset();
                // }else{
                $(".message").html('<p>'+response.message+'<p>');
                // }
            }
        });
    });
});
// $(document).ready(function(){
//     $('#cpassuserFrm').submit(function(e){
//         e.preventDefault();
//         var password = $("#cpass").val();
//         // var oldpassword = $("#newpass").val();

//         $.ajax({
//             type: 'post',
//             url: 'controllerUserdata_AJAX.php',
//             data: new FormData(this),
//             data: {password:cpass},
//             // contentType: false,
//             // cache: false,
//             // processData: false,
//             // 'submit=1&'+$form.serialize(),
//             dataType: 'html',
//             success: function(data){
//                 // $("#message").css("display", "block");
//                 $('#message').html(data);
//             // }else{
//             //     // $('#message').html(data);
//             // }
//                 }
//             // })
//                 // $(".message").css("display", "block");
//                 // if(response.status == 1){
//                 //     bgform.show();
//                 //     cpassform.hide();
//                 //     message2.hide();
//                     // $('#message').html(data);

//                 // }else  if(response.status == 2){
//                 //     bgform.show();
//                 //     addform.hide();
//                 //     message1.hide();
//                 //     $('#adduserFrm')[0].reset();

//             // }else{
//             //     $(".message").html('<p>'+response.message+'<p>');
//             // }
//                 })
//             });
//         });
// });
let btnClear = document.querySelector('#cancel');
// let btnClear1 = document.querySelector('#registered');
let inputs = document.querySelectorAll('#fill');
let pass = document.querySelectorAll('#pass');
let cpass = document.querySelectorAll('#cpass');
btnClear.addEventListener('click', () => {
    inputs.forEach(input => input.value = '');
    pass.forEach(input => input.value = '');
    cpass.forEach(input => input.value = '');
});

function isNumberKey(evt){
    var charCode = (evt.which) ? evt.which : evt.keyCode
    if (charCode > 31 && (charCode < 48 || charCode > 57))
        return false;
    return true;
}

const checkbox = document.getElementById('checkbox');
checkbox.addEventListener( 'change', () =>{
    document.body.classList.toggle('dark-theme');
});

// --------------------------------------Action Dropdown-------------------------------------- //
const actionsForm = document.querySelector(".bg-actionDropdown");
const actionsBtn = document.querySelector(".action-btn");
// actionsBtn.addEventListener('click', () =>{
//     actionsForm.style.display = 'block';
// })
function actionFunction(){
    // actionsForm.classList.toggle('bg-actionDropdown')
    actionsForm.style.display = 'flex';
}
function closeAction(){
    // actionsForm.classList.toggle('bg-actionDropdown')
    actionsForm.style.display = 'none';
}
const editBtn = document.querySelector(".edit");
const editForm = document.querySelector(".bg-editDropdown");

// editBtn.addEventListener('click', () =>{
//     editForm.style.display = 'flex';
//     })
function editAction(){
    editForm.style.display = 'flex';
    actionsForm.style.display = 'none';
}
const cpassBtn = document.querySelector(".changepass");
const cpassForm = document.querySelector(".bg-cpassDropdown");
function cpassAction(){
    cpassForm.style.display = 'flex';
    actionsForm.style.display = 'none';
}
const sideMenu = document.querySelector("#aside");
const addForm = document.querySelector(".bg-adduserform");

// const closeBtn = document.querySelector("#close-btn");
const cancelBtn = document.querySelector("#cancel");
const addBtn = document.querySelector(".add-account");
const adduserBtn = document.querySelector(".AddButton");
const menuBtn = document.querySelector("#menu-button");
// const darktheme = document.querySelector('.dark-theme');
// const checkbox = document.getElementById("checkbox");
menuBtn.addEventListener('click', () =>{
    sideMenu.style.display = 'block';
})

cancelBtn.addEventListener('click', () =>{
    addForm.style.display = 'none';
})

addBtn.addEventListener('click', () =>{
    addForm.style.display = 'flex';
})


function menuToggle(){
    const toggleMenu = document.querySelector('.drop-menu');
    toggleMenu.classList.toggle('user2')
}


function tableSearch(){
    let input, filter, table, tr, lastname,
        firstname, middlename, email, contactnum, role, i, txtValue;

    input = document.getElementById("searchInput");
    filter = input.value.toUpperCase();
    table = document.getElementById("myTable");
    tr = table.getElementsByTagName("tr");


    for(i = 0; i < tr.length; i++){

        lastname = tr[i].getElementsByTagName("td")[1];
        firstname = tr[i].getElementsByTagName("td")[2];
        middlename = tr[i].getElementsByTagName("td")[3];
        email = tr[i].getElementsByTagName("td")[4];
        contactnum = tr[i].getElementsByTagName("td")[5];
        role = tr[i].getElementsByTagName("td")[6];


        if(lastname || firstname || middlename || email || contactnum || role){
            var lastname_value = lastname.textContent || lastname.innerText;
            var firstname_value = firstname.textContent || firstname.innerText;
            var middlename_value = middlename.textContent || middlename.innerText;
            var email_value = email.textContent || email.innerText;
            var contactnum_value = contactnum.textContent || contactnum.innerText;
            var role_value = role.textContent || role.innerText;
            if(role_value.toUpperCase().indexOf(filter) > -1 ||
                contactnum_value.toUpperCase().indexOf(filter) > -1 ||
                email_value.toUpperCase().indexOf(filter) > -1 ||
                middlename_value.toUpperCase().indexOf(filter) > -1 ||
                lastname_value.toUpperCase().indexOf(filter) > -1 ||
                firstname_value.toUpperCase().indexOf(filter) > -1){
                tr[i].style.display ="";
            }
            else{
                tr[i].style.display = "none";
            }
            if($('#myTable tbody tr:visible').length === 0) {
                document.getElementById('noRecordTR').style.display = "";
            }else{
                document.getElementById('noRecordTR').style.display = "none";
            }
        }
        if($('#myTable tbody tr:visible').length === 0) {
            document.getElementById('noRecordTR').style.display = "";
        }else{
            document.getElementById('noRecordTR').style.display = "none";
        }
    }
}

// select.addEventListener('click', () => {
//     select.classList.toggle('select-action-clicked');
//     menu.classList.toggle('menu-action-open');

// });

// ///////////////////////////////////////////////////////////////////////////////////////////////////