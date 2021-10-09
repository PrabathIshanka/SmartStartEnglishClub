<?php
	$course="";
	$batch="";

	include "connection.php";

	if($_POST["cmbCourse"]!="")
	{
		$course=$_POST["cmbCourse"];
	}

	if($_POST["cmbBatch"]!="")
	{
		$batch=$_POST["cmbBatch"];
	}

$con = mysqli_connect($host,$uname,$pwd);
mysqli_select_db($con, $db_name);

if(isset($_POST["Delete"]))
{
	$sql = "DELETE user FROM user inner join studentbatch on studentbatch.studentNo=user.username WHERE studentbatch.batchCode='$batch'";
	$result=mysqli_query($con,$sql) or die(mysqli_error($con));
	$rows=mysqli_affected_rows($con);
	if ($rows>0)
			{
				echo "<script type='text/javascript'>alert('Batch Accounts Deleted');</script>";
			}
}
mysqli_close($con);
?>
<!DOCTYPE html>
<html>
<head>
	<title>Delete Batch Accounts</title>

<link rel="stylesheet" type="text/css" href="css/form.css"/>
<style type="text/css">
	
	  table
 {
    font-family: arial, sans-serif;
    border-collapse: collapse;
    width: 50%;
    padding: 30px;
}
td, th {
    border: 2px solid #dddddd;
    text-align: left;
    padding: 10px;
}

</style>
</head>
<body>
	
	<div class="testbox">
	<form name="form1" method="post" action="#" >
		<div class="banner">
	<h1>Delete Batch Accounts</h1></div>

<div class="item">
          <p>Course</p>
          <select name="cmbCourse" required onChange="submit()">
              <option selected value="<?php echo $course;?>"><?php echo $course;?></option>
              <?php
				$con = mysqli_connect($host,$uname,$pwd);
				mysqli_select_db($con, $db_name);
				$sql = "SELECT name from course";
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
          <select name="cmbBatch" required onChange="submit()">
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
		

<div class="btn-block">
          <input type="submit" value="Delete" name="Delete">
        </div><br><br>

<table>
	<tr >
		<th>Student No</th>
		<th>NIC</th>
		<th>Name</th>
	</tr>

	 <?php
	 $con = mysqli_connect($host,$uname,$pwd);
     mysqli_select_db($con, $db_name);
$sql="SELECT * FROM student,studentbatch,user where student.nic=studentbatch.nic and user.username=studentbatch.studentNo and studentbatch.batchCode='$batch' and studentbatch.studentNo!=''" ;
	
$result1 = $con->query($sql);
if($result1->num_rows > 0){
while($row1 = $result1->fetch_assoc()){


echo'<tr class="gradeX">
<td width="300px">'.$row1['studentNo'].'</td>
<td width="200px">'.$row1['nic'].'</td>
<td width="200px">'.$row1['fName']." ".$row1['lName'].'</td>

</tr>';

}
}
	
?> 
</tbody>
</table> <br>

</form>
</div>


</body>
</html>