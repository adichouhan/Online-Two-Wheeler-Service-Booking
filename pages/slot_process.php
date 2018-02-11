<?php


  session_start();

    //whether user has logged in or not

    if(!isset($_SESSION['loggedInUser'])){
        
        //send them to login page
        header('Location: login.php');
    }
    require("../../PHPMailer-master/PHPMailerAutoload.php");
    /*require("../../PHPMailer-master/class.phpmailer.php");*/
    include_once('includes/connections.php');
    include_once("includes/functions.php");
    
    $vehicle = validateFormData($_POST['vehicle']);
    $date = validateFormData($_POST['slotdate']);
    $slot = validateFormData($_POST['timing']);
    $id =  validateFormData($_POST['id']);
    
    $today = date('Y-m-d');
    $time = strtotime($today);
    $min = $time +  86400000; 
    $max = $time +  (86400000*30);
    $user_date = strtotime($date);
    if(($min >= $user_date) || ($max <= $user_date))
    {
        $date = null;    
    }
    $query = "select username,email from users where id=$id";
    $result = mysqli_query($conn,$query);
    if($result)
        $row = mysqli_fetch_assoc($result);
    else
        mysqli_error($conn);
    $email = $row['email'];
    $name = $row['username'];
    header("content-type:application/json");
    if($vehicle&&$date&&$slot)
    {
            $query = "insert into transaction (userID,vehicle,slotDate,slotTiming) values($id,'$vehicle','$date','$slot')";
            $result = mysqli_query($conn,$query);

            if($result)
            {
                 $data['success'] = true;
            }      
            else
            {
                $data['success'] = false;
            }
                //echo json_encode($data);
            if($data['success'])
            {


                $mail = new PHPMailer();
                $mail->isSMTP();                                      // Set mailer to use SMTP
                $mail->Host = 'smtp.gmail.com';  // Specify main and backup SMTP servers
                $mail->SMTPAuth = true;                               // Enable SMTP authentication
                $mail->Username = '';                 // SMTP username
                $mail->Password = '';                           // SMTP password
                $mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
                $mail->Port = 587;                                    // TCP port to connect to

                $mail->setFrom('', 'TWS');//tws is the Sender name displayed
                
                $mail->addAddress($email,$name);     // Add a recipient
                $mail->isHTML(true);                                  // Set email format to HTML

                $mail->Subject = 'Slot Booked';
                $mail->Body    = "<h1>Service Slot Booking Confirmation</h1><p>A service slot has been booked for $date for vehicle $vehicle, for timing $slot";
                $mail->AltBody = "Service Slot Booking Confirmation A service slot has been booked for $date for vehicle $vehicle, for timing $slot";
                //$mail->send();
                if(!$mail->send()) {
                   $data['success'] = false;

                } 
                else
                {
                    $data['success'] = true;   
                }
            }
                echo json_encode($data);        


    }
            else
            {
                $data['success'] = false;
                echo json_encode($data);
            }



                
                

    
        




?>