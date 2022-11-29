// -----------------------------add order table
$(document).ready(function(){
    $("#selectOrder").click(function(){
        var addcontrols="<tr>"
        addcontrols+="<td><button type='button' class='removeBtn'>X</button></td>"
        addcontrols+="<td><select class='selectTable-water1'><option value='Alkaline'>Alkaline</option><option value='Mineral'>Mineral</option></select></td>"
        addcontrols+="<td><select class='selectTable-item'><?php while($row2 = mysqli_fetch_array($result1)):;?><option><?php echo $row2[1];?></option><?php endwhile;?></select></td>"
        addcontrols+="<td><input type='number' class='textBox-table' min='0' placeholder='0' onkeypress='return isNumberKey(event)'></td>"
        addcontrols+="<td><input type='number' class='textBox-table' min='0' placeholder='0' onkeypress='return isNumberKey(event)'></td>"
        addcontrols+="<td><input type='text' class='textBox-table' min='0' placeholder='0' onkeypress='return isNumberKey(event)' readonly></td>"
        addcontrols+="<td><input type='text' class='textBox-table' min='0' placeholder='0' onkeypress='return isNumberKey(event)' readonly></td>"
        addcontrols+="</tr>";
        $(".table tbody").append(addcontrols);
    });
});
$('.table tbody').on('click','.removeBtn',function(){
    $(this).closest('tr').remove();
});
// -----------------------------date and time
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
checkbox.addEventListener( 'change', () =>{
    document.body.classList.toggle('dark-theme');
    //     if(this.checked) {
    //         body.classList.add('dark')
    //     } else {
    //         body.classList.remove('dark')
    //     }
});
function isNumberKey(evt){
    var charCode = (evt.which) ? evt.which : evt.keyCode
    if (charCode > 31 && (charCode < 48 || charCode > 57))
        return false;
    return true;
}