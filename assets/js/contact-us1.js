$(function(){
    
  $("#success-panel").hide();
     $('#ajax-spin').hide();

    jQuery.validator.addMethod("CheckAlpha",function(value,element,param)
    {
    
    if(/^[a-zA-Z]*$/.test(value))
    {
        return true;
    }
        return false;
    },"Please enter only alphabets");
    
     jQuery.validator.addMethod("CheckPhNum",function(value,element,param)
    {
    
    if(/^[0-9]{10}$/.test(value))
    {
        return true;
    }
        return false;
    },"Please enter valid phone number");

    $("#contact-form").validate({
        
        rules: {
          formName: {
           required: true,
            CheckAlpha: true
          },
            
            
            formEmail: 
            {
                required: true,
                email:true
            },
            formPhone:{
                required: true,
                CheckPhNum: true
                
                
            },
            
            formComments:{
                required: true
            }  
        },
        submitHandler: function()
        {
            
            event.preventDefault();
            var formData = {
			formName 				: $('#formName').val(),
			formEmail 			: $('#formEmail').val(),
			formPhone 	: $('#formPhone').val(),
            formComments  : $('#formComments').val()};
                
                
            $.ajax({
		    type 		: 'POST', // define the type of HTTP verb we want to use (POST for our form)
			url 		: 'processfb.php', // the url where we want to POST
			data 		: formData, // our data object
			dataType 	: 'json', // what type of data do we expect back from the server
			encode 		: true,
            beforeSend: function() {
					       $('#feedback-submit').prop("disabled", true);
                        $('#ajax-spin').show('fast');
                }
           
            }) 
        .done(function(data) {
           
            if(data.success)
            {
                $("#contact-form").hide();    
                $("#success-panel").show("slow");
                
                    
            }
            else{
                alert("There was an error submitting the data");
            }

                
                
		})
        .fail(function() { alert('request failed'); });

        }
            
    
                                 
    })
    

     /*$('#contact-form').on('submit', function (e) {

          e.preventDefault();

          $.ajax({
            type: 'post',
            url: 'processfb.php',
            data: $('#contact-form').serialize(),
            success: function () {
                
                
            }
          });

        });
        This the the working code*/
        
});
    
    
    