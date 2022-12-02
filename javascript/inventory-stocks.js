    // -----------------------------SIDE MENU
    $(document).ready(function(){
        //jquery for toggle sub menus
        $('.sub-btn').click(function(){
          $(this).next('.sub-menu').slideToggle();
          $(this).find('.dropdown').toggleClass('rotate');
        });
   
        //jquery for expand and collapse the sidebar
        $('.menu-btn').click(function(){
          $('.side-bar').addClass('active');
          $('.menu-btn').css("visibility", "hidden");
        });
   
        $('.close-btn').click(function(){
          $('.side-bar').removeClass('active');
          $('.menu-btn').css("visibility", "visible");
        });
        $('.menu-btn2').click(function(){
          $('.side-bar').addClass('active');
          $('.menu-btn2').css("visibility", "hidden");
        });
   
        $('.close-btn').click(function(){
          $('.side-bar').removeClass('active');
          $('.menu-btn2').css("visibility", "visible");
        });
      });
   //    --------------------------------------------------------------------
   $(function() {
       const rowsPerPage = 13;
       const rows = $('#my-table tbody tr');
       const rowsCount = rows.length;
       const pageCount = Math.ceil(rowsCount / rowsPerPage); // avoid decimals
       const numbers = $('#numbers');
       
       // Generate the pagination.
       for (var i = 0; i < pageCount; i++) {
           numbers.append('<li><a href="#">' + (i+1) + '</a></li>');
       }
           
       // Mark the first page link as active.
       $('#numbers li:first-child a').addClass('active');
   
       // Display the first set of rows.
       displayRows(1);
       
       // On pagination click.
       $('#numbers li a').click(function(e) {
           var $this = $(this);
           
           e.preventDefault();
           
           // Remove the active class from the links.
           $('#numbers li a').removeClass('active');
           
           // Add the active class to the current link.
           $this.addClass('active');
           
           // Show the rows corresponding to the clicked page ID.
           displayRows($this.text());
       });
       
       // Function that displays rows for a specific page.
       function displayRows(index) {
           var start = (index - 1) * rowsPerPage;
           var end = start + rowsPerPage;
           
           // Hide all rows.
           rows.hide();
           
           // Show the proper rows for this page.
           rows.slice(start, end).show();
       }
   });
       //SHOW PASSWORD-------------------------------------------------
   function myFunctionCP(){
           var x = document.getElementById("pass");
           var y = document.getElementById("cpass");
           if(x.type === 'password'){
               x.type = "text";
               y.type = "text";
           }else{
               x.type = "password";
               y.type = "password";
           }
       }
       // EDIT ACCOUNT--------------------------------------------------
       
       // document.querySelector("#myTable"),addEventListener("click", (e)=>{
       //     target = e.target;
       //     if(target.classList.contains("action-btn")){
       //         selectedRow = target.parentElement.parentElement;
       //         document.querySelector("#lastname").value = selectedRow.children[1].textContent;
       //         document.querySelector("#firstname").value = selectedRow.children[2].textContent;
       //         document.querySelector("#middlename").value = selectedRow.children[3].textContent;
       //         document.querySelector("#email").value = selectedRow.children[4].textContent;
       //         document.querySelector("#contactnum").value = selectedRow.children[5].textContent;
       //         // document.querySelector("#usertype").value = selectedRow.children[6].textContent;
       //         // document.querySelector("#image-profile").value = selectedRow.children[7].textContent;
       //     }
       // });
       // // Get the modal
    
       // // // Get the button that opens the modal
       // // var addbtn = $("#add-userbutton");
   
       // // // Get the <span> element that closes the modal
       // var cancelbtn = $("#cancel");
   
       // $(document).ready(function(){
       //     // When the user clicks the button, open the modal 
           // addbtn.on('click', function() {
           //     bgform.show();
           // });
           
       //     // When the user clicks on <span> (x), close the modal
       //     cancelbtn.on('click', function() {
       //         bgform.hide();
       //     });
       // // });
   
       // Add new User Message ----------------------------------------------------------------------------------
       const regForm = document.querySelector(".form-registered");
       const regBtn = document.querySelector(".AddButton");
       var bgform = $('#form-registered');
       var addform = $('#form-adduser1');
       var addbtn = $("#adduserBtn");
       var message = $(".message");
       
       $(document).ready(function(){
           $('#adduserFrm').submit(function(e){
               e.preventDefault();
               $.ajax({
                   type: 'post',
                   url: 'controllerUserdata.php',
                   data: new FormData(this),
                   contentType: false, 
                   cache: false,
                   processData: false,
                   // 'submit=1&'+$form.serialize(),
                   dataType: 'json',  
                   success: function(response){
                       $(".message").css("display", "block");
                       if(response.status == 1){   
                           bgform.show();  
                           addform.hide(); 
                           message.hide(); 
                           $('#adduserFrm')[0].reset();
                   }else{
                       $(".message").html('<p>'+response.message+'<p>');
                   }
                       }
                   });
               });
           //     $("#image-profile").change(function(){
           //         var file = this.files[0];
           //         var fileType = file.type;
           //         var match = ['image/jpeg', 'image/jpg', 'image/png']
   
           //         if(!((fileType == match[0]) || (fileType == match[1]) || (fileType == match[2]))){
           //             alert("JPEG, JPG, and PNG files only.")
           //             $("#image-profile").val('');
           //             return false;
           //         }
           // });
       });
       
   // 
       let btnClear = document.querySelector('#cancel');
       // let btnClear1 = document.querySelector('#registered');
       let inputs = document.querySelectorAll('#fill');
       let pass = document.querySelectorAll('#pass');
       let cpass = document.querySelectorAll('#cpass');
       btnClear.addEventListener('click', () => {
           inputs.forEach(input => input.value = '');
           pass.forEach(input => input.value = '');
           cpass.forEach(input => input.value = '');
       });
       // btnClear1.addEventListener('click', () => {
       //     inputs.forEach(input => input.value = '');
       // });
   
       function isNumberKey(evt){
       var charCode = (evt.which) ? evt.which : evt.keyCode
       if (charCode > 31 && (charCode < 48 || charCode > 57))
           return false;
       return true;
       }
   
       const checkbox = document.getElementById('checkbox');
            checkbox.addEventListener( 'change', () =>{
                document.body.classList.toggle('dark-theme');
            });
     
       // --------------------------------------Action Dropdown-------------------------------------- //
       const actionsForm = document.querySelector(".bg-actionDropdown");
       const actionsBtn = document.querySelector(".action-btn");
           // actionsBtn.addEventListener('click', () =>{
           //     actionsForm.style.display = 'block';
           // })
       function addnewuser(){
           const addBtn = document.querySelector(".add-account");
           addForm.style.display = 'flex';
       }
       function actionFunction(){
           // actionsForm.classList.toggle('bg-actionDropdown')
           actionsForm.style.display = 'flex';
       }
       function closeAction(){
           // actionsForm.classList.toggle('bg-actionDropdown')
           actionsForm.style.display = 'none';
       }
       const editBtn = document.querySelector(".edit");
       const editForm = document.querySelector(".bg-editDropdown");
       
       // editBtn.addEventListener('click', () =>{
       //     editForm.style.display = 'flex';
       //     })
       function editAction(){
           editForm.style.display = 'flex';
           actionsForm.style.display = 'none';
       }
       const sideMenu = document.querySelector("#aside");
       const addForm = document.querySelector(".bg-adduserform");
      
       const closeBtn = document.querySelector("#close-btn");
       const cancelBtn = document.querySelector("#cancel");
       const addBtn = document.querySelector(".add-account");
       const menuBtn = document.querySelector("#menu-button");
       // const darktheme = document.querySelector('.dark-theme');
       // const checkbox = document.getElementById("checkbox");
           menuBtn.addEventListener('click', () =>{
               sideMenu.style.display = 'block';
           })
           closeBtn.addEventListener('click', () =>{
               sideMenu.style.display = 'none';
           })
           cancelBtn.addEventListener('click', () =>{
               addForm.style.display = 'none';
           })
           // if(email.value === '' || middlename.value === '' || firstname.value === '' || lastname.value === '' || contactnum.value === '' || role.value === '' || password.value === '' || confirmpassword.value === '' || profilepicture.value === ''){ 
           // }else{
               
           // }
           addBtn.addEventListener('click', () =>{
               addForm.style.display = 'flex';
           })
           
           // adduserBtn.addEventListener('click', () =>{
           //     addForm.style.display = 'flex';
           // })
           
           // checkbox.addEventListener( 'change', function() {
           //     localStorage.setItem('dark-theme',this.checked);
           //     if(this.checked) {
           //         body.classList.add('dark-theme')
           //     } else {
           //         body.classList.remove('dark-theme')     
           //     }
           // });
           //     document.body.classList.add('dark-theme');
           // })
               // if(localStorage.getItem('dark-theme')) {
               // body.classList.add('dark-theme');
               // }
         
          
            function menuToggle(){
               const toggleMenu = document.querySelector('.drop-menu');
               toggleMenu.classList.toggle('user2')
           }
   
   
    
           function tableSearch(){
       let input, filter, table, tr, itemname,
        type, ingoing, outgoing, onhand, totalamount, supplier, datetime, i, txtValue;
        
       input = document.getElementById("searchInput");
       filter = input.value.toUpperCase();
       table = document.getElementById("myTable");
       tr = table.getElementsByTagName("tr");
   
           for(i = 0; i < tr.length; i++){
              
               itemname = tr[i].getElementsByTagName("td")[1];
               type = tr[i].getElementsByTagName("td")[2];
               ingoing = tr[i].getElementsByTagName("td")[3];
               outgoing = tr[i].getElementsByTagName("td")[4];
               onhand = tr[i].getElementsByTagName("td")[5];
               totalamount = tr[i].getElementsByTagName("td")[6];
               supplier = tr[i].getElementsByTagName("td")[7];
               datetime = tr[i].getElementsByTagName("td")[8];
   
        if(itemname || type || positem || reorder || srp || cost || supplier || datetime){
                   var itemname_value = itemname.textContent || itemname.innerText;
                   var type_value = type.textContent || type.innerText;
                   var ingoing_value = ingoing.textContent || ingoing.innerText;
                   var outgoing_value = outgoing.textContent || outgoing.innerText;
                   var onhand_value = onhand.textContent || onhand.innerText;
                   var totalamount_value = totalamount.textContent || totalamount.innerText;
                   var supplier_value = supplier.textContent || supplier.innerText;
                   var datetime_value = datetime.textContent || datetime.innerText;
                   if(itemname_value.toUpperCase().indexOf(filter) > -1 ||
                   type_value.toUpperCase().indexOf(filter) > -1 ||
                   ingoing_value.toUpperCase().indexOf(filter) > -1 ||
                   outgoing_value.toUpperCase().indexOf(filter) > -1 ||
                   onhand_value.toUpperCase().indexOf(filter) > -1 ||
                   totalamount_value.toUpperCase().indexOf(filter) > -1 ||
                   supplier_value.toUpperCase().indexOf(filter) > -1 ||
                   datetime_value.toUpperCase().indexOf(filter) > -1){
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
   }
       // $.fn.AddNoRowsFound = function() {
       //     if($(this).find('tbody tr:not([data-no-results-found]):visible').length > 0) {
       //     $(this).find('tbody tr[data-no-results-found]').hide();
       // }
       // else {
       //     $(this).find('tbody tr[data-no-results-found]').show();
       // }
       // };
   
       // $('#myTable').AddNoRowsFound();
   
   // function actionToggle(){
   //             const toggleAction = document.querySelector('.menu-action');
   //             toggleAction.classList.toggle('action-dropdown')
           // }
           // var smodal = document.getElementByClassName('action-dropdown');
       // const dropdowns = document.querySelectorAll(".action-dropdown");
       //     dropdowns.forEach(dropdown =>{
       //         const select = dropdown.querySelector(".select-action");
       //         // const caret = dropdown.querySelector(".caret");
       //         const menu = dropdown.querySelector(".menu-action");   
               // const options = dropdown.querySelectorAll(".menu-action .li");
               // const selected = dropdown.querySelector(".selected-action");
   
               // select.addEventListener('click', () => {
               //     select.classList.toggle('select-action-clicked');
               //     // caret.classList.toggle('caret-rotate');
               //     menu.classList.toggle('menu-action-open');
                   
               // });
             
               // options.forEach(option => {
               //     option.addEventListener('click', () =>{
               //         select.innerText = option.innerText;
               //         select.classList.remove('select-action-clicked');
               //         // caret.classList.remove('caret-rotate');
               //         menu.classList.remove('menu-action-open');
   
               //         options.forEach(option => {
               //             option.classList.remove('active');
               //         });
               //         option.classList.add('active');
               //     });
               // });
           // });
           // window.onclick = function(e){
           //         if(e.target == smodal){
           //             modal.style.display = "none"
           //         }
           //     }
   // ///////////////////////////////////////////////////////////////////////////////////////////////////
   // $(document).ready(function(){
   //     $("#actionsSelect").on("change", function() {
   //         $(".bg-editDropdown").hide();
   //         $("#" + $(this).val()).fadeIn(200);
   //     }).change();
   // });
   // $(document).ready(function(){
   //     $('#actionsSelect').on('change', function(){
   //     	var demovalue = $(this).val(); 
   //         // $("div.bg-editDropdown").hide();
   //         $("#edit-bgdrop").show();
   //     });
   // });
   // $("#actionsSelect").on("change", function() {
   //         $("#" + $(this).val()).show().siblings();
   //     })