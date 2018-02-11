$(function(){
    
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
           
        },
            
    
                                 
    })
    
    

    
});