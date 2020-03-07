<?php
$servername="localhost";
$username="root";
try {
    $conn = new PDO("mysql:host=localhost;dbname=theatrepedia", $username, "");
    // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	//check the data inserted in the form
	$show_ID=$_POST["show_ID"];
	$composer_ID=$_POST["composer_ID"];

		//SQL statement to insert into the database
	$sql = "INSERT INTO show_composer (show_ID, show_composer_ID)
	VALUES ('$show_ID', '$composer_ID')";
	if ($conn->query($sql)) {
		//if SQL complete a javascript pop-up will appear and tell that data have been inserted
	echo "<script type= 'text/javascript'>alert('New Record Inserted Successfully');</script>";
	include ('addcomposer.php');
	}
	else{
	//if SQL not complete a pop-up will tell something went wrong and you will be redirect to 
		//registrationPage
	echo "<script type= 'text/javascript'>alert('Data not successfully Inserted.');</script>";
	include('addcomposer.php');
	}
	$conn = null;}
catch(PDOException $e){
echo $e->getMessage();
}
?>