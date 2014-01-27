$(document).ready(function(){	

	$(document).on("click", "a[href='#delete']", function(e){
		e.preventDefault();
		var pathArray = window.location.pathname.split( '/' );
		var segment = pathArray[3];
	 	if (confirm("Are you sure you want to delete this item?")){
		 	var id = $(this).data("item-id");
		 	$.post(base_url+'admin/'+segment+'/delete', {id: id});

		    $(this).parents("tr").animate({ opacity: "hide" }, "slow");
	 	}
	}); 
		$(document).on("click", "a[href='#delete_logo']", function(e){
		e.preventDefault();
		var division_id = $(this).data("item-id");
		$.post(base_url+'admin/divisions/delete_logo', {division_id: division_id});
		$(".logo").animate({ opacity: "hide" }, "slow");
		}); 

});