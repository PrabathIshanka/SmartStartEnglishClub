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
if (isset($_POST["send"])) {
	
	$con = mysqli_connect($host,$uname,$pwd);
    mysqli_select_db($con, $db_name);
    $sql= "SELECT email From student,studentbatch where student.nic=studentbatch.nic and batchCode='$batch'";
    $result=mysqli_query($con,$sql) or die(mysqli_error($con));
    while($row=mysqli_fetch_array($result))
		{

	$to           = $row['email'];
       
	$mail_subject  ='Smart Start English Club';
	$email_body    ="Message from Smart Start English Club";
    $email_body   .="<b>From:</b> {$batch } </br>";
    $email_body   .="<b>subject:</b> {$subject } </br>";
    $email_body   .="<b>Message:</b></br>".nl2br(strip_tags($Message));
    $header        ="From:SmartStartEnglishClub@gmail.com";

   # $header        ="From:{$mail}\r\n Content-type: text/html;" ;

  $send_mail_result = mail($to ,$mail_subject ,$email_body ,$header);

    if ($send_mail_result) {
    	echo "Message Sent";
    }else{
    	echo "Message Not Send";
    }

}
}


	 ?>
<!DOCTYPE html>
<html>
<head>
	<title>Email</title>
	<link rel="stylesheet" type="text/css" href="css/form.css"/>
	<script type="text/javascript" src="js/Email.js"></script>
</head>
<body>
	
	<div class="testbox">
	<form name="form1" method="post" action="#" onsubmit="return validateform(this)">
		<div class="banner">
	<h1>Send Email</h1><br></div>
		
<div class="item">
          <p>Course</p>
          <select name="cmbCourse" required onChange="submit()">
              <option selected value="<?php echo $course;?>"><?php echo $course;?></option>
              <?php
				$con = mysqli_connect($host,$uname,$pwd);
				mysqli_select_db($con, $db_name);
				$sql = "select name from course";
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
<br>
<div class="item"><label for="subject">Subject</label>
<input type="text" id="subject" name="subject"  /></br>
Message<br></div>
<div class="item"><textarea name="comments" rows="10" cols="95">
</textarea><br></div>
 <div class="btn-block">
<input type="submit" value="Send" name="send">
</div>
</form>
</div>
</body>
</html>