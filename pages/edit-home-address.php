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
    $addrError = "";
    if(isset($_POST['add'])){
        //set all data variables to blank by default
        
        if (!strlen(trim($_POST['address'])))
        {
            $addrError = "Address cannot be Blank";    
        }
        else
        {
            $homeAddr = validateFormData($_POST['address']);
            $query = "update address set address='$homeAddr' where addresstype = 1 AND uid=$id";
    //store result
            $result = mysqli_query($conn,$query);
        
        if($result)
        {
             header('Location: myprofile.php');
        }
        else
            $addrError = "There was some problem in updating information";
        }
        
    }
    
    $query = "select address from address where uid='$id' AND addresstype = 1";
                //store result
    $result3 = mysqli_query($conn,$query);
    if(mysqli_num_rows($result3)>0)
    {
        $row3 = mysqli_fetch_assoc($result3);
        $homeAddr = $row3['address'];
    }
    else
        $homeAddr = "";
    $title = "Edit Home Address";
    include_once("includes/header.php");
?>


<div class="container">
    
    
    <h1>Edit Home Address</h1>
    
   <?php 
       if($addrError){
    ?>
    
    <div class="alert alert-danger">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
        <strong>ERROR </strong><?php echo $addrError; ?>
    </div>
    
<?php 
    }
    
   
?>
    
   

    
    <form action='<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>' method="POST" class="form-horizontal">
        
        <div class="form-group">
           
               <label for="address">Home Address:</label>
               <textarea class="form-control input-lg" id="address" name="address"><?php echo htmlspecialchars($homeAddr); ?></textarea>
               
            
        </div>
        <div class="form-group">
            <a href="myprofile.php" type="button" class="btn btn-lg btn-warning">Cancel</a>
            
            <button type="submit" class="btn btn-lg btn-success pull-right" name="add">Update</button>
        </div>
       
    </form>
    
    
    
</div>


<?php
    include_once('includes/footer.php');
?>
