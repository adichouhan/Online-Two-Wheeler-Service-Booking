<?php

    
    session_start();
    if(!isset($_SESSION['loggedInUser'])){
        
        //send them to login page
        header('Location: login.php');
       
    }
    $title = "My Profile";
    include_once("includes/header.php");
    include_once("includes/connections.php");
    $username = $_SESSION['loggedInUser'];
    $query = "select id,phone,email from users where username='$username'";
    //store result
    $result1 = mysqli_query($conn,$query);
    
    if(mysqli_num_rows($result1)>0){
        if(mysqli_num_rows($result1)>1)
        {
            $loginError = "<div class='alert alert-danger'>There is some issue in DB please contact admin <a class='close' data-dismiss='alert'>&times;</a> </div>";
        }
        else{
            
            $row1 = mysqli_fetch_assoc($result1);
            $id = $row1['id'];
            $email = $row1['email'];
            $phone = $row1['phone'];
             $query = "select first_name,last_name from personal_details where userID='$id'";
            //store result
            $result2 = mysqli_query($conn,$query);
            if(mysqli_num_rows($result2)>0){
                $row2 = mysqli_fetch_assoc($result2);
                $fname = $row2['first_name'];
                $lname = $row2['last_name'];
            }
            else
            {
                 $fname = "";
                $lname  = "";
            }
            $query = "select address from address where uid='$id' AND addresstype = 1";
            //store result
            $result3 = mysqli_query($conn,$query);
            if(mysqli_num_rows($result3)>0){
                $row3 = mysqli_fetch_assoc($result3);
                $homeAddr = $row3['address'];
                
            }
            else
            {
                 $homeAddr = "";
            }
            $query = "select address from address where uid='$id' AND addresstype = 2";
            //store result
            $result4 = mysqli_query($conn,$query);
            if(mysqli_num_rows($result3)>0){
                $row4 = mysqli_fetch_assoc($result4);
                $officeAddr = $row4['address'];
                
            }
            else
            {
                 $officeAddr = "";
            }
             $query = "select brand,model,vehicle_number from vehicles where uid='$id'";
            //store result
            $vehicleData ="";
            $result5 = mysqli_query($conn,$query);
            if(!(mysqli_num_rows($result5)>0))
            {
                     $vehicleData = "empty";
            }
            
           
                
    }
}
 
    
    
?>


<div class="container">
    
    
  <div class="row">
      
       <div class="panel panel-default panel-shadow-form text-black">
 

                      <div class="panel-heading">
                      
                                  <h2 class="pull-left">Personal Details</h2>
                                  <button type="button" class="btn btn-default btn-lg pull-right">Edit</button>
                                  <div class='clearfix'></div>

                      </div>
                      
                    
                        <div class="panel-body ">
                        <div class="row">
                        
                            <div class="col-md-6">
                                
                                <p class="lead">First Name: <?php echo $fname;?></p>
                                                            
                            </div> 
                            
                            <div class="col-md-6">
                                
                                <p class="lead">Last Name: <?php echo $lname;?></p>
                                                            
                            </div> 
                         
                        </div><!--end of row-->
                        
                             <div class="row">
                        
                            <div class="col-md-6">
                                
                                <p class="lead">Email: <?php echo $email;?></p>
                                                            
                            </div> 
                            
                            <div class="col-md-6">
                                
                                <p class="lead">Phone Number: <?php echo $phone;?></p>
                                                            
                            </div> 
                         
                       
                        </div><!--end of row-->
                    
                        </div><!--end of panel-body-->
                        
                    
                    </div><!--end of panel-->
                    
                    
                     <div class="panel panel-default panel-shadow-form text-black">
 

                      <div class="panel-heading">
                      
                                  <h2 class="pull-left">Home Address</h2>
                                  <a type="button" class="btn btn-default btn-lg pull-right" href="edit-home-address.php">Edit</a>
                                
                                  <div class='clearfix'></div>

                      </div>
                      
                    
                        <div class="panel-body ">
                        <div class="row">
                            
                            <?php if($homeAddr==""){ ?>
                    
                               
                                
                                        <div class="row">
                                           
                                            
                                                  <div class="col-md-10 col-md-offset-1">
                                                  <div class="alert alert-info">
                                                      <p class="lead text-center">You have not entered a home address yet! Click on Edit to add a home address. </p>
                                                    </div>
                                                </div>
                                                
                                        
                                        </div>

                                


                            <?php
                                                   
                                }
                                else
                                {
                            ?>
                             <div class="col-md-3">
                                          <p class="lead">Home Address:</p> 
                                       
                                    </div>     
                                    <div class="col-md-6">
                                        <p><?php echo $homeAddr;?></p>
                                    </div>
                        
                            <?php
                                    
                                }
                            ?>
                        </div><!--end of row-->
                    
                        </div><!--end of panel-body-->
                        
                    
                    </div><!--end of panel-->
      
                   <div class="panel panel-default panel-shadow-form text-black">
 

                      <div class="panel-heading">
                      
                                  <h2 class="pull-left">Office Address</h2>
                                 <a type="button" class="btn btn-default btn-lg pull-right" href="edit-office-address.php">Edit</a>
                                  <div class='clearfix'></div>

                      </div>
                      
                    
                        <div class="panel-body ">
                        <div class="row">
                        
                                     <?php if($officeAddr==""){ ?>
                    
                               
                                
                                        <div class="row">
                                             <!--<div class="col-md-1"></div>-->
                                            
                                                  <div class="col-md-10 col-md-offset-1">
                                                  <div class="alert alert-info">
                                                      <p class="lead text-center">You have not entered an office address yet! Click on Edit to add an office address. </p>
                                                    </div>
                                                </div>
                                               <!-- <div class="col-md-1"></div>
                                        -->
                                        </div>

                                


                            <?php
                                                   
                                }
                                else
                                {
                            ?> 
                                     
                                    
                                      <div class="col-md-3">
                                          <p class="lead ">Office Address:</p> 
                                       
                                    </div>     
                                    <div class="col-md-6">
                                        <p><?php echo $officeAddr;?></p>
                                    </div>
                        
                        <?php
                                }
                        ?>
                        </div><!--end of row-->
                    
                        </div><!--end of panel-body-->
                        
                    
                    </div><!--end of panel-->
      
                      <div class="panel panel-default panel-shadow-form text-black">
 

                      <div class="panel-heading">
                      
                                  <h2 class="pull-left">Your Vehicles</h2>
                                   <a type="button" class="btn btn-default btn-lg pull-right" href="edit-vehicle.php">Edit</a>
                                   <a type="button" class="btn btn-default btn-lg pull-right" href="add-vehicle.php">Add</a>
                                   <div class='clearfix'></div>

                      </div>
                      
                    
                        <div class="panel-body">
                        
                        <?php if($vehicleData=="empty"){ ?>
                    
                                    <div class="row">
                                             <!--<div class="col-md-1"></div>-->
                                            
                                                  <div class="col-md-10 col-md-offset-1">
                                                  <div class="alert alert-info">
                                                      <p class="lead text-center">You have not entered vehicle details yet! Click on Edit to add a vehicle</p>
                                                    </div>
                                                </div>
                                               <!-- <div class="col-md-1"></div>
                                        -->
                                        </div>
                                <?php
                                                   
                                }
                                else
                                {
                                    $count = 0;
                                    while($row5 = mysqli_fetch_array($result5)) 
                                    {
                                        $count++;
                                
                            ?>                   
                            
                            
                        
                        
                        <h4>Vehicle <span class="label label-info"><?php echo $count; ?></h4>
                        
                        <div class="row">
                                    
                                    <div class="col-md-4">
                                    
                                      <p class="lead">Brand: <?php echo $row5['brand'];?></p>
                                       
                                    </div>     
                                    <div class="col-md-4">
                                    
                                      <p class="lead">Model: <?php echo $row5['model'];?></p>
                                       
                                    </div>     
                                    <div class="col-md-4">
                                    
                                      <p class="lead">Vehicle Number: <span class="number-plate"><?php echo $row5['vehicle_number'];?></span></p>
                                       
                                    </div>     
                        
                        
                        </div><!--end of row-->
                        
                    <?php
                                    }
                                }
                    ?>
                        </div><!--end of panel-body-->
                        
                    
                    </div><!--end of panel-->
      
      
      
      
  </div>  <!--end of row-->
    
    
    
    
    
    
</div><!--end of container-->


<?php
    include_once("includes/footer.php");
?>