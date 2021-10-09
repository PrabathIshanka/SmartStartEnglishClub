<?php
	session_start();
	include "connection.php";
	$flag=0;
	$flag=$_POST["hdflag"];
	$hdexam="";
	$hdexam=$_POST["hdexam"];
	$hdcourse="";
	$hdcourse=$_POST["hdcourse"];
	$hdbatch="";
	$hdbatch=$_POST["hdbatch"];
	$course=$_POST["cmbCourse"];
	$batch=$_POST["cmbBatch"];
	$exam=$_POST["rbExam"];
	$fmark=$_POST["txtMark"]; //final mark to table
	$stdno=$_POST["txtSno"];
	$ab=$_POST["cbAbsent"];

	if($exam=='m')
		$mid="checked";
	else
		$mid="";
	if($exam=='e')
		$end="checked";
	else
		$end="";
	if($ab=='Y')
		$abcheck="checked";
		
	$con = mysqli_connect($host,$uname,$pwd);
	mysqli_select_db($con, $db_name);
	
	if($hdcourse!=$course and $hdcourse!="")
	{
		$hdcourse=$course;
		$batch="";
		$mid="";
		$end="";
		$stdno="";
	}

	if($hdbatch!=$batch and $hdbatch!="")
	{
		$hdbatch=$batch;
		$mid="";
		$end="";
		$stdno="";
	}

	if($ab=="Y")
	{
		$mark=0;
	}
	else
	{
		$sql="SELECT * FROM result RIGHT OUTER JOIN studentbatch ON result.nic = studentbatch.nic and result.batchCode=studentbatch.batchCode WHERE studentbatch.studentNo != '' and studentbatch.studentNo = '$stdno'  ";
		$result=mysqli_query($con,$sql) or die(mysqli_error($con));

		while($row=mysqli_fetch_array($result))
		{
			$nic=$row['nic'];
			$midm=$row['mid'];
			$endm=$row['end'];
		}
		if($exam=='m')
			$mark=$midm; //to txt box
		else if($exam=='e')
			$mark=$endm;
	}

	if(($hdexam!=$exam and $hdexam!="") or ($hdcourse!=$course and $hdcourse!="") or ($hdbatch!=$batch and $hdbatch!=""))
	{
		$hdexam=$exam;
		$hdcourse=$course;
		$hdbatch=$batch;
		$abcheck="";
		$sql="SELECT * FROM result RIGHT OUTER JOIN studentbatch ON result.nic = studentbatch.nic and result.batchCode=studentbatch.batchCode WHERE studentbatch.studentNo != '' and studentbatch.studentNo = '$stdno'  ";
		$result=mysqli_query($con,$sql) or die(mysqli_error($con));

		while($row=mysqli_fetch_array($result))
		{
			$nic=$row['nic'];
			$midm=$row['mid'];
			$endm=$row['end'];
		}
		if($exam=='m')
			$mark=$midm; //to txt box
		else if($exam=='e')
			$mark=$endm;
	}

	if($_POST["cmbCourse"]!="" and $_POST["cmbBatch"]!="" and $_POST["rbExam"]!="" and $flag==0)
	{
		$hdexam=$exam;
		$hdcourse=$course;
		$hdbatch=$batch;
		$flag=1;
		$sql="SELECT * FROM result RIGHT OUTER JOIN studentbatch ON result.nic = studentbatch.nic and result.batchCode=studentbatch.batchCode WHERE studentbatch.studentNo != '' and studentbatch.studentNo != '' and studentbatch.batchCode = '$batch' ORDER BY studentbatch.studentNo LIMIT 1 ";
		$result=mysqli_query($con,$sql) or die(mysqli_error($con));

		while($row=mysqli_fetch_array($result))
		{
			$nic=$row['nic'];
			$stdno=$row['studentNo'];
			$midm=$row['mid'];
			$endm=$row['end'];
		}
		if($exam=='m')
			$mark=$midm; //to txt box
		else if($exam=='e')
			$mark=$endm;
	}

	if(isset($_POST["btnSave"]))
	{
		$sql="SELECT * FROM result INNER JOIN studentbatch ON result.nic = studentbatch.nic and result.batchCode=studentbatch.batchCode WHERE studentbatch.studentNo != '' and studentbatch.studentNo = '$stdno' ";
		$result=mysqli_query($con,$sql) or die(mysqli_error($con));
		$recno=mysqli_num_rows($result);
		//$mark=$fmark;
		while($row=mysqli_fetch_array($result))
		{
			$nic=$row['nic'];
		}
		
		if($recno>0)
		{
			if($exam=='m')
			{
				$sql = "UPDATE result SET mid='$fmark',abMid='$ab' WHERE nic='$nic' and batchCode='$batch'";
				$result=mysqli_query($con,$sql) or die(mysqli_error($con));
			}
			else if($exam=='e')
			{
				$sql = "UPDATE result SET end='$fmark',abEnd='$ab' WHERE nic='$nic' and batchCode='$batch'";
				$result=mysqli_query($con,$sql) or die(mysqli_error($con));
			}
			
		}
		
		else
		{
			$sql="SELECT * FROM result RIGHT OUTER JOIN studentbatch ON result.nic = studentbatch.nic and result.batchCode=studentbatch.batchCode WHERE studentbatch.studentNo != '' and studentbatch.studentNo = '$stdno' ";
			$result=mysqli_query($con,$sql) or die(mysqli_error($con));
			$recno=mysqli_num_rows($result);
			//$mark=$fmark;
			while($row=mysqli_fetch_array($result))
			{
				$nic=$row['nic'];
			}
			
			if($exam=='m')
			{
				$sql = "INSERT INTO result(nic,batchCode,mid,abMid) VALUES('$nic', '$batch','$fmark','$ab')";
				$result=mysqli_query($con,$sql) or die(mysqli_error($con));
			}
			else if($exam=='e')
			{
				$sql = "INSERT INTO result(nic,batchCode,end,abEnd) VALUES('$nic', '$batch','$fmark','$ab')";
				$result=mysqli_query($con,$sql) or die(mysqli_error($con));
			}
			
		}
		
		$sql="SELECT * FROM result RIGHT OUTER JOIN studentbatch ON result.nic = studentbatch.nic and result.batchCode=studentbatch.batchCode WHERE studentbatch.studentNo != '' and studentbatch.batchCode = '$batch' and studentbatch.studentNo> '$stdno' ORDER BY studentbatch.studentNo LIMIT 1 ";
		$result=mysqli_query($con,$sql) or die(mysqli_error($con));
		$recno=mysqli_num_rows($result);
		
		while($row=mysqli_fetch_array($result))
		{
			$nic=$row['nic'];
			$stdno=$row['studentNo'];
			$midm=$row['mid'];
			$endm=$row['end'];
		}
		if($exam=='m')
			$mark=$midm; //to txt box
		else if($exam=='e')
			$mark=$endm;
		
		if($recno==0)
			$mark=$fmark;
		
	}

	if(isset($_POST["btnNext"]))
	{
			
		$sql="SELECT * FROM result RIGHT OUTER JOIN studentbatch ON result.nic = studentbatch.nic and result.batchCode=studentbatch.batchCode WHERE studentbatch.studentNo != '' and studentbatch.batchCode = '$batch' and studentbatch.studentNo> '$stdno' ORDER BY studentbatch.studentNo LIMIT 1 ";
		$result=mysqli_query($con,$sql) or die(mysqli_error($con));
		$recno=mysqli_num_rows($result);
		
		while($row=mysqli_fetch_array($result))
		{
			$nic=$row['nic'];
			$stdno=$row['studentNo'];
			$midm=$row['mid'];
			$endm=$row['end'];
		}
		if($exam=='m')
			$mark=$midm; //to txt box
		else if($exam=='e')
			$mark=$endm;
		
		if($recno==0)
			$mark=$fmark;
		
	}

	if(isset($_POST["btnPrevious"]))
	{
		$sql="SELECT * FROM result RIGHT OUTER JOIN studentbatch ON result.nic = studentbatch.nic and result.batchCode=studentbatch.batchCode WHERE studentbatch.studentNo != '' and studentbatch.batchCode = '$batch' and studentbatch.studentNo< '$stdno' ORDER BY studentbatch.studentNo desc LIMIT 1 ";
		$result=mysqli_query($con,$sql) or die(mysqli_error($con));
		$recno=mysqli_num_rows($result);
		
		while($row=mysqli_fetch_array($result))
		{
			$nic=$row['nic'];
			$stdno=$row['studentNo'];
			$midm=$row['mid'];
			$endm=$row['end'];
		}
		if($exam=='m')
			$mark=$midm; //to txt box
		else if($exam=='e')
			$mark=$endm;
		
		if($recno==0)
			$mark=$fmark;
		
	}

?>
<html>
  <head>
    <title>Add Exam Results</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link type="text/css" rel="stylesheet" href="css/form.css">
  </head>
  <body>
    <div class="testbox">
      <form name="addResultForm" method="post" action="#" >
        <div class="banner">
          <h1>Add Exam Results</h1>
		  	<input type="hidden" name="hdflag" value="<?php echo $flag;?>"/>
			<input type="hidden" name="hdexam" value="<?php echo $hdexam;?>"/>
			<input type="hidden" name="hdcourse" value="<?php echo $hdcourse;?>"/>
			<input type="hidden" name="hdbatch" value="<?php echo $hdbatch;?>"/>
        </div>
		
		<div class="item">
          <p>Course</p>
          <select name="cmbCourse" required onChange="submit()">
              <option selected value="<?php echo $course;?>"><?php echo $course;?></option>
              <?php
			  	$u=$_SESSION["usname"];
			  	$type=$_SESSION["utype"];
				$con = mysqli_connect($host,$uname,$pwd);
				mysqli_select_db($con, $db_name);
			  	if($type=='t')
				{
					$sql = "SELECT DISTINCT name FROM course,batch,user where course.courseNo=batch.courseNo and batch.teacherID=user.ID and user.username='$u'";
					$result=mysqli_query($con,$sql) or die(mysqli_error($con));
					while($row=mysqli_fetch_array($result))
						{
							echo "<option value='". $row['name'] ."'>" .$row['name'] ."</option>";
						}
				}
			   else{
				    $sql = "select name from course order by name";
					$result=mysqli_query($con,$sql) or die(mysqli_error($con));
					while($row=mysqli_fetch_array($result))
						{
							echo "<option value='". $row['name'] ."'>" .$row['name'] ."</option>";
						}
			   }
				
			  mysqli_close($con);
			?> 
            </select>
        </div>
		<div class="item">
          <p>Batch</p>
          <select name="cmbBatch" required onChange="submit()" >
              <option selected value="<?php echo $batch;?>"><?php echo $batch;?></option>
              
			  <?php
				$con = mysqli_connect($host,$uname,$pwd);
				mysqli_select_db($con, $db_name);
				$sql = "select batch.batchCode from batch,course where course.courseNo=batch.courseNo and course.name='$course' order by batch.batchCode desc ";
				$result=mysqli_query($con,$sql) or die(mysqli_error($con));
			  	$recno=mysqli_num_rows($result);
				while($row=mysqli_fetch_array($result))
					{
						echo "<option value='". $row['batchCode'] ."'>" .$row['batchCode'] ."</option>";
					}
			  	if($recno==0)
					echo "<option value=''></option>";
			  mysqli_close($con);
			?> 
            </select>
        </div>
		  
        <div class="question">
        <p>Exam</p>
        <div class="question-answer">
          <input type="radio" value="m" id="radio_1" name="rbExam" required <?php echo $mid; ?> onChange="submit()"/>
          <label for="radio_1" class="radio"><span>Mid Exam</span></label>
          <input type="radio" value="e" id="radio_2" name="rbExam" required <?php echo $end; ?> onChange="submit()"/>
          <label for="radio_2" class="radio"><span>End Exam</span></label>
        </div>
      </div>
		  
		<div class="item">
          <p>Student No</p>
          <div class="item">
            <input type="text" name="txtSno" readonly value="<?php echo $stdno;?>"/>
          </div>
        </div>
				
		<div class="item">
          <p>Exam Marks</p>
          <div class="name-item">
            <input type="number" name="txtMark"  value="<?php echo $mark;?>" min="0" max="100"/>
			<div class="question">
			  <div class="question-answer checkbox-item">
				<div>
				  <input type="checkbox" value="Y" id="check_1" name="cbAbsent"  onChange="submit()" <?php echo $abcheck; ?>/>
				  <label for="check_1" class="check"><span >Absent</span></label>
				</div>
			  </div>
			</div>
            </div>
          </div>
        </div>
		  
        <div class="btn-block">
          <input type="submit" value="Save" name="btnSave">
		  <input type="submit" name="btnPrevious" value="<< Previous" style="margin-left: 20px">
		  <input type="submit" name="btnNext" value="Next >>" style="margin-left: 20px">
        </div>
      </form>
    </div>
  </body>
</html>