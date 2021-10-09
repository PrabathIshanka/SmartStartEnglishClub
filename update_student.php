<?php
include"connection.php";
$nic="";
$con = mysqli_connect($host,$uname,$pwd);
mysqli_select_db($con, $db_name);
if($_POST["nic"]!="")
{
$nic=$_POST["nic"];

$sql = "SELECT * FROM student WHERE nic='$nic'";
$result=mysqli_query($con,$sql) or die(mysqli_error($con));
while($row=mysqli_fetch_array($result)) 
{
$nic=$row["nic"];
$fName=$row["fName"];
$lName=$row["lName"];
$title=$row["title"];
$dob=$row["dob"];
$mobile=$row["mobile"];
$email=$row["email"];
$aLine1=$row["aLine1"]; 
$aLine2=$row["aLine2"];
$aLine3=$row["aLine3"];
$aLine4=$row["aLine4"];  

  }
}

if(isset($_POST["update"]))
{
  $sno=$_POST["sno"];
  $nic=$_POST["nic"];
  $fName=$_POST["fName"];
  $lName=$_POST["lName"];
  $title=$_POST["title"];
  $dob=$_POST["dob"];
  $mobile=$_POST["mobile"];
  $email=$_POST["email"];
  $aLine1=$_POST["aLine1"];
  $aLine2=$_POST["aLine2"];
  $aLine3=$_POST["aLine3"];
  $aLine4=$_POST["aLine4"]; 
  
  $sql = "UPDATE student SET fName='$fName',lName='$lName',title='$title',dob='$dob',mobile='$mobile' ,email='$email',aLine1='$aLine1', aLine2='$aLine2', aLine3='$aLine3', aLine4='$aLine4' WHERE nic=$nic ";
  $result=mysqli_query($con,$sql) or die(mysqli_error($con));
  $rows=mysqli_affected_rows($con);
  if ($rows==1)
      {
        echo "<script type='text/javascript'>alert('Updated Successfully');</script>";
      }
}

mysqli_close($con);
?>
<!DOCTYPE html>
<html>
<head>
  <title>Update Students</title>
  <link rel="stylesheet" type="text/css" href="css/form.css"/>
</head>
<body>
  
  <div class="testbox">
  <form name="form1" method="post" action="#" >
    <div class="banner">
  <h1>Update Students</h1></div>

<div class="item"><label for="id"> NIC</label>
<input type="text" id="id" name="nic" required="required" onChange="submit()" value="<?php echo $nic; ?>"/></br></div>

<div class="item">
          <p>Name</p>
          <div class="name-item">
            <input type="text" name="fName" placeholder="First Names" required value="<?php echo $fName; ?>"/>
            <input type="text" name="lName" placeholder="Last Name" required value="<?php echo $lName; ?>"/>
          </div>
        </div>

        <div class="item">
          <p>Title<span class="required"></span></p>
          <select required name="title">
              <option selected value="<?php echo $title;?>"><?php echo $title;?></option>
              <option value="Mr">Mr</option>
              <option value="Ms">Ms</option>
            </select>
        </div>

<div class="item"><label for="name">Date of Birth</label>
<input type="date" id="name" name="dob"  required="required" value="<?php echo $dob; ?>"/></br></div>

	
         <div class="item">
          <p>Mobile Number<span class="required"></span></p>
          <input type="text" name="mobile" required value="<?php echo $mobile; ?>"/>
        </div>
	
<div class="item"><label for="name">Email</label>
<input type="email" id="name" name="email"  required="required" value="<?php echo $email; ?>"/></br></div>

<div class="item">
          <p>Address</p>
          <div class="name-item">
           <input type="text" name="aLine1" placeholder="Address Line1" required value="<?php echo $aLine1; ?>"/>
           <input type="text" name="aLine2" placeholder="Address Line2"  value="<?php echo $aLine2; ?>"/>
          <input type="text" name="aLine3" placeholder="Address Line3"  value="<?php echo $aLine3; ?>"/>
          <input type="text" name="aLine4" placeholder="Address Line4"  value="<?php echo $aLine4; ?>"/>
           
          </div>
        </div>



 </div>

<div class="btn-block">
          <input type="submit" value="Update" name="update">
      
</div>

</form>
</div>

</body>
</html>