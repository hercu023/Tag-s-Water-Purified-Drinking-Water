const addForm = document.querySelector(".bg-adduserform");

function addnewuser(){
    // const addBtn = document.querySelector(".add-customer");
    addForm.style.display = 'flex';
}

function loading() {
    document.querySelector(".loading").style.display = "flex";
    document.querySelector(".loader").style.display = "flex";
}
//    --------------------------------------------------------------------
    //Add New User
    function addnewuser(){
        document.querySelector(".bg-adduserform").style.display = 'flex';
    }
    setTimeout(function() {
        $('#myerror').fadeOut('fast');
    }, 3000);
    function myFunctionCP(){
    var x = document.getElementById("pass-account");
    var y = document.getElementById("cpass-account");
    if(x.type === 'password'){
        x.type = "text";
        y.type = "text";
    }else{
        x.type = "password";
        y.type = "password";
    }

}
function tableSearch(){
    var input, filter, table, tr, addedby,
    date, type, description, amount, id, datetime, i;

    input = document.getElementById("searchInput");
    filter = input.value.toUpperCase();
    table = document.getElementById("myTable");
    tr = table.getElementsByTagName("tr");


    for(i = 0; i < tr.length; i++){

        id = tr[i].getElementsByTagName("td")[0];
        date = tr[i].getElementsByTagName("td")[1];
        type = tr[i].getElementsByTagName("td")[2];
        amount = tr[i].getElementsByTagName("td")[3];
        description = tr[i].getElementsByTagName("td")[4];
        datetime = tr[i].getElementsByTagName("td")[5];
        addedby = tr[i].getElementsByTagName("td")[6];

        if(id || date || type || amount || description || datetime || addedby){
            var date_value = date.textContent || date.innerText;
            var id_value = id.textContent || id.innerText;
            var datetime_value = datetime.textContent || datetime.innerText;
            var amount_value = amount.textContent || amount.innerText;
            var addedby_value = addedby.textContent || addedby.innerText;
            var type_value = type.textContent || type.innerText;
            var description_value = description.textContent || description.innerText;

            if(date_value.toUpperCase().indexOf(filter) > -1 ||
                description_value.toUpperCase().indexOf(filter) > -1 ||
                id_value.toUpperCase().indexOf(filter) > -1 ||
                datetime_value.toUpperCase().indexOf(filter) > -1 ||
                middlename_value.toUpperCase().indexOf(filter) > -1 ||
                addedby_value.toUpperCase().indexOf(filter) > -1 ||
                amount_value.toUpperCase().indexOf(filter) > -1 ||
                type_value.toUpperCase().indexOf(filter) > -1) {
                tr[i].style.display ="";
            }else{
                tr[i].style.display = "none";
            }
            // if($('#myTable tbody tr:visible').length === 0) {
            //     document.getElementById('noRecordTR').style.display = "";
            // }else{
            //     document.getElementById('noRecordTR').style.display = "none";
            // }

        }
        if ($("#myTable tr:not('.noRecordTR, .table-heading'):visible").length == 0) {

        $("#myTable").find('.noRecordTR').show();
        }
        else {
        $("#myTable").find('.noRecordTR').hide();
        }
    }
}
//SHOW PASSWORD-------------------------------------------------


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


function menuToggle(){
    const toggleMenu = document.querySelector('.drop-menu');
    toggleMenu.classList.toggle('user2')
}


