function tableSearch(){
    var input, filter, table, tr, i, FullName, Position, DailyRate, DateofBirth, Email, Contact, DateTimeAdded;              
    input = document.getElementById("searchInput");
    filter = input.value.toUpperCase();
    table = document.getElementById("myTable");
    tr = table.getElementsByTagName("tr");

    for(i = 0; i < tr.length; i++){

        // id = tr[i].getElementsBy("td")[0];
        FullName = tr[i].getElementsByTagName("td")[1];
        // console.log(lastname);
        Position = tr[i].getElementsByTagName("td")[2];
        DailyRate = tr[i].getElementsByTagName("td")[3];
        DateofBirth = tr[i].getElementsByTagName("td")[4];
        Email = tr[i].getElementsByTagName("td")[5];
        Contact = tr[i].getElementsByTagName("td")[6];
        DateTimeAdded = tr[i].getElementsByTagName("td")[7];

        if(FullName || Position || DailyRate || DateofBirth || Email || Contact || DateTimeAdded){



            var FullName_value = FullName.textContent || FullName.innerText;
            var Position_value = Position.textContent || Position.innerText;
            var DailyRate_value = DailyRate.textContent || DailyRate.innerText;
            var DateofBirth_value = DateofBirth.textContent || DateofBirth.innerText;
            var Email_value = Email.textContent || Email.innerText;
            var Contact_value = Contact.textContent || Contact.innerText;
            var DateTimeAdded_value = DateTimeAdded.textContent || DateTimeAdded.innerText;

            if(FullName_value.toUpperCase().indexOf(filter) > -1 ||
                Position_value.toUpperCase().indexOf(filter) > -1 ||
                DailyRate_value.toUpperCase().indexOf(filter) > -1 ||
                DateofBirth_value.toUpperCase().indexOf(filter) > -1 ||
                Email_value.toUpperCase().indexOf(filter) > -1 ||
                Contact_value.toUpperCase().indexOf(filter) > -1 ||
                DateTimeAdded_value.toUpperCase().indexOf(filter) > -1) {
                    
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
