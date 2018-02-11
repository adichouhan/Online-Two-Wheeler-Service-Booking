<?php
    $title = "About US";
    include_once('includes/header.php');
    
    ?>

    <div class="container-fluid custom-padding">

    
       <div id="about-main-img">
           
           <img src="../assets/images/about-us.jpg" width="100%" height="500px" id="about-img"> 
           
           <h1 class="form-head" id="about-head">About Us</h1>
                   
           
       </div>   
   
   
   

     

        <div class="row custom-r-height-small">
            
            <div class="col-md-4  text-center">
                
                <div class="num-group">
                <h2 class="num-head"><span class="count">25</span></h2>
                <h5 class="num-caption">Service Centers</h5>
                </div>
                
            </div>
            
            <div class="col-md-4  text-center">
                
                  
                <div class="num-group">
                <h2 class="num-head"><span class="count">1000</span>+</h2>
                <h5 class="num-caption">Happy Customers</h5>
                </div>
            </div>
            
            <div class="col-md-4 text-center" >
                
                <div class="num-group">
                    <h2 class="num-head"><span class="count">500</span></h2>
                    <h5 class="num-caption">Strong Workforce</h5>
                </div>
            </div>
            
   
            
            
            
        </div>
                 <div class="about-content bg-1">
                
                <h1 class="text-center">Our Story</h1>
                
                <p>Our vehicle problems not only interfere with your time and peace of mind, but often dig a hole in your pocket as well. As a solution to this problem, we started this site with the vision of empowering people with an affordable, convenient, and transparent approach to auto repair and maintenance. No negotiating, no trips to the service center, no surprises.</p>
                
                  <p>
                      
                      We believe that seamless, automatic service trumps last minute, on-demand requests and with our less than 30-seconds booking process, secure payment, and a 100% money-back guarantee, We aim to be the easiest and most convenient way to provide your vehicle the service it deserves.
                      
                  </p>      
                
                
                
            </div>
     </div>

    <?php 
        include_once('includes/footer.php');
    ?>
    
    <script>
    $(document).ready(function(){
    $('.count').each(function () {
    $(this).prop('Counter',0).animate({
        Counter: $(this).text()
    }, {
        duration: 1000,
        easing: 'swing',
        step: function (now) {
            console.log(now);
            $(this).text(Math.ceil(now));
        }
    });
});});
        
    
    
    
    </script>

