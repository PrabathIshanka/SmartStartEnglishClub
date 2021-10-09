<?php
include"connection.php";
$tid="";
$teacher="";
$con = mysqli_connect($host,$uname,$pwd);
mysqli_select_db($con, $db_name);

	if($_POST["tid"]!="")
	{
		$teacher=$_POST["tid"];
		//$teacherID=$_POST["cmbTeacher"];
	}
if($_POST["tid"]!="")
{
$tid=$_POST["hdID"];

$sql = "SELECT * FROM teacher WHERE teacherID='$tid'";
$result=mysqli_query($con,$sql) or die(mysqli_error($con));
  while($row=mysqli_fetch_array($result)) 
{
$nic=$row["nic"];
$fName=$row["fname"];
$lName=$row["lname"];
$title=$row["title"];
$mobile=$row["mobile"];
$email=$row["email"];
$aLine1=$row["aLine1"]; 
$aLine2=$row["aLine2"]; 
$aLine3=$row["aLine3"]; 
$aLine4=$row["aLine4"];   
$highQuali=$row["highQuali"];
  }
}

if(isset($_POST["update"]))
{
  $tid=$_POST["hdID"];
  $nic=$_POST["nic"];
  $fName=$_POST["fName"];
  $lName=$_POST["lName"];
  $title=$_POST["title"];
  $mobile=$_POST["mobile"];
  $email=$_POST["email"];   
  $aLine1=$_POST["aLine1"]; 
  $aLine2=$_POST["aLine2"]; 
  $aLine3=$_POST["aLine3"]; 
  $aLine4=$_POST["aLine4"];   
  $highQuali=$_POST["highQuali"];

  $sql = "UPDATE teacher SET nic='$nic',fname='$fName',lname='$lName',title='$title' ,mobile='$mobile' ,email='$email',aLine1='$aLine1' ,aLine2='$aLine2' ,aLine3='$aLine3' ,aLine4='$aLine4' ,highQuali='$highQuali' WHERE teacherID='$tid' "; 
  $result=mysqli_query($con,$sql) or die(mysqli_error($con));
  $rows=mysqli_affected_rows($con);
	
  $sql = "DELETE FROM teachercourse WHERE teacherID=$tid ";
  $result=mysqli_query($con,$sql) or die(mysqli_error($con));
	
  $sql = "SELECT * FROM course order by name";
	$result=mysqli_query($con,$sql) or die(mysqli_error($con));
	  while($row=mysqli_fetch_array($result)) 
	{
		$no=$row["courseNo"];
		  if(isset($_POST[$no])){
			  $sql2 = "INSERT INTO teachercourse(teacherID,courseNo) VALUES('$tid','$no')";
			  $result2=mysqli_query($con,$sql2) or die(mysqli_error($con));
			  $rows2=mysqli_affected_rows($con);
		  }
	  }
	
  if ($rows==1 or $rows2>0)
      {
        echo "<script type='text/javascript'>alert('Updated Successfully');</script>";$teacher="";$tid="";
	  $nic="";
  $fName="";
  $lName="";
  $title="";
  $mobile="";
  $email="";   
  $aLine1=""; 
  $aLine2=""; 
  $aLine3=""; 
  $aLine4="";   
  $highQuali="";
      }
	
	
}

if(isset($_POST["delete"]))
{
  $sql = "DELETE FROM teacher WHERE teacherID=$tid ";
  $result=mysqli_query($con,$sql) or die(mysqli_error($con));
  $rows=mysqli_affected_rows($con);
	
	$sql = "DELETE FROM teachercourse WHERE teacherID=$tid ";
  $result=mysqli_query($con,$sql) or die(mysqli_error($con));
	$rows2=mysqli_affected_rows($con);
	
  if ($rows==1 and $rows2==1)
      {
        echo "<script type='text/javascript'>alert('Record Deleted');</script>";$teacher="";$tid="";
	  $nic="";
  $fName="";
  $lName="";
  $title="";
  $mobile="";
  $email="";   
  $aLine1=""; 
  $aLine2=""; 
  $aLine3=""; 
  $aLine4="";   
  $highQuali="";
      }
}
mysqli_close($con);
?>
<!DOCTYPE html>
<html>
<head>
  <title>Update/Delete Teachers</title>
  <link rel="stylesheet" type="text/css" href="css/form.css"/>
	<script language="javascript" type="text/javascript" src="js/upd_del_teacher.js"></script>
</head>
<body>
  
  <div class="testbox">
  <form name="form1" method="post" action="#" onSubmit="return validateform(this);">
    <div class="banner">
  <h1>Update/Delete Teachers</h1></div>

 
	  <div class="item">
          <p>Teacher</p>
          <select name="tid" required onChange="submit()">
              <option selected value="<?php echo $teacher;?>"><?php echo $tid." - ".$teacher;?></option>
              <?php
				$con = mysqli_connect($host,$uname,$pwd);
				mysqli_select_db($con, $db_name);
				$sql = "select * from teacher";
				$result=mysqli_query($con,$sql) or die(mysqli_error($con));
				while($row=mysqli_fetch_array($result))
					{
						echo "<option value='". $row['fname']." ".$row['lname'] ."'>".$row['teacherID']." - ".$row['fname']." ".$row['lname'] ."</option>";
						$id=$row['teacherID'];
						
					}
			  mysqli_close($con);
			?> <input type="hidden" name="hdID" value="<?php echo $id ?>"/>
            </select>
			
        </div>
	  
<div class="item"><label for="id"> NIC</label>
<input type="text" id="id" name="nic" required="required" value="<?php echo $nic; ?>"/></br></div>
<div class="item">
          <p>Title</p>
          <select required name="title">
              <option selected value="<?php echo $title;?>"><?php echo $title;?></option>
              <option value="Mr">Mr</option>
              <option value="Ms">Ms</option>
            </select>
        </div>
<div class="item">
          <p>Name</p>
          <div class="name-item">
            <input type="text" name="fName" placeholder="First Names" required value="<?php echo $fName; ?>"/>
            <input type="text" name="lName" placeholder="Last Name" required value="<?php echo $lName; ?>"/>
          </div>
        </div>

 <div class="item"><label for="number">Mobile Number</label>
<input type="text" id="name" name="mobile"  required="required" value="<?php echo $mobile; ?>"/></br></div>

<div class="item"><label for="name">Email</label>
<input type="email" id="name" name="email"  required="required" value="<?php echo $email; ?>"/></br></div>

<div class="item">
          <p>Address</p>
            <input type="text" name="aLine1" placeholder="Address Line 1" required value="<?php echo $aLine1; ?>"/>
            <input type="text" name="aLine2" placeholder="Address Line 2"  value="<?php echo $aLine2; ?>"/>
            <input type="text" name="aLine3" placeholder="Address Line 3"  value="<?php echo $aLine3; ?>"/>
            <input type="text" name="aLine4" placeholder="Address Line 4"  value="<?php echo $aLine4; ?>"/>
          
        </div>
   <div class="item">  
  <p>High Qualification</p>
  <textarea name="highQuali" rows="4"  cols="36" required ><?php echo $highQuali; ?></textarea>
  </div>
   <div class="item">
          <p>Courses</p>
          <?php
				$con = mysqli_connect($host,$uname,$pwd);
				mysqli_select_db($con, $db_name);
				$sql = "select * from course order by name";
				$result=mysqli_query($con,$sql) or die(mysqli_error($con));
				while($row=mysqli_fetch_array($result))
					{
						$cno=$row['courseNo'];
						$sql2 = "select count(*) from teachercourse where teacherID='$tid' and courseNo='$cno'";
						$result2=mysqli_query($con,$sql2) or die(mysqli_error($con));
						while($row2=mysqli_fetch_array($result2))
						{
							$c=$row2[0];
						}
						if($c==0)
							$ck="";
						else
							$ck="checked"; 
					    echo "<div class='question'>
          <div class='question-answer checkbox-item'>
            <div>
			  <input type='checkbox' ".$ck." value='". $row['courseNo'] ."' id='". $row['courseNo'] ."' name='".$row['courseNo']."'/>
              <label for='". $row['courseNo'] ."' class='check'><span >". $row['name'] ."</span></label>
			</div>
          </div>
        </div>";
					}
			  mysqli_close($con);
			?> 
        </div>

<div class="btn-block">
          <input type="submit" value="Update" name="update">
      <input type="submit" value="Delete" name="delete" style="margin-left: 20px">
</div>

</form>
</div>

</body>
</html>