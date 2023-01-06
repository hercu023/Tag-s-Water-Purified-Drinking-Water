function tableSearch(){
    var input, filter, table, tr, i, CustomerName, ContactNumber, Address, Balance, Credit;             
    input = document.getElementById("searchInput");
    filter = input.value.toUpperCase();
    table = document.getElementById("myTable");
    tr = table.getElementsByTagName("tr");

    for(i = 0; i < tr.length; i++){

        // id = tr[i].getElementsBy("td")[0];
        CustomerName = tr[i].getElementsByTagName("td")[1];
        // console.log(lastname);
        ContactNumber = tr[i].getElementsByTagName("td")[2];
        Address = tr[i].getElementsByTagName("td")[3];
        Balance = tr[i].getElementsByTagName("td")[4];
        Credit = tr[i].getElementsByTagName("td")[5];
        
        

        if(CustomerName || ContactNumber || Address || Balance || Credit){



            var CustomerName_value = CustomerName.textContent || CustomerName.innerText;
            var ContactNumber_value = ContactNumber.textContent || ContactNumber.innerText;
            var Address_value = Address.textContent || Address.innerText;
            var Balance_value = Balance.textContent || Balance.innerText;
            var Credit_value = Credit.textContent || Credit.innerText;
            
    

            if(CustomerName_value.toUpperCase().indexOf(filter) > -1 ||
                ContactNumber_value.toUpperCase().indexOf(filter) > -1 ||
                Address_value.toUpperCase().indexOf(filter) > -1 ||
                Balance_value.toUpperCase().indexOf(filter) > -1 ||
                Credit_value.toUpperCase().indexOf(filter) > -1) {
                    
                tr[i].style.display ="";
            }else{
                tr[i].style.display = "none";
            }
    
        }
        if ($("#myTable tr:not('.noRecordTR, .table-heading'):visible").length == 0) {

        $("#myTable").find('.noRecordTR').show();
        }
        else {
        $("#myTable").find('.noRecordTR').hide();
        }
    }
  
}
