$(function(){

    $("#add-serv-form").validate({
        
        rules: {
            formSName: "required",
            formSCost: {
                required: true,
                min:0
            },
            formSTime: {
                required : true,
                min:1
               
            },
            serviceType: "required"
                
        },
            
        messages: 
        {
            formSName: 
                {
                    required: "Please Enter Service name"
                },
                formSCost: {
                required: "Please Enter Service Cost",
                 
            },
            formSTime: {
                required: "Please Enter Service Time",
                 
               
            },
            serviceType: {
                required: "Please Select a Service Type"
            }
        }
    })

    
});