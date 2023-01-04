function tableSearch(){
    var input, filter, table, tr, lastname,
        firstname, middlename, email, contactnum, role, i;
    input = document.getElementById("searchInput");
    filter = input.value.toUpperCase();
    table = document.getElementById("myTable");
    tr = table.getElementsByTagName("tr");

    for(i = 0; i < tr.length; i++){

        // id = tr[i].getElementsBy("td")[0];
        lastname = tr[i].getElementsByTagName("td")[1];
        // console.log(lastname);
        firstname = tr[i].getElementsByTagName("td")[2];
        middlename = tr[i].getElementsByTagName("td")[3];
        email = tr[i].getElementsByTagName("td")[4];
        contactnum = tr[i].getElementsByTagName("td")[5];
        role = tr[i].getElementsByTagName("td")[6];

        if(lastname || firstname || middlename || email || contactnum || role){



            var lastname_value = lastname.textContent || lastname.innerText;
            var firstname_value = firstname.textContent || firstname.innerText;
            var middlename_value = middlename.textContent || middlename.innerText;
            var email_value = email.textContent || email.innerText;
            var contactnum_value = contactnum.textContent || contactnum.innerText;
            var role_value = role.textContent || role.innerText;

            if(role_value.toUpperCase().indexOf(filter) > -1 ||
                contactnum_value.toUpperCase().indexOf(filter) > -1 ||
                email_value.toUpperCase().indexOf(filter) > -1 ||
                middlename_value.toUpperCase().indexOf(filter) > -1 ||
                lastname_value.toUpperCase().indexOf(filter) > -1 ||
                firstname_value.toUpperCase().indexOf(filter) > -1) {
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