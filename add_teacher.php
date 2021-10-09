<?php
session_start();
include "connection.php";
$con = mysqli_connect($host,$uname,$pwd);
 mysqli_select_db($con, $db_name);
if(isset($_POST["teacherID"], $_POST["nic"], $_POST["fname"], $_POST["lname"] ,$_POST["title"] , $_POST["mobile"], $_POST["email"] ,$_POST["aLine1"], $_POST["aLine2"], $_POST["aLine3"] ,$_POST["aLine4"] , $_POST["highQuali"]))
{
  $teacherID= $_POST["teacherID"];
  $nic = $_POST["nic"];
  $fname = $_POST["fname"];
  $lname = $_POST["lname"];
  $title = $_POST["title"];
  $mobile= $_POST["mobile"];
  $email = $_POST["email"];
  $aLine1 = $_POST["aLine1"];
  $aLine2 = $_POST["aLine2"];
  $aLine3 = $_POST["aLine3"];
  $aLine4 = $_POST["aLine4"];
  $highQuali= $_POST["highQuali"];
  
  
  $sql = "INSERT INTO teacher(teacherID,nic,fname,lname,title,mobile,email,aLine1,aLine2,aLine3,aLine4,highQuali) VALUES('$teacherID','$nic','$fname','$lname','$title','$mobile','$email','$aLine1','$aLine2','$aLine3','$aLine4','$highQuali')";
  $result=mysqli_query($con,$sql) or die(mysqli_error($con));
  
  $rows=mysqli_affected_rows($con);
	
  $sql = "SELECT * FROM course order by name";
	$result=mysqli_query($con,$sql) or die(mysqli_error($con));
	  while($row=mysqli_fetch_array($result)) 
	{
		$no=$row["courseNo"];
		  if(isset($_POST[$no])){
			  $sql2 = "INSERT INTO teachercourse(teacherID,courseNo) VALUES('$teacherID','$no')";
			  $result2=mysqli_query($con,$sql2) or die(mysqli_error($con));
			  $rows2=mysqli_affected_rows($con);
		  }
	  }
	
	if ($rows==1 and $rows2>0)
  {
		$_SESSION['crt_type'] = "t";
		$_SESSION['crt_id'] = $_POST['teacherID'];
    echo "<script type='text/javascript'>alert('Teacher added successfully');window.location.href='create_user.php';</script>";
  
  }
}

    
    
$query ="select * from teacher order by teacherID desc limit 1";
$result=mysqli_query($con,$query);
$row=mysqli_fetch_array($result);

$lastid = $row['teacherID'];

if ($lastid == " ")
{
   $teaid = "001";
}
else
{
   $teaid = intval($lastid);
   $teaid = str_pad($teaid+1,3,0, STR_PAD_LEFT);
   
}

mysqli_close($con);
?>

<!doctype html>
<html>
<head>
<link type="text/css" rel="stylesheet" href="css/form.css">
<script language="javascript" type="text/javascript" src="js/add_teacher.js"></script>  
	<meta charset="utf-8">
<title>Add Teacher</title>
</head>

<body>
	<div class="testbox">
      <form name="addTeacherform" method="post" action="#" onSubmit="return validateform(this);">
        <div class="banner">
          <h1>Add Teacher</h1>
        </div>
		  <br>
		<div class="item">
          <p>Teacher ID</p>
		<input type="text"	id="Id"  name="teacherID" value="<?php echo $teaid; ?>" readonly>
        
        </div>
		<div class="item">
          <p>NIC</p>
          <input type="text" name="nic" required/>
        </div>
        <div class="item">
          <p>Name</p>
          <div class="name-item">
            <input type="text" name="fname" placeholder="First Names" required/>
            <input type="text" name="lname" placeholder="Last Name" required/>
          </div>
        </div>
		<div class="item">
          <p>Title</p>
          <select name="title" required>
              <option value=""></option>
              <option value="Mr">Mr</option>
              <option value="Ms">Ms</option>
            </select>
        </div>
		 <div class="item">
          <p>Mobile Number</p>
          <input type="number" name="mobile" required/>
        </div>
        <div class="item">
          <p>Email</p>
          <input type="email" name="email" required/><br/>
			
        </div>
		<div class="item">
          <p>Address</p>
          <input type="text" name="aLine1" placeholder="Address line 1" required />
          <input type="text" name="aLine2" placeholder="Address line 2" />
		      <input type="text" name="aLine3" placeholder="Address line 3" />
          <input type="text" name="aLine4" placeholder="Address line 4" />
        </div>
        <div class="item">
          <p> HIgh Qualification</p>
           <textarea name="highQuali" rows="4" required></textarea>
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
					    echo "<div class='question'>
          <div class='question-answer checkbox-item'>
            <div>
			  <input type='checkbox' value='". $row['courseNo'] ."' id='". $row['courseNo'] ."' name='". $row['courseNo'] ."'/>
              <label for='". $row['courseNo'] ."' class='check'><span >". $row['name'] ."</span></label>
			</div>
          </div>
        </div>";
					}
			  mysqli_close($con);
			?> 
        </div>
		  
				
              
            
		 <div class="btn-block">
          <input type="submit" value="Submit" >
        </div>
		</form>
	</div>
</body>
</html>
