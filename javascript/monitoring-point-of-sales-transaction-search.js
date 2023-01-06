function tableSearch(){
    var input, filter, table, tr, i, CustomerName, OrderDetails, TotalAmount, PaymentOption, Service, Note, PaymentStatus, CashierName, DateTime;             
    input = document.getElementById("searchInput");
    filter = input.value.toUpperCase();
    table = document.getElementById("myTable");
    tr = table.getElementsByTagName("tr");

    for(i = 0; i < tr.length; i++){

        // id = tr[i].getElementsBy("td")[0];
        CustomerName = tr[i].getElementsByTagName("td")[1];
        // console.log(lastname);
        OrderDetails = tr[i].getElementsByTagName("td")[2];
        TotalAmount = tr[i].getElementsByTagName("td")[3];
        PaymentOption = tr[i].getElementsByTagName("td")[4];
        Service = tr[i].getElementsByTagName("td")[5];
        Note = tr[i].getElementsByTagName("td")[6];
        PaymentStatus = tr[i].getElementsByTagName("td")[7];
        CashierName = tr[i].getElementsByTagName("td")[8];
        DateTime = tr[i].getElementsByTagName("td")[9];
        


        if(CustomerName || OrderDetails || TotalAmount || PaymentOption || Service || Note || PaymentStatus || CashierName || DateTime){



            var CustomerName_value = CustomerName.textContent || CustomerName.innerText;
            var OrderDetails_value = OrderDetails.textContent || OrderDetails.innerText;
            var TotalAmount_value = TotalAmount.textContent || TotalAmount.innerText;
            var PaymentOption_value = PaymentOption.textContent || PaymentOption.innerText;
            var Service_value = Service.textContent || Service.innerText;
            var Note_value = Note.textContent || Note.innerText;
            var PaymentStatus_value = PaymentStatus.textContent || PaymentStatus.innerText;
            var CashierName_value = CashierName.textContent || CashierName.innerText;
            var DateTime_value = DateTime.textContent || DateTime.innerText;
        

            if(CustomerName_value.toUpperCase().indexOf(filter) > -1 ||
                OrderDetails_value.toUpperCase().indexOf(filter) > -1 ||
                TotalAmount_value.toUpperCase().indexOf(filter) > -1 ||
                PaymentOption_value.toUpperCase().indexOf(filter) > -1 ||
                Service_value.toUpperCase().indexOf(filter) > -1 ||
                Note_value.toUpperCase().indexOf(filter) > -1 ||
                PaymentStatus_value.toUpperCase().indexOf(filter) > -1 ||
                CashierName_value.toUpperCase().indexOf(filter) > -1 ||
                DateTime_value.toUpperCase().indexOf(filter) > -1) {
                    
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
