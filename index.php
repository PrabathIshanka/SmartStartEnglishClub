<!DOCTYPE html>
<html lang="en">

    <!-- Basic -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">   
   
    <!-- Mobile Metas -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
 
     <!-- Site Metas -->
    <title>Smart Start English Club</title>  
    <meta name="keywords" content="">
    <meta name="description" content="">
    <meta name="author" content="">

    <!-- Site Icons -->
    <link rel="shortcut icon" href="images/logo2.jpg" />
    <link rel="apple-touch-icon" href="images/logo2.jpg">

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

    <!-- Modernizer for Portfolio -->
    <script src="js/modernizer.js"></script>
	<script src="jquery-3.5.1.min.js"></script>
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
	
	
</head>
<body class="host_version" > 

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
	
	<div id="carouselExampleControls" class="carousel slide bs-slider box-slider" data-ride="carousel" data-pause="hover" data-interval="false" >
		
		<div class="carousel-inner" role="listbox">
			<div class="carousel-item active">
				<div id="home" class="first-section" style="background-image:url('images/bg.jpg');">
					<div class="dtab">
						<div class="container">
							<div class="row">
								<div class="col-md-12 col-sm-12 text-md-center">
									<div class="big-tagline">
										<h2><strong>Smart Start  </strong> English Club</h2>
										
									</div>
								</div>
							</div><!-- end row -->            
						</div><!-- end container -->
					</div>
				</div><!-- end section -->
			</div>
			</div>
			
			
		</div>
	</div>
			
	</section>


		
		<div class="carousel-inner" role="listbox" ><!-- start course card section -->
			<div class="carousel-item active">
				<div id="home" style="background-color: white;">
				
					<div class="container py-5" >
							<div class="row" >
		
								<?php 
		
								include "connection.php";
		
								$con = mysqli_connect($host,$uname,$pwd) or die("Could not connect to database." .mysqli_error());
		
								mysqli_select_db($con,$db_name) or die("Could not select the database." .mysqli_error());
		
								$query="select *from `course` order by name";
								$query_run=mysqli_query($con,$query);
		
								while($row=mysqli_fetch_array($query_run))
								{
									?>
					
							 	
								
								<div class="col-sm-4 py-2" >
									
										<div class="card h-100 " style="text-align: center" >
											
												<div class="card-body h-100" style="background-color: #EDEDED;">
													
													<div class="blog-title">
													<h3>Certificate course in <?php echo "{$row['name']}"; ?></h3>
													</div>
											<div class="blog-desc">
												<?php echo "{$row['description']}"; ?><br><b>Duration: <?php echo "{$row['duration']}"; ?> hours<br>Course Fee: LKR <?php echo "{$row['fee']}"; ?></b>
											</div>
														
											<div class="blog-button">
												<a href="#" data-href="register_modal.php?c=<?php echo $row['courseNo'] ?>" class="hover-btn-new orange reg" ><span>Register Now</span></a>
											</div>
												
											    </div>
												
										</div>
										
									</div>	
									
									
		
									<?php
								}
	
		
									?>
		 
							</div>
						</div>
					</div>
				</div>
			</div><!-- end course card section -->
		
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
    <!-- ALL PLUGINS -->
    <script src="js/custom.js"></script>
	<script src="js/timeline.min.js"></script>
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