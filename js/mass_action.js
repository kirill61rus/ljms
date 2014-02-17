$(document).ready(function() {
    $(".check_all").change(function () {
    	﻿$(".check_div").prop('checked', this.checked);
    	process_ids();
    });

    $(".check_div").change(function(){
    	process_ids();
    });

    function process_ids() {
        var pathArray = window.location.pathname.split( '/' );
        var segment = pathArray[4];
        segment = segment.substring(0, segment.length - 1);        
    	$('input[name="'+segment+'_ids[]"]').remove();
    	$(".check_div").each(function(){
    		if(this.checked){
    			$('form#action_select').prepend('<input type="hidden" value="'+$(this).data('item-id')+'" name="'+segment+'_ids[]">');
    		}
    	});
    }
    $( ".action_dropdown" ).change(function() {
        var value_action = $(this).val();
        if (value_action) {
             $("#mass_action_button").attr({"class":"button"}).removeAttr("disabled"); ;
        } else {
             $("#mass_action_button").attr({"class":"inactiv", "disabled":"true"});
        }
    });
});   
