function tableSearch(){
    var input, filter, table, tr, i, ItemName, Type, POS, ReorderLevel, SRP, AlkalinePrice, MineralPrice, Image, DateTimeAdded, AddedBy;              
    input = document.getElementById("searchInput");
    filter = input.value.toUpperCase();
    table = document.getElementById("myTable");
    tr = table.getElementsByTagName("tr");

    for(i = 0; i < tr.length; i++){

        // id = tr[i].getElementsBy("td")[0];
        ItemName = tr[i].getElementsByTagName("td")[1];
        // console.log(lastname);
        Type = tr[i].getElementsByTagName("td")[2];
        POS = tr[i].getElementsByTagName("td")[3];
        ReorderLevel = tr[i].getElementsByTagName("td")[4];
        SRP = tr[i].getElementsByTagName("td")[5];
        AlkalinePrice = tr[i].getElementsByTagName("td")[6];
        MineralPrice = tr[i].getElementsByTagName("td")[7];
        Image = tr[i].getElementsByTagName("td")[8];
        DateTimeAdded = tr[i].getElementsByTagName("td")[9];
        AddedBy = tr[i].getElementsByTagName("td")[10];
        
        


        if(ItemName || Type || POS || ReorderLevel || SRP || AlkalinePrice || MineralPrice || Image || DateTimeAdded || AddedBy){



            var ItemName_value = Type.textContent || Type.innerText;
            var Type_value = Type.textContent || Type.innerText;
            var POS_value = POS.textContent || POS.innerText;
            var ReorderLevel_value = ReorderLevel.textContent || ReorderLevel.innerText;
            var SRP_value = SRP.textContent || SRP.innerText;
            var AlkalinePrice_value = AlkalinePrice.textContent || AlkalinePrice.innerText;
            var MineralPrice_value = MineralPrice.textContent || MineralPrice.innerText;
            var Image_value = Image.textContent || Image.innerText;
            var DateTimeAdded_value = DateTimeAdded.textContent || DateTimeAdded.innerText;
            var AddedBy_value = AddedBy.textContent || AddedBy.innerText;
        

            if(ItemName_value.toUpperCase().indexOf(filter) > -1 ||
                Type_value.toUpperCase().indexOf(filter) > -1 ||
                POS_value.toUpperCase().indexOf(filter) > -1 ||
                ReorderLevel_value.toUpperCase().indexOf(filter) > -1 ||
                SRP_value.toUpperCase().indexOf(filter) > -1 ||
                AlkalinePrice_value.toUpperCase().indexOf(filter) > -1 ||
                MineralPrice_value.toUpperCase().indexOf(filter) > -1 ||
                Image_value.toUpperCase().indexOf(filter) > -1 ||
                DateTimeAdded_value.toUpperCase().indexOf(filter) > -1 ||
                AddedBy_value.toUpperCase().indexOf(filter) > -1) {
                    
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
