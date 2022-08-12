<?php include('view/header.php'); 

if(!isset($_SESSION)) 
{ 
    session_start(); 
}  
?>

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
<h3>Online Exam Portal</h3><br><br>
	<form class="form-group" action="functions.php" method="post">
		
	
	<p style="color:maroon">You have successfully submitted your exam!!!!!!.</p><br><br>
	
	<?php echo 'Submitted On:' . ' ' . date('Y/m/d') . ' ' . 'at' . ' ' . date('h:i:sa') ;?> <br><br>
		<input type="submit" value="Back To Home" name="home" class="btn-green" >
		
	</form>
</div>
</div>
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>
</html>