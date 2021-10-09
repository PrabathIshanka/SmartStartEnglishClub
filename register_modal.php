<?php
$c=$_GET['c'];
include "connection.php";
$con = mysqli_connect($host,$uname,$pwd);
	mysqli_select_db($con, $db_name);
$sql = "select * from course,batch where course.courseNo=batch.courseNo and (curdate() between batch.appliFrom and batch.appliTo) and course.courseNo='$c'";
				$result=mysqli_query($con,$sql) or die(mysqli_error($con));
				$recno=mysqli_num_rows($result);
			if($recno>0){
				echo"<script>window.history.pushState({}, document.title, '/' + 'smart_start/register.php');</script>"; //to go back
				echo"<script>window.parent.location.href= 'register.php?c=$c';</script>";
				//header("location:register.php");
				//echo"<script>window.open('register.php');</script>";
				
			}	
			else
			{
				$sql = "select * from course,batch where course.courseNo=batch.courseNo and (curdate() < batch.appliFrom ) and course.courseNo='$c'";
				$result=mysqli_query($con,$sql) or die(mysqli_error($con));
				while($row=mysqli_fetch_array($result)) 
				{
					 $appliFrom=$row["appliFrom"];
				}
				$recno=mysqli_num_rows($result);
				if($recno>0)
					{
						$reg=1;
						$date=date("F d, Y", strtotime($appliFrom));
					}
				else
				{
					$reg=0;
				}
			}
			  mysqli_close($con); 
?>
<html>
<head>
<meta charset="utf-8">
<title>Untitled Document</title>
	<base target="_parent" />
<link rel="stylesheet" type="text/css" href="css/register_modal.css">
</head>

<body>
	<div class="svg-container">
    <svg viewbox="0 0 800 400" class="svg">
		<defs>
  <pattern id="img1" patternUnits="userSpaceOnUse" width="900px" height="360px">
    <image href="images/register2.jpg" x="0" y="0"  width="900px" height="360px" />
  </pattern>
</defs>
      <path id="curve" fill="url(#img1)" d="M 800 300 Q 400 350 0 300 L 0 0 L 800 0 L 800 300 Z">
      </path>
    </svg>
  </div>
<br><br><br><br><br><br><br><br><br><br><br><br><br>
<?php
	if($reg==1)
	{
		?>
	<h1>REGISTRATION NOT YET OPEN</h1><br><br>
    <h3>Registration will begin on <?php echo $date; ?></h3>
	<?php
	}
	else if($reg==0)
	{
	?>
	
	<!--<h2>REGISTRATION  FOR  NEW  BATCH  WILL  COMMENCE  SOON!</h2>-->
<h2>Registration for new batch will commence soon !</h2>
	<?php
	}
	?>
   

</body>
</html>