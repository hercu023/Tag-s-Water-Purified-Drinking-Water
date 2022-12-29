// -----------------------------SIDE MENU
$(document).ready(function(){
    //jquery for toggle sub menus
    $('.sub-btn').click(function(){
        $(this).next('.sub-menu').slideToggle();
        $(this).find('.dropdown').toggleClass('rotate');
    });

    //jquery for expand and collapse the sidebar
    $('.menu-btn').click(function(){
        $('.side-bar').addClass('active');
        $('.menu-btn').css("visibility", "hidden");
    });

    $('.close-btn').click(function(){
        $('.side-bar').removeClass('active');
        $('.menu-btn').css("visibility", "visible");
    });
    $('.menu-btn2').click(function(){
        $('.side-bar').addClass('active');
        $('.menu-btn2').css("visibility", "hidden");
    });

    $('.close-btn').click(function(){
        $('.side-bar').removeClass('active');
        $('.menu-btn2').css("visibility", "visible");
    });
});
//    --------------------------------------------------------------------

//SHOW PASSWORD-------------------------------------------------
function myFunctionCP(){
    var x = document.getElementById("pass");
    var y = document.getElementById("cpass");
    if(x.type === 'password'){
        x.type = "text";
        y.type = "text";
    }else{
        x.type = "password";
        y.type = "password";
    }
}
// EDIT ACCOUNT--------------------------------------------------

// document.querySelector("#myTable"),addEventListener("click", (e)=>{
//     target = e.target;
//     if(target.classList.contains("action-btn")){
//         selectedRow = target.parentElement.parentElement;
//         document.querySelector("#lastname").value = selectedRow.children[1].textContent;
//         document.querySelector("#firstname").value = selectedRow.children[2].textContent;
//         document.querySelector("#middlename").value = selectedRow.children[3].textContent;
//         document.querySelector("#email").value = selectedRow.children[4].textContent;
//         document.querySelector("#contactnum").value = selectedRow.children[5].textContent;
//         // document.querySelector("#usertype").value = selectedRow.children[6].textContent;
//         // document.querySelector("#image-profile").value = selectedRow.children[7].textContent;
//     }
// });
// // Get the modal

// // // Get the button that opens the modal
// // var addbtn = $("#add-userbutton");

// // // Get the <span> element that closes the modal
// var cancelbtn = $("#cancel");

// $(document).ready(function(){
//     // When the user clicks the button, open the modal
// addbtn.on('click', function() {
//     bgform.show();
// });

//     // When the user clicks on <span> (x), close the modal
//     cancelbtn.on('click', function() {
//         bgform.hide();
//     });
// // });

// Add new User Message ----------------------------------------------------------------------------------

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
});

// --------------------------------------Action Dropdown-------------------------------------- //
const actionsForm = document.querySelector(".bg-actionDropdown");
const actionsBtn = document.querySelector(".action-btn");
// actionsBtn.addEventListener('click', () =>{
//     actionsForm.style.display = 'block';
const addBtn = document.querySelector(".add-account");
    // })
function addnewuser(){
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

// adduserBtn.addEventListener('click', () =>{
//     addForm.style.display = 'flex';
// })

// checkbox.addEventListener( 'change', function() {
//     localStorage.setItem('dark-theme',this.checked);
//     if(this.checked) {
//         body.classList.add('dark-theme')
//     } else {
//         body.classList.remove('dark-theme')
//     }
// });
//     document.body.classList.add('dark-theme');
// })
// if(localStorage.getItem('dark-theme')) {
// body.classList.add('dark-theme');
// }


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
// $.fn.AddNoRowsFound = function() {
//     if($(this).find('tbody tr:not([data-no-results-found]):visible').length > 0) {
//     $(this).find('tbody tr[data-no-results-found]').hide();
// }
// else {
//     $(this).find('tbody tr[data-no-results-found]').show();
// }
// };

// $('#myTable').AddNoRowsFound();

// function actionToggle(){
//             const toggleAction = document.querySelector('.menu-action');
//             toggleAction.classList.toggle('action-dropdown')
// }
// var smodal = document.getElementByClassName('action-dropdown');
// const dropdowns = document.querySelectorAll(".action-dropdown");
//     dropdowns.forEach(dropdown =>{
//         const select = dropdown.querySelector(".select-action");
//         // const caret = dropdown.querySelector(".caret");
//         const menu = dropdown.querySelector(".menu-action");
// const options = dropdown.querySelectorAll(".menu-action .li");
// const selected = dropdown.querySelector(".selected-action");

// select.addEventListener('click', () => {
//     select.classList.toggle('select-action-clicked');
//     // caret.classList.toggle('caret-rotate');
//     menu.classList.toggle('menu-action-open');

// });

// options.forEach(option => {
//     option.addEventListener('click', () =>{
//         select.innerText = option.innerText;
//         select.classList.remove('select-action-clicked');
//         // caret.classList.remove('caret-rotate');
//         menu.classList.remove('menu-action-open');

//         options.forEach(option => {
//             option.classList.remove('active');
//         });
//         option.classList.add('active');
//     });
// });
// });
// window.onclick = function(e){
//         if(e.target == smodal){
//             modal.style.display = "none"
//         }
//     }
// ///////////////////////////////////////////////////////////////////////////////////////////////////
// $(document).ready(function(){
//     $("#actionsSelect").on("change", function() {
//         $(".bg-editDropdown").hide();
//         $("#" + $(this).val()).fadeIn(200);
//     }).change();
// });
// $(document).ready(function(){
//     $('#actionsSelect').on('change', function(){
//     	var demovalue = $(this).val();
//         // $("div.bg-editDropdown").hide();
//         $("#edit-bgdrop").show();
//     });
// });
// $("#actionsSelect").on("change", function() {
//         $("#" + $(this).val()).show().siblings();
//     })