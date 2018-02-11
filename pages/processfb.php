<?php
    require("../../PHPMailer-master/PHPMailerAutoload.php");
    /*require("../../PHPMailer-master/class.phpmailer.php");*/
    include_once('includes/connections.php');
    include_once("includes/functions.php");
    $name = validateFormData($_POST['formName']);
    $email = validateFormData($_POST['formEmail']);
    $phone = validateFormData($_POST['formPhone']);
    $comments = validateFormData($_POST['formComments']);
    header("content-type:application/json");

    if($name && $email && $phone && $comments)
    {
        $query = "insert into feedback values('".$name."','".$email."','".$phone."','".$comments."',Now())";
        $result = mysqli_query($conn,$query);
        if($result)
        {
            $data['success'] = true;
        }      
        else{
            $data['success'] = false;
        }
        	//echo json_encode($data);
        if($data['success'])
        {
            
        
            $mail = new PHPMailer();
            $mail->isSMTP();                                      // Set mailer to use SMTP
            $mail->Host = 'smtp.gmail.com';  // Specify main and backup SMTP servers
            $mail->SMTPAuth = true;                               // Enable SMTP authentication
            $mail->Username = '';                 // SMTP username - you email here
            $mail->Password = '';                           // SMTP password
            $mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
            $mail->Port = 587;                                    // TCP port to connect to

            $mail->setFrom('', 'TWS');//tws is the Sender name displayed
            $mail->addAddress($email, $name);     // Add a recipient
            $mail->isHTML(true);                                  // Set email format to HTML

            $mail->Subject = 'Feedback Recieved';
            $mail->Body    = '<h1>Thank you for your feedback!</h1>';
            $mail->AltBody = 'Thank you for your feedback!';
            //$mail->send();
            if(!$mail->send()) {
               $data['success'] = false;

            } else {
                $data['success'] = true;   
            }
        }
        echo json_encode($data);        
        

    }
    else{
        $data['success'] = false;
        echo json_encode($data);
    }
    



?>