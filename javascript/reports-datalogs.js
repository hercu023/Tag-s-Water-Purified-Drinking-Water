function table_reports_data_logs_search(){
    let input, filter, table, tr,
        full_name, email, module, status, data;

    input = document.getElementById("searchInput");
    filter = input.value.toUpperCase();
    table = document.getElementById("myTable");
    tr = table.getElementsByTagName("tr");

    for(let row = 0; row < tr.length; row++) {
        full_name = tr[row].getElementsByTagName("td")[1];
        email = tr[row].getElementsByTagName("td")[2];
        module = tr[row].getElementsByTagName("td")[3];
        status = tr[row].getElementsByTagName("td")[4];
        data = tr[row].getElementsByTagName("td")[5];
        if(full_name
            || email
            || module
            || status
            || data) {
            var fullname_value = full_name.textContent || full_name.innerText;
            var email_value = email.textContent || email.innerText;
            var module_value = module.textContent || module.innerText;
            var status_value = status.textContent || status.innerText;
            var data_value = data.textContent || data.innerText;

            if(fullname_value.toUpperCase().indexOf(filter) > -1
                || email_value.toUpperCase().indexOf(filter) > -1
                || module_value.toUpperCase().indexOf(filter) > -1
                || status_value.toUpperCase().indexOf(filter) > -1
                || data_value.toUpperCase().indexOf(filter) > -1) {
                tr[row].style.display ="";
            } else {
                tr[row].style.display = "none";
            }
            if ($('#myTable tbody tr:visible').length === 0) {
                document.getElementById('noRecordTR').style.display = "";
            } else {
                document.getElementById('noRecordTR').style.display = "none";
            }
        }
        if($('#myTable tbody tr:visible').length === 0) {
            document.getElementById('noRecordTR').style.display = "";
        } else {
            document.getElementById('noRecordTR').style.display = "none";
        }
    }
}