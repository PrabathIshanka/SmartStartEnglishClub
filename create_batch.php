<?php
include "connection.php";

$course="";
$teacher="";

	if($_POST["cmbCourse"]!="")
	{
		$course=$_POST["cmbCourse"];
	}

	if($_POST["cmbTeacher"]!="")
	{
		$teacher=$_POST["cmbTeacher"];
		//$teacherID=$_POST["cmbTeacher"];
	}

if(isset($_POST["cmbCourse"], $_POST["txtBatch"], $_POST["cmbTeacher"], $_POST["startDate"] ,$_POST["day"],  $_POST["fromTime"] ,$_POST["toTime"] , $_POST["maxStd"],$_POST["appOpen"],$_POST["appClose"] ))
{
	//Get form data
	$batchCode = $_POST["txtBatch"];
	$course = $_POST["cmbCourse"];
	$teacher = $_POST["cmbTeacher"];
	$startDate = $_POST["startDate"];
	$day = $_POST["day"];
	$fromTime = $_POST["fromTime"];
	$toTime = $_POST["toTime"];
	$maxStd = $_POST["maxStd"];
	$appOpen = $_POST["appOpen"];
	$appClose = $_POST["appClose"];
	$teacherID = $_POST["hdID"];
	
	$con = mysqli_connect($host,$uname,$pwd);
	mysqli_select_db($con, $db_name);
	
	$sql = "select courseNo from course where name='$course'";
				$result=mysqli_query($con,$sql) or die(mysqli_error($con));
				while($row=mysqli_fetch_array($result))
					{
						$courseNo=$row['courseNo'];
					}
	
	
	$sql = "INSERT INTO batch(batchCode,courseNo,teacherID,startDate,day,fromTime,toTime,maxStd,appliFrom,appliTo) VALUES('$batchCode','$courseNo','$teacherID' ,'$startDate' , '$day' ,'$fromTime' ,'$toTime' ,'$maxStd','$appOpen','$appClose')";
	$result=mysqli_query($con,$sql) or die(mysqli_error($con));
	
	$rows=mysqli_affected_rows($con);
	if ($rows==1)
	{
		echo "<script type='text/javascript'>alert('Batch added successfully');</script>";
	}
	mysqli_close($con);
}
?>


<!doctype html>
<html>
<head>
	<link type="text/css" rel="stylesheet" href="css/form.css">
<meta charset="utf-8">
<title>Create Batch</title>
	<script language="javascript" type="text/javascript" src="js/create_batch.js"></script>
</head>

<body>

	
	<div class="testbox">
	<form name="createBatchForm" method="post" action="#" onSubmit="return validateform(this);">
		 <div class="banner">
         <h1>Create Batch</h1>
			 	
                </div>
			 
		<div class="item">
          <p>Course</p>
          <select name="cmbCourse" required onChange="submit()">
              <option selected value="<?php echo $course;?>"><?php echo $course;?></option>
              <?php
				$con = mysqli_connect($host,$uname,$pwd);
				mysqli_select_db($con, $db_name);
				$sql = "select name from course order by name";
				$result=mysqli_query($con,$sql) or die(mysqli_error($con));
				while($row=mysqli_fetch_array($result))
					{
						echo "<option value='". $row['name'] ."'>" .$row['name'] ."</option>";
					}
			  mysqli_close($con);
			?> 
            </select>
        </div>
		<div class="item">
          <p>Batch</p>
			<?php
				$con = mysqli_connect($host,$uname,$pwd);
				mysqli_select_db($con, $db_name);
				$sql = "select batch.batchCode, course.courseNo from batch right outer join course on course.courseNo=batch.courseNo where course.name='$course' order by batch.batchCode desc limit 1";
				$result=mysqli_query($con,$sql) or die(mysqli_error($con));
				while($row=mysqli_fetch_array($result))
					{
						$cno=$row['courseNo'];
						$maxno=$row['batchCode'];
						
					}
			if ($maxno == " ")
			{
			   $new = $cno."01";
			}
			else
			{
			   $new = substr($maxno,2);
			   $new = intval($new);
			   $new = $cno.str_pad($new+1,2,0, STR_PAD_LEFT);

			}
			  mysqli_close($con);
			?> 
		<input type="text"	id="Id"  name="txtBatch" value="<?php echo $new; ?>" readonly>
        
        </div>
		
		<div class="item">
          <p>Teacher</p>
          <select name="cmbTeacher" required onChange="submit()">
              <option selected value="<?php echo $teacher;?>"><?php echo $teacher;?></option>
              <?php
				$con = mysqli_connect($host,$uname,$pwd);
				mysqli_select_db($con, $db_name);
				$sql = "select teacher.teacherID,teacher.fname,teacher.lname from teachercourse,course,teacher where course.courseNo=teachercourse.courseNo and teacher.teacherID=teachercourse.teacherID and course.name='$course' ";
				$result=mysqli_query($con,$sql) or die(mysqli_error($con));
				while($row=mysqli_fetch_array($result))
					{
						echo "<option value='". $row['fname']." ".$row['lname'] ."'>" .$row['fname']." ".$row['lname'] ."</option>";
						$id=$row['teacherID'];
					}
			  mysqli_close($con);
			?> 
            </select>
			<input type="hidden" name="hdID" value="<?php echo $id ?>"/>
        </div>
	    <div class="item">
          <p>Starting Date</p>
          <input type="date" name="startDate" />
          
        </div>
		<div class="item">
          <p>Day</p>
          <select name="day" required>
			  <option disabled selected value></option>
              <option value="1">Monday</option>
              <option value="2">Tuesday</option>
              <option value="3">Wednesday</option>
			  <option value="4">Thursday</option>
              <option value="5">Friday</option>
              <option value="6">Saturday</option>
			  <option value="7">Sunday</option>
            </select>
        </div>
		<div class="item">
          <p>From Time</p>
          <input type="time" name="fromTime" />
          
        </div>
		<div class="item">
          <p>To Time</p>
          <input type="time" name="toTime" required/>
        </div>
		<div class="item">
          <p>Maximum No of Students</p>
          <input type="number" name="maxStd" required/>
          
        </div>
		<div class="item">
          <p>Application Opening Date</p>
          <input type="date" name="appOpen" required/>
          
        </div>
		<div class="item">
          <p>Application Closing Date</p>
          <input type="date" name="appClose" required/>
          
        </div>
		
		<div class="btn-block">
          <input type="submit" value="Create">
        </div>
		</form>
	</div>
</body>
</html>
