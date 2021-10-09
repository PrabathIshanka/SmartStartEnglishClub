<?php
session_start();
include"connection.php";
$con = mysqli_connect($host,$uname,$pwd);
mysqli_select_db($con, $db_name);
if (isset($_POST["submit"]))
 {
$sid=$_POST["sid"];
$nic=$_POST["nic"];
$fname=$_POST["fName"];
$lname=$_POST["lName"];
$type=$_POST["type"];
$email=$_POST["email"];

 /*$sql ="INSERT INTO user(username,password,type,id) VALUES('$uname',$pwd1,$type,$nic)";
 $result=mysql_query($con,$sql)or die(mysql_error($con));
 $rows1=mysqli_affected_rows($con);*/
	
$sql ="INSERT INTO staff(staffID,nic,fName,lName,email,desig) VALUES('$sid','$nic','$fname','$lname','$email','$type')";
$result=mysqli_query($con,$sql) or die(mysqli_error($con));

$rows=mysqli_affected_rows($con);
	
 if($rows==1)
    {
	 $_SESSION["crt_type"] = $type;
	 $_SESSION["crt_id"] = $sid;
 	 echo "<script type='text/javascript'>alert('User Added Successfuly');window.location.href='create_user.php';</script>";
    }

    
 }
    
$query ="select * from staff order by staffID desc limit 1";
$result=mysqli_query($con,$query);
$row=mysqli_fetch_array($result);

$lastid = $row['staffID'];

if ($lastid == " ")
{
   $id = "01";
}
else
{
   $id = intval($lastid);
   $id = str_pad($id+1,2,0, STR_PAD_LEFT);
   
}
mysqli_close($con);
?>
<html>
<head>
	<title>Add System User</title>

<link rel="stylesheet" type="text/css" href="css/form.css"/>
</head>
<body>
	
<div class="testbox">
	
	<form name="form1" method="post" action="#">
		<div class="banner">
	<h1>Add System User</h1>
</div>

<div class="item"><label for="Uname">Staff ID</label>
<input type="text" id="Uname" name="sid"  required="required" value="<?php echo $id; ?>" readonly/></div>
<div class="item"><label for="id"> NIC</label>
<input type="text" id="id" name="nic"  required="required" /></br></div>
<div class="item">
          <p>Name</p>
          <div class="name-item">
            <input type="text" name="fName" placeholder="First Names" required />
            <input type="text" name="lName" placeholder="Last Name" required/>
          </div>
        </div>
<div class="item"><label for="name">Email</label>
<input type="email" name="email"  required="required" /></br></div>
<div class="item"><label for="Usertype">User Type</label>
<select id="type" name="type" required >
<option disabled selected value></option>
<option value="a" >Admin</option> 
<option value="o">Office Assistant</option>
<option value="c">Course Coordinator</option>
</select></div>

<div class="btn-block">
          <input type="submit" value="Submit" name="submit">
</div><br>

	</form>
</div>
</body>
</html>