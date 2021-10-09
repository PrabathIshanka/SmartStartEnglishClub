<?php
$course="";
$batch="";

include "connection.php";

if($_POST["cmbCourse"]!="")
{
	$course=$_POST["cmbCourse"];
}

if($_POST["batchCode"]!="")
{
	$batch=$_POST["batchCode"];
}


if (isset($_POST['Upload']))
{
/*
$batchCode=$_POST['batchCode'];
$material_name=$_FILES['material']['name'];
$material_type=$_FILES['material']['type'];
$material_size=$_FILES['material']['size'];
$material_tem_loc=$_FILES['material']['tem_name'];
$material_store="uploads/".$material_name;
move_uploaded_file($material_tem_loc, $material_store);}*/

{   
		
	$img = $_FILES["material"]["name"];
		$ext = end((explode('.',$img)));
		$name= basename($img,$ext);
		$material = $name.$batch.".".$ext;
		$src = $_FILES['material']['tmp_name'];
		$dst = "material/".$material;
		$upload = move_uploaded_file($src, $dst);
	
	   /* $material=$_FILES["file"];
		$img = $_FILES["material"]["name"];
		$ext = end((explode('.',$img))); //extra () to avoid error
		$material = $batchCode.".".$ext;
		$src = $_FILES['material']['tmp_name'];
		$dst = "material/".$material;
		$upload = move_uploaded_file($src, $dst);*/

		if($upload==false)
		{
			echo "<script type='text/javascript'>alert('File was not uploaded');</script>";
		}
			


}

$con=mysqli_connect($host,$uname,$pwd);
 mysqli_select_db($con,$db_name);
 $sql ="INSERT INTO learningmaterial (batchCode,material) VALUES('$batch','$material')";
$result=mysqli_query($con,$sql);
	if (mysqli_errno($con) == 1062) {
		
    	echo "<script type='text/javascript'>alert('File already exists');</script>";
	}
	$rows=mysqli_affected_rows($con);
if($rows>0)
	{
		echo"<script>alert('Uploaded successfully');</script>"; 

	}
	
 
}
?>


<!DOCTYPE html>
<html>
<head>
	<title>Upload Learning Material</title>
	<link rel="stylesheet" type="text/css" href="css/form.css"/>
	
</head>
<body>
	<div class="testbox">
	<form name="form1" method="post" action="#" enctype="multipart/form-data" >
		 <div class="banner">
<h1> Upload Learning Material</h1><br></div>
<div class="item">
          <p>Course</p>
          <select name="cmbCourse" required onChange="submit()">
              <option selected value="<?php echo $course;?>"><?php echo $course;?></option>
              <?php
				$con = mysqli_connect($host,$uname,$pwd);
				mysqli_select_db($con, $db_name);
				$sql = "select name from course order by name";
				$result=mysqli_query($con,$sql) or die(mysqli_error($con));
				while($row=mysqli_fetch_array($result))
					{
						echo "<option value='". $row['name'] ."'>" .$row['name'] ."</option>";
					}
			  mysqli_close($con);
			?> 
            </select>
        </div>
		<div class="item">
          <p>Batch</p>
          <select name="batchCode" required onChange="submit()">
              <option selected value="<?php echo $batch;?>"><?php echo $batch;?></option>
              
			  <?php
				$con = mysqli_connect($host,$uname,$pwd);
				mysqli_select_db($con, $db_name);
				$sql = "select batch.batchCode from batch,course where course.courseNo=batch.courseNo and course.name='$course' order by batch.batchCode desc limit 3";
				$result=mysqli_query($con,$sql) or die(mysqli_error($con));
				while($row=mysqli_fetch_array($result))
					{
						echo "<option value='". $row['batchCode'] ."'>" .$row['batchCode'] ."</option>";
					}
			  mysqli_close($con);
			?> 
            </select>
        </div>

<div class="item">
          <p>Upload Learning Material</p>
          <input type="file" name="material" style="border: none" required/>
        </div><br>

<div class="btn-block">
<input type="Submit" value="Upload" name="Upload"  ></div>

</form>
</div>
</body>
</html>