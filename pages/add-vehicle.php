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
     $error = "";

    if(isset($_POST['add']))
    {
        
        $brand = validateFormData($_POST['brand']);
        $model = validateFormData($_POST['model']);
        $vehnum = validateFormData($_POST['vehnum']);
        
        if($brand&&$model&&$vehnum)
        {
            $query = "insert into vehicles (brand,model,vehicle_number,uid) values('$brand','$model','$vehnum',$id)";
            $result = mysqli_query($conn,$query);
            
            if($result){
                header("Location: myprofile.php");
            }
            else
                $error = "Some problem currently, try again later";
            
        }
        
    
    }
    

$title = "Add Vehicle Information ";
    include_once("includes/header.php");
?>

<div class="container-fluid">

 <div class="panel panel-default panel-shadow-form text-black">
 

                      <div class="panel-heading">
                      
                                  <h2 class="pull-left">Add Vehicle</h2>
                                   
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
                
                
                <form class="form-vertical" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>" method="post">
                    
                    
                    <div class="form-group">

                                        <label for="brand" class="sr-only">Brand</label>
                                        <input type="text" id="brand" name="brand" placeholder="Brand" class="form-control" data-toggle="tooltip" data-placement="bottom" title="Enter your Vehicle Brand" >
                                        
                                    </div>
                                      
                                      <div class="form-group">

                                        <label for="model" class="sr-only">Model</label>
                                        <input type="text" id="model" name="model" placeholder="Model" class="form-control" data-toggle="tooltip" data-placement="bottom" title="Enter your Vehicle Model">
                                        
                                    </div>
                                      
                                      <div class="form-group">

                                        <label for="vehnum" class="sr-only">Vehicle Number</label>
                                        <input type="text" id="vehnum" name="vehnum" placeholder="Vehicle Number" class="form-control" data-toggle="tooltip" data-placement="bottom" title="Enter your Vehicle Number" ></br>
                                        <small class="label label-info">eg: MH01BG1100</small>
                    
                    
                                          </div>
                    
                    </div><!--end of panel body-->
                        <div class="panel-footer">
			                
			                 <button type="submit" class="btn btn-lg btn-success pull-right" name="add">Add</button>
                            <a href="myprofile.php" type="button" class="btn btn-lg btn-warning">Cancel</a>
			                
		                </div><!--end of panel footer-->
                    
                    
                    
                    
                </form>
     
    </div><!--end of panel-->
</div><!--end of container-->




<?php
    include_once('includes/footer.php');
?>