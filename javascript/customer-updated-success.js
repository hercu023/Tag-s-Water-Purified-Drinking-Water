const regForm = document.querySelector(".form-registered");
const regBtn = document.querySelector(".AddButton");
var bgform = $('#form-registered1');
var addform = $('#form-addcustomer1');
var addbtn = $("#addcustomerBtn");
var message = $(".message");

// $(document).ready(function(){
//     $('#addcustomerFrm').submit(function(e){
//         e.preventDefault();

//         $.ajax({
//             type: 'post',
//             url: 'controllerUserdata_customers.php',
//             data: new FormData(this),
//             contentType: false,
//             cache: false,
//             processData: false,
//             // 'submit=1&'+$form.serialize(),
//             dataType: 'json',
//             success: function(response){
//                 $(".message").css("display", "block");
//                 if(response.status == 1){
//                     $("#form-registered1").css("display", "block");
//                     addform.hide();
//                     message.hide();
//                     $('#addcustomerFrm')[0].reset();
//             }else{
//                 $(".message").html('<p>'+response.message+'<p>');
//             }
//                 }
//             });
//         });
//     });


let btnClear = document.querySelector('#cancel');
// let btnClear1 = document.querySelector('#registered');
let inputs = document.querySelectorAll('#fill');

btnClear.addEventListener('click', () => {
    inputs.forEach(input => input.value = '');
});
// btnClear1.addEventListener('click', () => {
//     inputs.forEach(input => input.value = '');
// });

function isNumberKey(evt){
    var charCode = (evt.which) ? evt.which : evt.keyCode
    if (charCode > 31 && (charCode < 48 || charCode > 57))
        return false;
    return true;
}

const checkbox = document.getElementById('checkbox');
checkbox.addEventListener( 'change', () =>{
    document.body.classList.toggle('dark-theme');
    //     if(this.checked) {
    //         body.classList.add('dark')
    //     } else {
    //         body.classList.remove('dark')
    //     }
});



const sideMenu = document.querySelector("#aside");
const addForm = document.querySelector(".bg-addcustomerform");


const cancelBtn = document.querySelector("#cancel");
const addBtn = document.querySelector(".add-customer");
const addcustomerBtn = document.querySelector(".AddButton");

const menuBtn = document.querySelector("#menu-button");

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
        firstname, address, contactnum, i, txtValue;

    input = document.getElementById("searchInput");
    filter = input.value.toUpperCase();
    table = document.getElementById("myTable");
    tr = table.getElementsByTagName("tr");

    for(let i = 0; i < tr.length; i++){
        lastname = tr[i].getElementsByTagName("td")[1];
        firstname = tr[i].getElementsByTagName("td")[2];
        address = tr[i].getElementsByTagName("td")[3];
        contactnum = tr[i].getElementsByTagName("td")[4];
        if(lastname || firstname || address || contactnum){
            var lastname_value = lastname.textContent || lastname.innerText;
            var firstname_value = firstname.textContent || firstname.innerText;
            var contactnum_value = contactnum.textContent || contactnum.innerText;
            var address_value = address.textContent || address.innerText;

            if(address_value.toUpperCase().indexOf(filter) > -1 ||
                contactnum_value.toUpperCase().indexOf(filter) > -1 ||
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
    if($('#myTable tbody tr:visible').length === 0) {
        document.getElementById('noRecordTR').style.display = "";
    }else{
        document.getElementById('noRecordTR').style.display = "none";
    }
}
const dropdowns = document.querySelectorAll(".usertype-dropdown");
dropdowns.forEach(dropdown =>{
    const select = dropdown.querySelector(".select");
    const caret = dropdown.querySelector(".caret");
    const menu = dropdown.querySelector(".menu");
    const options = dropdown.querySelectorAll(".menu li");
    const selected = dropdown.querySelector(".selected");

    select.addEventListener('click', () => {
        select.classList.toggle('select-clicked');
        caret.classList.toggle('caret-rotate');
        menu.classList.toggle('menu-open');
    });
    options.forEach(option => {
        option.addEventListener('click', () =>{
            select.innerText = option.innerText;
            select.classList.remove('select-clicked');
            caret.classList.remove('caret-rotate');
            menu.classList.remove('menu-open');
            options.forEach(option => {
                option.classList.remove('active');
            });
            option.classList.add('active');
        });
    });
});