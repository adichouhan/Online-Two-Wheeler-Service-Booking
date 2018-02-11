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
    if(isset($_POST['add']))
    {
        
        $n = $_GET['n'];
        for($i=1;$i<=$n;$i++)
        {
            
            $vehid = "veh-id".$i;
            $brand = "brand".$i;
            $model = "model".$i;
            $vehnum = "vehnum".$i;
            
            
           
            if(isset($_POST[$brand])&&isset($_POST[$model])&&isset($_POST[$vehnum]))
            {
                
                
                $vehid = validateFormData($_POST[$vehid]);
                
                $brand = validateFormData($_POST[$brand]);
                
                $model = validateFormData($_POST[$model]);
                $vehnum = validateFormData($_POST[$vehnum]);
                
                
                $query = "update vehicles set brand = '$brand',model = '$model', vehicle_number = '$vehnum' where id=$vehid";
                //store result
                $result = mysqli_query($conn,$query);
                if($result)
                {
                    header('Location: myprofile.php');
                }
                    else
                    $error = mysqli_error($conn);
            }
        }
                
    }
        
            
        
        
    
    $vehicleData = "";
    $query = "select id,brand,model,vehicle_number from vehicles where uid=$id";
                //store result
    $result = mysqli_query($conn,$query);
    if(!(mysqli_num_rows($result)>0))
    {
        $vehicleData = "empty";
    }
   
$title = "Edit Vehicle Information ";
    include_once("includes/header.php");
?>


<div class="container-fluid">

 <div class="panel panel-default panel-shadow-form text-black">
 

                      <div class="panel-heading">
                      
                                  <h2 class="pull-left">Your Vehicles</h2>
                                   <a type="button" class="btn btn-default btn-lg pull-right" href="add-vehicle.php">Add</a>
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
                   
                <?php if($vehicleData=="empty"){ ?>
                    
                                    <div class="row">
                                             <!--<div class="col-md-1"></div>-->
                                            
                                                  <div class="col-md-10 col-md-offset-1">
                                                  <div class="alert alert-info">
                                                      <p class="lead text-center">You have not entered vehicle details yet! Click on Add to add a vehicle</p>
                                                    </div>
                                                </div>
                                               <!-- <div class="col-md-1"></div>
                                        -->
                                        </div>
                                <?php
                                                   
                                }
                                else
                                {
                                     $numRows = mysqli_num_rows($result);
                                ?>
                                 <form class="form-inline" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF'])."?n=$numRows";?>" method="post">  
                                   
                                   
                            <?php 
                                   $count = 0;
                                    while($row = mysqli_fetch_array($result)) 
                                    {
                                        $count++;
                                
                            ?>                   
                            
                            
                                <div class="one-vehicle" id="veh<?php echo $row['id'];?>">
                        
                                     <h4>Vehicle <span class="label label-info"><?php echo $count; ?></span><a type="button" class="btn btn-sm btn-danger delete-button" id="<?php echo $row['id'];?>" name="<?php echo $row['id'];?>" >Delete</a></h4>
                        
                                <div class="row">
                                    
                                    
                                    <div class="col-md-12">
                                        
                                     <div class="form-group">

                                        <label for="brand<?php echo $count;?>" class="sr-only">Brand</label>
                                        <input type="text" id="brand<?php echo $count;?>" name="brand<?php echo $count;?>" placeholder="Brand" class="form-control" data-toggle="tooltip" data-placement="bottom" title="Enter your Vehicle Brand" value="<?php echo $row['brand']?>">
                                        
                                    </div>
                                      
                                      <div class="form-group">

                                        <label for="model<?php echo $count;?>" class="sr-only">Model</label>
                                        <input type="text" id="model<?php echo $count;?>" name="model<?php echo $count;?>" placeholder="Model" class="form-control" data-toggle="tooltip" data-placement="bottom" title="Enter your Vehicle Model" value="<?php echo $row['model']?>">
                                        
                                    </div>
                                      
                                      <div class="form-group">

                                        <label for="vehnum<?php echo $count;?>" class="sr-only">Vehicle Number</label>
                                        <input type="text" id="vehnum<?php echo $count;?>" name="vehnum<?php echo $count;?>" placeholder="Vehicle Number" class="form-control" data-toggle="tooltip" data-placement="bottom" title="Enter your Vehicle Number" value="<?php echo $row['vehicle_number']?>">
                                        <small class="label label-info">eg: MH01BG1100</small>
                                        
                                    </div>
                                        <input type="hidden" name="veh-id<?php echo $count;?>" id="veh-id<?php echo $count;?>" value="<?php echo $row['id']?>"> 
                                    </div>
                                        
                                        
                                        
                                    
                                                    
                        </div><!--end of row-->
                        </div><!--end of one-vehicle-->
                    <?php
                                    }
                                }
                    ?>
                       
                        
            </div><!--end of panel body-->
	                   <div class="panel-footer">
			                
			                 <button type="submit" class="btn btn-lg btn-success pull-right" name="add">Update</button>
                            <a href="myprofile.php" type="button" class="btn btn-lg btn-warning">Cancel</a>
			                
		                </div><!--end of panel footer-->
                            </form>
                                    
                        
                    
</div><!--end of panel-->

</div>

<?php
    include_once('includes/footer.php');
?>


<script>


    $(document).ready(function() {
        
       
        $id = "";
       /* $tempString = "#veh"+$id;
        $($tempString).hide();*/
        
        $('.delete-button').click(function(event){
         
            event.preventDefault();   
            $id = $(this).attr('id');
            $formData = { 'id': $id };
            
             $.ajax({
		    type 		: 'POST', // define the type of HTTP verb we want to use (POST for our form)
			url 		: 'delete-vehicle.php', // the url where we want to POST
			data 		: $formData, // our data object
			dataType 	: 'json', // what type of data do we expect back from the server
			encode 		: true
            
            
            
        })
             .done(function(data) {
           
                if(data.success)
                {
                      $tempstr = "#veh"+$id;
                      $($tempstr).remove();
                      
                    
                }
                else{
                    alert("There was an error submitting the data");
                }

                
                
		})
        .fail(function() { alert('request failed'); });
    
    
    
    
    
    
    });
});



</script>