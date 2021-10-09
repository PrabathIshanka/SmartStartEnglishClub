<?php
echo "<script>
 var thank = new Audio('audio/thank.mp3');
 var try = new Audio('audio/try.mp3');
</script>";

include "connection.php";
$flag=0;
$stop="";
$stdno=$_POST["txtSno"];
	
	if(isset($_POST["btnStop"]))
	{
		$flag=1;
		$stop="display: none;";
		$stdno="";
	}
	
	$con = mysqli_connect($host,$uname,$pwd);
	mysqli_select_db($con, $db_name);

if(isset($_POST["txtSno"]))
{
	$sql="SELECT * FROM studentbatch WHERE studentNo = '$stdno'";
	$result=mysqli_query($con,$sql) or die(mysqli_error($con));
	$recno=mysqli_num_rows($result);
	
	if($recno==0 and $stdno!="")
	{
		echo "<script> var myAudio = new Audio('audio/try.mp3');
		myAudio.play(); </script>";
		$stdno="";
	}
	else if( $stdno!="")
	{
		date_default_timezone_set('Asia/Colombo');
		$date= date('Y-m-d');
		
		$sql="SELECT * FROM studentbatch WHERE studentNo = '$stdno'";
			$result=mysqli_query($con,$sql) or die(mysqli_error($con));
			$recno=mysqli_num_rows($result);
			while($row=mysqli_fetch_array($result))
			{
				$nic=$row['nic'];
				$batch=$row['batchCode'];
			}
		
		$sql="SELECT * FROM attendance WHERE nic = '$nic' and batchCode='$batch' and date='$date'";
		$result=mysqli_query($con,$sql) or die(mysqli_error($con));
		$recno=mysqli_num_rows($result);
		
		if($recno==0)
		{
			$sql = "INSERT INTO attendance(nic,batchCode,date) VALUES('$nic', '$batch','$date')";
			$result=mysqli_query($con,$sql) or die(mysqli_error($con));
			$rows=mysqli_affected_rows($con);
			
			if($rows>0)
			{
				echo "<script> var myAudio = new Audio('audio/thank.mp3');
				myAudio.play(); </script>";
				$stdno="";
			}
			else{
				echo "<script> var myAudio = new Audio('audio/try.mp3');
				myAudio.play(); </script>";
				$stdno="";
			}
			
		}
		
		else
		{
			echo "<script> var myAudio = new Audio('audio/thank.mp3');
			myAudio.play(); </script>";
			$stdno="";
		}
			
	}
	
}
?>
<html>

<head>

	<title>Attendance</title>
	
	<link type="text/css" rel="stylesheet" href="css/qr.css">
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<script src="https://rawgit.com/schmich/instascan-builds/master/instascan.min.js"></script>
	
</head>

<body>
	  <div class="main-block">
      <div class="block-item left">
        <h1>Record Attendance</h1>
        <p>Scan QR Code here
        </p><br>
		  <video id="preview" width="400px" height="300px"></video>
<?php if($flag==0) { ?>
		  
    <script type="text/javascript">
		
      let scanner = new Instascan.Scanner({ video: document.getElementById('preview'),refractoryPeriod: 1000 });

      scanner.addListener('scan', function (content) {
		 document.getElementById("txtSno").value = content;
		 window.setTimeout(function() { document.atdForm.submit(); }, 100);
			
      });

      Instascan.Camera.getCameras().then(function (cameras) {

		 /* $('[name="btnScan"]').on('click',function(){
                 scanner.start(cameras[0]);
			  	document.getElementById("btnScan").style.visibility="hidden";
			  document.getElementById("btnStop").style.visibility="visible";
            });
		  $('[name="btnStop"]').on('click',function(){
                scanner.stop();
			  	document.getElementById("btnScan").style.visibility="visible";
			  document.getElementById("btnStop").style.visibility="hidden";
			  document.getElementById("txtSno").value = "";
            });*/
		  
        if (cameras.length > 0) {

          scanner.start(cameras[0]);
		 /* document.getElementById("btnScan").style.visibility="hidden";
		  document.getElementById("btnStop").style.visibility="visible";*/
		 
        } else {

          console.error('No cameras found.');

        }

      }).catch(function (e) {

        console.error(e);

      });
    </script> <?php } ?>
      </div>
      <div class="block-item right">
		  <form name="atdForm" method="post" action="#">
		  <p>Student No</p>
		  <input type="text" ID="txtSno" name="txtSno" readonly onInput="submit()" value="<?php echo $stdno; ?>"/>
		  		  
		<div class="container">
		  <div class="search">
			  <input type="submit" class="btn facebook" id='btnScan' name='btnScan' value="Scan QR Code"/>
				<input type="submit" class="btn twitter stop" id='btnStop' name='btnStop' value="Stop Camera" style="<?php echo $stop; ?>"/>
		  </div>
		</div>
			
		  </form>  
      </div>
    </div>
		
		
       
</body>

</html>