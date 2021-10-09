<?php
include"connection.php";
$cname="";

$con = mysqli_connect($host,$uname,$pwd);
mysqli_select_db($con, $db_name);
if($_POST["cname"]!="")
{
$cname=$_POST["cname"];

$sql = "SELECT * FROM course WHERE name='$cname'";
$result=mysqli_query($con,$sql) or die(mysqli_error($con));
  while($row=mysqli_fetch_array($result)) 
{
$courseNo=$row["courseNo"];
$description=$row["description"];
$duration=$row["duration"];   
$fee=$row["fee"];
  }
}

if(isset($_POST["update"]))
{
  $cname=$_POST["cname"];
  $name=$_POST["name"];
  $courseNo=$_POST["courseNo"];
  $description=$_POST["description"];
  $duration=$_POST["duration"];
  $fee=$_POST["fee"];   

  $sql = "UPDATE course SET name='$name', description='$description',duration='$duration',fee='$fee' WHERE name='$cname' ";
  $result=mysqli_query($con,$sql) or die(mysqli_error($con));
  $rows=mysqli_affected_rows($con);
  if ($rows==1)
      {
        echo "<script type='text/javascript'>alert('Updated Successfully');</script>";
	  	$cname="";
	  	$name="";
		$description="";
		$duration="";  
		$fee="";
      }
}

if(isset($_POST["delete"]))
{
  $sql = "DELETE FROM course WHERE name='$cname'";
  $result=mysqli_query($con,$sql) or die(mysqli_error($con));
  $rows=mysqli_affected_rows($con);
  if ($rows==1)
      {
        echo "<script type='text/javascript'>alert('Record Deleted');</script>";
	  	$cname="";
	    $name="";
		$description="";
		$duration="";  
		$fee="";
      }
}
mysqli_close($con);
?>


<!DOCTYPE html>
<html>
<head>
  <title>Update/Delete Course</title>
  <link rel="stylesheet" type="text/css" href="css/form.css"/>
	<script language="javascript" type="text/javascript" src="js/upd_del_course.js"></script>
</head>
<body>
  
  <div class="testbox">
  <form name="upd_del_cform" method="post" action="#" onSubmit="return validateform(this);">
    <div class="banner">
  <h1>Update/Delete Course</h1></div>

 
    <div class="item">
          <p>Course</p>
          <select name="cname" required onChange="submit()">
              <option selected value="<?php echo $cname;?>"><?php echo $cname;?></option>
              <?php
        $con = mysqli_connect($host,$uname,$pwd);
        mysqli_select_db($con, $db_name);
        $sql = "select * from course order by name";
        $result=mysqli_query($con,$sql) or die(mysqli_error($con));
        while($row=mysqli_fetch_array($result))
          {
            echo "<option value='".$row['name']."'>" .$row['name'] ."</option>";
                        
          }
        mysqli_close($con);
      ?> 
            </select>
        </div>
	  <div class="item"><label for="id"> Name </label>
<input type="text" id="id" name="name" required="required" value="<?php echo $cname; ?>"/></br></div>
<div class="item">	
	<p>Description of Course</p>
		 <textarea name="description" rows="4"  cols="36"><?php echo $description; ?></textarea>
	</div>

<div class="item"><label for="id"> Duration </label>
<input type="number" id="id" name="duration" required="required" min="0" value="<?php echo $duration; ?>"/></br></div>

<div class="item"><label for="id"> Fee </label>
<input type="number" id="id" name="fee" required="required" min="0" value="<?php echo $fee; ?>"/></br></div>

<div class="btn-block">
          
      <input type="submit" value="Update" name="update">
      <input type="submit" value="Delete" name="delete" style="margin-left: 20px">
</div>





</form>
</div>

</body>
</html>