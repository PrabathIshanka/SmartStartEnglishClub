<!DOCTYPE html>
<html>
<title>W3.CSS Template</title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.3.0/css/font-awesome.min.css">
<body>


<!-- Header -->
<header class="w3-container w3-theme w3-padding" id="myHeader" style="background-image: url('images/dashboard.jpg'); background-size: contain;">
  
  <div class="w3-center" style="color: white" ><br>
  <h1 class="w3-xxxlarge w3-animate-bottom">WELCOME</h1>
	  <h2 class=" w3-animate-bottom">TO SMART START ENGLISH CLUB</h2>
    <br><br>
  </div>
</header>
<?php
	include "connection.php";
		
	$con = mysqli_connect($host,$uname,$pwd);
	mysqli_select_db($con, $db_name);
	
	$sql="SELECT count(*) as c FROM studentbatch where studentNo!=''";
		$result=mysqli_query($con,$sql) or die(mysqli_error($con));

		while($row=mysqli_fetch_array($result))
		{
			$student=$row['c'];
		}
	$sql="SELECT count(*) as c FROM teacher";
		$result=mysqli_query($con,$sql) or die(mysqli_error($con));

		while($row=mysqli_fetch_array($result))
		{
			$teacher=$row['c'];
		}
	$sql="SELECT count(*) as c FROM course";
		$result=mysqli_query($con,$sql) or die(mysqli_error($con));

		while($row=mysqli_fetch_array($result))
		{
			$course=$row['c'];
		}
	?>

<div class="w3-row-padding w3-center w3-margin-top " style="color: #0F2C5C">
<div class="w3-third">
  <div class="w3-card w3-container" style="min-height:280px">
  <h3>Students</h3><br>
  <i class="fa fa-group w3-margin-bottom w3-text-theme" style="font-size:120px"></i>
  <h3><?php echo $student?></h3>
  </div>
</div>

<div class="w3-third">
  <div class="w3-card w3-container" style="min-height:280px">
  <h3>Teachers</h3><br>
  <i class="fa fa-user w3-margin-bottom w3-text-theme" style="font-size:120px"></i>
  <h3><?php echo $teacher?></h3>
  </div>
</div>

<div class="w3-third">
  <div class="w3-card w3-container" style="min-height:280px">
  <h3>Courses</h3><br>
  <i class="fa fa-graduation-cap w3-margin-bottom w3-text-theme" style="font-size:120px"></i>
  <h3><?php echo $course?></h3>
  </div>
</div>
</div>
<br>
</body>
</html>
