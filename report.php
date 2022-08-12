<?php include("view/header.php"); ?>
<!DOCTYPE html>
<html>
<head>
	<link href="css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
	
</head>
<body>

<div class="container" style="width:900px; margin-top:0px;">
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
	
</div>
</div>
</div>

</body>
</html>
<main role="main" class="col-md-9 ml-sm-auto col-lg-10 pt-3 px-4">
    <div style="position: absolute; left: 0px; top: 0px; right: 0px; bottom: 0px; overflow: hidden; pointer-events: none; visibility: hidden; z-index: -1;" class="chartjs-size-monitor">
        <div class="chartjs-size-monitor-expand" style="position:absolute;left:0;top:0;right:0;bottom:0;overflow:hidden;pointer-events:none;visibility:hidden;z-index:-1;">
            <div style="position:absolute;width:1000000px;height:1000000px;left:0;top:0"></div>
        </div>
        <div class="chartjs-size-monitor-shrink" style="position:absolute;left:0;top:0;right:0;bottom:0;overflow:hidden;pointer-events:none;visibility:hidden;z-index:-1;">
            <div style="position:absolute;width:200%;height:200%;left:0; top:0"></div>
        </div>
    </div>
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-3 border-bottom">
        <h1 class="h2">Online Exam Portal \ MIS Report</h1>

    </div>


   <div class="card-header">
				<i class="fas fa-table"></i>
				Exception Report</div>
	<h4 class="my-4 card-title">List showing submissions made in months</h4>
    <div class="table-responsive">
	
<?php 
//connect to the database
 include('database.php');
  ///function for the summary report 
 function exceptionReport(){
	 global $db;
	 $query = 'SELECT
				COUNT(extract(month FROM Exam_Date)) "NUMBER OF MODULES SUBMITTED",
				monthname(Exam_Date) "MONTH"
				FROM exam
				GROUP BY MONTH
				ORDER BY extract(month FROM Exam_Date);';
	$result = $db->query($query);
	return $result;
 
 }
 ?>
				
<?php $sumary = exceptionReport(); ?>

        <table class="table table-striped table-sm">
            <thead>
                <tr>
					<th>Number of Modules Submitted </th>
					<th>Month </th>
				</tr>
            </thead>
            <tbody>
                <?php if($sumary->rowCount() > 0){ ?>
				<?php foreach($sumary as $sum){ ?>
					<tr>
						<td><?php echo $sum["NUMBER OF MODULES SUBMITTED"] ?></td>
						<td><?php echo $sum["MONTH"] ?></td>
					</tr>
				<?php } ?>
				<?php }else{ ?>
					<tr>
						<td colspan="2"> no data found</td>
					</tr>
				<?php } ?>
			</tbody>
        </table>
    </div>
	<br><br>
	<br><br>

    <hr>

    <div class="card-header">
		<i class="fas fa-table"></i>Summary Report - Student submissions</div>
	<h4 class="my-4 card-title">Report showing summary of submitted module “ICT3715” on the date: 15th of February 2021.</h4>
    <div class="table-responsive">
	
	 <?php 
	include('database.php');
 
	///function for the summary report
	function summaryReport1(){
	 global $db;
	 $query = 'SELECT 
				exam.Mod_Code "MODULE CODE", student.Stud_Number "STUDENT NUMBER", 
				CONCAT(student.Stud_FirstName, " ", student.Stud_LastName) "STUDENT", 
				CONCAT(exam.Start_Time, " ", "TO", " ", exam.Completion_Time) "DURATION", 
				exam.Exam_Date "DATE" 
				FROM 
				exam, student 
				WHERE 
				Mod_Code = "ICT3715" AND Exam_Date = "2021-02-15"
				AND 
				student.Stud_Number = exam.Stud_Number 
				ORDER BY exam.Exam_Date ASC;';
 
	$result = $db->query($query);
	return $result;
	}
	?>
	<?php $sumary = summaryReport1(); ?>
        <table class="table table-striped table-sm">
            <thead>
               <tr>
					<th>Module code </th>
					<th>Student Number </th>
					<th>Student </th>
					<th>DURATION</th>
					<th>Date </th>
				</tr>
            </thead>
            <tbody>
    <?php if($sumary->rowCount() > 0){ ?>
	<?php foreach($sumary as $sum){ ?>
			<tr>
				<td><?php echo $sum["MODULE CODE"] ?></td>
				<td><?php echo $sum["STUDENT NUMBER"] ?></td>
				<td><?php echo $sum["STUDENT"] ?></td>
				<td><?php echo $sum["DURATION"] ?></td>
				<td><?php echo $sum["DATE"] ?></td>
			</tr>
	<?php } ?>
	<?php }else{ ?>
			<tr>
				<td colspan="5"> no data found</td>
			</tr>
						
	<?php } ?>
            </tbody>
        </table>
    </div>
	<br><br>
	<br><br>

    <hr>

   <div class="card-header">
		<i class="fas fa-table"></i>Trend Report</div>
	<h4 class="my-4 card-title">Report showing number of submissions or upload times that occurred in the morning between 07am and 12pm.</h4>
    <div class="table-responsive">
	<?php 
	include('database.php');
 
  ///function for the trend report
 function trendReport(){
	 global $db;
	 $query = 'SELECT
				exam.Start_Time "UPLOAD TIME", exam.Mod_Code "MODULE CODE", COUNT(exam.Start_Time) 
				"NUMBER OF UPLOAD TIME", COUNT(exam.Mod_Code) "NUMBER OF MODULE CODES", student.Stud_Email "STUDENT EMAIL"
				FROM
				exam, student
				WHERE
				Start_Time BETWEEN "07:00:00" AND "12:00:00"
				AND
				exam.Stud_Number = student.Stud_Number
				AND
				exam.Mod_Code <> "-99"
				GROUP BY Start_Time;';
 
	$result = $db->query($query);
	return $result; 
 }
 ?>
				
	<?php $sumary = trendReport(); ?>
        <table class="table table-striped table-sm">
            <thead>
                <tr>
					<th>Upload Time</th>
					<th>Module Code</th>
					<th>Number of Upload Time</th>
					<th>Number of Module Codes</th>
					<th>Student Email</th>
				</tr>
            </thead>
            <tbody>
    <?php if($sumary->rowCount() > 0){ ?>
	<?php foreach($sumary as $sum){ ?>
				<tr>
					<td><?php echo $sum["UPLOAD TIME"] ?></td>
					<td><?php echo $sum["MODULE CODE"] ?></td>
					<td><?php echo $sum["NUMBER OF UPLOAD TIME"] ?></td>
					<td><?php echo $sum["NUMBER OF MODULE CODES"] ?></td>
					<td><?php echo $sum["STUDENT EMAIL"] ?></td>
				</tr>
	<?php } ?>
	<?php }else{ ?>
				<tr>
					<td colspan="5"> no data found</td>
				</tr>
						
	<?php } ?>
			</tbody>
        </table>
    </div>
	<br><br>
	<br><br>


    <hr>
	
	  <div class="card-header">
		<i class="fas fa-table"></i>Trend Report 2</div>
	<h4 class="my-4 card-title">Report showing number of submissions or upload times that occurred in the afternoon between 13pm and 17pm.</h4>
    <div class="table-responsive">
	<?php 
	include('database.php');
 
  ///function for the trend report 2
 function trendReport1(){
	 global $db;
	 $query = 'SELECT
				exam.Start_Time "UPLOAD TIME", exam.Mod_Code "MODULE CODE", COUNT(exam.Start_Time) 
				"NUMBER OF UPLOAD TIME", COUNT(exam.Mod_Code) "NUMBER OF MODULE CODES", student.Stud_Email "STUDENT EMAIL"
				FROM
				exam, student
				WHERE
				Start_Time BETWEEN "13:00:00" AND "17:00:00"
				AND
				exam.Stud_Number = student.Stud_Number
				AND
				exam.Mod_Code <> "-99"
				GROUP BY Start_Time;';
 
	$result = $db->query($query);
	return $result; 
 }
 ?>
				
	<?php $sumary = trendReport1(); ?>
        <table class="table table-striped table-sm">
            <thead>
                <tr>
					<th>Upload Time</th>
					<th>Module Code</th>
					<th>Number of Upload Time</th>
					<th>Number of Module Codes</th>
					<th>Student Email</th>
				</tr>
            </thead>
            <tbody>
    <?php if($sumary->rowCount() > 0){ ?>
	<?php foreach($sumary as $sum){ ?>
				<tr>
					<td><?php echo $sum["UPLOAD TIME"] ?></td>
					<td><?php echo $sum["MODULE CODE"] ?></td>
					<td><?php echo $sum["NUMBER OF UPLOAD TIME"] ?></td>
					<td><?php echo $sum["NUMBER OF MODULE CODES"] ?></td>
					<td><?php echo $sum["STUDENT EMAIL"] ?></td>
				</tr>
	<?php } ?>
	<?php }else{ ?>
				<tr>
					<td colspan="5"> no data found</td>
				</tr>
						
	<?php } ?>
			</tbody>
        </table>
    </div>
	<br><br>
	<br><br>


    <hr>
	
	 <div class="card-header">
		<i class="fas fa-table"></i>Trend Report 3</div>
	<h4 class="my-4 card-title">Report showing number of submissions or upload times that occurred in the evening between 18pm and 22pm.</h4>
    <div class="table-responsive">
	<?php 
	include('database.php');
 
  ///function for the trend report 3
 function trendReport2(){
	 global $db;
	 $query = 'SELECT
				exam.Start_Time "UPLOAD TIME", exam.Mod_Code "MODULE CODE", COUNT(exam.Start_Time) 
				"NUMBER OF UPLOAD TIME", COUNT(exam.Mod_Code) "NUMBER OF MODULE CODES", student.Stud_Email "STUDENT EMAIL"
				FROM
				exam, student
				WHERE
				Start_Time BETWEEN "18:00:00" AND "22:00:00"
				AND
				exam.Stud_Number = student.Stud_Number
				AND
				exam.Mod_Code <> "-99"
				GROUP BY Start_Time;';
 
	$result = $db->query($query);
	return $result; 
 }
 ?>
				
	<?php $sumary = trendReport2(); ?>
        <table class="table table-striped table-sm">
            <thead>
                <tr>
					<th>Upload Time</th>
					<th>Module Code</th>
					<th>Number of Upload Time</th>
					<th>Number of Module Codes</th>
					<th>Student Email</th>
				</tr>
            </thead>
            <tbody>
    <?php if($sumary->rowCount() > 0){ ?>
	<?php foreach($sumary as $sum){ ?>
				<tr>
					<td><?php echo $sum["UPLOAD TIME"] ?></td>
					<td><?php echo $sum["MODULE CODE"] ?></td>
					<td><?php echo $sum["NUMBER OF UPLOAD TIME"] ?></td>
					<td><?php echo $sum["NUMBER OF MODULE CODES"] ?></td>
					<td><?php echo $sum["STUDENT EMAIL"] ?></td>
				</tr>
	<?php } ?>
	<?php }else{ ?>
				<tr>
					<td colspan="5"> no data found</td>
				</tr>
						
	<?php } ?>
			</tbody>
        </table>
    </div>
	
	<br><br>
	<br><br>
	
	 <hr>

    <div class="card-header">
		<i class="fas fa-table"></i>Trend Reports Summaries - Number of upload times (morning, afternoon and evening)</div>
	<h4 class="my-4 card-title">Report showing number of different upload times.</h4>
    <div class="table-responsive">
        <p>NUMBER OF UPLOAD FILES (MORNING): <span style="color:red"><?php echo treport(); ?></span></p>
		<p>NUMBER OF UPLOAD FILES (AFTERNOON): <span style="color:red"><?php echo treport1(); ?></span></p>
		<p>NUMBER OF UPLOAD FILES (EVENING): <span style="color:red"><?php echo treport2(); ?></span></p>
	<?php include('database.php'); 
		function treport(){
			global $db;
			$query = 'SELECT COUNT(exam.Mod_Code) "NUMBER OF MODULE CODES(SUBMITTED in the EVENING)"
						FROM
						exam, student
						WHERE
						Start_Time BETWEEN "07:00:00" AND "12:00:00"
						AND
						exam.Stud_Number = student.Stud_Number
						AND
						exam.Mod_Code <> "-99";';

			$result = $db->query($query)->fetchColumn();
				if($result > 0){
					$number = $result;
				}else{
					$numbert = "0";
			}
			return $number;
	}
	function treport1(){
			global $db;
			$query = 'SELECT COUNT(exam.Mod_Code) "NUMBER OF MODULE CODES(SUBMITTED in the EVENING)"
						FROM
						exam, student
						WHERE
						Start_Time BETWEEN "13:00:00" AND "17:00:00"
						AND
						exam.Stud_Number = student.Stud_Number
						AND
						exam.Mod_Code <> "-99";';

			$result = $db->query($query)->fetchColumn();
				if($result > 0){
					$number = $result;
				}else{
					$numbert = "0";
			}
			return $number;
	}
	function treport2(){
			global $db;
			$query = 'SELECT COUNT(exam.Mod_Code) "NUMBER OF MODULE CODES(SUBMITTED in the EVENING)"
						FROM
						exam, student
						WHERE
						Start_Time BETWEEN "18:00:00" AND "22:00:00"
						AND
						exam.Stud_Number = student.Stud_Number
						AND
						exam.Mod_Code <> "-99";';

			$result = $db->query($query)->fetchColumn();
				if($result > 0){
					$number = $result;
				}else{
					$numbert = "0";
			}
			return $number;
	}
echo	'<p> According to the information gathered from the Trend Report, most students submitted their exams in the afternoon between the hours of 13pm to 17pm.</p>';
echo '<br><br>';
echo '<br><br>';	
?>
	


    <hr>

    <div class="card-header">
		<i class="fas fa-table"></i>Summary Report 2 - Number of PDF files submitted</div>
	<h4 class="my-4 card-title">Report showing summary of the number of files that were uploaded.</h4>
    <div class="table-responsive">
        <p>NUMBER OF FILES SUBMITTED: <span style="color:red"><?php echo report(); ?></span></p>
	<?php include('database.php'); 
		function report(){
			global $db;
			$query = 'SELECT
						COUNT(Upload) "NUMBER OF FILES SUBMITTED"
						FROM exam;';

			$result = $db->query($query)->fetchColumn();
				if($result > 0){
					$number = $result;
				}else{
					$numbert = "0";
			}
			return $number;
	}
	echo '<br><br>';
echo '<br><br>';
			
?>

	<form class="form-group" action="functions.php" method="post">
		
		<input type="submit" value="Back To Home" name="home" class="btn-green" >
		
	</form>
	
    </div>
</main>

