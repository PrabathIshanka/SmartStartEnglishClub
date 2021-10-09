<?php
include "connection.php";

$course="";
$batch="";
$teacher="";

if($_POST["courseNo"]!="")
{
	$course=$_POST["courseNo"]; 
}

if($_POST["batchCode"]!="")
{
	$batch=$_POST["batchCode"];
}

if($_POST["teacherID"]!="")
{
	$teacher=$_POST["teacherID"];
}
$batchCode="";
$con = mysqli_connect($host,$uname,$pwd);
mysqli_select_db($con, $db_name);
if($_POST["batchCode"]!="")
{
$batchCode=$_POST["batchCode"];

$sql = "SELECT * FROM batch,teacher WHERE batch.teacherID=teacher.teacherID and batchCode='$batchCode'";
$result=mysqli_query($con,$sql) or die(mysqli_error($con));
  while($row=mysqli_fetch_array($result)) 
{
$courseNo=$row["courseNo"];
$teacher=$row["fname"]." ".$row["lname"];
$startDate=$row["startDate"];
$day=$row["day"];   
$fromTime=$row["fromTime"];
$toTime=$row["toTime"];
$maxStd=$row["maxStd"];
$appOpen = $row["appliFrom"];
$appClose = $row["appliTo"];
$dateAward = $row["dateAward"];
  }
	
		  	
if ($day=='1')
	$d='Monday';
elseif ($day=='2')
	$d='Tuesday';
elseif ($day=='3')
	$d='Wednesday';
elseif ($day=='4')
	$d='Thursday';
elseif ($day=='5')
	$d='Friday';
elseif ($day=='6')
	$d='Saturday';
elseif ($day=='7')
	$d='Sunday';
}


if (isset($_POST["Update"]))
 {
	$batchCode = $_POST["batchCode"];
	$teacherID = $_POST["hdID"];
	$startDate = $_POST["startDate"];
	$day = $_POST["day"];
	$fromTime = $_POST["fromTime"];
	$toTime = $_POST["toTime"];
	$maxStd = $_POST["maxStd"];
  	$appOpen = $_POST["appOpen"];
	$appClose = $_POST["appClose"];
	$dateAward = $_POST["dateAward"];
     $con=mysqli_connect($host,$uname,$pwd);
     mysqli_select_db($con,$db_name); 

	
   $sql = "UPDATE batch SET teacherID='$teacherID',startDate='$startDate',day='$day',fromTime='$fromTime',toTime='$toTime',maxStd='$maxStd',appliFrom='$appClose',appliTo='$appClose',dateAward='$dateAward' WHERE batchCode='$batchCode' ";
   $result=mysqli_query($con,$sql) or die(mysqli_error($con));
	$rows=mysqli_affected_rows($con);
	if ($rows==1)
			{
				echo "<script type='text/javascript'>alert('Updated Successfully');</script>";
			}
  else
  {
    echo"<script>alert('data not Updated..!');</script>";
    //echo"Error".mysqli_error($con);
  }
}

?>
<!DOCTYPE html>
<html>
<head>
	<title>Update Batch</title>
	<link rel="stylesheet" type="text/css" href="css/form.css"/>
</head>
<body>
	
	<div class="testbox">
	<form method="post">
		 <div class="banner">
         <h1>Update Batch</h1>
			 	
                </div>
		<div class="item">
          <p>Course</p>
          <select name="courseNo" required onChange="submit()">
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
          <select name="batchCode" required onChange="submit()">
              <option selected value="<?php echo $batch;?>"><?php echo $batch;?></option>
              
			  <?php
			 
				$con = mysqli_connect($host,$uname,$pwd);
				mysqli_select_db($con, $db_name);
				$sql = "select batch.batchCode from batch,course where course.courseNo=batch.courseNo and course.name='$course' order by batch.batchCode desc limit 3";
				$result=mysqli_query($con,$sql) or die(mysqli_error($con));
				while($row=mysqli_fetch_array($result))
					{
						echo "<option value='". $row['batchCode'] ."'>" .$row['batchCode'] ."</option>";
					}
			  mysqli_close($con);
			?> 
            </select>
        </div>
		<div class="item">
          <p>Teacher</p>
          <select name="teacherID" required onChange="submit()">
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
          <p>Start Date</p>
          <input type="Date" name="startDate" required value="<?php echo $startDate; ?>" />
          
        </div>
        
	
		<div class="item">
          <p>Day</p>
          <select name="day" required>
           
			  <option disabled selected value="<?php echo $day;?>"><?php echo $d;?></option>
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
          <input type="time" name="fromTime" required value="<?php echo $fromTime; ?>"/>
          
        </div>
		<div class="item">
          <p>To Time</p>
          <input type="time" name="toTime" required value="<?php echo $toTime; ?>"/>
        </div>
		<div class="item">
          <p>Maximum No of Students</p>
          <input type="number" name="maxStd" required value="<?php echo $maxStd; ?>"/>
          
        </div>
		<div class="item">
          <p>Application Opening Date</p>
          <input type="date" name="appOpen" required value="<?php echo $appOpen; ?>"/>
          
        </div>
		<div class="item">
          <p>Application Closing Date</p>
          <input type="date" name="appClose" required value="<?php echo $appClose; ?>"/>
          
        </div>
		<div class="item">
          <p>Certificate Award Date</p>
          <input type="date" name="dateAward" value="<?php echo $dateAward; ?>"/>
          
        </div>
		<div class="btn-block">
          <input type="submit" value="Update" name="Update">
        </div>
		</form>
	</div>
</body>
</html>