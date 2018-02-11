<?php

if(isset($_POST['feedback-submit']))
{
    
    include_once('includes/connections.php');
    include_once("includes/functions.php");
    $name = validateFormData($_POST['formName']);
    $email = validateFormData($_POST['formEmail']);
    $phone = validateFormData($_POST['formPhone']);
    $comments = validateFormData($_POST['formComments']);

    if($name && $email && $phone && $comments)
    {
        $query = "insert into feedback values('".$name."','".$email."','".$phone."','".$comments."',Now())";
        $result = mysqli_query($conn,$query);
        if($result)
        {
    
            header("location: contact-us.php?submitted=success");
        }      
        else{
            echo "ERROR: ".$query."<br>".mysqli_error($conn);
        }
        
    }
    
}
$title = "Contact Us";
include_once('includes/header.php');
?>

    <div class="container-fluid" id="contact-container">
        
        
            
                <div class="page-header text-center">
            
                    <h1>Contact Us</h1>
                    <p class="lead">Feel free to contact us!</p>

                </div><!--Page Header-->
        
                <div class="row">
        
                    <div class="col-md-4 text-center">
                        
                        <div class="panel panel-primary">
                          <div class="panel-heading"><i class="fa fa-phone" aria-hidden="true"></i> Phone Number</div>
                          <div class="panel-body">+910909090910</div>
                        </div>
                    </div>
                        
                     <div class="col-md-4 text-center">
                        
                        <div class="panel panel-primary">
                          <div class="panel-heading"><i class="fa fa-envelope" aria-hidden="true"></i> E-Mail ID</div>
                          <div class="panel-body">twscwi@yourdomain.com</div>
                        </div>
                    </div>
                    
                     <div class="col-md-4 text-center">
                        
                        <div class="panel panel-primary">
                          <div class="panel-heading"><i class="fa fa-map-marker" aria-hidden="true"></i> Address</div>
                          <div class="panel-body">Mumbai,India</div>
                        </div>
                    </div>
                        
                    
        
        
        
                </div>
                <div class="row">
        
                    <div class="col-md-6">
                    <?php
                        if(!isset($_GET['submitted'])){
                            ?>
                        
                    <form id="contact-form" action='<?php echo htmlspecialchars($_SERVER['PHP_SELF'])?>' method="POST">

                        
                            <div class="form-group">

                                <label for="formName">Your Name<span class="red-star"><sup> *</sup></span></label>
                                <input type="text" id="formName" class="form-control" name="formName">

                            </div>

                            <div class="form-group">

                                <label for="formEmail">Email<span class="red-star"><sup> *</sup></span></label>
                                <input type="email" id="formEmail" class="form-control" name="formEmail">
                                <small class="form-text text-muted">We'll never share your email with anyone else.</small>


                            </div>

                            <div class="form-group">
                                <label for="formPhone">Mobile Number<span class="red-star"><sup> *</sup></span></label>
                                <input type="text" id="formPhone" class="form-control" name="formPhone">

                            </div>

                              <div class="form-group">

                                <label for="formComments">Comments<span class="red-star"><sup> *</sup></span></label>
                                  <textarea id="formComments" rows="5" class="form-control" name="formComments"></textarea>

                            </div>
                        
                            <button type="submit" class="btn btn-primary" name="feedback-submit">Submit</button>
                        
                    </form>
                <?php       
                        }
                        else
                        {
                            ?>
                            
                            <div class="panel panel-default panel-shadow text-black">
 
                                <div class="panel-body ">

                                
                                <div class="text-center">
                                        <canvas height="200" ></canvas>
                                </div>
                                <p class="lead text-center">Your Feedback was successfully submitted.<br> Thank you for your feedback! </p>



                            </div><!--end of panel-body-->
  
                </div><!--end of panel-->
                            
                            
                            
                            
                            
                            
                        <?php    
                            
                            }
                        ?>
                </div><!--end of col-md-6-->
                <div class="col-md-4">

                    <iframe width="650" height="450" frameborder="0" style="border:0"
    src="https://www.google.com/maps/embed/v1/view?zoom=10&center=19.0760,72.8777&key=AIzaSyCrI7FzwjA-ycI1aE2FF61bHkCj8APpFqc" allowfullscreen></iframe>


            
            
            
            
            </div><!--end of col-md-4-->
        
        </div><!--End of row-->
        
    </div><!--.container-->

<?php

include_once('includes/footer.php');

?>
     <!--Validate Plugin-->
        <script src="../assets/js/jquery.validate.js">  </script>
        <script src="../assets/js/additional-methods.js"></script>
    <!--Form Validation-->
    <script src="../assets/js/contact-us.js"></script>
    <script>
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


