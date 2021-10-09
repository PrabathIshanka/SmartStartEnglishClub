<!DOCTYPE html>
<html>
<head>

	<title>Update/Delete System Users</title>
	<link rel="stylesheet" type="text/css" href="css/form.css"/>

<style>
#table {
  font-family: Arial, Helvetica, sans-serif;
  border-collapse: collapse;
  width: 100%;


}

#table td, #table th {
  border: 1px solid #ddd;
  padding: 8px;

}

#table tr:nth-child(even){background-color: #f2f2f2;}

#table tr:hover {background-color: #ddd;}

#table th {
  padding-top: 12px;
  padding-bottom: 12px;
  text-align:center;
  background-color: #04AA6D;
  color: white;
}
</style>


</head>
<body>


   <div class="banner">
<h1>Update/Delete System Users</h1></div>

   <div class="testbox">
<form name="form1" method="post" action="#" >

   <div class="item"><label for="username">User ID</label>
<input type="text" id="username" name="username"  required="required" /></br></div>

   <div class="item"><label for="id"> NIC</label>
<input type="text" id="id" name="id" required="required" /></br></div>

   <div class="item"><label for="Usertype">User Type</label>
 <select id="type" name="type"/ >
<option disabled selected value></option>
<option value="admin" >Admin</option> 
<option value="officeassis">Office Assistant</option>
<option value="courscore">Course Coordinator</option>
<option value="manager">Manager</option><br>
 </select></br></div>

  <div class="item"><label for="password">Change Password</label>
<input type="password" id="password" name="password"  required="required" /></br></div>

  <div class="item"><label for="password">Confirm Password</label>
<input type="password" id="pwd2" name="pwd2" required="required" /></br></div>

  <div class="btn-block">
<input type="submit" name="View" value="View">
<input type="submit" name="Update" value="Update">
<input type="submit" name="Delete" value="Delete" style="margin-left: 20px">
  </div>

</form>
   </div>
   <div class="table1">
<table id="table" >
  <thead>
  	<tr>
		<th>User name</th>
		<th>ID</th>
		<th>Type</th>
		<th>Password</th>
	</tr>
  </thead>
 <tbody>


<?php

session_start();
include"connection.php";
$msg="";

if (isset($_POST["username"],$_POST["id"],$_POST["type"],$_POST["password"]))
 {
 $username=$_POST["username"];
 $id=$_POST["id"];
 $type=$_POST["type"];
 $password=$_POST["password"];

//if (isset($_POST["View"])) 
 //{
 $con=mysqli_connect($host,$uname,$pwd);
 mysqli_select_db($con,$db_name);
if(isset($_POST["username"],$_POST["id"],$_POST["type"],$_POST["password"]));

 $sql = "SELECT * FROM user";
$result=mysqli_query($con,$sql) or die(mysqli_error($con));
  while($row=mysqli_fetch_array($result)) 
{
 echo ("<tr>");
      echo ("<td>"); echo $row["username"]; echo ("</td>");
      echo ("<td>"); echo $row["id"]; echo ("</td>");
      echo ("<td>"); echo $row["type"]; echo ("</td>");
      echo ("<td>"); echo $row["password"]; echo ("</td>");
 echo("</tr>");


?>


<script type="text/javascript">
	window.location.href=window.location.href;
</script>


<?php  

//}

}



if (isset($_POST["Update"]))
 {
 	 $con=mysqli_connect($host,$uname,$pwd);
     mysqli_select_db($con,$db_name);
if(isset($_POST["username"],$_POST["id"],$_POST["type"],$_POST["password"]));

	 $sql = "UPDATE user SET id='$id',type='$type',password='$password' WHERE username='$username' ";
	 $result=mysqli_query($con,$sql) or die(mysqli_error($con));

	 ?>

<script type="text/javascript">
	window.location.href=window.location.href;
</script>


<?php





}


if (isset($_POST["Delete"]))
 {
 	 $con=mysqli_connect($host,$uname,$pwd);
     mysqli_select_db($con,$db_name);
if(isset($_POST["username"],$_POST["id"],$_POST["type"],$_POST["password"]));

	 $sql = "DELETE FROM user WHERE username='$username' ";
	 $result=mysqli_query($con,$sql) or die(mysqli_error($con));





?>

<script type="text/javascript">
	window.location.href=window.location.href;
</script>

<?php 

}
}
 ?>
</tbody>
</table>
</body>
</html>

