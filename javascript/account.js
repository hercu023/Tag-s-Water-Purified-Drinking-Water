
//    --------------------------------------------------------------------
//SHOW PASSWORD-------------------------------------------------
function myFunctionCP(){
    var x = document.getElementById("pass-account");
    var y = document.getElementById("cpass-account");
    if( x.type === 'password'){
        x.type = "text";
        y.type = "text";
    }else{
        x.type = "password";
        y.type = "password";
    }
}

// Add new User Message ----------------------------------------------------------------------------------
const regForm = document.querySelector(".form-registered");
const regBtn = document.querySelector(".AddButton");
var bgform = $('#form-registered');
var addform = $('#form-adduser1');
var addbtn = $("#adduserBtn");
var message = $(".message");

//
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
function addnewuser(){
    const addBtn = document.querySelector(".add-account");
    addForm.style.display = 'flex';
}
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
const sideMenu = document.querySelector("#aside");
const addForm = document.querySelector(".bg-adduserform");

const closeBtn = document.querySelector("#close-btn");
const cancelBtn = document.querySelector("#cancel");
// const addBtn = document.querySelector(".add-account");
const menuBtn = document.querySelector("#menu-button");
// const darktheme = document.querySelector('.dark-theme');
// const checkbox = document.getElementById("checkbox");
menuBtn.addEventListener('click', () =>{
    sideMenu.style.display = 'block';
})
closeBtn.addEventListener('click', () =>{
    sideMenu.style.display = 'none';
})
cancelBtn.addEventListener('click', () =>{
    addForm.style.display = 'none';
})
// if(email.value === '' || middlename.value === '' || firstname.value === '' || lastname.value === '' || contactnum.value === '' || role.value === '' || password.value === '' || confirmpassword.value === '' || profilepicture.value === ''){
// }else{

// }
addBtn.addEventListener('click', () =>{
    addForm.style.display = 'flex';
})

function menuToggle(){
    const toggleMenu = document.querySelector('.drop-menu');
    toggleMenu.classList.toggle('user2')
}


function tableSearch(){
    let input, filter, table, tr, lastname,
        firstname, middlename, email, contactnum, role, i;

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
                role_value.toUpperCase().indexOf(filter) > -1 ||
                firstname_value.toUpperCase().indexOf(filter) > -1) {
                tr[i].style.display ="";
            }
            else {
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