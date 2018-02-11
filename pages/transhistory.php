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
    $transactionHistory = "";
    $query = "select vehicle,slotTiming,slotDate,transaction_time from transaction where userid=$id";
                //store result
    $result = mysqli_query($conn,$query);
    if(!(mysqli_num_rows($result)>0))
    {
        $transactionHistory = "empty";
    }
    
$title = "Transaction History";
include_once('includes/header.php');
?>




<div class="container">

    <h1>Transaction History</h1>
    
     <?php if($transactionHistory=="empty"){ ?>
                    
                                    <div class="row">
                                             <!--<div class="col-md-1"></div>-->
                                            
                                                  <div class="col-md-10 col-md-offset-1">
                                                  <div class="alert alert-info">
                                                      <p class="lead text-center">You have not booked any service slots yet!</p>
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
    
    <table class="table table-bordered table-responsive table-responsive text-center">
    
        <tr>
            <th  class="text-center">Vehicle</th>
            <th  class="text-center">Date</th>
            <th  class="text-center">Time Slot</th>
            <th  class="text-center">Booking Date and Time</th>
            
        </tr>
        <?php
            if(mysqli_num_rows($result)>0){
                //We have data
                while($row=mysqli_fetch_assoc($result))
                {
                    
                    
                    $date = new DateTime($row['transaction_time']);
                    //echo $dt->format('M j Y g:i A');
                   echo "<tr>";
                    echo "<td>".$row['vehicle']."</td>"."<td>".$row['slotDate']."</td>"."<td>".$row['slotTiming']."</td>"."<td>".$date->format('M j Y g:i A')."</td>";
                    echo '</tr>';
                
                }
            }
            else{//no data
                    echo "<div class='alert alert-warning'>You have no clients! </div> ";
            }
        
    ?>
        
        
    
    </table>
</div><!--end of container-->
<?php
                                }
?>


<div id="login-footer">
<?php

      include_once('includes/footer.php');
?>
</div>

