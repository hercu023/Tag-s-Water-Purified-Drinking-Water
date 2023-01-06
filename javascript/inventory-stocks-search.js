function tableSearch(){
    var input, filter, table, tr, i, ItemName, Type, Status, TotalIn, TotalOut, TotalOnHand;              
    input = document.getElementById("searchInput");
    filter = input.value.toUpperCase();
    table = document.getElementById("myTable");
    tr = table.getElementsByTagName("tr");

    for(i = 0; i < tr.length; i++){

        // id = tr[i].getElementsBy("td")[0];
        ItemName = tr[i].getElementsByTagName("td")[1];
        // console.log(lastname);
        Type = tr[i].getElementsByTagName("td")[2];
        Status = tr[i].getElementsByTagName("td")[3];
        TotalIn = tr[i].getElementsByTagName("td")[4];
        TotalOut = tr[i].getElementsByTagName("td")[5];
        TimeOut = tr[i].getElementsByTagName("td")[6];
        TotalOnHand = tr[i].getElementsByTagName("td")[7];
        


        if(ItemName || Type || Status || TotalIn || TotalOut || TimeOut || TotalOnHand){



            var ItemName_value = Type.textContent || Type.innerText;
            var Status_value = Status.textContent || Status.innerText;
            var TotalIn_value = TotalIn.textContent || TotalIn.innerText;
            var TotalOut_value = TotalOut.textContent || TotalOut.innerText;
            var TimeOut_value = TimeOut.textContent || TimeOut.innerText;
            var TotalOnHand_value = TotalOnHand.textContent || TotalOnHand.innerText;
        

            if(ItemName_value.toUpperCase().indexOf(filter) > -1 ||
                Type_value.toUpperCase().indexOf(filter) > -1 ||
                Status_value.toUpperCase().indexOf(filter) > -1 ||
                TotalOut_value.toUpperCase().indexOf(filter) > -1 ||
                TimeOut_value.toUpperCase().indexOf(filter) > -1 ||
                TotalOnHand_value.toUpperCase().indexOf(filter) > -1) {
                    
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
