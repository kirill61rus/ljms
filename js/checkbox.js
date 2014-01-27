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
        var segment = pathArray[3];
        segment = segment.substring(0, segment.length - 1);        
    	$('input[name="'+segment+'_ids[]"]').remove();
    	$(".check_div").each(function(){
    		if(this.checked){
    			$('form#action_select').prepend('<input type="hidden" value="'+$(this).data('item-id')+'" name="'+segment+'_ids[]">');
    		}
    	});
    }
});   