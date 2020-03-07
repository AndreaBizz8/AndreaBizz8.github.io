<?php
$servername="localhost";
$username="root";
try {
    $conn = new PDO("mysql:host=localhost;dbname=theatrepedia", $username, "");
    // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	//check the data inserted in the registration form
	$agent_name=$_POST["agent_name"];
	$agent_email=$_POST["agent_email"];
	$agent_phone=$_POST["agent_phone"];
	$continent_ID=$_POST["continent_ID"];
	$country_ID=$_POST["country_ID"];
	$state_ID=$_POST["state_ID"];
	$region_ID=$_POST["region_ID"];
	$agent_street_address=$_POST["agent_street_address"];
	$agent_postcode=$_POST["agent_postcode"];
	$agent_latitude=$_POST["agent_latitude"];
	$agent_latitude_direction=$_POST["agent_latitude_direction"];
	$agent_longitude=$_POST["agent_longitude"];
	$agent_longitude_direction=$_POST["agent_longitude_direction"];
		//SQL statement to insert into the database
	$sql = "INSERT INTO agent (agent_ID, agent_name, agent_email, agent_phone, continent_ID, country_ID, state_ID, region_ID, agent_street_address, agent_postcode, agent_latitude, agent_latitude_direction, agent_longitude, agent_longitude_direction)
	VALUES ('', '$agent_name', '$agent_email', '$agent_phone', '$continent_ID', '$country_ID', '$state_ID', '$region_ID', '$agent_street_address', '$agent_postcode', '$agent_latitude', '$agent_latitude_direction', '$agent_longitude', '$agent_longitude_direction')";
	if ($conn->query($sql)) {
		//if SQL complete a javascript pop-up will appear and tell that data have been inserted
	echo "<script type= 'text/javascript'>alert('New Record Inserted Successfully');</script>";
	include ('index.php');
	}
	else{
	//if SQL not complete a pop-up will tell something went wrong and you will be redirect to 
		//registrationPage
	echo "<script type= 'text/javascript'>alert('Data not successfully Inserted.');</script>";
	include('addagent.php');
	}
	$conn = null;}
catch(PDOException $e){
echo $e->getMessage();
}
?>