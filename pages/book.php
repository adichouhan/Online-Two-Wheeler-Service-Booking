<?php

 session_start();

    //whether user has logged in or not

    if(!isset($_SESSION['loggedInUser'])){
        
        //send them to login page
        header('Location: login.php');
    }
    //Connect to DB
    include_once("includes/connections.php");
    
    //include custom Functions
    
    include_once("includes/functions.php");

    $username = $_SESSION['loggedInUser'];
    $query = "select id from users where username='$username'";
    //store result
    $result1 = mysqli_query($conn,$query);

    if(mysqli_num_rows($result1)>0){
       
        if(mysqli_num_rows($result1)>1)
        {
            
            $loginError = "<div class='alert alert-danger'>There is some issue in DB please contact admin <a class='close' data-dismiss='alert'>&times;</a> </div>";
        }
        else
        {
              
                $row1 = mysqli_fetch_assoc($result1);
                $id = $row1['id'];
            
        }

            
    }
  
    $error="";
    $vehicleData = "";
    $query = "select id,brand,model,vehicle_number from vehicles where uid=$id";
                //store result
    $result = mysqli_query($conn,$query);
    if(!(mysqli_num_rows($result)>0))
    {
        $vehicleData = "empty";
    }
    
    

    
$title = "Book your Slot";
include_once('includes/header.php');
?>

<div class="container-fluid">

 <div class="panel panel-default panel-shadow-form text-black">
 

                      <div class="panel-heading">
                      
                                  <h2 class="pull-left">Book A Service Slot</h2>
                                   
                                  <div class='clearfix'></div>
                                    
    
                      </div>
                      
                    
                        <div class="panel-body">
                   <?php 
                       if($error){
                    ?>

                    <div class="alert alert-danger">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                        <strong>ERROR </strong><?php echo $error; ?>
                    </div>

                <?php 
                    }


                ?>
                   
            
                                 <form class="form-vertical" action="slot_process.php" method="post" id="bookForm">  
                                   
                                                   
                                     
                                <div class="row">
                                    
                                    
                                    <div class="col-md-10">
                                        
                                    <div class="form-group">
                                      <label for="vehicle">Select Vehicle:</label>
                                      <select class="form-control" id="vehicle" name="vehicle">
                                      <option disabled selected>--SELECT A VEHICLE--</option>
                                    <?php 
                                          
                                          $count = 0;
                                        while($row = mysqli_fetch_array($result)) 
                                        {
                                            $count++;
                                    ?>
                                        
                                        
                                        <option id="<?php echo $row['id'];?>" value="<?php echo $row['brand']." ".$row['model']." ".$row['vehicle_number']?>"><?php echo $row['brand']." ".$row['model']." ".$row['vehicle_number']?></option>
                                        
                                      
                                      <?php } ?>
                                      
                                      </select>
                                    </div>
                                      
                                      <div class="form-group">

                                        <label for="slotdate">Slot Date</label>
                                        <input type="date" id="slotdate" name="slotdate" placeholder="Select Date" class="form-control" data-toggle="tooltip" data-placement="bottom" title="Select Date">
                                        
                                    </div>
                                    
                                     <div class="form-group">
                                      <label for="vehicle">Select Slot Timing:</label>
                                      <select class="form-control" id="timing" name="timing">
                                   
                                          <option disabled selected>--SELECT A TIMING--</option>
                                          <option id="morning" value = "morning" >Morning Slot (9am - 11.59am) </option>
                                          <option id="afternoon" value = "afternoon">Afternoon Slot (12pm - 3pm) </option>
                                          <option id="evening" value="evening">Evening Slot (4pm - 7pm) </option>
                                          
                                      </select>
                                    </div>
                                    
                                     <input type="hidden" name="id" id="id" value="<?php echo $id?>">
                                  </div><!--end of col-->
                                        
                                      
                                        
                                    
                                                    
                        </div><!--end of row-->
                       
                       
                        
            </div><!--end of panel body-->
	                   <div class="panel-footer" id="operation-buttons">
			                
			                <span class="spin-margin pull-right" id="ajax-spin"><img src ='../assets/images/ajax-loader.gif' ></span> <button type="submit" class="btn btn-lg btn-success pull-right" name="book" id="book">Book</button>
                           <button type="reset" class="btn btn-lg btn-danger">Cancel</button>
			                
		                </div><!--end of panel footer-->
                 </form>
                                   
                         <div id="success-panel">
                            
 
                                <div class="panel-body ">

                                
                                <div class="text-center">
                                        <canvas height="200" ></canvas>
                                </div>
                                <p class="lead text-center">Slot Booked Successfully<br> Check your registered email for details</p>



                            </div><!--end of panel-body-->
  
               
                  </div>              <!--end of success panel-->
                                    
                        
                    
</div><!--end of panel-->

</div><!--end of container-->


<div id="login-footer">
<?php

      include_once('includes/footer.php');
?>
</div>


<script src="../assets/js/jquery.validate.js">  </script>
        <script src="../assets/js/additional-methods.js"></script>
<script>

    $('document').ready(function(){
        
     $("#success-panel").hide();
     $('#ajax-spin').hide();
        jQuery.validator.addMethod("validDate",function(value,element,param)
        {
            
                 $enteredDate = new Date($('#slotdate').val());     
                 $entered = $enteredDate.getTime();
                 $today = new Date();
                 $min = $today.getTime()  + 86400000;
                 $max = $today.getTime()  + (86400000*30);
                 if(($max>=$entered)&&($min<=$entered))
                 {
                     
                        return true;        
                 }
            else
                return false;
                
        })  
   
        
        $('#bookForm').validate({
        
     
        rules:
            {
                vehicle: {required:true},
                slotdate:{required:true,
                            validDate: true
                         },
                timing: {required:true},
            },
        submitHandler : function(){


            event.preventDefault();
            var formData = {
			'vehicle' 			: $('#vehicle').val(),
			'slotdate' 			: $('#slotdate').val(),
			'timing'         	: $('#timing').val(),
            'id'                : $('#id').val()};
                
                
            $.ajax({
		    type 		: 'POST', // define the type of HTTP verb we want to use (POST for our form)
			url 		: 'slot_process.php', // the url where we want to POST
			data 		: formData, // our data object
			dataType 	: 'json', // what type of data do we expect back from the server
			encode 		: true,
            beforeSend: function() {
					   $('#book').prop("disabled", true);
                        $('#ajax-spin').show('fast');
                }
           
        }) 
        .done(function(data) {
           
            if(data.success)
            {
                $("#bookForm").hide();    
                $("#success-panel").show("slow");
                $("#operation-buttons").hide();
                
                    
            }
            else{
                alert("There was an error submitting the data");
            }

                
                
		})
        .fail(function() { alert('request failed'); });

    
    
    
      }
        
      
    
        })
     });
        
        var today = new Date();
        var min = new Date(today.getTime()+86400000);
        var dd = min.getDate();
        var mm = min.getMonth()+1; //January is 0!
        var yyyy = min.getFullYear();
        if(dd<10)
        {
            dd='0'+dd
        } 
        if(mm<10)
        {
            mm='0'+mm
        } 

        min = yyyy+'-'+mm+'-'+dd;
        document.getElementById("slotdate").setAttribute("min", min);
        var max = new Date(today.getTime()+(86400000*30));
        var dd = max.getDate();
        var mm = max.getMonth()+1; //January is 0!
        var yyyy = max.getFullYear();
        if(dd<10)
        {
            dd='0'+dd
        } 
        if(mm<10)
        {
            mm='0'+mm
        } 

        max = yyyy+'-'+mm+'-'+dd;
        document.getElementById("slotdate").setAttribute("max", max);

        var start = 100;
        var mid = 145;
        var end = 250;
        var width = 22;
        var leftX = start;
        var leftY = start;
        var rightX = mid - (width / 2.7);
        var rightY = mid + (width / 2.7);
        var animationSpeed = 20;

        var ctx = document.getElementsByTagName('canvas')[0].getContext('2d');
        ctx.lineWidth = width;
        ctx.strokeStyle = 'rgba(0, 150, 0, 1)';

        for (i = start; i < mid; i++) {
            var drawLeft = window.setTimeout(function () {
                ctx.beginPath();
                ctx.moveTo(start, start);
                ctx.lineTo(leftX, leftY);
                ctx.stroke();
                leftX++;
                leftY++;
            }, 1 + (i * animationSpeed) / 3);
        }

        for (i = mid; i < end; i++) {
            var drawRight = window.setTimeout(function () {
                ctx.beginPath();
                ctx.moveTo(leftX, leftY);
                ctx.lineTo(rightX, rightY);
                ctx.stroke();
                rightX++;
                rightY--;
            }, 1 + (i * animationSpeed) / 3);
        }

</script>




