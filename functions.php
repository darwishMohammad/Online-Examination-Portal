
 <?php
if(!isset($_SESSION)) 
{ 
    session_start(); 
}  
use PHPMailer\PHPMailer\PHPMailer;
set_include_path('/oep1/PHPMailer6/');
require_once './PHPMailer6/src/PHPMailer.php';
require_once './PHPMailer6/src/SMTP.php';
require_once './PHPMailer6/src/Exception.php';

$sendEmail = new PHPMailer();
$sendEmail->isSMTP();
$sendEmail->Host = 'smtp.gmail.com';
$sendEmail->Port = 587;
$sendEmail->SMTPAuth = true;
$sendEmail->Username = 'examsub73@gmail.com';
$sendEmail->Password = 'ExamSub73?';

 
 //the connection to the database of the student's login details, student and password 
 $con=mysqli_connect("localhost","root","","oepdb");
 if(isset($_POST['loginsubmit'])){
	 $username=$_POST['username'];
	 $password=$_POST['password'];
	 $_SESSION['username'] = $username;
 $query="select * from logintb where username='$username' and password='$password'";
 $result=mysqli_query($con,$query);
 if(mysqli_num_rows($result)==1)
 {
	header("Location:instruction.php"); 
 }
 else
 {
	 echo "<script>alert('Error login')</script>";
	 echo "<script>window.open('login.php','_self')</script>";
 }
 }
 
global $username; 
 
 

 
 $con2=mysqli_connect("localhost","root","","onlineexamportal");
 
 $dsn = 'mysql:host=localhost;dbname=onlineexamportal';
 $usernames = 'root';
 $password = '';
 
 $db = new PDO($dsn, $usernames, $password);
 
 
 
 
 //code to upload the file and submit to the database
 if(isset($_POST['upload'])){
	 
			
			$declare = $_SESSION['declare'];
			$examp_type = $_SESSION['exam_type'];
			$now = date('Y-m-d');
			
			$_Session['uploaded_time'] = date("H:i:s");
			$uploaded_time = $_Session['uploaded_time'];
			$student_email = $_SESSION['username'];
			$studentFetch = explode('@', $student_email);
			$studentFetch_1 = $studentFetch[0];
			
			$mod_codFetch = $_SESSION['module_codes'];
			$started_time = $_SESSION['starte_time'];
			
			
			$pdf=$_FILES['pdf']['name'];
			$pdf_type=$_FILES['pdf']['type'];
			$pdf_size=$_FILES['pdf']['size'];
			$pdf_tem_loc=$_FILES['pdf']['tmp_name'];
			$pdf_store="pdf/".$pdf;
			
			move_uploaded_file($pdf_tem_loc,$pdf_store);
			
			
			
			$sql = "INSERT INTO exam(Stud_Number, Mod_Code, Start_Time, Completion_Time, Declaration, Exam_Type, Upload, Exam_Date) VALUES (:Stud_Number,:Mod_Code,:Start_Time,:Completion_Time,:Declaration,:Exam_Type,:Upload,:Exam_Date)";
			$statement = $db->prepare($sql);
			$statement-> bindValue(':Stud_Number', $studentFetch_1);
			$statement-> bindValue(':Mod_Code', $mod_codFetch);
			$statement-> bindValue(':Start_Time', $started_time);
			$statement-> bindValue(':Completion_Time', $uploaded_time);
			$statement-> bindValue(':Declaration', $declare);
			$statement-> bindValue(':Exam_Type', $examp_type);
			$statement-> bindValue(':Upload', $pdf_store);
			$statement-> bindValue(':Exam_Date', $now);
			$statement->execute();
			
			$sendEmail ->setFrom('tshidi@myexam.co.za', 'Online Exam');
			$sendEmail->addAddress('tsidychlabo@gmail.com','Tshidi');
			$sendEmail->Subject= 'exam';
			$sendEmail->Body = "thank you for submiting your exam today";
			$sendEmail->AltBody = "thanks for your submition";
			$sendEmail->isHTML(true);
				
		}
		
		
	
 
  //the connection to the database of the admin's login details, student and password 
 $con1=mysqli_connect("localhost","root","","oepdb");
 if(isset($_POST['loginsubmit1'])){
	 $username=$_POST['username'];
	 $password=$_POST['password'];
 $query1="select * from logintb1 where username='$username' and password='$password'";
 $result=mysqli_query($con1,$query1);
 if(mysqli_num_rows($result)==1)
 {
	header("Location:report.php"); 
 }
 else
 {
	 echo "<script>alert('Error login')</script>";
	 echo "<script>window.open('adminLogin.php','_self')</script>";
 }
 }
 
 ////INSTRUCTION page
	if(isset($_POST['next1'])){

	header("Location:admin.php"); 

 }
 
 //UI Elements validation for admin page
  if(isset($_POST['next'])){
	if(isset($_POST['declation']) && $_POST['declation']!="")
	if(isset($_POST['exam_type']) && $_POST['exam_type']!="")
	if(isset($_POST['module_code']) && $_POST['module_code']!="")
	
	header("Location:admin1.php"); 
 
	 echo "<script>alert('You must agree to the honor pledge by checking the box next to the honor pledge statement to procceed.')</script>";
	 echo "<script>alert('You must select the appropriate exam type')</script>";
	 echo "<script>alert('You must select the appropriate module code')</script>";
	 echo "<script>window.open('admin.php','_self')</script>";

 }
	
	//Code validation for uploading the correct file type for admin1 page
	if(isset($_POST['upload'])){

	header("Location:admin2.php"); 

 }
 
 	if(isset($_POST['next'])){

	$_SESSION['module_codes'] = filter_input(INPUT_POST,'module_code');
	$_SESSION['declare'] = filter_input(INPUT_POST,'declation');
	$_SESSION['exam_type'] = filter_input(INPUT_POST, 'exam_type');
	
	if ($_SESSION['declare'] == "Yes") {
		
		$_SESSION['declare'] = Yes;
 }else {$_SESSION['declare'] = No;}
 
	
 
	}
 
 ////admin2 page
	if(isset($_POST['submit'])){



	header("Location:admin3.php"); 

 }
 
 
 
 ////admin2 page to click on the back button will redirect the user to the upload page
	if(isset($_POST['back'])){

	header("Location:admin1.php"); 
 
 }
 
 ///admin3 page
	if(isset($_POST['home'])){

	header("Location:index.php"); 
 }
 
 //admin3 page
	if(isset($_POST['backhome'])){

	header("Location:index.php"); 
 }
 
 //adminLogin page
	if(isset($_POST['backhome1'])){

	header("Location:index.php"); 
 }
 
 	if(isset($_POST['schedule'])){
	$stud_num = $_POST['stud_number'];
	$module_cd = $_POST['mod_code'];
	
	$sql_schedule = "INSERT INTO enroll(Stud_Number, Mod_Code) VALUES (:stud_number,:mod_code)";
	$statement = $db->prepare($sql_schedule);
	$statement-> bindValue(':stud_number',$stud_num);
	$statement-> bindValue(':mod_code',$module_cd);
	$statement->execute();


	header("Location:index.php"); 
 }
 
 ?>
 
 
 
 