<?php
	$course="";
	$batch="";

	include "connection.php";

	if($_POST["cmbCourse"]!="")
	{
		$course=$_POST["cmbCourse"];
	}

	if($_POST["cmbBatch"]!="")
	{
		$batch=$_POST["cmbBatch"];
	}

	$con = mysqli_connect($host,$uname,$pwd);
	mysqli_select_db($con, $db_name);

	if(isset($_POST["btnPrint"]))
	{
		header("location:rpt_reg_std.php?id1=".$batch );
	}

?>
<html>
  <head>
    <title>Student List</title>
    
    <link type="text/css" rel="stylesheet" href="css/form.css">
  </head>
  <body>
    <div class="testbox">
      <form name="printIDForm" method="post" action="#">
        <div class="banner">
          <h1>Student List</h1>
        </div>
		  <br>
		
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
          <select name="cmbBatch" required onChange="submit()">
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
		
        <div class="btn-block">
          <input type="submit" name="btnPrint" value="Generate Report">
        </div>
      </form>
    </div>
  </body>
</html>