$(document).ready(function() {

    $( ".assign_division" ).change(function() {
        var value_div = $(this).val();
        var value_rol = $("select.control_button").val();
        if (value_div && (value_rol == 3 || value_rol == 4 )) {
            $(".assign_team").prop("disabled", false);
        } else if (value_div && value_rol == 2){
            $(".inactive_button").attr({"class":"active_button", "href":"#addrole"}).css("cursor","pointer");
        } else {
            $(".assign_team").prop("disabled", true);
            $(".active_button").attr("class","inactive_button").css("cursor","default");
        } 
        $.post(base_url+'admin/system_users/get_teams_for_division_id', {div_id: value_div}, function(data){
            if (data!=0){
                data = JSON.parse(data);
                var options = $(".assign_team");
                options.html('');
                options.append($("<option />").val(0).text('Select'));
                for(var key in data) {
                    options.append($("<option />").val(data[key]['id']).text(data[key]['name']));
                }
            }        
        }) 
    });
    $( ".assign_team" ).change(function() {
         var value_team =  $(this).val();
         if (value_team != 0) {
            $(".inactive_button").attr({"class":"active_button", "href":"#addrole"}).css("cursor","pointer");
         } else {
             $(".active_button").attr("class","inactive_button").css("cursor","default");
         }
    });
    $( "select.control_button" ).change(function() {
        $(".assign_division").prop("disabled",true);
        $(".assign_team").prop("disabled", true);
        $(".active_button").removeAttr("href"); 
        $(".active_button").attr("class","inactive_button").css("cursor","default");
      /*switch(value) {
            case 1:
            case 5:
             break;
        }*/
        var value_rol =  $(this).val();
        if (value_rol == 1 || value_rol == 5) {
            $(".assign_division").prop("disabled",true);
            $(".inactive_button").attr({"class":"active_button", "href":"#addrole"}).css("cursor","pointer");
        // director
        } else if (value_rol == 2) {
            $(".assign_division").prop("disabled", false);
            $(".active_button").attr("class","inactive_button").css("cursor","default");           
        // manager or coach
        } else if (value_rol == 3 || value_rol == 4){
            $(".assign_division").prop("disabled", false);
        }          
    }); 
    /*$('a[href=]').click(function(){

    })*/ 
    
    // Adds new role to the roles table. Also adds hidden inputs with roles ids
    $(document).on("click", "a[href='#addrole']", function(){
        var template = '<tr id="roles_block">' + $('#roles_block').html() + '</tr>';
        var data = [];
        data.role_id   = $('select.control_button').val();
        data.role_name = $('.control_button option:selected').html();

        data.div_id   = $('select.assign_division').val();
        data.div_name = $('.assign_division option:selected').html();

        data.team_id   = $('select.assign_team').val();
        data.team_name = $('.assign_team option:selected').html();

        if ($(".assign_team").attr("disabled")) data.team_name = '', data.team_id = '';
        if ($(".assign_division").attr("disabled")) data.div_name = '', data.div_id = '';


        data.role_input = '<input type="hidden" value="'+data.role_id+'" name="role[]">';
        data.div_input = '<input type="hidden" value="'+data.div_id+'" name="div[]">';
        data.team_input = '<input type="hidden" value="'+ data.team_id+'" name="team[]">';
        data.role_to_user_id = '';
        for(var key in data) {
            template = template.replace('{' + key + '}', data[key]);
        }
        $(template).appendTo($("thead + tbody"));
    });  
    $(document).on("click", "a[href='#delete_role']", function(e){
        e.preventDefault();
        var id = $(this).data("item-id");
        if (id) {
            alert('from db');
            $.post(base_url+'admin/system_users/delete_role', {id: id});
            $(this).parents("tr").remove();
        } else {
            alert('ajax');
            $(this).parents("tr").remove();
        }
    });     
}); 