<?php
session_start();
include "connection.php";
$msg="";
if(isset($_POST["courseNo"], $_POST["name"], $_POST["description"], $_POST["duration"] ,$_POST["fee"]))
{
	//Get form data
	$courseNo = $_POST["courseNo"];
	$name = $_POST["name"];
	$desc = $_POST["description"];
	$duration = $_POST["duration"];
	$fee = $_POST["fee"];
	
	
	$con = mysqli_connect($host,$uname,$pwd);
	mysqli_select_db($con, $db_name);
	$sql = "INSERT INTO course(courseNo,name,description,duration,fee) VALUES('$courseNo','$name','$desc' ,'$duration' , '$fee')";
	$result=mysqli_query($con,$sql);
	if (mysqli_errno($con) == 1062) {
		
    	echo "<script type='text/javascript'>alert('This Course No is not available. Please enter another course number');</script>";
	}
	
	
	
	$rows=mysqli_affected_rows($con);
	if ($rows==1)
	{
		echo "<script type='text/javascript'>alert('Course added successfully');</script>";
	}
	mysqli_close($con);
}
?>

<!doctype html>
<html>
<head>
<link type="text/css" rel="stylesheet" href="css/form.css">
<script language="javascript" type="text/javascript" src="js/add_course.js"></script>
<meta charset="utf-8">
	
<title>Add course</title>
</head>
	<body>
		<div class="testbox">
	<form name="addCourseform" method="post" onSubmit="return validateform(this);">
		
	 <div class="banner">
          <h1>Add Course</h1><br/><br/>
        </div>
	<div class="item">
	<p>Course Number</p>
	 <input type="text" name="courseNo" value="" required/>
	</div>		
	<div class="item">
	<p>Course Name</p>
		 <input type="text" name="name" value="" required />
	</div>
	<div class="item">
	<p>Description of Course</p>
		 <textarea name="description" value="" rows="4"  cols="36" required></textarea>
		</div>
		<div class="item">
	<p>Duration(hours)</p>
		 <input type="number" name="duration" value="" required/>
		</div>
		<div class="item">
	<p>Fee</p>
		 <input type="number" name="fee" value="" required/>
		</div>
		 <div class="btn-block">
          <input type="submit" value="Submit">
        </div>
		</form>
			</div>
</body>
</html>
