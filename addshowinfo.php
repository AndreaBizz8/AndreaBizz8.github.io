<?php
$servername="localhost";
$username="root";
try {
    $conn = new PDO("mysql:host=localhost;dbname=theatrepedia", $username, "");
    // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	//check the data inserted in the registration form
	$show_title=$_POST["show_title"];
	$show_duration=$_POST["show_duration"];
	$rawdate = htmlentities($_POST['show_premiere_date']);
	$show_premiere_date = date('Y-m-d', strtotime($rawdate));
	$show_plot=$_POST["show_plot"];
	$show_main_picture=$_POST["show_pic"];
	$show_logo_picture=$_POST["show_logo"];
	
		//SQL statement to insert into the database
	$sql = "INSERT INTO show_info (show_ID, show_title, show_duration, show_premiere_date, show_plot, show_pic, show_logo)
	VALUES ('', '$show_title', '$show_duration', '$show_premiere_date', '$show_plot', '$show_main_picture', '$show_logo_picture')";
	if ($conn->query($sql)) {
		//if SQL complete a javascript pop-up will appear and tell that data have been inserted
	echo "<script type= 'text/javascript'>alert('New Record Inserted Successfully');</script>";
	include ('addlyrics.php');
	}
	else{
	//if SQL not complete a pop-up will tell something went wrong and you will be redirect to 
		//registrationPage
	echo "<script type= 'text/javascript'>alert('Data not successfully Inserted.');</script>";
	include('addlyrics.php');
	}
	$conn = null;}
catch(PDOException $e){
echo $e->getMessage();
}
?>