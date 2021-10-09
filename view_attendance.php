<?php  
session_start();
include "connection.php";
$stdno=$_SESSION["usname"];
$con = mysqli_connect($host,$uname,$pwd);
mysqli_select_db($con, $db_name);

$sql = "SELECT * FROM student,studentbatch,attendance WHERE student.nic=studentbatch.nic and studentbatch.nic=attendance.nic and studentbatch.studentNo='$stdno'";
$result=mysqli_query($con,$sql) or die(mysqli_error($con));

while( $row = mysqli_fetch_array($result) )
{

$date=$row['date'];
$batch=$row['batchCode'];
$nic=$row['nic'];
}
$sql = "SELECT * FROM studentbatch,batch,course WHERE batch.batchCode=studentbatch.batchCode and batch.courseNo=course.courseNo and studentbatch.batchCode='$batch'";
$result=mysqli_query($con,$sql) or die(mysqli_error($con));
while( $row = mysqli_fetch_array($result) )
{

$course=$row['name'];

}


?>




<!DOCTYPE html>
<html>
<head>
	<title>View Attendance</title>
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
	<div class="banner">
	<h1>Check Your Attendance</h1><br><br><br></div>
	<div class="testbox">
    <form name="form1" method="post" action="#" >
    	<div class="item"><label for="nic">Student No</label>
<input type="text" id="nic" name="nic" required="required" readonly value="<?php echo $stdno; ?>"/></br></div>
<div class="item"><label for="CID">Course</label>
<input type="text" id="CID" name="course" required="required" readonly value="<?php echo $course; ?>"/></br></div>
<div class="item"><label for="CID">Course</label>
<input type="text" id="CID" name="course" required="required" readonly value="<?php echo $batch; ?>"/></br></div>
<div class="row">
        <div class="col-xs-8 col-xs-offset-2">
            <table class="table table-striped table-hover">
                <thead>
                    <tr>
                        <td>Attendance</td>
                        
                    </tr>
                </thead>
                <tbody>
                <?php
$con = mysqli_connect($host,$uname,$pwd);
mysqli_select_db($con, $db_name);

$sql="SELECT date FROM attendance where nic='$nic' and batchCode='$batch'" ;
    
$result1 = $con->query($sql);
if($result1->num_rows > 0){
while($row1 = $result1->fetch_assoc()){


echo'<tr class="gradeX">
<td width="300px">'.$row1['date'].'</td>

</tr>';
}
}
    
?> 
</tbody>
                </tbody>
            </table>
        </div>
    </div>
</form>
</div>
</body>
</html>