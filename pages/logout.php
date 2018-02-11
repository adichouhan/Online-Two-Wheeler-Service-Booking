<?php
    
    include_once('includes/header.php');
    session_start();

    if(isset($_COOKIE[session_name()])){
        //empty cookie
        setcookie(session_name(),'',time()-86400,'/');  // / stands for root makes cookie accessible from everywhere                                     
    }
    //clear all session variables
    session_unset();
    
    //after clearing it is IMP to destroy the session 

    session_destroy();

   echo "<div class='container'>";
    echo"<p class='lead text-center'>You have been successfully logged out See u next time</p>" ;



    echo "<p class='lead text-center'><a href='login.php' class='btn btn-success'><span class='glyphicon glyphicon-user'></span>  Log Back In! </a></p>";

    echo "</div>";
    include_once('includes/footer.php');
        
?>