<?php

    include_once('includes/connections.php');
    include_once("includes/functions.php");
    $id = $_POST['id'];
    
    header("content-type:application/json");

    if($id)
    {
        $query = "delete from vehicles where id=$id";
        $result = mysqli_query($conn,$query);
        if($result)
        if($result)
        {
            $data['success'] = true;
        }      
        else{
            $data['success'] = false;
        }
         echo json_encode($data);        
        

    }
    

?>