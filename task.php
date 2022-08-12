<?php include('./view/header.php'); ?>

<!DOCTYPE html>
<html>
<head>
	<link href="css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
	<link href="css/customs.css" rel="stylesheet">
</head>
<body>

<div class="container" style="width:400px; margin-top:60px;">
<div class="card">
<div class="card-body">

<ul class="nav">
  <li class="nav-item">
    <a class="nav-link active" aria-current="page" href="task.php">Schedule</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" href="report.php">Dashboard</a>
  </li>
</ul>

	<form class="form-group" action="functions.php" method="post">
		<label>Exam Scheduling</label><br><br>
	
		
		<input type="text" name="stud_number" >Student Number<br><br>
		<input type="text" name="mod_code" >Module Code<br><br>
		
		<input type="submit" value="Schedule" name="schedule" class="btn-green" > <input type="submit" value="Back To Home" name="home" class="btn-green" >
	</form>
	
</div>
</div>
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>
</html>




