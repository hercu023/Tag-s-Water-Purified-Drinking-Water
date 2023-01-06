function tableSearch(){
    var input, filter, table, tr, i, ItemName, Details, Action, Quantity, AddedBy, Date;             
    input = document.getElementById("searchInput");
    filter = input.value.toUpperCase();
    table = document.getElementById("myTable");
    tr = table.getElementsByTagName("tr");

    for(i = 0; i < tr.length; i++){

        // id = tr[i].getElementsBy("td")[0];
        ItemName = tr[i].getElementsByTagName("td")[1];
        // console.log(lastname);
        Details = tr[i].getElementsByTagName("td")[2];
        Action = tr[i].getElementsByTagName("td")[3];
        Quantity = tr[i].getElementsByTagName("td")[4];
        AddedBy = tr[i].getElementsByTagName("td")[5];
        Date = tr[i].getElementsByTagName("td")[6];
       
    

        if(ItemName || Details || Action || Quantity || AddedBy || Date){



            var ItemName_value = ItemName.textContent || ItemName.innerText;
            var Details_value = Details.textContent || Details.innerText;
            var Action_value = Action.textContent || Action.innerText;
            var Quantity_value = Quantity.textContent || Quantity.innerText;
            var AddedBy_value = AddedBy.textContent || AddedBy.innerText;
            var Date_value = Date.textContent || Date.innerText;
           
        

            if(ItemName_value.toUpperCase().indexOf(filter) > -1 ||
                Details_value.toUpperCase().indexOf(filter) > -1 ||
                Action_value.toUpperCase().indexOf(filter) > -1 ||
                Quantity_value.toUpperCase().indexOf(filter) > -1 ||
                AddedBy_value.toUpperCase().indexOf(filter) > -1 ||
                Date_value.toUpperCase().indexOf(filter) > -1) {
                    
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
