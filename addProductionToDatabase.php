<?php
$servername="localhost";
$username="root";
try {
    $conn = new PDO("mysql:host=localhost;dbname=theatrepedia", $username, "");
    // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	//check the data inserted in the registration form
	/*CHE
	
	CHECK HOW TO MAKE THE VALUE OF PRODUCTION ID AUMENTABILE
	
	*/
	$production_show=$_POST["show_number"];
	$valuenumber = 'SELECT COUNT(production_ID) FROM production_info WHERE show_ID = '.$conn->quote($production_show).'';
	$statement = $conn->prepare($valuenumber);
	$statement->execute();
	$showCount = $statement->fetchColumn();
	$statement->closeCursor();
	$addOne = 1;
	$production_ID= $showCount + $addOne;
	$production_type=$_POST["production_type"];
	$production_title=$_POST["production_title"];
	$production_facebook=$_POST["production_facebook"];
	$production_instagram=$_POST["production_instagram"];
	$production_twitter=$_POST["production_twitter"];
	$production_youtube=$_POST["production_youtube"];
	$production_pic=$_POST["production_pic"];
	$production_logo=$_POST["production_logo"];
	
		//SQL statement to insert into the database
	$sql = "INSERT INTO production_info (show_ID, production_ID, production_type_ID, production_name, production_FB, production_insta, production_twitter, production_youtube, production_pic, production_logo)
	VALUES ('$production_show', '$production_ID', '$production_type', '$production_title', '$production_facebook', '$production_instagram', '$production_twitter', '$production_youtube', '$production_pic', '$production_logo')";
	if ($conn->query($sql)) {
		//if SQL complete a javascript pop-up will appear and tell that data have been inserted
	echo "<script type= 'text/javascript'>alert('New Record Inserted Successfully');</script>";
	include ('addproduction.php');
	}
	else{
	//if SQL not complete a pop-up will tell something went wrong and you will be redirect to 
		//registrationPage
	echo "<script type= 'text/javascript'>alert('Data not successfully Inserted.');</script>";
	include('addproduction.php');
	}
	$conn = null;}
catch(PDOException $e){
echo $e->getMessage();
echo $production_show;
echo $production_type;
echo $production_title;
echo $production_facebook;
echo $production_instagram;
echo $production_twitter;
echo $production_youtube;
echo $production_pic;
echo $production_logo;

}
?>