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
           userfile:{
                 accept: "image/jpg,image/png,image/jpeg,image/gif",
            },
       },
        messages: {
            userfile:{
                accept: 'Incorrect image format! Select jpg, png or gif'
            }
        }
    });
        $.validator.addMethod('age_validation',
        function() {
            var from = parseInt($("#age_from").val());
            var to   = parseInt($("#age_to").val());
            if (to<=from) {
                    return  false;
                } else {
                    return  true;
                }
            },"Incorrect years interval!");

});