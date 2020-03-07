<?php
$servername="localhost";
$username="root";
try {
    $conn = new PDO("mysql:host=localhost;dbname=theatrepedia", $username, "");
    // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	//collect the passed id
	$id = $_POST['show_ID'];
	//check the data inserted in the registration form
	$role_name=$_POST["role_name"];
	$role_type=$_POST["role_type"];


		//SQL statement to insert into the database
	$sql = "INSERT INTO role (role_ID, show_ID, role_type_ID, role_name)
	VALUES (0, '$id', '$role_type', '$role_name')";
	if ($conn->query($sql)) {
		//if SQL complete a javascript pop-up will appear and tell that data have been inserted
	echo "<script type= 'text/javascript'>alert('New Record Inserted Successfully');</script>";
	include ('addRole.php');
	}
	else{
	//if SQL not complete a pop-up will tell something went wrong and you will be redirect to 
		//registrationPage
	echo "<script type= 'text/javascript'>alert('Data not successfully Inserted.');</script>";
	include('addRole.php');
	}
	$conn = null;}
catch(PDOException $e){
echo $e->getMessage();}
?>