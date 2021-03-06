<?php


        
$loginError = "";
$SIActive = "active";
$SUActive = "";

      include('includes/functions.php'); 
    if(isset($_POST['login'])){
        /*function validateFormData($formData)
        {
            $formData = trim(stripslashes(htmlspecialchars($formData)));
            return $formData;
        }*/
    
    //Create varibales to store data
    //Wrap data with validating functions

    $formUser = validateFormData($_POST['username']);
    $formPass = validateFormData($_POST['password']);
    
    //Connect to db
    include('includes/connections.php');

    //create SQL query

    $query = "select username,password,role from users where username='$formUser'";

    //store result
    $result = mysqli_query($conn,$query);

    //verify is user is returned
    if(mysqli_num_rows($result)>0){
        if(mysqli_num_rows($result)>1)
        {
            $loginError = "<div class='alert alert-danger'>There is some issue in DB please contact admin <a class='close' data-dismiss='alert'>&times;</a> </div>";
        }
        else{
            //exactly one row is returned
            //store basic userdata in variables
            
            if($row = mysqli_fetch_assoc($result)){
                $user = $row['username'];
               /* $email = $row['email'];*/
                $hashedPass = $row['password']; 
                $role = $row['role'];
            }
            
            
            //verify whether hashed pass is correct or not
            
            if(password_verify($formPass,$hashedPass)){
                //details are correct
                //start session
                session_start();
                
                //store values in session
                
                $_SESSION['loggedInUser']=$user;
                $_SESSION['loggedInEmail']=$email;
                $_SESSION['loggedInRole']= $role;
                header("Location: myprofile.php");
            
            }
            else{
                //password didnt verify
                
                 $loginError = "<div class='alert alert-danger'>Wrong Username and Password Combo <a class='close' data-dismiss='alert'>&times;</a> </div>";
            }
            
            
        }
        
    }

    else
    {
         $loginError = "<div class='alert alert-danger'>No Such User Found <a class='close' data-dismiss='alert'>&times;</a> </div>";
    }
    //login error
    mysqli_close($conn);

    }/*end of isset*/
    include('includes/connections.php');
     $nameError = $emailError = $passwordError = $message= $phoneError = $fnameError = $lnameError = "";
     if(isset($_POST['add']))
     {
        $SIActive = "";
         $SUActive = "active";
        
        //set to blank
        
        $name = $email = $password="";
        //check for inputs
        if(!$_POST['signup-name']){
            $nameError = "Please Enter a Name";
        }
        else{
            $name = validateFormData($_POST['signup-name']);
            
            $query = "select username from users where username='$name'";

            //store result
            $result = mysqli_query($conn,$query);

            //verify is user is returned
            if(mysqli_num_rows($result)>0){
                
                $nameError = "Username Already Exists";
                $name=NULL;
                
            }
        }
        
        if(!$_POST['signup-email']){
            $emailError = "Please Enter a Email";
        }
        else{
            $email = validateFormData($_POST['signup-email']);
            
            $query = "select email from users where email='$email'";

            //store result
            $result = mysqli_query($conn,$query);

            //verify is user is returned
            if(mysqli_num_rows($result)>0){
                
                $emailError = "Email is already registered";
                $email = NULL;
            }
            
        }
        
         if(!$_POST['signup-password']){
            $passwordError = "Please Enter a Password";
         }
        else{
            
            $testPass = validateFormData($_POST['signup-password']);
            $emailString = explode("@",$email,1);
            $firstCombo = "$emailString[0]$name";
            $secondCombo = "$name$emailString[0]";
            /*$testPass = strtolower($testPass);
            $firstCombo = strtolower($firstCombo);
            $secondCombo = strtolower($secondCombo);
            */
            if(strcasecmp($testPass,$firstCombo)==0){
                $passwordError = "Password Cannot be a combination of email and name, Please chose another password";
            }
            else if(strcasecmp($testPass,$secondCombo)==0){
                $passwordError = "Password Cannot be a combination of email and name, Please chose another password";
            }
            else{
                $password = password_hash(validateFormData($_POST['signup-password']),PASSWORD_DEFAULT);
                
            
            }
        }
        
        //check if all data is feeded or not
        if(!$_POST['signup-phone']){
            $phoneError = "Please Enter your Phone Number";
        }
        else{
            $phone = validateFormData($_POST['signup-phone']);
            
            $query = "select phone from users where phone='$phone'";

            //store result
            $result = mysqli_query($conn,$query);

            //verify is user is returned
            if(mysqli_num_rows($result)>0){
                
                $phoneError = "Phone Number is already registered";
                $phone = NULL;
            }
        }
            
         if(!$_POST['signup-fname']){
            $fnameError = "Please Enter your First Name";
        }
        else{
            $fname = validateFormData($_POST['signup-fname']);
            
        }
            
        if(!$_POST['signup-lname']){
            $lnameError = "Please Enter your Last Name";
        }
        else{
            $lname = validateFormData($_POST['signup-lname']);
            
        }
        if($name && $email && $password && $phone && $fname && $lname){
            $query = "Insert into users(username,email,password,role,phone) values('$name','$email','$password','user','$phone')";
            if(mysqli_query($conn,$query))
            {
                $query2 = "select id from users where username = '$name'";
                 $result1 = mysqli_query($conn,$query2);
    
                  $row = mysqli_fetch_assoc($result1);
                  $id = $row['id'];
                    
                 $query3 = "insert into personal_details(first_name,last_name,userID) values('$fname','$lname',$id)";
                 if(mysqli_query($conn,$query3))
                 {
                    $message = "<div class='alert alert-success'>User Successfully Added </div>";
                /* echo "<div class='alert alert-success'>New Record in DB </div>";*/
                     
                }
                else
                    $message ="<div class='alert alert-danger'>".mysqli_error($conn)." </div>";
            }
        
            else
                $message ="<div class='alert alert-danger'>".mysqli_error($conn)." </div>";
               /* echo "<div class='alert alert-danger'>".mysqli_error($conn)." </div>";*/
        }
        mysqli_close($conn);
    }
    $title = "Sign In";
    include_once('includes/header.php');



?>

<div class="container">
            
    
        <div class="row"> 
        <div class="col-md-3"></div>
        <div class="col-md-6">   
            <div class="panel panel-default">

               
                    
                    <div class="panel-body">
                        
                        <!-- Nav tabs -->
                            <ul class="nav nav-tabs" role="tablist">
                              <li class='<?php echo " $SIActive"?>'><a href="#sign-in" role="tab" data-toggle="tab">Sign In</a></li>
                              <li class='<?php echo " $SUActive"?>'><a href="#sign-up" role="tab" data-toggle="tab">Sign Up</a></li>
                              
                            </ul>

                            <!-- Tab panes -->
                            <div class="tab-content">
                              <div class='tab-pane <?php echo " $SIActive"?>' id="sign-in">
                                <br>
                                <form class="form-vertical" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>" method="post">

                            <div class="form-group">
                              
                                
                                    <?php
                                        if($loginError){
                                            echo $loginError;

                                        }
                                    ?>
                                <label for="login-username" class="sr-only">Username</label>
                                <input type="text" id="login-username" name="username" placeholder="Username" class="form-control" data-toggle="tooltip" data-placement="bottom" title="Enter your username">


                            </div>

                            <div class="form-group">

                                <label for="login-password" class="sr-only">Password</label>
                                <input type="password" id="login-password" name="password" placeholder="Password" class="form-control" data-toggle="tooltip" data-placement="bottom" title="Enter your Password">


                            </div>
                            <div class="row">
                            <div class="col-md-5"></div>    
                                <button type="submit" class="btn btn-primary text-center" name="login">Login</button>
                            
                            </div>




                    </form>


                                
                                </div><!--end of signIn-->
                                
                                
                                
                              <div class='tab-pane <?php echo " $SUActive"?>' id="sign-up">
                                
                                 
                                 <br>
                                <form class="form-vertical" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>" method="post">

                            <div class="form-group">
                                
                                 <?php
                                        if($message){
                                            echo $message;

                                        }
                                    ?>
                                
                                <label for="signup-name" class="sr-only">Username</label>
                                <input type="text" id="signup-name" name="signup-name" placeholder="Username" class="form-control" data-toggle="tooltip" data-placement="bottom" title="Enter your username">
                                <small class="text-danger"><?php echo $nameError;?> </small>   


                            </div>

                            <div class="form-group">

                                <label for="signup-password" class="sr-only">Password</label>
                                <input type="password" id="signup-password" name="signup-password" placeholder="Password" class="form-control" data-toggle="tooltip" data-placement="bottom" title="Enter your Password">
                                 <small class="text-danger"><?php echo $passwordError;?> </small> 

                            </div>

                             <div class="form-group">

                                <label for="signup-email" class="sr-only">Email</label>
                                <input type="email" id="signup-email" name="signup-email" placeholder="Email" class="form-control" data-toggle="tooltip" data-placement="bottom" title="Enter your Email Id">
                                <small class="text-danger"><?php echo $emailError;?> </small>


                            </div>
                             <div class="form-group">

                                <label for="signup-phone" class="sr-only">Phone</label>
                                <input type="text" id="signup-phone" name="signup-phone" placeholder="Phone Number" class="form-control" data-toggle="tooltip" data-placement="bottom" title="Enter your Phone Number">
                                <small class="text-danger"><?php echo $phoneError;?> </small>


                            </div>
                             <div class="form-group">

                                <label for="signup-fname" class="sr-only">First Name</label>
                                <input type="text" id="signup-fname" name="signup-fname" placeholder="First Name" class="form-control" data-toggle="tooltip" data-placement="bottom" title="Enter your First Number">
                                <small class="text-danger"><?php echo $fnameError;?> </small>


                            </div>
                            <div class="form-group">

                                <label for="signup-fname" class="sr-only">Last Name</label>
                                <input type="text" id="signup-lname" name="signup-lname" placeholder="Last Name" class="form-control" data-toggle="tooltip" data-placement="bottom" title="Enter your Last Number">
                                <small class="text-danger"><?php echo $lnameError;?> </small>


                            </div>
                            <div class="row">
                            <div class="col-md-5"></div>    
                                <button type="submit" class="btn btn-primary text-center" name="add">Sign Up!</button>
                            
                            </div>


                                </form>
                            
                              </div><!--end of signUp-->
                              
                            </div>

                    
                    </div><!--end of panel body-->
                    </div><!--end of panel-->
                </div> 
                 <div class="col-md-3"></div>
                </div><!--end of row-->
   
</div>

<div id="login-footer">
<?php

      include_once('includes/footer.php');
?>
</div>





