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


	<form class="form-group" action="functions.php" method="post">
		<label>Student Email</label><br>
		<input type="text" name="username" class="form-control" placeholder="enter student number"><br>		
		<label>Password</label><br>
		<input type="password" name="password" class="form-control" placeholder="enter password"><br>
		<input type="submit" value="Login" name="loginsubmit" class="btn-green" >
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




