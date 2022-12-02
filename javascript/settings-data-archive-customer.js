function tableSearch(){
    let input, filter, table, tr,
        customername, address, contactnum1, contactnum2 , note, addedby;

    input = document.getElementById("searchInput");
    filter = input.value.toUpperCase();
    table = document.getElementById("myTable");
    tr = table.getElementsByTagName("tr");

    for(let i = 0; i < tr.length; i++){
        customername = tr[i].getElementsByTagName("td")[1];
        address = tr[i].getElementsByTagName("td")[2];
        contactnum1 = tr[i].getElementsByTagName("td")[3];
        contactnum2 = tr[i].getElementsByTagName("td")[4];
        note = tr[i].getElementsByTagName("td")[6];
        addedby = tr[i].getElementsByTagName("td")[7];

        if(customername || address || contactnum1 || contactnum2 || note || addedby){
            var customername_value = customername.textContent || customername.innerText;
            var address_value = address.textContent || address.innerText;
            var contactnum1_value = contactnum1.textContent || contactnum1.innerText;
            var contactnum2_value = contactnum2.textContent || contactnum2.innerText;
            var note_value = note.textContent || note.innerText;
            var addedby_value = addedby.textContent || addedby.innerText;

            if(address_value.toUpperCase().indexOf(filter) > -1 ||
                contactnum1_value.toUpperCase().indexOf(filter) > -1 ||
                contactnum2_value.toUpperCase().indexOf(filter) > -1 ||
                note_value.toUpperCase().indexOf(filter) > -1 ||
                addedby_value.toUpperCase().indexOf(filter) > -1 ||
                customername_value.toUpperCase().indexOf(filter) > -1){
                tr[i].style.display ="";
            }
            else{
                tr[i].style.display = "none";
            }
            if($('#myTable tbody tr:visible').length === 0) {
                document.getElementById('noRecordTR').style.display = "";
            }else{
                document.getElementById('noRecordTR').style.display = "none";
            }
        }
        if($('#myTable tbody tr:visible').length === 0) {
            document.getElementById('noRecordTR').style.display = "";
        }else{
            document.getElementById('noRecordTR').style.display = "none";
        }
    }
    if($('#myTable tbody tr:visible').length === 0) {
        document.getElementById('noRecordTR').style.display = "";
    }else{
        document.getElementById('noRecordTR').style.display = "none";
    }
}