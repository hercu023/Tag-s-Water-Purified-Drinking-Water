setTimeout(function() {
    $('#myerror').fadeOut('fast');
}, 10000);

const addForm = document.querySelector(".bg-addcustomerform");
function addnewuser(){
// const addBtn = document.querySelector(".add-customer");
addForm.style.display = 'flex';
}

var today = new Date();
var day = today.getDate();
var month = today.getMonth() + 1;

function appendZero(value) {
return "0" + value;
}

function theTime() {
var d = new Date();
document.getElementById("time").innerHTML = d.toLocaleTimeString("en-US");
}

if (day < 10) {
day = appendZero(day);
}

if (month < 10) {
month = appendZero(month);
}

today = day + "/" + month + "/" + today.getFullYear();

document.getElementById("date").innerHTML = today;

var myVar = setInterval(function () {
theTime();
}, 1000);

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
const sideMenu = document.querySelector('#aside');
const closeBtn = document.querySelector('#close-btn');
const menuBtn = document.querySelector('#menu-button');
const checkbox = document.getElementById('checkbox');
    menuBtn.addEventListener('click', () =>{
        sideMenu.style.display = 'block';
    })

    closeBtn.addEventListener('click', () =>{
        sideMenu.style.display = 'none';
    })

    
// -----------------------------date and time
