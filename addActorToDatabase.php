<?php
$servername="localhost";
$username="root";
try {
    $conn = new PDO("mysql:host=localhost;dbname=theatrepedia", $username, "");
    // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	//check the data inserted in the registration form
	$actor_name=$_POST["actor_name"];
	$actor_middleName=$_POST["actor_middlename"];
	$actor_lastName=$_POST["actor_lastname"];
	$actor_gender_ID=$_POST["gender_ID"];
	$rawdate = htmlentities($_POST['actor_dob']);
	$actor_dob = date('Y-m-d', strtotime($rawdate));
	$actor_pob=$_POST["actor_pob"];
	$actor_height=$_POST["actor_height"];
	$actor_website=$_POST["actor_website"];
	$actor_country=$_POST["actor_country"];
	$actor_school=$_POST["actor_school"];
	$actor_school_graduation_year=$_POST["actor_school_graduation_year"];
	$actor_instagram=$_POST["actor_insta"];
	$actor_facebook=$_POST["actor_facebook"];
	$actor_twitter=$_POST["actor_twitter"];
	$actor_youtube=$_POST["actor_youtube"];
	$actor_email=$_POST["actor_email"];
	$actor_agent=$_POST["agent_ID"];
	$actor_biography=$_POST["actor_biography"];
	$actor_profile_picture=$_POST["actor_profile_pic"];
	
		//SQL statement to insert into the database
	$sql = "INSERT INTO actor (actor_ID, actor_name, actor_middlename, actor_lastname, gender_ID, actor_dob, actor_pob, actor_height, actor_website, actor_country, actor_school, actor_school_graduation_year, actor_insta, actor_facebook, actor_twitter, actor_youtube, actor_email, agent_ID, actor_biography, actor_profile_pic)
	VALUES ('', '$actor_name', '$actor_middleName', '$actor_lastName', '$actor_gender_ID', '$actor_dob', '$actor_pob', '$actor_height', '$actor_website', '$actor_country', '$actor_school', '$actor_school_graduation_year', '$actor_instagram', '$actor_facebook', '$actor_twitter', '$actor_youtube', '$actor_email', '$actor_agent', '$actor_biography', '$actor_profile_pic')";
	if ($conn->query($sql)) {
		//if SQL complete a javascript pop-up will appear and tell that data have been inserted
	echo "<script type= 'text/javascript'>alert('New Record Inserted Successfully');</script>";
	include ('addactor.php');
	}
	else{
	//if SQL not complete a pop-up will tell something went wrong and you will be redirect to 
		//registrationPage
	echo "<script type= 'text/javascript'>alert('Data not successfully Inserted.');</script>";
	include('addactor.php');
	}
	$conn = null;}
catch(PDOException $e){
echo $e->getMessage();
}
?>