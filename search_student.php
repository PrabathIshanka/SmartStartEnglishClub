<?php
include"connection.php";
$stdno="";
if($_POST["studentNo"]!="")
{
$stdno=$_POST["studentNo"];
$con = mysqli_connect($host,$uname,$pwd);
mysqli_select_db($con, $db_name);
$sql = "SELECT * FROM student WHERE nic=$nic";
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
	mysqli_close($con);
}
?>

<!doctype html>
<html>
<head>
	 <link type="text/css" rel="stylesheet" href="css/form.css">

<title>Search Student</title>
</head>
<body>
	<div class="testbox">
	<form>
		 <div class="banner">
         <h1>Search Student</h1>
        </div>
            <div class="item">
		
		 <p> Student Number
		</p>
			<input type="text" name="studentNo" onChange="submit()" value="<?php echo $stdno; ?>"> </div>
		
		<div class="item">
		  	<p>Course</p>
	
		  <input type="text" name="Course" value="<?php echo $course ?>">
		  </div>
		<div class="item">
		  	<p>Batch</p>
		
		  <input type="text" name="Batch" value="<?php echo $batch ?>">
		  </div>
		<div class="item">
		
		 <p> NIC
		</p>
			<input type="text" name="NIC" value="<?php echo $nic; ?>"> </div>
		<div class="item">
	    <p>Image</p>
		<img src="../final p/eda.png" height="150" width="90" value="<?php echo $image; ?>">
		</div>
	    <div class="item">
         <p> Name </p>
		<input type="text" name="Name or No" value="<?php echo $name ?>"></div>
		<div class="item">
		  	<p>Mobile Number</p>
	
		  <input type="text" name="Mobile No" value="<?php echo $mobile ?>">
		  </div>
		<div class="item">
		 	<p> Email </p>
		
		  <input type="text" name="Email" value="<?php echo $email ?>">
		  </div>
		<div class="item">
		 	<p>Address</p>
		
		  <textarea name="Address" rows="4" value="<?php echo $address ?>"></textarea>
		  </div>
		<div class="item">
	<p> Exam Results</p>
	<table value="<?php echo $result ?>">
	<tr >
		<th>Mid Exam Marks</th>
		<th>End Exam Marks</th>
		<th>Average Marks</th>
		<th>Grade</th>
	</tr>
	<tr>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		
	</tr>
	
	</table>
		</div>

	
	
</form>
	</div>
</body>
</html>
