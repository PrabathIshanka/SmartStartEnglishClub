<?php
	session_start();
	include "connection.php";
	if(isset($_POST["txtCurrent"],$_POST["txtNew"],$_POST["txtConfirm"]))
	{
		$usname=$_SESSION["usname"];
		$current = $_POST["txtCurrent"];
		$new = $_POST["txtNew"];
		$confirm = $_POST["txtConfirm"];
		
		$con = mysqli_connect($host,$uname,$pwd);
		mysqli_select_db($con, $db_name);
		
		$sql = "select count(*) as count from user where username='$usname' and password=md5('$current')";
		
		$result=mysqli_query($con,$sql) or die(mysqli_error($con));
		while($row=mysqli_fetch_array($result))
			{
				$count=$row['count'];
			}

		if ($count>0)
		{
			$sql = "UPDATE user SET password=md5('$new') where username='$usname'";
			$result=mysqli_query($con,$sql) or die(mysqli_error($con));
			$rows=mysqli_affected_rows($con);
			if ($rows==1)
			{
				echo "<script type='text/javascript'>alert('Password changed successfully');</script>";
				//header("location:index.php");
			}	
		}
		else
		{
			echo "<script type='text/javascript'>alert('Current Password is incorrect');showTab(2);</script>";
		}
		mysqli_close($con);
	}

	
?>
<!doctype html>
<html>
  <head>
    <title>Change Password</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link type="text/css" rel="stylesheet" href="css/form.css">
	  <script language="javascript" type="text/javascript" src="js/change_password.js"></script>
  </head>
  <body>
    <div class="testbox">
      <form name="changePassForm" method="post" action="#" onSubmit="return validateform(this);">
        <div class="banner">
          <h1>Change Password</h1>
        </div>
		
		<div class="item">
			<label for="password">Current Password</label>
			<input type="password" id="password" name="txtCurrent"  required="required" /></br>
		</div>
		<div class="item">
			<label for="password">New Password</label>
			<input type="password" id="password" name="txtNew"  required="required" /></br>
		</div>
		<div class="item">
			<label for="password">Confirm New Password</label>
			<input type="password" id="cpassword" name="txtConfirm"  required="required" />
		</div>


        <div class="btn-block">
          <input type="submit" value="Change Password" name="btnChange">
        </div>
      </form>
    </div>
  </body>
</html>