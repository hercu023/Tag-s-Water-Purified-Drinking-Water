function tableSearch(){
    var input, filter, table, tr, i, Details, Description, TotalQuantity;             
    input = document.getElementById("searchInput");
    filter = input.value.toUpperCase();
    table = document.getElementById("myTable");
    tr = table.getElementsByTagName("tr");

    for(i = 0; i < tr.length; i++){

        // id = tr[i].getElementsBy("td")[0];
        Details = tr[i].getElementsByTagName("td")[1];
        // console.log(lastname);
        Description = tr[i].getElementsByTagName("td")[2];
        TotalQuantity = tr[i].getElementsByTagName("td")[3];
        


        if(Details || Description || TotalQuantity){



            var Details_value = Details.textContent || Details.innerText;
            var Description_value = Description.textContent || Description.innerText;
            var TotalQuantity_value = TotalQuantity.textContent || TotalQuantity.innerText;
        
        

            if(Details_value.toUpperCase().indexOf(filter) > -1 ||
                Description_value.toUpperCase().indexOf(filter) > -1 ||
                TotalQuantity_value.toUpperCase().indexOf(filter) > -1) {
                    
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
