function selectAll(){
    if(jQuery('#checkall-checkbox').prop("checked")){
        jQuery('input[type=checkbox]').each(function(){
            jQuery('#'+this.id).prop('checked',true);
        });
    }else{
        jQuery('input[type=checkbox]').each(function(){
            jQuery('#'+this.id).prop('checked',false);
        });
    }
}
const addForm = document.querySelector(".bg-addcustomerform");
const message = document.querySelector(".message");
checkBox = document.getElementById("<?php echo $rows['id']; ?>");
function selectRestore(){
if (checkBox.checked){
        addForm.style.display = 'flex';
    }else{
    message.style.display = 'block';
}
}

