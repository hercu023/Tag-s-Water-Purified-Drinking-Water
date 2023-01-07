function tableSearch(){
    var input, filter, table, tr, i, EmployeeName, Position, WholeDay, Date, TimeIn, TimeOut, Deduction, Bonus, Note, Total, Status, AddedBy;              
    input = document.getElementById("searchInput");
    filter = input.value.toUpperCase();
    table = document.getElementById("myTable");
    tr = table.getElementsByTagName("tr");

    for(i = 0; i < tr.length; i++){

        // id = tr[i].getElementsBy("td")[0];
        EmployeeName = tr[i].getElementsByTagName("td")[1];
        // console.log(lastname);
        Position = tr[i].getElementsByTagName("td")[2];
        WholeDay = tr[i].getElementsByTagName("td")[3];
        Date = tr[i].getElementsByTagName("td")[4];
        TimeIn = tr[i].getElementsByTagName("td")[5];
        TimeOut = tr[i].getElementsByTagName("td")[6];
        Deduction = tr[i].getElementsByTagName("td")[7];
        Bonus = tr[i].getElementsByTagName("td")[8];
        Note = tr[i].getElementsByTagName("td")[9];
        Total = tr[i].getElementsByTagName("td")[10];
        Status = tr[i].getElementsByTagName("td")[11];
        AddedBy = tr[i].getElementsByTagName("td")[12];

        if(EmployeeName || Position || WholeDay || Date || TimeIn || TimeOut || Deduction || Bonus || Note || Total || Status || AddedBy){



            var EmployeeName_value = EmployeeName.textContent || EmployeeName.innerText;
            var Position_value = Position.textContent || Position.innerText;
            var WholeDay_value = WholeDay.textContent || WholeDay.innerText;
            var Date_value = Date.textContent || Date.innerText;
            var TimeIn_value = TimeIn.textContent || TimeIn.innerText;
            var TimeOut_value = TimeOut.textContent || TimeOut.innerText;
            var Deduction_value = Deduction.textContent || Deduction.innerText;
            var Bonus_value = Bonus.textContent || Bonus.innerText;
            var Note_value = Note.textContent || Note.innerText;
            var Total_value = Total.textContent || Total.innerText;
            var Status_value = Status.textContent || Status.innerText;
            var AddedBy_value = AddedBy.textContent || AddedBy.innerText;

            if(EmployeeName_value.toUpperCase().indexOf(filter) > -1 ||
                Position_value.toUpperCase().indexOf(filter) > -1 ||
                WholeDay_value.toUpperCase().indexOf(filter) > -1 ||
                Date_value.toUpperCase().indexOf(filter) > -1 ||
                TimeIn_value.toUpperCase().indexOf(filter) > -1 ||
                TimeOut_value.toUpperCase().indexOf(filter) > -1 ||
                Deduction_value.toUpperCase().indexOf(filter) > -1 ||
                Bonus_value.toUpperCase().indexOf(filter) > -1 ||
                Note_value.toUpperCase().indexOf(filter) > -1 ||
                Total_value.toUpperCase().indexOf(filter) > -1 ||
                Status_value.toUpperCase().indexOf(filter) > -1 ||
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
