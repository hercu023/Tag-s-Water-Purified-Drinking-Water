// -----------------------------AUTO CLOSE MESSAGE
    
    setTimeout(function() {
        $('#myerror').fadeOut('fast');
    }, 3000);
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
function addnewuser(){
    // const addBtn = document.querySelector(".add-customer");
    addForm.style.display = 'flex';
}
function menuToggle(){
    const toggleMenu = document.querySelector('.drop-menu');
    toggleMenu.classList.toggle('user2')
}

function tableSearch(){
    let input, filter, table, tr,
    customername, address, contactnum1, contactnum2, note; i;

    input = document.getElementById("searchInput");
    filter = input.value.toUpperCase();
    table = document.getElementById("myTable");
    tr = table.getElementsByTagName("tr");


        for(i = 0; i < tr.length; i++){
           
            customername = tr[i].getElementsByTagName("td")[1];
            address = tr[i].getElementsByTagName("td")[2];
            contactnum1 = tr[i].getElementsByTagName("td")[3];
            contactnum2 = tr[i].getElementsByTagName("td")[4];
            note = tr[i].getElementsByTagName("td")[6];

            if(customername || address || contactnum1 || contactnum2 || note){
                var customername_value = customername.textContent || customername.innerText;
                var address_value = address.textContent || address.innerText;
                var contactnum1_value = contactnum1.textContent || contactnum1.innerText;
                var contactnum2_value = contactnum2.textContent || contactnum2.innerText;
                var note_value = note.textContent || note.innerText;

                if(customername_value.toUpperCase().indexOf(filter) > -1||
                address_value.toUpperCase().indexOf(filter) > -1 ||
                contactnum1_value.toUpperCase().indexOf(filter) > -1 ||
                contactnum2_value.toUpperCase().indexOf(filter) > -1 ||
                note_value.toUpperCase().indexOf(filter) > -1){
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