<!DOCTYPE html>
<html>
<head>
    <title> View and Download Material </title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport" >
    <link rel="stylesheet" type="text/css" href="css/form.css">
    <link rel="stylesheet" href="css/bootstrap.css" type="text/css" />
</head>
<body>
<br/>
<div class="container">
   
    <div class="banner">
	<h1>Learning Materials</h1><br><br></div>
    <div class="row">
        <div class="col-xs-8 col-xs-offset-2">
            <table class="table table-striped table-hover" >
                <thead>
                    <tr>
                        <th>File Name</th>
                        <th>View</th>
                        <th>Download</th>
                    </tr>
                </thead>
                <tbody>
                <?php
					include('connection.php');
					$con = mysqli_connect($host,$uname,$pwd);
					mysqli_select_db($con, $db_name);
					// fetch files
					$sql = "SELECT material from learningmaterial";
					$result = mysqli_query($con, $sql);
									while($row = mysqli_fetch_array($result)) { ?>
                <tr>
                    
                    <td><?php echo $row['material']; ?></td>
                    <td><a href="material/<?php echo $row['material']; ?>" target="_blank">View</a></td>
                    <td><a href="material/<?php echo $row['material']; ?>" download>Download</td>
                </tr>
                <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
</body>
</html>