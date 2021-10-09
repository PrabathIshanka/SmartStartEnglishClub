<?php
include"connection.php";
$flag=0;
$flag=$_POST["hdflag"];
$nic=$_POST["txtNIC"];
$course=$_POST["cmbCourse"];
$fee=$_POST["txtAmount"];
$photo="";
$slip="";
$con = mysqli_connect($host,$uname,$pwd);
mysqli_select_db($con, $db_name);

if(!isset($_POST["cmbCourse"]) and $flag==0)
{
	$c=$_GET['c'];
	$con = mysqli_connect($host,$uname,$pwd);
	mysqli_select_db($con, $db_name);
	$sql = "select course.name , course.fee from course where courseNo='$c'";
	$result=mysqli_query($con,$sql) or die(mysqli_error($con));
	while($row=mysqli_fetch_array($result))
	{
			$course=$row['name'];
			$fee=$row['fee'];
	}
	mysqli_close($con);
	
}

if(isset($_POST["txtNIC"],$_POST["cmbCourse"]) and $flag==0)
{
	$flag=1;
	$required='required';
	$prequired='required';
	$readonly='';
	/*
	$fName = '';
	$lName = '';
	$title = '';
	$bDate = '';
	$add1 = '';
	$add2 = '';
	$add3 = '';
	$add4 = '';
	$mobile = '';
	$email = '';
	$photo = '';
	$slip = '';*/
	$sql = "SELECT * FROM student WHERE nic='$nic'";
	$result=mysqli_query($con,$sql) or die(mysqli_error($con));
	
	while($row=mysqli_fetch_array($result))
		{
			$required='';
			$readonly='readonly';
			$fName = $row["fName"];
			$lName = $row["lName"];
			$title = $row["title"];
			$bDate = $row["dob"];
			$add1 = $row["aLine1"];
			$add2 = $row["aLine2"];
			$add3 = $row["aLine3"];
			$add4 = $row["aLine4"];
			$mobile = $row["mobile"];
			$email = $row["email"];
			$photo = $row["image"];			
		}
	
	$sql = "select batch.batchCode from course,batch where course.courseNo=batch.courseNo and (curdate() between batch.appliFrom and batch.appliTo) and course.name='$course'";
	$result=mysqli_query($con,$sql) or die(mysqli_error($con));
	while($row=mysqli_fetch_array($result))
		{
			$batch=$row[0];
		}
	
	$sql = "SELECT * FROM payment WHERE nic='$nic' and batchCode='$batch'";
	$result=mysqli_query($con,$sql) or die(mysqli_error($con));
	
	while($row=mysqli_fetch_array($result))
		{
			$prequired='';
			//$amount = $row["amount"];
			$pDate = $row["date"];
			$slip = $row["payslip"];
						
		}
	
	$sql = "select count(*) from student where nic='$nic'";
	$result=mysqli_query($con,$sql) or die(mysqli_error($con));
	while($row=mysqli_fetch_array($result))
		{
			$c=$row[0];
		}

	$sql = "select count(*) from studentbatch where nic='$nic' and batchCode='$batch'";
	$result=mysqli_query($con,$sql) or die(mysqli_error($con));
	while($row=mysqli_fetch_array($result))
		{
			$c2=$row[0];
		}
	
}


if(isset($_POST["cmbCourse"],$_POST["txtNIC"],$_POST["txtFName"],$_POST["txtLName"],$_POST["cmbTitle"],$_POST["bDate"],$_POST["txtAdd1"],$_POST["txtAdd2"],$_POST["txtAdd3"],$_POST["txtAdd4"],$_POST["txtMobile"],$_POST["txtEmail"],$_FILES["photo"]["name"],$_POST["txtAmount"],$_POST["pDate"],$_FILES["slip"]["name"],$_POST["check"]))
{
	$course = $_POST["cmbCourse"];
	$nic = $_POST["txtNIC"];
	$fName = $_POST["txtFName"];
	$lName = $_POST["txtLName"];
	$title = $_POST["cmbTitle"];
	$bDate = $_POST["bDate"];
	$add1 = $_POST["txtAdd1"];
	$add2 = $_POST["txtAdd2"];
	$add3 = $_POST["txtAdd3"];
	$add4 = $_POST["txtAdd4"];
	$mobile = $_POST["txtMobile"];
	$email = $_POST["txtEmail"];
	$amount = $_POST["txtAmount"];
	$pDate = $_POST["pDate"];
	
	$sql = "select batch.batchCode from course,batch where course.courseNo=batch.courseNo and (curdate() between batch.appliFrom and batch.appliTo) and course.name='$course'";
	$result=mysqli_query($con,$sql) or die(mysqli_error($con));
	while($row=mysqli_fetch_array($result))
		{
			$batch=$row[0];
		}
	
	
	$sql = "select count(*) from student where nic='$nic'";
	$result=mysqli_query($con,$sql) or die(mysqli_error($con));
	while($row=mysqli_fetch_array($result))
		{
			$c=$row[0];
		}
	
	if($c>0)
	{
		if(empty($_FILES["photo"]["name"]))
		{
			$sql = "UPDATE student SET fName='$fName',lName='$lName',title='$title',dob='$bDate',mobile='$mobile',email='$email',aLine1='$add1',aLine2='$add2',aLine3='$add3',aLine4='$add4' WHERE nic='$nic' ";
			$result=mysqli_query($con,$sql) or die(mysqli_error($con));
			$rows=mysqli_affected_rows($con);
		}

		else{
			$img = $_FILES["photo"]["name"];
			$ext = end((explode('.',$img))); //extra () to avoid error
			$image = $nic.".".$ext;
			$src = $_FILES['photo']['tmp_name'];
			$dst = "student_img/".$image;
			$upload = move_uploaded_file($src, $dst);
			if($upload==false)
			{echo "<script type='text/javascript'>alert('photo was not uploaded');</script>";}
			else{
				unlink("student_img/".$photo);
			}
			
			$sql = "UPDATE student SET fName='$fName',lName='$lName',title='$title',dob='$bDate',mobile='$mobile',email='$email',aLine1='$add1',aLine2='$add2',aLine3='$add3',aLine4='$add4',image='$image' WHERE nic='$nic' ";
			$result=mysqli_query($con,$sql) or die(mysqli_error($con));
			$rows=mysqli_affected_rows($con);

		}
		
		$sql = "select count(*) from studentbatch where nic='$nic' and batchCode='$batch'";
		$result=mysqli_query($con,$sql) or die(mysqli_error($con));
		while($row=mysqli_fetch_array($result))
			{
				$c2=$row[0];
			}
		if($c2>0){
			if(empty($_FILES["slip"]["name"]))
			{
				$sql = "UPDATE payment SET amount='$amount',date='$pDate' WHERE nic='$nic' and batchCode='$batch' ";
				$result=mysqli_query($con,$sql) or die(mysqli_error($con));
				$rows2=mysqli_affected_rows($con);
			}

			else{
				
				$img = $_FILES["slip"]["name"];
				$ext = end((explode('.',$img)));
				$image = $nic.$batch.".".$ext;
				$src = $_FILES['slip']['tmp_name'];
				$dst = "payslip/".$image;
				$upload1 = move_uploaded_file($src, $dst);
				
				if($upload1==false)
				{
					echo "<script type='text/javascript'>alert('payslip was not uploaded');</script>";
				}
				else{
					unlink("payslip/".$slip);
				}				
				$sql = "UPDATE payment SET amount='$amount',date='$pDate',payslip='$image' WHERE nic='$nic' and batchCode='$batch' ";
				$result=mysqli_query($con,$sql) or die(mysqli_error($con));
				$rows2=mysqli_affected_rows($con);
			}
		}
		else{
			$img = $_FILES["slip"]["name"];
			$ext = end((explode('.',$img)));
			$image = $nic.$batch.".".$ext;
			$src = $_FILES['slip']['tmp_name'];
			$dst = "payslip/".$image;
			$upload1 = move_uploaded_file($src, $dst);

			if($upload1==false)
			{
				echo "<script type='text/javascript'>alert('payslip was not uploaded');</script>";
			}

			$sql = "INSERT INTO studentbatch(nic,batchCode) VALUES('$nic','$batch')";
			$result=mysqli_query($con,$sql) or die(mysqli_error($con));
			$rows1=mysqli_affected_rows($con);

			$sql = "INSERT INTO payment(nic,batchCode,amount,date,payslip) VALUES('$nic','$batch','$amount','$pDate','$image')";
			$result=mysqli_query($con,$sql) or die(mysqli_error($con));
			$rows2=mysqli_affected_rows($con);
		}
	}
	else
	{
		$img = $_FILES["photo"]["name"];
		$ext = end((explode('.',$img))); //extra () to avoid error
		$image = $nic.".".$ext;
		$src = $_FILES['photo']['tmp_name'];
		$dst = "student_img/".$image;
		$upload = move_uploaded_file($src, $dst);

		if($upload==false)
		{
			echo "<script type='text/javascript'>alert('photo was not uploaded');</script>";
		}
			
		$sql = "INSERT INTO student(nic,fName,lName,title,dob,mobile,email,aLine1,aLine2,aLine3,aLine4,image) VALUES('$nic','$fName','$lName','$title','$bDate','$mobile','$email','$add1','$add2','$add3','$add4','$image')";
		$result=mysqli_query($con,$sql) or die(mysqli_error($con));
		$rows=mysqli_affected_rows($con);
		
		$img = $_FILES["slip"]["name"];
		$ext = end((explode('.',$img)));
		$image = $nic.$batch.".".$ext;
		$src = $_FILES['slip']['tmp_name'];
		$dst = "payslip/".$image;
		$upload1 = move_uploaded_file($src, $dst);

		if($upload1==false)
		{
			echo "<script type='text/javascript'>alert('payslip was not uploaded');</script>";
		}
	
		$sql = "INSERT INTO studentbatch(nic,batchCode) VALUES('$nic','$batch')";
		$result=mysqli_query($con,$sql) or die(mysqli_error($con));
		$rows1=mysqli_affected_rows($con);
	
		$sql = "INSERT INTO payment(nic,batchCode,amount,date,payslip) VALUES('$nic','$batch','$amount','$pDate','$image')";
		$result=mysqli_query($con,$sql) or die(mysqli_error($con));
		$rows2=mysqli_affected_rows($con);
	}
	
		//messages only for insert commands
	
		if($c>0)
		{
			//current student, new batch
			if($c2==0){
				if ($rows1==1 and $rows2==1 )
				{
					echo "<script type='text/javascript'>alert('Registration successful');window.location.href='index.php';</script>";
				}
								
			}
			
			//current batch (update)
			else if ($rows==1 or $rows2==1 )
			{
				echo "<script type='text/javascript'>alert('Updated successfully');window.location.href='index.php';</script>";
			}
			else
			{
				echo "<script type='text/javascript'>window.location.href='index.php';</script>";
			}
		}
		
		else{
			if ($rows==1 and $rows1==1 and $rows2==1 )
			{
				echo "<script type='text/javascript'>alert('Registration successful');window.location.href='index.php';</script>";
			}

			else
			{
				echo "<script type='text/javascript'>alert('Registration failed. Please try again.');</script>";
			}
		}
	
	
	}
	
	mysqli_close($con);

?>
<!DOCTYPE html>
<html lang="en">

    <!-- Basic -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">   
   
    <!-- Mobile Metas -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
 
     <!-- Site Metas -->
    <title>Online Student Registration</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	
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

	<link type="text/css" rel="stylesheet" href="css/register.css">
	
    <!-- Modernizer for Portfolio -->
    <script src="js/modernizer.js"></script>
	<script src="jquery-3.5.1.min.js"></script>
	<script language="javascript" type="text/javascript" src="js/register.js"></script>
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
	

	</div>
			
	</section>


		
		<div class="carousel-inner" role="listbox" ><!-- start course card section -->
			<div class="testbox">
      <form name="regForm" enctype="multipart/form-data" method="post" action="#" onSubmit="return validateform(this);">
		
        <div class="banner">
          <h1>Online Student Registration</h1><input type="hidden" name="hdflag" id="hdflag" value="<?php echo $flag;?>"/>
        </div>
		  <br>
		<div class="item">
          <p>Course<span class="required">*</span></p>
          <select required name="cmbCourse">
			  <option selected value="<?php echo $course;?>"><?php echo $course;?></option>
              <?php
				$con = mysqli_connect($host,$uname,$pwd);
				mysqli_select_db($con, $db_name);
				$sql = "select course.name from course,batch where course.courseNo=batch.courseNo and (curdate() between batch.appliFrom and batch.appliTo) order by course.name";
				$result=mysqli_query($con,$sql) or die(mysqli_error($con));
				while($row=mysqli_fetch_array($result))
					{
						echo "<option value='". $row['name'] ."'>" .$row['name'] ."</option>";
					}
			  mysqli_close($con);
			?> 
            </select>
        </div>
        <h2>Applicant Details</h2>
		<div class="item">
          <p>NIC<span class="required">*</span></p>
          <input type="text" name="txtNIC" required onChange="submit()" <?php echo $readonly;?> value="<?php echo $nic; ?>"/>
        </div>
        <div class="item">
          <p>Name<span class="required">*</span></p>
          <div class="name-item">
            <input type="text" name="txtFName" placeholder="First Names" required value="<?php echo $fName; ?>"/>
            <input type="text" name="txtLName" placeholder="Last Name" required value="<?php echo $lName; ?>"/>
          </div>
        </div>
		<div class="item">
          <p>Title<span class="required">*</span></p>
          <select required name="cmbTitle">
              <option selected value="<?php echo $title;?>"><?php echo $title;?></option>
              <option value="Mr">Mr</option>
              <option value="Ms">Ms</option>
            </select>
        </div>
		<div class="item">
          <p>Date of Birth<span class="required">*</span></p>
          <input type="date" name="bDate" required value="<?php echo $bDate; ?>"/>
          <i class="fa fa-calendar"></i>
        </div>
		<div class="item">
          <p>Address<span class="required">*</span></p>
          <input type="text" name="txtAdd1" placeholder="Address line 1" required value="<?php echo $add1; ?>"/>
          <input type="text" name="txtAdd2" placeholder="Address line 2" value="<?php echo $add2; ?>"/>
		  <input type="text" name="txtAdd3" placeholder="Address line 3" value="<?php echo $add3; ?>"/>
          <input type="text" name="txtAdd4" placeholder="Address line 4" value="<?php echo $add4; ?>"/>
        </div>
        <div class="item">
          <p>Mobile Number<span class="required">*</span></p>
          <input type="number" name="txtMobile" required value="<?php echo $mobile; ?>"/>
        </div>
        <div class="item">
          <p>Email<span class="required">*</span></p>
          <input type="email" name="txtEmail" required value="<?php echo $email; ?>"/>
        </div>
        <div class="item">
          <p>Upload your photo<span class="required">*</span></p>
          <input type="file" name="photo" style="border: none" accept=".jpg,.jpeg,.png" <?php echo $required;?>/>
		  <img src="student_img/<?php echo $photo; ?>" width="150px"/>
        </div>
		  
        <h2>Payment Details</h2>
        <div class="item">
          <p>Payment Amount (Rs.)<span class="required">*</span></p>
          <input type="text" name="txtAmount" required readonly value="<?php echo $fee; ?>"/>
        </div>
        <div class="item">
          <p>Payment Date<span class="required">*</span></p>
          <input type="date" name="pDate" required value="<?php echo $pDate; ?>"/>
          <i class="fa fa-calendar"></i>
        </div>
		<div class="item">
          <p>Upload Payment Slip<span class="required">*</span></p>
          <input type="file" name="slip" style="border: none" accept=".jpg,.jpeg,.png" <?php echo $prequired;?>/>
		  <img src="payslip/<?php echo $slip; ?>" width="150px"/>
        </div>
        <div class="question">
          <div class="question-answer checkbox-item">
            <div>
              <input type="checkbox" value="none" id="check_1" name="check"/>
              <label for="check_1" class="check"><span >I hereby declare that the information given above is true and accurate to the best of my knowledge.</span><span class="required">*</span></label>
            </div>
          </div>
        </div>
        <div class="btn-block">
          <button type="submit" href="/">Submit</button>
        </div>
      </form>
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
                        <p> Integer rutrum ligula eu dignissim laoreet. Pellentesque venenatis nibh sed tellus faucibus bibendum. Sed fermentum est vitae rhoncus molestie. Cum sociis natoque penatibus et magnis dis montes.</p>   
												
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