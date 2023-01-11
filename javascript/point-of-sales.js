function menuToggle(){
    const toggleMenu = document.querySelector('.drop-menu');
    toggleMenu.classList.toggle('user2')
}
function loading() {
    document.querySelector(".loading").style.display = "flex";
    document.querySelector(".loader").style.display = "flex";
}
function numberWithCommas(x) {
    return x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
}

function deliveryFee(delivery_fee){   
       
    try{
        let deliveryfee = 0.00;
        if(!isNaN(delivery_fee) && delivery_fee !== ''){
            deliveryfee = parseFloat(delivery_fee);
        }
        let totalamountvalue = document.getElementById("totalamount_value").value;
        let totalAmount = 0.00;
        if(!isNaN(totalamountvalue) && totalamountvalue !== ''){
            totalAmount = parseFloat(document.getElementById("totalamount_value").value);
        }

        let total = deliveryfee + totalAmount; 
        document.getElementById("totalAmount_order").value = numberWithCommas(total.toFixed(2));
    }catch(err){

    }

}
function deliveryOption(delivery){
    if(delivery.value == 'Delivery' || delivery.value == 'Delivery/Pick Up'){
        document.getElementById("deliveryfee_amount1").style.display = 'none';
        document.getElementById("delivery-fee").style.display = 'inline-block';
    }else if(delivery.value == 'Walk In'){
        document.getElementById("deliveryfee_amount1").style.display = 'inline-block';
        document.getElementById("delivery-fee").style.display = 'none';
        document.getElementById("deliveryfee_amount").value = 0;
        var ele = document.getElementsByName("pos_item");
        for(var i=0;i<ele.length;i++)
            ele[i].checked = false;
    }
    selectElement = document.querySelector('#deliveryoption');
    output = selectElement.value;
    document.querySelector('.deliveryoption_class').value = output;
}
function waterChange(answer){
    if(answer.value == 'Alkaline'){
        document.getElementById("form-water1").style.display = 'block';
        document.getElementById("form-water2").style.display = 'none';
        document.getElementById("form-water3").style.display = 'block';
        document.getElementById("form-category").style.display = 'none';
        document.getElementById("form-water4").style.display = 'none';

    }else if(answer.value == 'Mineral'){
        document.getElementById("form-water1").style.display = 'none';
        document.getElementById("form-water2").style.display = 'block';
        document.getElementById("form-category").style.display = 'none';
        document.getElementById("form-water3").style.display = 'none';
        document.getElementById("form-water4").style.display = 'block';
    }else if(answer.value == 'Container/Bottle Only'){
        document.getElementById("form-water1").style.display = 'block';
        document.getElementById("form-water2").style.display = 'none';
        document.getElementById("form-category").style.display = 'block';
        document.getElementById("form-water3").style.display = 'none';
        document.getElementById("form-water4").style.display = 'none';
    }
    
}

function guestCustomer(){
    var guestTxt = document.getElementById("guest-button");
    var selectLbl = document.getElementById("selectCustomer-text");
    container2 = document.querySelector(".bg-selectcustomerform");

    selectLbl.innerHTML = guestTxt.value;
    container2.style.display = 'none';
}
// -----------------------------form table
const form3Table = document.querySelector(".form3-table");
const form2Table = document.querySelector(".form2-table-water");
const form1Table = document.querySelector(".form1-table-water");
function refillFunction(){
    form1Table.style.display = 'block';
    form2Table.style.display = 'none';
    form3Table.style.display = 'none';
}
function orderFunction(){
    form1Table.style.display = 'none';
    form2Table.style.display = 'block';
    form3Table.style.display = 'none';
}
function otherFunction(){
    form1Table.style.display = 'none';
    form2Table.style.display = 'none';
    form3Table.style.display = 'inline-block';
}

function increaseButton(id) {
    let quantity = document.getElementById('item-quantity-' + id);
    quantity.value = parseInt(quantity.value) + 1;
    document.getElementById("addqty-"+ id).submit();
}

function decreaseButton(id) {
    let quantity = document.getElementById('item-quantity-' + id);
    quantity.value = Math.max(parseInt(quantity.value) - 1, 1);
    document.getElementById("addqty-"+ id).submit();
}
// -----------------------------Automatic close message
setTimeout(function() {
    $('#myerror').fadeOut('fast');
}, 10000);
// -----------------------------SELECT CUSTOMER
const selectForm = document.querySelector(".bg-selectcustomerform");
function selectcustomer(){
    selectForm.style.display = 'flex';
}
const addForm = document.querySelector(".bg-addcustomerform");
function addcustomer(){
    addForm.style.display = 'flex';
    cusForm.style.display = 'none';
}
// -----------------------------ADD CUSTOMER
const cusForm = document.querySelector(".bg-placeorderform");
function placeorder(){
    cusForm.style.display = 'flex';
}
// const cusForm = document.querySelector(".bg-placeorderform");
const canceladdForm = document.querySelector(".bg-addcustomerform");
function cancelAddCustomer(){
    canceladdForm.style.display = 'none';
    cusForm.style.display = 'flex';

}


// -----------------------------date and time

//    --------------------------------------------------------------------
const closeBtn = document.querySelector('#close-btn');
closeBtn.addEventListener('click', () =>{
sideMenu.style.display = 'none';
})

function isNumberKey(evt){
var charCode = (evt.which) ? evt.which : evt.keyCode
if (charCode > 31 && (charCode < 48 || charCode > 57))
    return false;
return true;
}