$(document).ready(function(){	

	$(document).on("click", "a[href='#delete']", function(e){
		e.preventDefault();
	 	if (confirm("Are you sure you want to delete this item?")){
		 	var division_id = $(this).data("item-id");
		 	$.post(base_url+'admin/divisions/delete', {division_id: division_id});

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