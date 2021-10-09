<?php
session_start();
function usname($firstname)
{

//

$firstname=trim($firstname);

////
$len1=strlen($firstname);
 
  $p=0;
  $count=$len1;

  while ($p <= $len1)
  {
   if (substr($firstname,$count,1) != ' ')
     {
		 $text1=substr($firstname,$count,$p);
		$p++;
		$count=$count-1;
		}
 
	 else
	 	$p=$len1+1;
     }
 

$usname=strtolower($text1);
return($usname);

}

function genpass()
{
$data1 = '23456789';
$data2 = 'ABCDEFGHJKLMNPQRSTUVWXYZ';
$data3 = 'abcefghkkmnpqrstuvwxyz';
$data4 = '#$&@';

$p1=substr(strval(str_shuffle($data1)),1,4);

$p2=str_shuffle($data2);
$p2a=substr($p2, 1, 1);

$p3=str_shuffle($data3);
$p3a=substr($p3, 1, 2);

$p4=substr(str_shuffle($data4),1,1);
$p5=substr(strval(str_shuffle($data1)),1,2);

$mypass=$p2a.$p1.$p4.$p3a.$p5;
return $mypass;
}

include "connection.php";
//"javascript: return confirm('Please confirm deletion');\" href='delete.php?id=".$query2['id']."
//if(echo "<script type='text/javascript'>confirm('Are you sure you want to delete this food');</script>";)

if(isset($_SESSION["crt_type"],$_SESSION["crt_id"]))
{
	//Get session data
	$type=$_SESSION["crt_type"];
	$id=$_SESSION["crt_id"];
	
	$con = mysqli_connect($host,$uname,$pwd);
	mysqli_select_db($con, $db_name);
	
	if($type=="t")
	{
		$sql = "SELECT * FROM teacher WHERE teacherID='$id'";
		$result=mysqli_query($con,$sql) or die(mysqli_error($con));
		while($row=mysqli_fetch_array($result))
			{
				$fname=$row["fname"];
				$email=$row["fName"];
			}
		
	}
	
	else
	{
		$sql = "SELECT * FROM staff WHERE staffID=$id";
		$result=mysqli_query($con,$sql) or die(mysqli_error($con));
		while($row=mysqli_fetch_array($result))
			{
				$fname=$row["fName"];
				$email=$row["fName"];
			}
	}
	
	$u=usname($fname);
	$pw=genpass();
			
	$sql = "INSERT INTO user(username,password,type,ID) VALUES('$u', md5('$pw'),'$type','$id')";
	$result=mysqli_query($con,$sql) or die(mysqli_error($con));

	$rows=mysqli_affected_rows($con);
		if ($rows==1 and $type=="t")
		{
			echo "<script type='text/javascript'>window.location.href='add_teacher.php';</script>";
			
		}
		else if ($rows==1)
		{
			echo "<script type='text/javascript'>window.location.href='add_user.php';</script>";
			
		}
	mysqli_close($con);
}

?>