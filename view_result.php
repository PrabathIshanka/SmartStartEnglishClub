<?php  
session_start();
include "connection.php";
$stdno=$_SESSION["usname"];
$con = mysqli_connect($host,$uname,$pwd);
mysqli_select_db($con, $db_name);

$sql = "SELECT * FROM student,studentbatch,result WHERE student.nic=studentbatch.nic and studentbatch.nic=result.nic and studentbatch.studentNo='$stdno'";
$result=mysqli_query($con,$sql) or die(mysqli_error($con));

while( $row = mysqli_fetch_array($result) )
{
$batchCode = $row['batchCode'];
$fname=$row['fName'];
$lname=$row['lName'];
$mid=$row['mid'];
$end=$row['end'];
$abm=$row['abMid'];
$abe=$row['abEnd'];
$tot=number_format(($mid+$end)/2,0);
		if ($abm=='Y')
		{
			$mid='Ab';
			$tot='-';
			$grade='-';
		}
		else if ($abe=='Y')
		{
			$end='Ab';
			$tot='-';
			$grade='-';
		}
		else if ($tot>84)
			$grade='A+';
		elseif ($tot>69)
			$grade='A';
		elseif ($tot>64)
			$grade='A-';
		elseif ($tot>59)
			$grade='B+';
		elseif ($tot>54)
			$grade='B';
		elseif ($tot>49)
			$grade='B-';
		elseif ($tot>44)
			$grade='C+';
		elseif ($tot>39)
			$grade='C';
		else
			$grade='F';
}
$sql = "SELECT * FROM batch,course WHERE batch.courseNo=course.courseNo and batch.batchCode='$batchCode'";
$result=mysqli_query($con,$sql) or die(mysqli_error($con));

while( $row = mysqli_fetch_array($result) )
{
	$course=$row['name'];
}

?>
<!DOCTYPE html>
<html>
<head>
	<title>Exam Results</title>
	<link rel="stylesheet" type="text/css" href="css/form.css"/>
</head>
<body>
	
	<div class="testbox">
    <form name="form1" method="post" action="#" >
		<div class="banner">
	<h1>Exam Results</h1></div>
<div class="item"><label for="nic">Student No</label>
<input type="text" id="nic" name="nic" readonly value="<?php echo $stdno; ?>"/></br></div>

<div class="item"><label for="name">Name</label>
<input type="text" id="name " name="name"readonly value="<?php echo $fname.' '.$lname; ?>" /></br></div>
<div class="item"><label for="CID">Course</label>
<input type="text" id="CID" name="course"  readonly value="<?php echo $course; ?>"/></br></div>
<div class="item"><label for="CID">Batch</label>
<input type="text" id="CID" name="batch" readonly value="<?php echo $batchCode; ?>"/></br></div>
<div class="item"><label for="mid">Mid Exam Marks</label>
<input type="text" id="mid" name="mid" readonly value="<?php echo $mid; ?>"/></br></div>

<div class="item"><label for="End">End Exam Marks</label>
<input type="text" id="end" name="end"  readonly value="<?php echo $end; ?>"/></br></div>

<div class="item"><label for="tot">Total Marks</label>
<input type="text" id="tot" name="tot" readonly value="<?php echo $tot; ?>"/></br></div>

<div class="item"><label for="grade">Grade</label>
<input type="text" id="grade" name="grade" readonly value="<?php echo $grade; ?>"/></br></div>

</form>
</div>
</body>
</html>