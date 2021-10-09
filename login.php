<?php
session_start();
include "connection.php";
$b=0;
if(isset($_POST["txtUsername"],$_POST["password"]))
{
	$username = $_POST["txtUsername"];
	$passwd = $_POST["password"];
	$con = mysqli_connect($host,$uname,$pwd);
	mysqli_select_db($con, $db_name);
	$sql = "select count(*) as log,type,username,status from user where username='$username' and password=md5('$passwd')";
	$result=mysqli_query($con,$sql) or die(mysqli_error($con));
	while($row=mysqli_fetch_array($result))
		{
			$count=$row['log'];
			$utype=$row['type'];
			$usname=$row['username'];
			$status=$row['status'];
		}
	
	if ($count>0)
	{
		$_SESSION["usname"]=$usname;
		$_SESSION["utype"]=$utype;
		
		$rem=$_POST["remember"];
		if($rem=='remember')
		{
			setcookie("username", "$username", time()+ (86400 * 30), "/","", 0); // 86400s = 1 day
		}
		else
		{
			setcookie("username", "$username", time()-3600, "/","", 0);
		}
		
		if($status==0)
		{
			$b=5;
		}
		else{
			echo "<script type='text/javascript'>
			parent.window.location = 'dashboard.php';
			</script>";
		}
		
		
	}
	else
	{
		echo "<script type='text/javascript'>alert('Invalid Username or password');</script>";
	}
	mysqli_close($con);
}

if(isset($_POST["txtForgot"]))
{
	$forgot = $_POST["txtForgot"];
	$con = mysqli_connect($host,$uname,$pwd);
	mysqli_select_db($con, $db_name);
	$sql = "select count(*) as log,type,id,username from user where username='$forgot'";
	$result=mysqli_query($con,$sql) or die(mysqli_error($con));
	while($row=mysqli_fetch_array($result))
		{
			$count=$row['log'];
			$utype=$row['type'];
			$id=$row['id'];
		}
	
	if ($count>0)
	{
		$_SESSION["usname"]=$forgot;
		
		if($utype=='a'||$utype=='m'||$utype=='o'||$utype=='c')
		{
			$sql = "select email from staff where staffID='$id'";
			$result=mysqli_query($con,$sql) or die(mysqli_error($con));
			while($row=mysqli_fetch_array($result))
				{
					$email=$row['email'];
					$code = rand(10000,99999);
					mail($email,"Verification Code","Your verification code is: ","From: kavinyachanmini@gmail.com");
				}
		}
		else if ($utype=='s')
		{
			$sql = "select student.email from student,studentbatch where student.nic=studentbatch.nic and studentbatch.studentNo='$id'";
			$result=mysqli_query($con,$sql) or die(mysqli_error($con));
			while($row=mysqli_fetch_array($result))
				{
					$email=$row['email'];
				}
		}
		else if ($utype=='t')
		{
			$sql = "select email from teacher where teacherID='$id'";
			$result=mysqli_query($con,$sql) or die(mysqli_error($con));
			while($row=mysqli_fetch_array($result))
				{
					$email=$row['email'];
				}
		}
		$b=3;		
	}
	else
	{
		echo "<script type='text/javascript'>alert('Invalid Username');showTab(2);</script>";
		$b=2;
	}
	mysqli_close($con);
}
if(isset($_POST["password"],$_POST["cpassword"]))
{
	$password = md5($_POST["password"]);
	
	$con = mysqli_connect($host,$uname,$pwd);
	mysqli_select_db($con, $db_name);
		$u=$_SESSION["usname"];
		$sql = "UPDATE user SET password='$password' where username='$u'";
		$result=mysqli_query($con,$sql) or die(mysqli_error($con));
		$rows=mysqli_affected_rows($con);
		if ($rows==1)
		{
			echo "<script type='text/javascript'>alert('Password changed successfully');parent.window.location.href='index.php';</script>";
			//header("location:index.php");
		}
	
	mysqli_close($con);
}
if(isset($_POST["fl_password"],$_POST["fl_cpassword"]))
{
	$password = md5($_POST["fl_password"]);
	
	$con = mysqli_connect($host,$uname,$pwd);
	mysqli_select_db($con, $db_name);
		$u=$_SESSION["usname"];
		$sql = "UPDATE user SET password='$password',status='1' where username='$u'";
		$result=mysqli_query($con,$sql) or die(mysqli_error($con));
		$rows=mysqli_affected_rows($con);
		if ($rows==1)
		{
			echo "<script type='text/javascript'>alert('Password changed successfully');parent.window.location.href='dashboard.php';</script>";
			//header("location:index.php");
		}
	
	mysqli_close($con);
}
?>

<html>
<head>
<meta charset="utf-8">
<title>Untitled Document</title>
<link type="text/css" rel="stylesheet" href="css/login.css">
<script language="javascript" type="text/javascript" src="js/login.js"></script>
<script type='text/javascript'>
  function showTab(n) {
  if (n == 0) {
	document.getElementById("log").style.display = "block"; 
	document.getElementById("forgot").style.display = "none";
	document.getElementById("verify").style.display = "none"; 
	document.getElementById("reset").style.display = "none";
  } else if (n == 2) {
	document.getElementById("log").style.display = "none"; 
	document.getElementById("forgot").style.display = "block";
  } else if (n == 3) {
    document.getElementById("forgot").style.display = "none"; 
	document.getElementById("verify").style.display = "block";
  } else if (n == 4) {
    document.getElementById("verify").style.display = "none"; 
	document.getElementById("reset").style.display = "block";
  } else if (n == 5) {
    document.getElementById("reset").style.display = "none"; 
	document.getElementById("firstLogin").style.display = "block";
  } else if (n == 1) {
    document.getElementById("firstLogin").style.display = "none"; 
	document.getElementById("log").style.display = "block";
  }
}
</script>

</head>

<body onLoad="">
  
  <div id="log" class="tab">
  <div id="formContent" align="justify" >
    <!-- Tabs Titles -->
    <h2 > Login 
      
    </h2>
	<br><br>
    <!-- Login Form -->
    <form name="form1" method="post" action="#">
	  <?php
				if(isset($_COOKIE["username"]))
				{
					?>
					<input type="text" name="txtUsername" placeholder="Username"  value="<?php echo $_COOKIE['username'] ?>" required>
				<?php
				}
				else
				{ ?>
					<input type="text" name="txtUsername" placeholder="Username" required>
				<?php
				}
				?>
      <input type="password" id="password"  name="password" placeholder="Password" required>
		<input type="submit"  value="Log In">
    

    <!-- Remind Passowrd -->
    <div id="formFooter">
		<?php
		if(isset($_COOKIE["username"]))
				{
					?>
					<input type="checkbox" name="remember" value="remember" checked>Remember Me
				<?php
				}
				else
				{ ?>
					<input type="checkbox" name="remember" value="remember" >Remember Me
				<?php
				}
				?>
	  
	  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
      <a class="underlineHover" href="#" onClick="showTab(2)">Forgot Password?</a>
    </div>
	</form>
  </div>
  </div>
	
  <div id="forgot"  class="tab">
  <div id="formContent" align="justify">
    <!-- Tabs Titles -->
    <h2 > Forgot Password </h2>
	<br><br>
    <!-- Login Form -->
    <form name="form1" method="post" action="#">
      <input type="text" id="login" name="txtForgot" placeholder="Username" required> 
      <input type="submit"  value="Next">
    </form>


  </div>
  </div>
	
  <div id="verify"  class="tab">
  <div id="formContent" align="justify">
    <!-- Tabs Titles -->
    <h2 > Verification </h2>
	<br><br><p style="margin: 0px 5px 0px 5px">An email with a verification code was just sent to your email account. Please enter the verification code.</p><br>
    <!-- Login Form -->
    <form name="form1" method="post" action="#" >
      <input type="text" id="login" name="login" placeholder="Verification Code" required> 
      <input type="button"  value="Next" onClick="showTab(4)">
    </form>


  </div>
  </div>
	
  <div id="reset"  class="tab">
  <div id="formContent" align="justify">
    <!-- Tabs Titles -->
    <h2 > Reset Password </h2>
    <!-- Login Form -->
    <form name="resetForm" method="post" action="#" onSubmit="return validateform(this);">
      <input type="password" id="login" name="password" placeholder="New password" required>
	  <input type="password" id="login" name="cpassword" placeholder="Re-enter new passsword" required>
      <input type="submit"  value="Change Password" >
    </form>


  </div>
  </div>
	
  <div id="firstLogin"  class="tab">
  <div id="formContent" align="justify">
    <!-- Tabs Titles -->
    <h2 > Change Password </h2>
	<br><br><p style="margin: 0px 10px 0px 10px">You must change your password before logging in for the first time.</p><br>
    <!-- Login Form -->
    <form name="resetForm" method="post" action="#" onSubmit="return validateform(this);">
      <input type="password" id="login" name="fl_password" placeholder="New password" required>
	  <input type="password" id="login" name="fl_cpassword" placeholder="Re-enter new passsword" required>
      <input type="submit"  value="Change Password" >
    </form>


  </div>
  </div>
	<?php
	if ($b == '0') 
	{
		$a=$_GET['a'];
		if($a == '1') {
		echo "<script type='text/javascript'>showTab(1);</script>";}
	}
	else if ($b == '2') 
	{
		echo "<script type='text/javascript'>showTab(2);</script>";
	}
	else if ($b == '3') 
	{
		echo "<script type='text/javascript'>showTab(3);</script>";
	}
	else if ($b == '5') 
	{
		echo "<script type='text/javascript'>showTab(5);</script>";
	}
  ?>
</body>
</html>