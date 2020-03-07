<!doctype html>
<?php 
/*DATABASE CONNECTION*/
require_once('database.php');

/*SELECT CONTINENT*/
$continent_select = 'SELECT * FROM continent WHERE continent_ID > 1';
$statement = $conn->prepare($continent_select);
$statement->execute();
$select_continent = $statement->fetchAll();
$statement->closeCursor();

/*SELECT COUNTRY*/
$country_select = 'SELECT * FROM country ORDER BY continent_ID';
$statement1 = $conn->prepare($country_select);
$statement1->execute();
$select_country = $statement1->fetchAll();
$statement->closeCursor();

/*SELECT STATE*/
$state_select = 'SELECT * FROM state';
$statement2 = $conn->prepare($state_select);
$statement2->execute();
$select_state = $statement2->fetchAll();
$statement->closeCursor();

/*SELECT REGION*/
$region_select = 'SELECT * FROM region';
$statement3 = $conn->prepare($region_select);
$statement3->execute();
$select_region = $statement3->fetchAll();
$statement->closeCursor();

?>
<html>
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		<meta name="description" content="">
		<meta name="author" content="">
			<!--STYLESHEET-->
		<link href="prova.css" rel="stylesheet" type="text/css">
		 <!--FONTS --- font-family: 'Roboto Slab', serif; --- font-family: 'Karla', sans-serif; --- 	font-family: 'Montserrat', sans-serif; -->
		<link href="https://fonts.googleapis.com/css?family=Karla:400,400i,700,700i|Montserrat:400,500,600,700,700i,900|Roboto+Slab:300,400,700" rel="stylesheet">
			<!--FONTAWESOME STYLESHEET FOR ICONS-->
		<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.13/css/all.css" integrity="sha384-DNOHZ68U8hZfKXOrtjWvjxusGo9WQnrNx2sqG0tfsghAvtVlRW3tvkXWZh58N9jp" crossorigin="anonymous">
		<!--STYLESHEET FOR BOOTSTRAP-->
		<link href="css/bootstrap.min.css" rel="stylesheet" type="text/css"> 
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
		<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
		<!--SLICKNAV FR SLIDER-->
		<link rel="stylesheet" type="text/css" href="./slick/slick.css">
		<link rel="stylesheet" type="text/css" href="./slick/slick-theme.css">
		<!-- Magnific Popup core CSS file -->
		<link rel="stylesheet" href="css/magnific-popup.css">

		<title>HomePage</title>
	</head>

<body>
	<header class="fixed-top">
		<nav class="navbar navbar-nav navbar-expand-md fixed-top mb-4 px-3" style="line-height: 100px">
			<a class="navbar-brand" href="#">
				<img src="img/logo.png" alt="logo" width="200">
			</a>
			<div id="navbarCollapse" class="collapse navbar-collapse container-fluid float-right">
				<ul class="navbar navbar-nav mr-auto align-items-end container align-items-center">
					<li class="nav-item mx-2"><a class="nav-link font-size-180" data-toggle="collapse" href="#navbar-header-search" role="button" aria-expanded="false" aria-controls="navbar-header-search"><i class="fas fa-search"></i></a></li>
					<li class="nav-item mx-2"><a class="nav-link" href="news.html">News</a></li>
					<li class="nav-item mx-2"><a class="nav-link" href="theatre.html">Theatre</a></li>
					<li class="nav-item mx-2"><a class="nav-link" href="production.html">Production</a></li>
					<li class="nav-item mx-2"><a class="nav-link" href="calendar.html">Calendar</a></li>
					<li class="nav-item mx-2"><a class="nav-link" href="contact.html">Contact</a></li>
					<li class="nav-item mx-2"><a class="nav-link" href="about-us.html">About US</a></li>
					<li class="nav-item mx-2">
						<a class="nav-link btn btn-default btn-rounded my-3" href="#" data-toggle="modal" data-target="#modalLoginForm"><i class="fas fa-sign-in-alt font-size-150"></i></a>
					</li>
				</ul>
			</div>		
		</nav>
		<div class="collapse" id="navbar-header-search">
			<form class="p-2 px-5" style="margin-top:100px">
				<div class="row" >
					<i class="fas fa-search font-size-180 mx-3"></i>
					<input class="p-2 container" type="text" placeholder="Search">
				</div>
			</form>
		</div>
	</header>
	<main class="mt-5 pt-5" role="main">
		<div class="container">
			<p class="h2 paragraphTitle">Add Agent</p>
			<form action="addAgentToDatabase.php" method="post" id="registrationForm">
				<div class="row">
					<div class="col">
						<label>Agent Name</label>
					</div>
					<div class="col">
						<input type="text" name="agent_name" id="agent_name" required>
					</div>
				</div>
				<div class="row">
					<div class="col">
						<label>Agent Email</label>
					</div>
					<div class="col">
						<input type="text" name="agent_email" id="agent_email" required>
					</div>
				</div>
				<div class="row">
					<div class="col">
						<label>Agent Phone</label>
					</div>
					<div class="col">
						<input type="text" name="agent_phone" id="agent_phone" required>
					</div>
				</div>
				<div class="row">
					<div class="col">
						<label>Continent</label>
					</div>
					<div class="col">
						<select name='continent_ID' id='continent_ID' required>
							  <option value=''>Select</option>
							  <?php
							  $stmt = $conn->query('SELECT * FROM continent WHERE continent_ID > 1');
							  while($row = $stmt->fetch(PDO::FETCH_OBJ)) {
								  echo "<option value='$row->continent_ID'>$row->continent_name</option>";
							  }
							  ?>
						</select>
					</div>
				</div>
				<div class="row">
					<div class="col">
						<label>Country</label>
					</div>
					<div class="col">
						<select name='country_ID' id='country_ID' required></select>
					</div>
				</div>
				<div class="row">
					<div class="col">
						<label>State</label>
					</div>
					<div class="col">
						<select name='state_ID' id='state_ID' required></select>
					</div>
				</div>
				<div class="row">
					<div class="col">
						<label>Region</label>
					</div>
					<div class="col">
						<select name='region_ID' id='region_ID' required></select>
					</div>
				</div>
				<div class="row">
					<div class="col">
						<label>Street Address</label>
					</div>
					<div class="col">
						<input type="text" name="agent_street_address" id="agent_street_address" required>
					</div>
				</div>
				<div class="row">
					<div class="col">
						<label>Postcode</label>
					</div>
					<div class="col">
						<input type="text" name="agent_postcode" id="agent_postcode" >
					</div>
				</div>
				<div class="row">
					<div class="col">
						<label>Latitude</label>
					</div>
					<div class="col">
						<input type="text" name="agent_latitude" id="agent_latitude" >
					</div>
				</div>
				<div class="row">
					<div class="col">
						<label>Latitude Direction</label>
					</div>
					<div class="col">
						<input type="text" name="agent_latitude_direction" id="agent_latitude_direction_direction" >
					</div>
				</div>
				<div class="row">
					<div class="col">
						<label>Longitude</label>
					</div>
					<div class="col">
						<input type="text" name="agent_longitude" id="agent_longitude">
					</div>
				</div>
				<div class="row">
					<div class="col">
						<label>Longitude Direction</label>
					</div>
					<div class="col">
						<input type="text" name="agent_longitude_direction" id="agent_longitude_direction">
					</div>
				</div>	
				<input type="submit" value="REGISTER" >
			</form>
		</div>
	</main>
	<footer class="container-fluid mt-4 pt-4 karla">
		<div class="row text-center">
			<div class="col"><p class="container text-center">Who We Are</p></div>
			<div class="col white-left-line">
				<div class="row"><p class="container text-center">Help Us</p></div>
				<div class="row container mt-2">
					<p class="container text-justify small">If you have any advice or you see that some details are wrong, do not hesitate to contact us and let us know what we should implement, or change about the website</p>
				</div>
			</div>
			<div class="col white-left-line">
				<div class="row"><p class="container text-center">Contact Us</p></div>
				<div class="row align-items-center mt-2">
					<div class="col-3 text-right font-size-150"><i class="fas fa-envelope"></i></div>
					<div class="col small">emailoftheadministrator@gmail.com</div>
				</div>
				<div class="row container align-items-center mt-2">
					<div class="col-3 text-right font-size-150"><i class="fas fa-phone"></i></div>
					<div class="col small text-left">02072447653</div>
				</div>
				<div class="row container align-items-center mt-2">
					<div class="col-3 text-right font-size-150"><i class="fas fa-map-marker"></i></div>
					<div class="col small">
						<div class="row container">Address</div>
						<div class="row container">City</div>
						<div class="row container">PostCode</div>
					</div>
				</div>
			</div>
			<div class="col white-left-line">
				<div class="row"><p class="container text-center">Social</p></div>
				<div class="row container">
					<div class="col m-o font-size-200"><i class="fab fa-facebook-square"></i></div>
					<div class="col m-0 font-size-200"><i class="fab fa-twitter-square"></i></div>
					<div class="col m-0 font-size-200"><i class="fab fa-instagram"></i></div>
					<div class="col m-0 font-size-200"><i class="fab fa-youtube-square"></i></div>
					<!--<div class="col-2 m-0 font-size-200"><i class="fab fa-snapchat-square"></i></div> -->
				</div>
			</div>
		</div>
		<div class="row mt-4">
		  <div class="container-fluid text-center">Copyright by Andrea Bizzotto</div>
		</div>
	</footer>
	<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js" integrity="sha384-smHYKdLADwkXOn1EmN1qk/HfnUcbVRZyYmZ4qpPea6sjB/pTJ0euyQp0Mk8ck+5T" crossorigin="anonymous"></script>
	<!-- jQuery 1.7.2+ or Zepto.js 1.0+ -->
	<script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>	
	<script src="https://code.jquery.com/jquery-2.2.0.min.js" type="text/javascript"></script>
	<!--SCRIPT TO CHANGE THE COUNTRY-->
	<script type="text/javascript">
	$(function() {
	 $("#continent_ID").bind("change", function() {
		 $.ajax({
			 type: "GET", 
			 url: "changecountry.php",
			 data: "continent_ID="+$("#continent_ID").val(),
			 success: function(html) {
				 $("#country_ID").html(html);
			 }
		 });
	 });
	});
	</script>
	<!--SCRIPT TO CHANGE THE STATE-->
	<script type="text/javascript">
	$(function() {
	 $("#country_ID").bind("change", function() {
		 $.ajax({
			 type: "GET", 
			 url: "changecountry.php",
			 data: "country_ID="+$("#country_ID").val(),
			 success: function(html) {
				 $("#state_ID").html(html);
			 }
		 });
	 });
	});
	</script>
		<!--SCRIPT TO CHANGE THE REGION-->
	<script type="text/javascript">
	$(function() {
	 $("#state_ID").bind("change", function() {
		 $.ajax({
			 type: "GET", 
			 url: "changecountry.php",
			 data: "state_ID="+$("#state_ID").val(),
			 success: function(html) {
				 $("#region_ID").html(html);
			 }
		 });
	 });
	});
	</script>
	
	
	
</body>
</html>