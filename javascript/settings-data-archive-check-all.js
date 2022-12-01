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
function selectRestore(){
    addForm = document.querySelector(".bg-addcustomerform");
    message = document.querySelector(".message");
    checkBox = document.getElementById("<?php echo $rows['id']; ?>");

    let counter = 0;
    jQuery('input[type=checkbox]').each(function(){
        if(jQuery('#'+this.id).prop('checked')){
            counter++;
            addForm.style.display = 'flex';
        }});
    if(counter===0){
        message.style.display = 'block';
    }
}