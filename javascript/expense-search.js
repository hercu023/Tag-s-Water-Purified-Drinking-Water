function tableSearch(){
    var input, filter, table, tr, i, Date, Type, Amount, Description, DateTimeAdded, AddedBy;              
    input = document.getElementById("searchInput");
    filter = input.value.toUpperCase();
    table = document.getElementById("myTable");
    tr = table.getElementsByTagName("tr");

    for(i = 0; i < tr.length; i++){

        // id = tr[i].getElementsBy("td")[0];
        Date = tr[i].getElementsByTagName("td")[1];
        // console.log(lastname);
        Type = tr[i].getElementsByTagName("td")[2];
        Amount = tr[i].getElementsByTagName("td")[3];
        Description = tr[i].getElementsByTagName("td")[4];
        DateTimeAdded = tr[i].getElementsByTagName("td")[5];
        AddedBy = tr[i].getElementsByTagName("td")[6];

        if(Date || Type || Amount || Description || DateTimeAdded || AddedBy){



            var Date_value = Date.textContent || Date.innerText;
            var Type_value = Type.textContent || Type.innerText;
            var Amount_value = Amount.textContent || Amount.innerText;
            var Description_value = Description.textContent || Description.innerText;
            var DateTimeAdded_value = DateTimeAdded.textContent || DateTimeAdded.innerText;
            var AddedBy_value = AddedBy.textContent || AddedBy.innerText;

            if(Date_value.toUpperCase().indexOf(filter) > -1 ||
                AddedBy_value.toUpperCase().indexOf(filter) > -1 ||
                DateTimeAdded_value.toUpperCase().indexOf(filter) > -1 ||
                Description_value.toUpperCase().indexOf(filter) > -1 ||
                Amount_value.toUpperCase().indexOf(filter) > -1 ||
                Type_value.toUpperCase().indexOf(filter) > -1) {
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
