<?php
if (isset($_POST['submit'])) {
	$fullname = $_POST ["fullname"];
	$email = $_POST ["email"];
	$subject = $_POST ["subject"];
	$message = $_POST ["message"];

	$to = 'imeshapitadeniya2@gmail.com';
	$mail_subject = 'Message from website';
	$email_body = "Message fro Contact Us page of the Website: <br> ";
	$email_body ="<b>From:</b> {$fullname} <br>";
    $email_body ="<b>Subject:</b> {$subject} <br>";
    $email_body ="<b>Message:</b><br> ". nl2br(strip_tags($message));

    $header = "From: {$email}\r\nContent-Type: text/html;";

    $send_mail_result = mail($to, $mail_subject, $email_body, $header);

    if ( $send_mail_result ){

    	echo "Message Sent.";
    }else{
    	echo "Message Not Sent.";
    }

}


?>
<!DOCTYPE html>
<html lang="en">
    <!-- Basic -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">   
   
    <!-- Mobile Metas -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
 
     <!-- Site Metas -->
    <title>SmartEDU - Education Responsive HTML5 Template</title>  
    <meta name="keywords" content="">
    <meta name="description" content="">
    <meta name="author" content="">
	<link type="text/css" rel="stylesheet" href="css/contact.css">
    <!-- Site Icons -->
    <link rel="shortcut icon" href="images/favicon.ico" type="image/x-icon" />
    <link rel="apple-touch-icon" href="images/apple-touch-icon.png">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <!-- Site CSS -->
    <link rel="stylesheet" href="style.css">
    <!-- ALL VERSION CSS -->
    <link rel="stylesheet" href="css/versions.css">
    <!-- Responsive CSS -->
    <link rel="stylesheet" href="css/responsive.css">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="css/custom.css">
	<script language="javascript" type="text/javascript" src="js/contact.js"></script>
    <!-- Modernizer for Portfolio -->
    <script src="js/modernizer.js"></script>

    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>
<body class="host_version"> 

	<div class="modal fade" id="login" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" >
	  <div class="modal-dialog modal-dialog-centered modal-lg" role="document" style="width: 40%">
		<div class="modal-content" style="border-radius: 10px; overflow: hidden;">
			<iframe id="ilogin" src="login.php?a=1" style="height:410px;border:none;"></iframe>
		</div>
	  </div>
	</div>
	
	<div class="modal fade" id="register" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" >
	  <div class="modal-dialog modal-dialog-centered modal-lg" role="document" style="width: 40%">
		<div class="modal-content" style="border-radius: 10px; overflow: hidden;">
			<iframe id="iregister" src="register_modal.php?c=<?php echo $cno?>" style="height:410px;border:none;"></iframe>
		</div>
	  </div>
	</div>
	
	<!-- Start header -->
	<header class="top-navbar">
		<nav class="navbar navbar-expand-lg navbar-light bg-light">
			<div class="container-fluid" >
					<img src="images/logo4.png" alt="" width="60px" height="60px"/>
				
				<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbars-host" aria-controls="navbars-rs-food" aria-expanded="false" aria-label="Toggle navigation">
					<span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
				</button>
				<div class="collapse navbar-collapse" id="navbars-host">
					<ul class="navbar-nav ml-auto">
						<li class="nav-item active"><a class="nav-link" href="index.php"> Home </a></li> &emsp;
						<li class="nav-item"><a class="nav-link" href="about.php"> About Us </a></li> &emsp;
						
						<li class="nav-item"><a class="nav-link" href="contact.php"> Contact </a></li> &emsp;
					</ul>
					<ul class="nav navbar-nav navbar-right">
                        <li><a class="hover-btn-new log orange" href="#" data-toggle="modal" data-target="#login"><span> LOGIN </span></a></li>
						
                    </ul>
				</div>
			</div>
		</nav>
	</header>
	<!-- End header -->
	
	<div class="all-title-box">
		<div class="container text-center">
			<h1>Contact<span class="m_1"></span></h1>
		</div>
	</div>
	
    <div class="container1">
    <h1>Contact Us</h1>
 	<form action="contact.php" method="post" onSubmit="return validateform(this);">
 		<p>
 			<label for="fullname">Full Name *:</label>
 			<input type="text" name="fullname" id="fullname" required>
 		</p>	
        <p>
 			<label for="email">Email *:</label>
 			<input type="email" name="email" id="email" required>
 		</p>	
        <p>
 			<label for="subject">Subject *:</label>
 			<input type="text" name="subject" id="subject" required>
 		</p>	
         <p>
 			<label for="message">Message *:</label>
 			<textarea name="message" id="message" cols="30" rows="10" required></textarea>
 		</p>	

        <p>
        	<button type="submit" name="submit">Send Message</button>

</div>

	<div class="contact-in">
	<div class="contact-map">
		<iframe src="https://goo.gl/maps/49gpz7tjaQBFDuhm8" width="100%" height="500px" frameborder="0" style="border: 0;" allowfullscreen="" aria-hidden="false" tabindex="0"></iframe>
	</div>
</div>

 <footer class="footer">
      <div class="container">
            <div class="row">
                <div class="col-lg-4 col-md-4 col-xs-12">
                    <div class="widget clearfix">
                        <div class="widget-title">
                            <h3>About US</h3>
                        </div>
                        <p> We are committed to provide world class education for our students. We used presentations and activity based teaching for our students. We will be conduting seperate sessions under reading, writing, listning and speaking.</p>   
												
                    </div><!-- end clearfix -->
                </div><!-- end col -->

				<div class="col-lg-4 col-md-4 col-xs-12">
                    <div class="widget clearfix">
                        <div class="widget-title">
                            <h3>Information Link</h3>
                        </div>
                        <ul class="footer-links">
                            <li><a href="index.php">Home</a></li>
							<li><a href="about.php">About</a></li>
							<li><a href="contact.php">Contact</a></li>
                        </ul><!-- end links -->
                    </div><!-- end clearfix -->
                </div><!-- end col -->
				
                <div class="col-lg-4 col-md-4 col-xs-12">
                    <div class="widget clearfix">
                        <div class="widget-title">
                            <h3>Contact Details</h3>
                        </div>

                        <ul class="footer-links">
                            <li><a href="mailto:#">smartstartenglishclub@gmail.com</a></li>
                            <li><a href="#">www.smartstartenglishclub.com</a></li>
                            <li>No.374/2, Kanda Pansala Road, Nagashandiya, Kalutara, Sri Lanka
</li>
                            <li>077 329 2392</li>
                        </ul><!-- end links -->
                    </div><!-- end clearfix -->
                </div><!-- end col -->
				
            </div><!-- end row -->
        </div><!-- end container -->
    </footer><!-- end footer -->

    <div class="copyrights">
        <div class="container">
            <div class="footer-distributed">
                <div class="footer-center">                   
                    <p class="footer-company-name">All Rights Reserved. &copy; 2021 <a href="#">Smart Start English Club</a></p>
                </div>
            </div>
        </div><!-- end container -->
    </div><!-- end copyrights -->

    <a href="#" id="scroll-to-top" class="dmtop global-radius"><i class="fa fa-angle-up"></i></a>

    <!-- ALL JS FILES -->
    <script src="js/all.js"></script>
	<script src="https://maps.googleapis.com/maps/api/js?libraries=places&key=AIzaSyCKjLTXdq6Db3Xit_pW_GK4EXuPRtnod4o"></script>
	<!-- Mapsed JavaScript -->
	<script src="js/mapsed.js"></script>
	<script src="js/01-custom-places-example.js"></script>
    <!-- ALL PLUGINS -->
    <script src="js/custom.js"></script>
	<script>
		$('#login').on('hidden.bs.modal', function() {
			window.location.reload();
		});
	</script>
<script  type='text/javascript'>
	$(document).ready(function() {
	  $(".reg").click(function(e) {
		e.preventDefault();
		var url = $(this).attr("data-href");
		$("#register iframe").attr("src", url);
		$("#register").modal("show");
	  });
	});
</script>

</body>
</html>