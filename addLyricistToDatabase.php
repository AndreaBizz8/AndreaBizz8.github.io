<?php
$servername="localhost";
$username="root";
try {
    $conn = new PDO("mysql:host=localhost;dbname=theatrepedia", $username, "");
    // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	//check the data inserted in the registration form
	$show_lyrics_name=$_POST["show_lyrics_name"];

		//SQL statement to insert into the database
	$sql = "INSERT INTO show_lyrics_info (show_lyrics_ID, show_lyrics_name)
	VALUES ('', '$show_lyrics_name')";
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