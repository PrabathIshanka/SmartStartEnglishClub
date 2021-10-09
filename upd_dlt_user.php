<?php
include"connection.php";
$sid="";
$con = mysqli_connect($host,$uname,$pwd);
mysqli_select_db($con, $db_name);
if($_POST["sid"]!="")
{
$sid=$_POST["sid"];

$sql = "SELECT * FROM staff WHERE staffID='$sid'";
$result=mysqli_query($con,$sql) or die(mysqli_error($con));
  while($row=mysqli_fetch_array($result)) 
{
$nic=$row["nic"];
$fName=$row["fName"];
$lName=$row["lName"];
$email=$row["email"];	  
$type=$row["desig"];
	  	
if ($type=='a')
	$t='Admin';
elseif ($type=='o')
	$t='Office Assistant';
elseif ($type=='c')
	$t='Course Courdinator';

  }
}

if(isset($_POST["update"]))
{
	$sid=$_POST["sid"];
	$nic=$_POST["nic"];
	$fName=$_POST["fName"];
	$lName=$_POST["lName"];
	$email=$_POST["email"];	  
	$type=$_POST["type"];
	
	$sql = "UPDATE staff SET nic='$nic',fName='$fName',lName='$lName',email='$email',desig='$type' WHERE staffID=$sid ";
	$result=mysqli_query($con,$sql) or die(mysqli_error($con));
	$rows=mysqli_affected_rows($con);
	if ($rows==1)
			{
				echo "<script type='text/javascript'>alert('Updated Successfully');</script>";
				$sid="";
				$nic="";
				$fName="";
				$lName="";
				$email="";	  
				$type="";
				$t="";
			}
}

if(isset($_POST["delete"]))
{
	$sql = "DELETE FROM staff WHERE staffID=$sid ";
	$result=mysqli_query($con,$sql) or die(mysqli_error($con));
	$rows=mysqli_affected_rows($con);
	if ($rows==1)
			{
				echo "<script type='text/javascript'>alert('Record Deleted');</script>";
				$sid="";
				$nic="";
				$fName="";
				$lName="";
				$email="";	  
				$type="";
				$t="";
			}
}
mysqli_close($con);
?>
<!DOCTYPE html>
<html>
<head>
	<title>Update/Delete System Users</title>
	<link rel="stylesheet" type="text/css" href="css/form.css"/>
</head>
<body>
	
	<div class="testbox">
	<form name="form1" method="post" action="#" >
		<div class="banner">
	<h1>Update/Delete System Users</h1></div>
<div class="item">
          <p>Staff ID</p>
          <select name="sid" required onChange="submit()">
              <option selected value="<?php echo $sid;?>"><?php echo $sid;?></option>
              <?php
				$con = mysqli_connect($host,$uname,$pwd);
				mysqli_select_db($con, $db_name);
				$sql = "select * from staff order by staffID";
				$result=mysqli_query($con,$sql) or die(mysqli_error($con));
				while($row=mysqli_fetch_array($result))
					{
						echo "<option value='". $row['staffID'] ."'>" .$row['staffID'] ."</option>";
					}
			  mysqli_close($con);
			?> 
            </select>
        </div>

<div class="item"><label for="id"> NIC</label>
<input type="text" id="id" name="nic" required="required" value="<?php echo $nic; ?>"/></br></div>
<div class="item">
          <p>Name</p>
          <div class="name-item">
            <input type="text" name="fName" placeholder="First Names" required value="<?php echo $fName; ?>"/>
            <input type="text" name="lName" placeholder="Last Name" required value="<?php echo $lName; ?>"/>
          </div>
        </div>
<div class="item"><label for="name">Email</label>
<input type="email" id="name" name="email"  required="required" value="<?php echo $email; ?>"/></br></div>
<div class="item"><label for="Usertype">User Type</label>
<select required id="type" name="type"/ >
<option selected value="<?php echo $type;?>"><?php echo $t;?></option>
<option value="a" >Admin</option> 
<option value="o">Office Assistant</option>
<option value="c">Course Coordinator</option>
</select></br></div>

<div class="btn-block">
          <input type="submit" value="Update" name="update">
		  <input type="submit" value="Delete" name="delete" style="margin-left: 20px">
</div>

</form>
</div>

</body>
</html>