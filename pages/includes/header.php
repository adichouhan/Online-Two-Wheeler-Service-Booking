<html>

    <head>
        
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>TWS- <?php echo $title;?></title>

        <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="../assets/css/bootstrap/css/bootstrap.css">
       <!-- <link rel="stylesheet" href="../assets/css/bootstrap/css/bootstrap-theme.css">-->
        
        <!--Custom CSS-->
        <link rel="stylesheet" href="../assets/css/two-wheeler.css">
        <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
            <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
            <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->
    </head>
    
    <body style="padding-top: 60px;">
        <nav class="navbar navbar-inverse navbar-fixed-top">
        
                <div class="container-fluid">
                
                        <div class="navbar-header">
                        
                            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse">
                                
                                <span class="sr-only">Toggle Navigation</span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                            
                            </button>
                            
                            <a class="navbar-brand" href="Home-Page.php">TWS</a>
                        
                        </div>
            
                        <div class="collapse navbar-collapse" id="navbar-collpase">
                    
                            
                            <?php
                                if(isset($_SESSION['loggedInUser'])){
                            ?>
                                <ul class="nav navbar-nav">
                                  <li class="custom-li-back"><a href="myprofile.php">My Profile</a></li>
                                  <li class="custom-li-back"><a href="book.php">Book a Slot</a></li>
                                  <li class="custom-li-back"><a href="transhistory.php">View Transactions</a></li>
                                </ul>

                                    <ul class="nav navbar-nav navbar-right">
                            
                                        <p class="navbar-text">Hello, <?php echo $_SESSION['loggedInUser'];?></p>
                                        <li><a href="logout.php">Log Out</a></li>
                                        
                                    </ul>
                                    
                                    
                                    <?php
                                    
                                        }
                                        else{
                                            
                                            
                                        
                                    ?>
                                    
                                       <ul class="nav navbar-nav">
                                          <li class="custom-li-back"><a href="Home-Page.php">Home</a></li>
                                          <li class="custom-li-back"><a href="about-us.php">About Us</a></li>
                                          <li class="custom-li-back"><a href="contact-us1.php">Contact Us</a></li>
                                        </ul>
                                        <ul class="nav navbar-nav navbar-right">
                                            <li class="custom-li-back"><a href="login.php"><span class="fa  fa-sign-in
                        "></span> Login</a></li>
                                        </ul>

                            
                            
                            
                                    <?php
                                        }
                                            
                                            
                                    ?>
                    
                        </div>
            
            
            
            
                </div><!--end of container-->
        
        
        
        </nav>
        








