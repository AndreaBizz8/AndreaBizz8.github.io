<?php
$servername="localhost";
$username="root";
try {
    $conn = new PDO("mysql:host=localhost;dbname=theatrepedia", $username, "");
    // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	//check the data inserted in the registration form
	$user_email=$_POST["email_Address"];
	$user_password=$_POST["pass_word"];
	$name=$_POST["firstName"];
	$middleName=$_POST["middleName"];
	$lastName=$_POST["lastName"];
	$rawdate = htmlentities($_POST['user_dob']);
	$user_dob = date('Y-m-d', strtotime($rawdate));
	$gender = $_POST['gender'];
	$user_height= $_POST['userHeight'];
	$user_biography= $_POST['userBiography'];

		//SQL statement to insert into the database
	$sql = "INSERT INTO user (user_ID, user_email, user_password, user_firstname, user_middlename, user_lastname, user_dob, gender_ID, user_height, user_biography, user_phone)
	VALUES (0, '$user_email', '$user_password', '$name', '$middleName', '$lastName', '$user_dob', '$gender', '$user_height', '$user_biography', '')";
	if ($conn->query($sql)) {
		//if SQL complete a javascript pop-up will appear and tell that data have been inserted
	echo "<script type= 'text/javascript'>alert('New Record Inserted Successfully');</script>";
	include ('index.php');
	}
	else{
	//if SQL not complete a pop-up will tell something went wrong and you will be redirect to 
		//registrationPage
	echo "<script type= 'text/javascript'>alert('Data not successfully Inserted.');</script>";
	include('prova.php');
	}
	$conn = null;}
catch(PDOException $e){
echo $e->getMessage();}
?>