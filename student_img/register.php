<?php
session_start();
include "connection.php";
$flag=0;
$flag=$_POST["hdflag"];
$nic=$_POST["txtNIC"];
$course=$_POST["cmbCourse"];
$con = mysqli_connect($host,$uname,$pwd);
mysqli_select_db($con, $db_name);

if(isset($_POST["txtNIC"],$_POST["cmbCourse"]) and $flag==0)
{
	$flag=1;
	$readonly='readonly';
	$required='required';
	$sql = "SELECT * FROM student WHERE nic=$nic";
	$result=mysqli_query($con,$sql) or die(mysqli_error($con));
	
	while($row=mysqli_fetch_array($result))
		{
			$required='';
			$fName = $row["fName"];
			$lName = $row["lName"];
			$title = $row["title"];
			$bDate = $row["dob"];
			$add1 = $row["aLine1"];
			$add2 = $row["aLine2"];
			$add3 = $row["aLine3"];
			$add4 = $row["aLine4"];
			$mobile = $row["mobile"];
			$email = $row["email"];
			$photo = $row["image"];			
		}
	
}

if(isset($_POST["cmbCourse"],$_POST["txtNIC"],$_POST["txtFName"],$_POST["txtLName"],$_POST["cmbTitle"],$_POST["bDate"],$_POST["txtAdd1"],$_POST["txtAdd2"],$_POST["txtAdd3"],$_POST["txtAdd4"],$_POST["txtMobile"],$_POST["txtEmail"],$_FILES["photo"]["name"],$_POST["txtAmount"],$_POST["pDate"],$_FILES["slip"]["name"],$_POST["check"]))
{
	$course = $_POST["cmbCourse"];
	$nic = $_POST["txtNIC"];
	$fName = $_POST["txtFName"];
	$lName = $_POST["txtLName"];
	$title = $_POST["cmbTitle"];
	$bDate = $_POST["bDate"];
	$add1 = $_POST["txtAdd1"];
	$add2 = $_POST["txtAdd2"];
	$add3 = $_POST["txtAdd3"];
	$add4 = $_POST["txtAdd4"];
	$mobile = $_POST["txtMobile"];
	$email = $_POST["txtEmail"];
	$amount = $_POST["txtAmount"];
	$pDate = $_POST["pDate"];
	
	$sql = "select count(*) from student where nic='$nic'";
	$result=mysqli_query($con,$sql) or die(mysqli_error($con));
	while($row=mysqli_fetch_array($result))
		{
			$c=$row[0];
		}
	if($c>0)
	{
		if(empty($_FILES["photo"]["name"]))
		{
			$sql = "UPDATE student SET fName='$fName',lName='$lName',title='$title',dob='$bDate',mobile='$mobile',email='$email',aLine1='$add1',aLine2='$add2',aLine3='$add3',aLine4='$add4' WHERE nic=$nic ";
			$result=mysqli_query($con,$sql) or die(mysqli_error($con));
			$rows=mysqli_affected_rows($con);
		}

		else{
			$img = $_FILES["photo"]["name"];
			$ext = end((explode('.',$img))); //extra () to avoid error
			$image = $name.".".$ext;
			$src = $_FILES['photo']['tmp_name'];
			$dst = "student_img/".$image;
			$upload = move_uploaded_file($src, $dst);
			if($upload==false)
			{echo "<script type='text/javascript'>alert('image was not uploaded');</script>";}
			else{
				unlink("student_img/".$photo);
			}
			$sql = "UPDATE student SET fName='$fName',lName='$lName',title='$title',dob='$bDate',mobile='$mobile',email='$email',aLine1='$add1',aLine2='$add2',aLine3='$add3',aLine4='$add4',image='$image' WHERE nic=$nic ";
			$result=mysqli_query($con,$sql) or die(mysqli_error($con));
			$rows=mysqli_affected_rows($con);

		}
		
	}
	else
	{
		$img = $_FILES["photo"]["name"];
		$ext = end((explode('.',$img))); //extra () to avoid error
		$image = $nic.".".$ext;
		$src = $_FILES['photo']['tmp_name'];
		$dst = "student_img/".$image;
		$upload = move_uploaded_file($src, $dst);

		if($upload==false)
		{
			echo "<script type='text/javascript'>alert('image was not uploaded');</script>";
		}
			
		$sql = "INSERT INTO student(nic,fName,lName,title,dob,mobile,email,aLine1,aLine2,aLine3,aLine4,image) VALUES('$nic','$fName','$lName','$title','$bDate','$mobile','$email','$add1','$add2','$add3','$add4','$image')";
		$result=mysqli_query($con,$sql) or die(mysqli_error($con));
		$rows=mysqli_affected_rows($con);
	}
	
		if ($rows==1)
		{
			echo "<script type='text/javascript'>alert('Registration successful');window.location.href='index.php';</script>";
			//header("location:index.php");
		}
	}
	
	mysqli_close($con);

?>
<html>
  <head>
    <title>Online Student Registration</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link type="text/css" rel="stylesheet" href="css/register.css">
  </head>
  <body>
    <div class="testbox">
      <form name="regForm" enctype="multipart/form-data" method="post" action="#">
		
        <div class="banner">
          <h1>Online Student Registration</h1><input type="hidden" name="hdflag" id="hdflag" value="<?php echo $flag;?>"/>
        </div>
		  <br>
		<div class="item">
          <p>Course<span class="required">*</span></p>
          <select required name="cmbCourse">
			  <option selected value="<?php echo $course;?>"><?php echo $course;?></option>
              <?php
				$con = mysqli_connect($host,$uname,$pwd);
				mysqli_select_db($con, $db_name);
				$sql = "select course.name from course,batch where course.courseNo=batch.courseNo and (curdate() between batch.appliFrom and batch.appliTo)";
				$result=mysqli_query($con,$sql) or die(mysqli_error($con));
				while($row=mysqli_fetch_array($result))
					{
						echo "<option value='". $row['name'] ."'>" .$row['name'] ."</option>";
					}
			  mysqli_close($con);
			?> 
            </select>
        </div>
        <h2>Applicant Details</h2>
		<div class="item">
          <p>NIC<span class="required">*</span></p>
          <input type="text" name="txtNIC" required onChange="submit()" <?php echo $readonly;?> value="<?php echo $nic; ?>"/>
        </div>
        <div class="item">
          <p>Name<span class="required">*</span></p>
          <div class="name-item">
            <input type="text" name="txtFName" placeholder="First Names" required value="<?php echo $fName; ?>"/>
            <input type="text" name="txtLName" placeholder="Last Name" required value="<?php echo $lName; ?>"/>
          </div>
        </div>
		<div class="item">
          <p>Title<span class="required">*</span></p>
          <select required name="cmbTitle">
              <option selected value="<?php echo $title;?>"><?php echo $title;?></option>
              <option value="Mr">Mr</option>
              <option value="Ms">Ms</option>
            </select>
        </div>
		<div class="item">
          <p>Date of Birth<span class="required">*</span></p>
          <input type="date" name="bDate" required value="<?php echo $bDate; ?>"/>
          <i class="fa fa-calendar"></i>
        </div>
		<div class="item">
          <p>Address<span class="required">*</span></p>
          <input type="text" name="txtAdd1" placeholder="Address line 1" required value="<?php echo $add1; ?>"/>
          <input type="text" name="txtAdd2" placeholder="Address line 2" value="<?php echo $add2; ?>"/>
		  <input type="text" name="txtAdd3" placeholder="Address line 3" value="<?php echo $add3; ?>"/>
          <input type="text" name="txtAdd4" placeholder="Address line 4" value="<?php echo $add4; ?>"/>
        </div>
        <div class="item">
          <p>Mobile Number<span class="required">*</span></p>
          <input type="text" name="txtMobile" required value="<?php echo $mobile; ?>"/>
        </div>
        <div class="item">
          <p>Email<span class="required">*</span></p>
          <input type="email" name="txtEmail" required value="<?php echo $email; ?>"/>
        </div>
        <div class="item">
          <p>Upload your photo<span class="required">*</span></p>
          <input type="file" name="photo" style="border: none" <?php echo $required;?> accept=".jpg,.jpeg,.png"/>
		  <img src="student_img/<?php echo $photo; ?>" width="150px"/>
        </div>
		  
        <h2>Payment Details</h2>
        <div class="item">
          <p>Payment Amount<span class="required">*</span></p>
          <input type="text" name="txtAmount" required/>
        </div>
        <div class="item">
          <p>Payment Date<span class="required">*</span></p>
          <input type="date" name="pDate" required/>
          <i class="fa fa-calendar"></i>
        </div>
		<div class="item">
          <p>Upload Payment Slip<span class="required">*</span></p>
          <input type="file" name="slip" style="border: none" required accept=".jpg,.jpeg,.png"/>
        </div>
        <div class="question">
          <div class="question-answer checkbox-item">
            <div>
              <input type="checkbox" value="none" id="check_1" name="check" required/>
              <label for="check_1" class="check"><span >I hereby declare that the information given above is true and accurate to the best of my knowledge.</span><span class="required">*</span></label>
            </div>
          </div>
        </div>
        <div class="btn-block">
          <button type="submit" href="/">Register</button>
        </div>
      </form>
    </div>
  </body>
</html>