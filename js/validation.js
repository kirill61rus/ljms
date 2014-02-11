$(document).ready(function(){

    $("#add_division").validate({

       rules:{
            status: {
                required: true,
            },
            name:{
                required: true,
                maxlength: 30,
            },
            base_fee:{
                number : true,
            },
            addon_fee:{
                number : true,
            },
            age_to:{
               age_validation: true,
            },
       },
    });
        $.validator.addMethod('age_validation',
        function(val,el) {
            var from = $("#age_from").val();
            var to   = $("#age_to").val();
            if (to<=from) {
                    return  false;
                } else {
                    return  true;
                }
            },"Incorrect years interval!");

});