<?php session_start(); ?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Smart Start English Club</title>
<link rel="shortcut icon" href="images/logo2.jpg" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" type="text/css" href="css/dashboard.scss">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
function call(url){
    document.getElementById('iframe').src = url;
}
</script>
</head>

<body >
	
	<div class="container">
  <div class="nav">
    <div class="nav-header">
      <div class="nav-title">MENU</div>
		<div><a href="change_password.php" target="iframe" class="myButton">Change Password</a> <a href="index.php" class="myButton">Logout</a></div>
      
    </div>
	 
    <div class="nav-links" id="nav">
	<div class=" moderate">
		<button class="dropdown-btn nav-link dash" onclick="call('dashboard_first.php')"><i class="fa fa-dashboard"></i>&emsp;&nbsp; Dashboard </button>
	</div>
	<?php 
	if($_SESSION["utype"]=='a' or $_SESSION["utype"]=='o')
	{?>
    <div class=" moderate">
		<button class="dropdown-btn nav-link" onclick="call('confirm.php')"><i class="fa fa-check-square-o"></i>&emsp;&nbsp; Confirm Registration</button>
	</div> 
	   <div class=" moderate">
		  <button class="dropdown-btn nav-link" ><i class="fa fa-print"></i>&emsp;&nbsp; Print &emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp; &emsp;&nbsp;
			  <i class="fa fa-caret-right"></i>
		  </button>

		  <div class="dropdown-container">
			
			<a class="sub-link" href="print_id.php" target="iframe"><i class="fa fa-angle-right"> </i><label>Print Student ID</label></a>
			<a class="sub-link" href="print_certificate.php" target="iframe"><i class="fa fa-angle-right"> </i><label> Print Certificate</label></a>
		  </div>
		</div>
		<div class=" moderate">
	  <button class="dropdown-btn nav-link"><i class="fa fa-sticky-note-o"></i>&emsp;&nbsp; Report&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&nbsp;&nbsp;&nbsp;<i class="fa fa-caret-right"></i>
	  </button>
	  <div class="dropdown-container">
		<a class="sub-link" href="attendance_rpt.php" target="iframe"><i class="fa fa-angle-right"> </i><label>Attendance Report</label></a>
		<a class="sub-link" href="reg_std_rpt.php" target="iframe"><i class="fa fa-angle-right"> </i><label>Student List</label></a>
		 <a class="sub-link" href="result_sheet_rpt.php" target="iframe"><i class="fa fa-angle-right"> </i><label>Result Sheet</label></a>
		<a class="sub-link" href="course_income_rpt.php" target="iframe"><i class="fa fa-angle-right"> </i><label>Course Income Report</label></a>
	  </div>
	  </div>
	  <div class=" moderate">
	  <button class="dropdown-btn nav-link"><i class="fa fa-user"></i>&emsp;&nbsp; Student &emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&nbsp;&nbsp;
		  <i class="fa fa-caret-right"></i>
	  </button>
	  <div class="dropdown-container">
		<a class="sub-link" href="search_student.php" target="iframe"><i class="fa fa-angle-right"> </i><label> Search Student</label></a>
		<a class="sub-link" href="update_student.php" target="iframe"><i class="fa fa-angle-right"> </i><label>Update Student</label></a>
	  </div>
	  </div>
	  <?php }
	  if($_SESSION["utype"]=='c')
	{?>
	<div class=" moderate">
		<button class="dropdown-btn nav-link" onclick="call('search_student.php')"><i class="fa fa-user"></i>&emsp;&nbsp; Search Student </button>
	</div>
	<?php }
	if($_SESSION["utype"]=='a' or $_SESSION["utype"]=='c')
	{?>
	  <div class=" moderate">
	  <button class="dropdown-btn nav-link"><i class="fa fa-edit"></i>&emsp;&nbsp;Course &emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&nbsp;&nbsp;&nbsp;
		  <i class="fa fa-caret-right"></i>
	  </button>
	  <div class="dropdown-container">
		<a class="sub-link" href="add_course.php" target="iframe"><i class="fa fa-angle-right"> </i><label>Add New Course</label></a>
		<a class="sub-link" href="upd_dlt_course.php" target="iframe"><i class="fa fa-angle-right"> </i><label> Update/Delete Course</label></a>
	  </div>
	  </div>
	  <div class=" moderate">
      <button class="dropdown-btn nav-link"><i class="fa fa-user-o"></i>&emsp;&nbsp; Teacher&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&nbsp;&nbsp;
		  <i class="fa fa-caret-right"></i>
	  </button>
	  <div class="dropdown-container">
		<a class="sub-link" href="add_teacher.php" target="iframe"><i class="fa fa-angle-right"> </i><label> Add New Teacher</label></a>
		<a class="sub-link" href="upd_dlt_teacher.php" target="iframe"><i class="fa fa-angle-right"> </i><label> Update/Delete Teacher</label></a>
	  </div>
	  </div>
	  <div class=" moderate">
	  <button class="dropdown-btn nav-link"><i class="fa fa-users "></i>&emsp;&nbsp;Batch &emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
		  <i class="fa fa-caret-right"></i>
	  </button>
	  <div class="dropdown-container">
		<a class="sub-link" href="create_batch.php" target="iframe"><i class="fa fa-angle-right"> </i><label>Create Batch</label></a>
		<a class="sub-link" href="update_batch.php" target="iframe"><i class="fa fa-angle-right"> </i><label>Update Batch</label></a>
		<a class="sub-link" href="dlt_batch_acc.php" target="iframe"><i class="fa fa-angle-right"> </i><label> Delete Batch Accounts</label></a>
	  </div>
	  </div>
		<?php }
		if($_SESSION["utype"]=='a')
	{?>
	  <div class=" moderate">
	  <button class="dropdown-btn nav-link"><i class="fa fa-user-circle-o"></i>&emsp;&nbsp;System Users &emsp;&emsp;&emsp;&emsp;&nbsp;&nbsp;&nbsp;<i class="fa fa-caret-right"></i>
	  </button>
	  <div class="dropdown-container">
		<a class="sub-link" href="add_user.php" target="iframe"><i class="fa fa-angle-right"> </i><label>Add Users</label></a>
		<a class="sub-link" href="upd_dlt_user.php" target="iframe"><i class="fa fa-angle-right"> </i><label> Update/Delete Users</label></a>
	  </div>
	  </div> <?php } 
		if($_SESSION["utype"]=='a' or $_SESSION["utype"]=='t') {?>
	<div class=" moderate">
		<button class="dropdown-btn nav-link" onclick="call('Upload_lm.php')"><i class="fa fa-cloud-upload"></i>&emsp;&nbsp;Upload Learning Material</button>
	</div>  
     <div class=" moderate">
		<button class="dropdown-btn nav-link" onclick="call('add_result.php')"><i class="fa fa-plus-square"></i>&emsp;&nbsp; Add Exam Result</button>
	</div>
	<div class=" moderate">
		<button class="dropdown-btn nav-link" onclick="call('take_attendance.php')"><i class="fa fa-qrcode"></i>&emsp;&nbsp; Record Attendance</button>
	</div>
	<?php }
		if($_SESSION["utype"]=='a' or $_SESSION["utype"]=='t' or $_SESSION["utype"]=='c')
	{?>
	<div class=" moderate">
		<button class="dropdown-btn nav-link" onclick="call('email.php')"><i class="fa fa-envelope-o"></i>&emsp;&nbsp; Email</button>
	</div>
	 
	<?php }
		if($_SESSION["utype"]=='s')
	{?>
	<div class=" moderate">
		<button class="dropdown-btn nav-link" onclick="call('view_lm.php')"><i class="fa fa-file-pdf-o"></i>&emsp;&nbsp; Learning Material</button>
	</div>
	
	<div class=" moderate">
		<button class="dropdown-btn nav-link" onclick="call('view_result.php')"><i class="fa fa-clone"></i>&emsp;&nbsp; Exam Results</button>
	</div>
	<div class=" moderate">
		<button class="dropdown-btn nav-link" onclick="call('view_attendance.php')"><i class="fa fa-calendar-check-o"></i>&emsp;&nbsp; Attendance</button>
	</div>
     <?php } ?>
    </div>
    <div class="nav-images" >
		<iframe name="iframe" id="iframe" src="dashboard_first.php" width="100%" ></iframe>
      
    </div>
  </div>
</div>


<script>
$(document).ready(function() {
    $('.dash').toggleClass('nav-click');
});
	
$('.dropdown-btn ').on('click', (event) => {
  $(event.target).siblings('.dropdown-container')
    .toggleClass('is-open');
	 $(event.target).toggleClass('nav-click');
	//$(event.target).siblings('.nav-link').style.backgroundColor = "red";	
});

$(document).click(function(e) {
  $('.moderate')
    .not($('.moderate').has($(e.target)))
    .children('.dropdown-container')
    .removeClass('is-open');
	
	$('.moderate')
    .not($('.moderate').has($(e.target))).children('.dropdown-btn').removeClass('nav-click');
		
	//$('.dropdown-container').removeClass('subnav-click');
	//$('.nav-link').removeClass('nav-click');
});

	
$(document).on('mousedown',function(e) {
    if (!$(e.target).hasClass('.sub-link')) {
        $('label').removeClass('subnav-click');
		$('i').removeClass('subnav-click');
    } else {
    }
});	
	
$('.sub-link').on('mouseup', (event) => {
	 $(event.target).toggleClass('subnav-click');
	$(event.target).siblings('i')
    .toggleClass('subnav-click');
});

/*
$('.nav-link').on('click', (event) => {
	 $(event.target).toggleClass('nav-click');
});
/*
$(document).click(function(e) {
	$('.moderate')
    .not($('.moderate').has($(e.target))).children('.dropdown-btn').removeClass('subnav-click');
});
	
	//* Loop through all dropdown buttons to toggle between hiding and showing its dropdown content - This allows the user to have multiple dropdowns without any conflict */
	
/*var dropdown = document.getElementsByClassName("dropdown-btn");
var i;

for (i = 0; i < dropdown.length; i++) {
  dropdown[i].addEventListener("click", function() {
    this.classList.toggle("active"); 
    var dropdownContent = this.nextElementSibling;
    if (dropdownContent.style.display === "block") {
      alert("ss");
    } else {
      //dropdownContent.style.display = "block";
    }/*
	 dropdown.splice(i, 1);
	var x;

	for (x = 0; i < dropdown.length; x++) {
	  this.classList.toggle("active");
		var dropdownContent = this.nextElementSibling;
		dropdownContent.style.display = "none";
		
	}
  });
//var colors = ["red","blue","car","green"];
//var carIndex = dropdown.indexOf("car");//get  "car" index
//remove car from the colors array

}*/
	
</script>
</body>
</html>