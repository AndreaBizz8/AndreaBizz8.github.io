<!doctype html>
<?php
/*DATABASE CONNECTION*/
require_once('database.php');

/*FEATURE SHOW GALLERY*/
$queryShowPic = 'SELECT show_pic FROM show_info';
$statement = $conn->prepare($queryShowPic);
$statement->execute();
$showPicture = $statement->fetchAll();
$statement->closeCursor();

/*OPENING DATES CALENDAR SECTION
show name
production name
production_opening_date
*/
$openingShow = 'SELECT show_info.show_title, production_info.production_name, production_theatre.production_opening
FROM production_theatre
INNER JOIN show_info ON show_info.show_ID = production_theatre.show_ID
INNER JOIN production_info ON production_info.production_ID = production_theatre.production_ID AND production_info.show_ID = production_theatre.show_ID
ORDER BY production_theatre.production_opening';
$statement1 = $conn->prepare($openingShow);
$statement1->execute();
$showOpeningDate = $statement1->fetchAll();
$statement1->closeCursor();
/*CLOSING DATE CALENDAR SECTION*/
$closingShow = 'SELECT show_info.show_title, production_info.production_name, production_theatre.production_opening
FROM production_theatre
INNER JOIN show_info ON show_info.show_ID = production_theatre.show_ID
INNER JOIN production_info ON production_info.production_ID = production_theatre.production_ID AND production_info.show_ID = production_theatre.show_ID
ORDER BY production_theatre.production_opening DESC';
$statement2 = $conn->prepare($closingShow);
$statement2->execute();
$showClosingDate = $statement2->fetchAll();
$statement2->closeCursor();


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
		
		
		<!--JAAVASCRIPT FOR THE BUTTONS FOR THE SELECTION OF THE COUNTRY -->
		<script>
		var socials = ["social1", "social2","social3","social4", "social5", "social6"]
		function selectSocial(s, event){
			for (var social in socials) {
				if (social != s) {
					document.getElementById(socials[social]).style.display = "none";
					document.getElementById("btn"+socials[social]).style.background = "rgba(40, 2, 22, 1.00)";
					document.getElementById("btn"+socials[social]).style.color = "white";
				}
			}
			document.getElementById(s).style.display = "block";
			document.getElementById("btn"+s).style.background = "rgba(143, 27, 50, 1.00)";	
		}
		</script>
		<title>HomePage</title>
	</head>

<body>
	<!--Modal: Login / Register Form-->
		<div class="modal fade" id="modalLoginForm" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header text-center">
                <h4 class="modal-title w-100 font-weight-bold">Sign in</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body mx-3">
                <div class="md-form mb-5">
                    <i class="fa fa-envelope prefix grey-text"></i>
                    <input type="email" id="defaultForm-email" class="form-control validate">
                    <label data-error="wrong" data-success="right" for="defaultForm-email">Your email</label>
                </div>

                <div class="md-form mb-4">
                    <i class="fa fa-lock prefix grey-text"></i>
                    <input type="password" id="defaultForm-pass" class="form-control validate">
                    <label data-error="wrong" data-success="right" for="defaultForm-pass">Your password</label>
                </div>

            </div>
            <div class="modal-footer d-flex justify-content-center">
				<div class="row">
					<div class="col"><button class="btn btn-default">Login</button></div>
					<div class="col small">Not Registered yet? 
						<a href="registration.php" class="">SIGN UP</a>
					</div>
				</div>
                
            </div>
        </div>
    </div>
</div>
		<!--Modal: Login / Register Form-->

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
		<!--CAROUSEL FULL WIDTH-->
		<div class="container-fluid p-0 mt-0">
			<div id="myCarousel" class="carousel slide align-content-center" data-ride="carousel">
				<ol class="carousel-indicators">
				<!-- ADD ONE FOR EACH SLIDE OF THE CAROUSEL  -->
					<li data-target="#myCarousel" data-slide-to="0" class="active"></li>
					<li data-target="#myCarousel" data-slide-to="1"></li>
					<li data-target="#myCarousel" data-slide-to="2"></li>
					<li data-target="#myCarousel" data-slide-to="3"></li>
				</ol>
				<div class="carousel-inner">
					<div class="carousel-item active">
						<img class="first-slide" src="../../../foto/IMG_6571.JPG" alt="First slide">
						<div class="container">
							<div class="carousel-caption text-left">
								<h1>Example headline.</h1>
								<p>Cras justo odio, dapibus ac facilisis in, egestas eget quam. Donec id elit non mi porta gravida at eget metus. Nullam id dolor id nibh ultricies vehicula ut id elit.</p>
								<p><a class="btn btn-lg btn-primary" href="#" role="button">Sign up today</a></p>
							</div>
						</div>
					</div>
					<div class="carousel-item">
						<img class="second-slide" src="data:image/gif;base64,R0lGODlhAQABAIAAAHd3dwAAACH5BAAAAAAALAAAAAABAAEAAAICRAEAOw==" alt="Second slide">
						<div class="container">
							<div class="carousel-caption">
								<h1>Another example headline.</h1>
								<p>Cras justo odio, dapibus ac facilisis in, egestas eget quam. Donec id elit non mi porta gravida at eget metus. Nullam id dolor id nibh ultricies vehicula ut id elit.</p>
								<p><a class="btn btn-lg btn-primary" href="#" role="button">Learn more</a></p>
							</div>
						</div>
					</div>
					<div class="carousel-item">
						<img class="third-slide" src="data:image/gif;base64,R0lGODlhAQABAIAAAHd3dwAAACH5BAAAAAAALAAAAAABAAEAAAICRAEAOw==" alt="Third slide">
						<div class="container">
							<div class="carousel-caption text-right">
								<h1>One more for good measure.</h1>
								<p>Cras justo odio, dapibus ac facilisis in, egestas eget quam. Donec id elit non mi porta gravida at eget metus. Nullam id dolor id nibh ultricies vehicula ut id elit.</p>
								<p><a class="btn btn-lg btn-primary" href="#" role="button">Browse gallery</a></p>
							</div>
						</div>
					</div>
					<div class="carousel-item">
						<img class="fourth-slide" src="data:image/gif;base64,R0lGODlhAQABAIAAAHd3dwAAACH5BAAAAAAALAAAAAABAAEAAAICRAEAOw==" alt="Second slide">
						<div class="container">
							<div class="carousel-caption">
								<h1>Another example headline.</h1>
								<p>Cras justo odio, dapibus ac facilisis in, egestas eget quam. Donec id elit non mi porta gravida at eget metus. Nullam id dolor id nibh ultricies vehicula ut id elit.</p>
								<p><a class="btn btn-lg btn-primary" href="#" role="button">Learn more</a></p>
							</div>
						</div>
					</div>
				<!--template slide
					<div class="carousel-item">
						<img class="NUMBER_SLIDE-slide" src="data:image/gif;base64,R0lGODlhAQABAIAAAHd3dwAAACH5BAAAAAAALAAAAAABAAEAAAICRAEAOw==" alt="Second slide">
						<div class="container">
							<div class="carousel-caption">
								<h1>Another example headline.</h1>
								<p>Cras justo odio, dapibus ac facilisis in, egestas eget quam. Donec id elit non mi porta gravida at eget metus. Nullam id dolor id nibh ultricies vehicula ut id elit.</p>
								<p><a class="btn btn-lg btn-primary" href="#" role="button">Learn more</a></p>
							</div>
						</div>
					</div>-->
				</div>
				<a class="carousel-control-prev" href="#myCarousel" role="button" data-slide="prev">
					<span class="carousel-control-prev-icon" aria-hidden="true"></span>
					<span class="sr-only">Previous</span>
				</a>
				<a class="carousel-control-next" href="#myCarousel" role="button" data-slide="next">
					<span class="carousel-control-next-icon" aria-hidden="true"></span>
					<span class="sr-only">Next</span>
				</a>
			</div>
		</div>
		
		<div class="container">
			<div class="row my-3 h4 text-center">
				<div class="container-fluid">
					<a href="#" class="row my-1 titleSection align-content-center">
						<p class="col p-1 mx-2 my-0 montserrat">Top Stories</p>
						<i class="col-1 container far fa-plus-square p-0 m-0 my-auto right-button-plus"></i>
					</a>
				</div>
			</div>
		</div>
		<!--container for cards for news, with sliding-->
		<div class="container">
			<section class="regular-double slider">
				<div style="">
					<div class="row">
						<div class="col-md-12">
							<div class="card flex-md-row mb-4 shadow-sm h-md-250">
								<div class="card-body event-link p-3 d-flex flex-column align-items-start">
									<strong class="d-inline-block my-1 text-location">World</strong>
									<h3 class="mb-0">
										<a class="title-news" href="#">Featured post</a>
									</h3>
									<div class="mb-1 date-news font-size-70">Nov 12</div>
									<p class="news-sub-title mb-auto">This is a wider card with supporting text below as a natural lead-in to additional content.</p>
									<a class="news-sub-title" href="#">Continue reading</a>
								</div>
								<img class="card-img-right flex-auto d-none d-md-block img-new-post-slider" src="http://placehold.it/350x300?text=1" alt="Card image cap">
							</div>
						</div>
					</div>
				</div>
				
				<div style="">
					<div class="row">
						<div class="col-md-12">
							<div class="card flex-md-row mb-4 shadow-sm h-md-250">
								<div class="card-body event-link p-3 d-flex flex-column align-items-start">
									<strong class="d-inline-block my-1 text-location">World</strong>
									<h3 class="mb-0">
										<a class="title-news" href="#">Featured post</a>
									</h3>
									<div class="mb-1 font-size-70">Nov 12</div>
									<p class="news-sub-title mb-auto">This is a wider card with supporting text below as a natural lead-in to additional content.</p>
									<a class="news-sub-title" href="#">Continue reading</a>
								</div>
								<img class="card-img-right flex-auto d-none d-md-block img-new-post-slider" src="http://placehold.it/350x300?text=2" alt="Card image cap">
							</div>
						</div>
					</div>
				</div>
				<div style="">
					<div class="row">
						<div class="col-md-12">
							<div class="card flex-md-row mb-4 shadow-sm h-md-250">
								<div class="card-body event-link p-3 d-flex flex-column align-items-start">
									<strong class="d-inline-block my-1 text-location">World</strong>
									<h3 class="mb-0">
										<a class="title-news" href="#">Featured post</a>
									</h3>
									<div class="mb-1 date-news font-size-70">Nov 12</div>
									<p class="news-sub-title mb-auto">This is a wider card with supporting text below as a natural lead-in to additional content.</p>
									<a class="news-sub-title" href="#">Continue reading</a>
								</div>
								<img class="card-img-right flex-auto d-none d-md-block img-new-post-slider" src="http://placehold.it/350x300?text=3" alt="Card image cap">
							</div>
						</div>
					</div>
				</div>
				<div style="">
					<div class="row">
						<div class="col-md-12">
							<div class="card flex-md-row mb-4 shadow-sm h-md-250">
								<div class="card-body event-link p-3 d-flex flex-column align-items-start">
									<strong class="d-inline-block my-1 text-location">World</strong>
									<h3 class="mb-0">
										<a class="title-news" href="#">Featured post</a>
									</h3>
									<div class="mb-1 date-news font-size-70">Nov 12</div>
									<p class="news-sub-title mb-auto">This is a wider card with supporting text below as a natural lead-in to additional content.</p>
									<a class="news-sub-title" href="#">Continue reading</a>
								</div>
								<img class="card-img-right flex-auto d-none d-md-block img-new-post-slider" src="http://placehold.it/350x300?text=4" alt="Card image cap">
							</div>
						</div>
					</div>
				</div>
				<div style="">
					<div class="row">
						<div class="col-md-12">
							<div class="card flex-md-row mb-4 shadow-sm h-md-250">
								<div class="card-body event-link p-3 d-flex flex-column align-items-start">
									<strong class="d-inline-block my-1 text-location">World</strong>
									<h3 class="mb-0">
										<a class="title-news" href="#">Featured post</a>
									</h3>
									<div class="mb-1 date-news font-size-70">Nov 12</div>
									<p class="news-sub-title mb-auto">This is a wider card with supporting text below as a natural lead-in to additional content.</p>
									<a class="news-sub-title" href="#">Continue reading</a>
								</div>
								<img class="card-img-right flex-auto d-none d-md-block img-new-post-slider" src="http://placehold.it/350x300?text=5" alt="Card image cap">
							</div>
						</div>
					</div>
				</div>
				<div style="">
					<div class="row">
						<div class="col-md-12">
							<div class="card flex-md-row mb-4 shadow-sm h-md-250">
								<div class="card-body event-link p-3 d-flex flex-column align-items-start">
									<strong class="d-inline-block my-1 text-location">World</strong>
									<h3 class="mb-0">
										<a class="title-news" href="#">Featured post</a>
									</h3>
									<div class="mb-1 date-news font-size-70">Nov 12</div>
									<p class="news-sub-title mb-auto">This is a wider card with supporting text below as a natural lead-in to additional content.</p>
									<a class="news-sub-title" href="#">Continue reading</a>
								</div>
								<img class="card-img-right flex-auto d-none d-md-block img-new-post-slider" src="http://placehold.it/350x300?text=6" alt="Card image cap">
							</div>
						</div>
					</div>
				</div>
				<div style="">
					<div class="row">
						<div class="col-md-12">
							<div class="card flex-md-row mb-4 shadow-sm h-md-250">
								<div class="card-body event-link p-3 d-flex flex-column align-items-start">
									<strong class="d-inline-block my-1 text-location">World</strong>
									<h3 class="mb-0">
										<a class="title-news" href="#">Featured post</a>
									</h3>
									<div class="mb-1 date-news font-size-70">Nov 12</div>
									<p class="news-sub-title mb-auto">This is a wider card with supporting text below as a natural lead-in to additional content.</p>
									<a class="news-sub-title" href="#">Continue reading</a>
								</div>
								<img class="card-img-right flex-auto d-none d-md-block img-new-post-slider" src="http://placehold.it/350x300?text=7" alt="Card image cap">
							</div>
						</div>
					</div>
				</div>
				<div style="">
					<div class="row">
						<div class="col-md-12">
							<div class="card flex-md-row mb-4 shadow-sm h-md-250">
								<div class="card-body event-link p-3 d-flex flex-column align-items-start">
									<strong class="d-inline-block my-1 text-location">World</strong>
									<h3 class="mb-0">
										<a class="title-news" href="#">Featured post</a>
									</h3>
									<div class="mb-1 date-news font-size-70">Nov 12</div>
									<p class="news-sub-title mb-auto">This is a wider card with supporting text below as a natural lead-in to additional content.</p>
									<a class="news-sub-title" href="#">Continue reading</a>
								</div>
								<img class="card-img-right flex-auto d-none d-md-block img-new-post-slider" src="http://placehold.it/350x300?text=8" alt="Card image cap">
							</div>
						</div>
					</div>
				</div>
				<div style="">
					<div class="row">
						<div class="col-md-12">
							<div class="card flex-md-row mb-4 shadow-sm h-md-250">
								<div class="card-body event-link p-3 d-flex flex-column align-items-start">
									<strong class="d-inline-block my-1 text-location">World</strong>
									<h3 class="mb-0">
										<a class="title-news" href="#">Featured post</a>
									</h3>
									<div class="mb-1 date-news font-size-70">Nov 12</div>
									<p class="news-sub-title mb-auto">This is a wider card with supporting text below as a natural lead-in to additional content.</p>
									<a class="news-sub-title" href="#">Continue reading</a>
								</div>
								<img class="card-img-right flex-auto d-none d-md-block img-new-post-slider" src="http://placehold.it/350x300?text=9" alt="Card image cap">
							</div>
						</div>
					</div>
				</div>

				
			</section>
		</div>
		<!--NAVIGATION BAR TO LET THE USER CHOOSE THE COUNTRY TO VIEW THE NEWS BASED ON THE COUNTRY,
			THE NEWS HERE WOULD BE ONLY TITLE, DATE AND AUTHOR, MAYBE A SMALL SQUARED IMAGE-->
		<div class="container-fluid p-0">
			<!--ROW FOR NAVIGATION FOR SELECTION NEWS BY COUNTRY-->
			<div class="container-fluid p-0 inline-list-user-profile">			
				<ul class="list-inline container-fluid d-flex justify-content-around align-items-end mb-0 p-0">
					<li onClick="selectSocial('social1')" id="btnsocial1" class="list-inline-item paragraphTitle h4 m-0 py-0">
						<div class="container-fluid">
							<div class="row my-0 p-3 text-center title-selection">
								<p class="col p-0 mx-0 my-0 montserrat">All</p>
							</div>
						</div>
					</li>
					<li onClick="selectSocial('social2')" id="btnsocial2" class="list-inline-item paragraphTitle h4 m-0 py-0">
						<div class="container-fluid">
							<div class="row my-0 p-3 text-center title-selection">
								<p class="col p-0 mx-0 my-0 montserrat">America</p>
							</div>
						</div>
					</li>
					<li onClick="selectSocial('social3')" id="btnsocial3" class="list-inline-item paragraphTitle h4 m-0 py-0">
						<div class="container-fluid">
							<div class="row my-0 p-3 text-center title-selection">
								<p class="col p-0 mx-0 my-0 montserrat">Europe</p>
							</div>
						</div>
					</li>
					<li onClick="selectSocial('social4')" id="btnsocial4" class="list-inline-item paragraphTitle h4 m-0 py-0">
						<div class="container-fluid">
							<div class="row my-0 p-3 text-center title-selection">
								<p class="col p-0 mx-0 my-0 montserrat">Asia</p>
							</div>
						</div>
					</li>
					<li onClick="selectSocial('social5')" id="btnsocial5" class="list-inline-item paragraphTitle h4 m-0 py-0">
						<div class="container-fluid">
							<div class="row my-0 p-3 text-center title-selection">
								<p class="col p-0 mx-0 my-0 montserrat">Australia</p>
							</div>
						</div>
					</li>
					<li onClick="selectSocial('social6')" id="btnsocial6" class="list-inline-item paragraphTitle h4 m-0 py-0">
						<div class="container-fluid">
							<div class="row my-0 p-3 text-center title-selection">
								<p class="col p-0 mx-0 my-0 montserrat">Africa</p>
							</div>
						</div>
					</li>
				</ul>
			</div>
			<!--ROW FOR DISPLAY THE NEWS SELECTED-->
			<!--FIRST FOR ALL COUNTRIES-->
			<div class="container mt-4" id="social1" style="display:block">
				<div class="row">
					<div class="col-md-4">
						<div class="card flex-md-row mb-4 shadow-sm h-md-250">
							<div class="card-body event-link d-flex flex-column align-items-start">
								<strong class="d-inline-block mb-2 text-location">World</strong>
								<h3 class="mb-0">
									<a class="title-news" href="#">Featured post</a>
								</h3>
								<div class="mb-1 date-news font-size-70">Nov 12</div>
								<p class="card-text news-sub-title mb-auto">This is a wider card with supporting text below as a natural lead-in to additional content.</p>
								<a class="news-sub-title" href="#">Continue reading</a>
							</div>
						</div>
					</div>
					<div class="col-md-4">
						<div class="card flex-md-row mb-4 shadow-sm h-md-250">
							<div class="card-body event-link d-flex flex-column align-items-start">
								<strong class="d-inline-block mb-2 text-location">World</strong>
								<h3 class="mb-0">
									<a class="title-news" href="#">Featured post</a>
								</h3>
								<div class="mb-1 date-news font-size-70">Nov 12</div>
								<p class="card-text news-sub-title mb-auto">This is a wider card with supporting text below as a natural lead-in to additional content.</p>
								<a class="news-sub-title" href="#">Continue reading</a>
							</div>
						</div>
					</div>
					<div class="col-md-4">
						<div class="card flex-md-row mb-4 shadow-sm h-md-250">
							<div class="card-body event-link d-flex flex-column align-items-start">
								<strong class="d-inline-block mb-2 text-location">World</strong>
								<h3 class="mb-0">
									<a class="title-news" href="#">Featured post</a>
								</h3>
								<div class="mb-1 date-news font-size-70">Nov 12</div>
								<p class="card-text news-sub-title mb-auto">This is a wider card with supporting text below as a natural lead-in to additional content.</p>
								<a class="news-sub-title" href="#">Continue reading</a>
							</div>
						</div>
					</div>
					<div class="col-md-4">
						<div class="card flex-md-row mb-4 shadow-sm h-md-250">
							<div class="card-body event-link d-flex flex-column align-items-start">
								<strong class="d-inline-block mb-2 text-location">World</strong>
								<h3 class="mb-0">
									<a class="title-news" href="#">Featured post</a>
								</h3>
								<div class="mb-1 date-news font-size-70">Nov 12</div>
								<p class="card-text news-sub-title mb-auto">This is a wider card with supporting text below as a natural lead-in to additional content.</p>
								<a class="news-sub-title" href="#">Continue reading</a>
							</div>
						</div>
					</div>
					<div class="col-md-4">
						<div class="card flex-md-row mb-4 shadow-sm h-md-250">
							<div class="card-body event-link d-flex flex-column align-items-start">
								<strong class="d-inline-block mb-2 text-location">World</strong>
								<h3 class="mb-0">
									<a class="title-news" href="#">Featured post</a>
								</h3>
								<div class="mb-1 date-news font-size-70">Nov 12</div>
								<p class="card-text news-sub-title mb-auto">This is a wider card with supporting text below as a natural lead-in to additional content.</p>
								<a class="news-sub-title" href="#">Continue reading</a>
							</div>
						</div>
					</div>
					<div class="col-md-4">
						<div class="card flex-md-row mb-4 shadow-sm h-md-250">
							<div class="card-body event-link d-flex flex-column align-items-start">
								<strong class="d-inline-block mb-2 text-location">World</strong>
								<h3 class="mb-0">
									<a class="title-news" href="#">Featured post</a>
								</h3>
								<div class="mb-1 date-news font-size-70">Nov 12</div>
								<p class="card-text news-sub-title mb-auto">This is a wider card with supporting text below as a natural lead-in to additional content.</p>
								<a class="news-sub-title" href="#">Continue reading</a>
							</div>
						</div>
					</div>
				
				</div>
			</div>
			<!--FIRST FOR ALL AMERICA-->
			<div class="container mt-4" id="social2" style="display:none">
					<div class="row">
					<div class="col-md-4">
						<div class="card flex-md-row mb-4 shadow-sm h-md-250">
							<div class="card-body event-link d-flex flex-column align-items-start">
								<strong class="d-inline-block mb-2 text-location">America</strong>
								<h3 class="mb-0">
									<a class="title-news" href="#">Featured post</a>
								</h3>
								<div class="mb-1 date-news font-size-70">Nov 12</div>
								<p class="card-text news-sub-title mb-auto">This is a wider card with supporting text below as a natural lead-in to additional content.</p>
								<a class="news-sub-title" href="#">Continue reading</a>
							</div>
						</div>
					</div>
					<div class="col-md-4">
						<div class="card flex-md-row mb-4 shadow-sm h-md-250">
							<div class="card-body event-link d-flex flex-column align-items-start">
								<strong class="d-inline-block mb-2 text-location">World</strong>
								<h3 class="mb-0">
									<a class="title-news" href="#">Featured post</a>
								</h3>
								<div class="mb-1 date-news font-size-70">Nov 12</div>
								<p class="card-text news-sub-title mb-auto">This is a wider card with supporting text below as a natural lead-in to additional content.</p>
								<a class="news-sub-title" href="#">Continue reading</a>
							</div>
						</div>
					</div>
					<div class="col-md-4">
						<div class="card flex-md-row mb-4 shadow-sm h-md-250">
							<div class="card-body event-link d-flex flex-column align-items-start">
								<strong class="d-inline-block mb-2 text-location">World</strong>
								<h3 class="mb-0">
									<a class="title-news" href="#">Featured post</a>
								</h3>
								<div class="mb-1 date-news font-size-70">Nov 12</div>
								<p class="card-text news-sub-title mb-auto">This is a wider card with supporting text below as a natural lead-in to additional content.</p>
								<a class="news-sub-title" href="#">Continue reading</a>
							</div>
						</div>
					</div>
					<div class="col-md-4">
						<div class="card flex-md-row mb-4 shadow-sm h-md-250">
							<div class="card-body event-link d-flex flex-column align-items-start">
								<strong class="d-inline-block mb-2 text-location">World</strong>
								<h3 class="mb-0">
									<a class="title-news" href="#">Featured post</a>
								</h3>
								<div class="mb-1 date-news font-size-70">Nov 12</div>
								<p class="card-text news-sub-title mb-auto">This is a wider card with supporting text below as a natural lead-in to additional content.</p>
								<a class="news-sub-title" href="#">Continue reading</a>
							</div>
						</div>
					</div>
					<div class="col-md-4">
						<div class="card flex-md-row mb-4 shadow-sm h-md-250">
							<div class="card-body event-link d-flex flex-column align-items-start">
								<strong class="d-inline-block mb-2 text-location">World</strong>
								<h3 class="mb-0">
									<a class="title-news" href="#">Featured post</a>
								</h3>
								<div class="mb-1 date-news font-size-70">Nov 12</div>
								<p class="card-text news-sub-title mb-auto">This is a wider card with supporting text below as a natural lead-in to additional content.</p>
								<a class="news-sub-title" href="#">Continue reading</a>
							</div>
						</div>
					</div>
					<div class="col-md-4">
						<div class="card flex-md-row mb-4 shadow-sm h-md-250">
							<div class="card-body event-link d-flex flex-column align-items-start">
								<strong class="d-inline-block mb-2 text-location">World</strong>
								<h3 class="mb-0">
									<a class="title-news" href="#">Featured post</a>
								</h3>
								<div class="mb-1 date-news font-size-70">Nov 12</div>
								<p class="card-text news-sub-title mb-auto">This is a wider card with supporting text below as a natural lead-in to additional content.</p>
								<a class="news-sub-title" href="#">Continue reading</a>
							</div>
						</div>
					</div>
				
				</div>
			</div>
			<!--FIRST FOR ALL EUROPE-->
			<div class="container mt-4" id="social3" style="display:none">
					<div class="row">
					<div class="col-md-4">
						<div class="card flex-md-row mb-4 shadow-sm h-md-250">
							<div class="card-body event-link d-flex flex-column align-items-start">
								<strong class="d-inline-block mb-2 text-location">Europe</strong>
								<h3 class="mb-0">
									<a class="title-news" href="#">Featured post</a>
								</h3>
								<div class="mb-1 date-news font-size-70">Nov 12</div>
								<p class="card-text news-sub-title mb-auto">This is a wider card with supporting text below as a natural lead-in to additional content.</p>
								<a class="news-sub-title" href="#">Continue reading</a>
							</div>
						</div>
					</div>
					<div class="col-md-4">
						<div class="card flex-md-row mb-4 shadow-sm h-md-250">
							<div class="card-body event-link d-flex flex-column align-items-start">
								<strong class="d-inline-block mb-2 text-location">World</strong>
								<h3 class="mb-0">
									<a class="title-news" href="#">Featured post</a>
								</h3>
								<div class="mb-1 date-news font-size-70">Nov 12</div>
								<p class="card-text news-sub-title mb-auto">This is a wider card with supporting text below as a natural lead-in to additional content.</p>
								<a class="news-sub-title" href="#">Continue reading</a>
							</div>
						</div>
					</div>
					<div class="col-md-4">
						<div class="card flex-md-row mb-4 shadow-sm h-md-250">
							<div class="card-body event-link d-flex flex-column align-items-start">
								<strong class="d-inline-block mb-2 text-location">World</strong>
								<h3 class="mb-0">
									<a class="title-news" href="#">Featured post</a>
								</h3>
								<div class="mb-1 date-news font-size-70">Nov 12</div>
								<p class="card-text news-sub-title mb-auto">This is a wider card with supporting text below as a natural lead-in to additional content.</p>
								<a class="news-sub-title" href="#">Continue reading</a>
							</div>
						</div>
					</div>
					<div class="col-md-4">
						<div class="card flex-md-row mb-4 shadow-sm h-md-250">
							<div class="card-body event-link d-flex flex-column align-items-start">
								<strong class="d-inline-block mb-2 text-location">World</strong>
								<h3 class="mb-0">
									<a class="title-news" href="#">Featured post</a>
								</h3>
								<div class="mb-1 date-news font-size-70">Nov 12</div>
								<p class="card-text news-sub-title mb-auto">This is a wider card with supporting text below as a natural lead-in to additional content.</p>
								<a class="news-sub-title" href="#">Continue reading</a>
							</div>
						</div>
					</div>
					<div class="col-md-4">
						<div class="card flex-md-row mb-4 shadow-sm h-md-250">
							<div class="card-body event-link d-flex flex-column align-items-start">
								<strong class="d-inline-block mb-2 text-location">World</strong>
								<h3 class="mb-0">
									<a class="title-news" href="#">Featured post</a>
								</h3>
								<div class="mb-1 date-news font-size-70">Nov 12</div>
								<p class="card-text news-sub-title mb-auto">This is a wider card with supporting text below as a natural lead-in to additional content.</p>
								<a class="news-sub-title" href="#">Continue reading</a>
							</div>
						</div>
					</div>
					<div class="col-md-4">
						<div class="card flex-md-row mb-4 shadow-sm h-md-250">
							<div class="card-body event-link d-flex flex-column align-items-start">
								<strong class="d-inline-block mb-2 text-location">World</strong>
								<h3 class="mb-0">
									<a class="title-news" href="#">Featured post</a>
								</h3>
								<div class="mb-1 date-news font-size-70">Nov 12</div>
								<p class="card-text news-sub-title mb-auto">This is a wider card with supporting text below as a natural lead-in to additional content.</p>
								<a class="news-sub-title" href="#">Continue reading</a>
							</div>
						</div>
					</div>
				
				</div>
			</div>
			<!--FIRST FOR ALL ASIA-->
			<div class="container mt-4" id="social4" style="display:none">
				<div class="row">
					<div class="col-md-4">
						<div class="card flex-md-row mb-4 shadow-sm h-md-250">
							<div class="card-body event-link d-flex flex-column align-items-start">
								<strong class="d-inline-block mb-2 text-location">Asia</strong>
								<h3 class="mb-0">
									<a class="title-news" href="#">Featured post</a>
								</h3>
								<div class="mb-1 date-news font-size-70">Nov 12</div>
								<p class="card-text news-sub-title mb-auto">This is a wider card with supporting text below as a natural lead-in to additional content.</p>
								<a class="news-sub-title" href="#">Continue reading</a>
							</div>
						</div>
					</div>
					<div class="col-md-4">
						<div class="card flex-md-row mb-4 shadow-sm h-md-250">
							<div class="card-body event-link d-flex flex-column align-items-start">
								<strong class="d-inline-block mb-2 text-location">World</strong>
								<h3 class="mb-0">
									<a class="title-news" href="#">Featured post</a>
								</h3>
								<div class="mb-1 date-news font-size-70">Nov 12</div>
								<p class="card-text news-sub-title mb-auto">This is a wider card with supporting text below as a natural lead-in to additional content.</p>
								<a class="news-sub-title" href="#">Continue reading</a>
							</div>
						</div>
					</div>
					<div class="col-md-4">
						<div class="card flex-md-row mb-4 shadow-sm h-md-250">
							<div class="card-body event-link d-flex flex-column align-items-start">
								<strong class="d-inline-block mb-2 text-location">World</strong>
								<h3 class="mb-0">
									<a class="title-news" href="#">Featured post</a>
								</h3>
								<div class="mb-1 date-news font-size-70">Nov 12</div>
								<p class="card-text news-sub-title mb-auto">This is a wider card with supporting text below as a natural lead-in to additional content.</p>
								<a class="news-sub-title" href="#">Continue reading</a>
							</div>
						</div>
					</div>
					<div class="col-md-4">
						<div class="card flex-md-row mb-4 shadow-sm h-md-250">
							<div class="card-body event-link d-flex flex-column align-items-start">
								<strong class="d-inline-block mb-2 text-location">World</strong>
								<h3 class="mb-0">
									<a class="title-news" href="#">Featured post</a>
								</h3>
								<div class="mb-1 date-news font-size-70">Nov 12</div>
								<p class="card-text news-sub-title mb-auto">This is a wider card with supporting text below as a natural lead-in to additional content.</p>
								<a class="news-sub-title" href="#">Continue reading</a>
							</div>
						</div>
					</div>
					<div class="col-md-4">
						<div class="card flex-md-row mb-4 shadow-sm h-md-250">
							<div class="card-body event-link d-flex flex-column align-items-start">
								<strong class="d-inline-block mb-2 text-location">World</strong>
								<h3 class="mb-0">
									<a class="title-news" href="#">Featured post</a>
								</h3>
								<div class="mb-1 date-news font-size-70">Nov 12</div>
								<p class="card-text news-sub-title mb-auto">This is a wider card with supporting text below as a natural lead-in to additional content.</p>
								<a class="news-sub-title" href="#">Continue reading</a>
							</div>
						</div>
					</div>
					<div class="col-md-4">
						<div class="card flex-md-row mb-4 shadow-sm h-md-250">
							<div class="card-body event-link d-flex flex-column align-items-start">
								<strong class="d-inline-block mb-2 text-location">World</strong>
								<h3 class="mb-0">
									<a class="title-news" href="#">Featured post</a>
								</h3>
								<div class="mb-1 date-news font-size-70">Nov 12</div>
								<p class="card-text news-sub-title mb-auto">This is a wider card with supporting text below as a natural lead-in to additional content.</p>
								<a class="news-sub-title" href="#">Continue reading</a>
							</div>
						</div>
					</div>
				
				</div>
			</div>
			<!--FIRST FOR ALL AUSTRALIA-->
			<div class="container mt-4" id="social5" style="display:none">
					<div class="row">
					<div class="col-md-4">
						<div class="card flex-md-row mb-4 shadow-sm h-md-250">
							<div class="card-body event-link d-flex flex-column align-items-start">
								<strong class="d-inline-block mb-2 text-location">Australia</strong>
								<h3 class="mb-0">
									<a class="title-news" href="#">Featured post</a>
								</h3>
								<div class="mb-1 date-news font-size-70">Nov 12</div>
								<p class="card-text news-sub-title mb-auto">This is a wider card with supporting text below as a natural lead-in to additional content.</p>
								<a class="news-sub-title" href="#">Continue reading</a>
							</div>
						</div>
					</div>
					<div class="col-md-4">
						<div class="card flex-md-row mb-4 shadow-sm h-md-250">
							<div class="card-body event-link d-flex flex-column align-items-start">
								<strong class="d-inline-block mb-2 text-location">World</strong>
								<h3 class="mb-0">
									<a class="title-news" href="#">Featured post</a>
								</h3>
								<div class="mb-1 date-news font-size-70">Nov 12</div>
								<p class="card-text news-sub-title mb-auto">This is a wider card with supporting text below as a natural lead-in to additional content.</p>
								<a class="news-sub-title" href="#">Continue reading</a>
							</div>
						</div>
					</div>
					<div class="col-md-4">
						<div class="card flex-md-row mb-4 shadow-sm h-md-250">
							<div class="card-body event-link d-flex flex-column align-items-start">
								<strong class="d-inline-block mb-2 text-location">World</strong>
								<h3 class="mb-0">
									<a class="title-news" href="#">Featured post</a>
								</h3>
								<div class="mb-1 date-news font-size-70">Nov 12</div>
								<p class="card-text news-sub-title mb-auto">This is a wider card with supporting text below as a natural lead-in to additional content.</p>
								<a class="news-sub-title" href="#">Continue reading</a>
							</div>
						</div>
					</div>
					<div class="col-md-4">
						<div class="card flex-md-row mb-4 shadow-sm h-md-250">
							<div class="card-body event-link d-flex flex-column align-items-start">
								<strong class="d-inline-block mb-2 text-location">World</strong>
								<h3 class="mb-0">
									<a class="title-news" href="#">Featured post</a>
								</h3>
								<div class="mb-1 date-news font-size-70">Nov 12</div>
								<p class="card-text news-sub-title mb-auto">This is a wider card with supporting text below as a natural lead-in to additional content.</p>
								<a class="news-sub-title" href="#">Continue reading</a>
							</div>
						</div>
					</div>
					<div class="col-md-4">
						<div class="card flex-md-row mb-4 shadow-sm h-md-250">
							<div class="card-body event-link d-flex flex-column align-items-start">
								<strong class="d-inline-block mb-2 text-location">World</strong>
								<h3 class="mb-0">
									<a class="title-news" href="#">Featured post</a>
								</h3>
								<div class="mb-1 date-news font-size-70">Nov 12</div>
								<p class="card-text news-sub-title mb-auto">This is a wider card with supporting text below as a natural lead-in to additional content.</p>
								<a class="news-sub-title" href="#">Continue reading</a>
							</div>
						</div>
					</div>
					<div class="col-md-4">
						<div class="card flex-md-row mb-4 shadow-sm h-md-250">
							<div class="card-body event-link d-flex flex-column align-items-start">
								<strong class="d-inline-block mb-2 text-location">World</strong>
								<h3 class="mb-0">
									<a class="title-news" href="#">Featured post</a>
								</h3>
								<div class="mb-1 date-news font-size-70">Nov 12</div>
								<p class="card-text news-sub-title mb-auto">This is a wider card with supporting text below as a natural lead-in to additional content.</p>
								<a class="news-sub-title" href="#">Continue reading</a>
							</div>
						</div>
					</div>
				
				</div>
			</div>
			<!--FIRST FOR ALL AFRICA-->
			<div class="container mt-4" id="social6" style="display:none">
					<div class="row">
					<div class="col-md-4">
						<div class="card flex-md-row mb-4 shadow-sm h-md-250">
							<div class="card-body event-link d-flex flex-column align-items-start">
								<strong class="d-inline-block mb-2 text-location">Africa</strong>
								<h3 class="mb-0">
									<a class="title-news" href="#">Featured post</a>
								</h3>
								<div class="mb-1 date-news font-size-70">Nov 12</div>
								<p class="card-text news-sub-title mb-auto">This is a wider card with supporting text below as a natural lead-in to additional content.</p>
								<a class="news-sub-title" href="#">Continue reading</a>
							</div>
						</div>
					</div>
					<div class="col-md-4">
						<div class="card flex-md-row mb-4 shadow-sm h-md-250">
							<div class="card-body event-link d-flex flex-column align-items-start">
								<strong class="d-inline-block mb-2 text-location">World</strong>
								<h3 class="mb-0">
									<a class="title-news" href="#">Featured post</a>
								</h3>
								<div class="mb-1 date-news font-size-70">Nov 12</div>
								<p class="card-text news-sub-title mb-auto">This is a wider card with supporting text below as a natural lead-in to additional content.</p>
								<a class="news-sub-title" href="#">Continue reading</a>
							</div>
						</div>
					</div>
					<div class="col-md-4">
						<div class="card flex-md-row mb-4 shadow-sm h-md-250">
							<div class="card-body event-link d-flex flex-column align-items-start">
								<strong class="d-inline-block mb-2 text-location">World</strong>
								<h3 class="mb-0">
									<a class="title-news" href="#">Featured post</a>
								</h3>
								<div class="mb-1 date-news font-size-70">Nov 12</div>
								<p class="card-text news-sub-title mb-auto">This is a wider card with supporting text below as a natural lead-in to additional content.</p>
								<a class="news-sub-title" href="#">Continue reading</a>
							</div>
						</div>
					</div>
					<div class="col-md-4">
						<div class="card flex-md-row mb-4 shadow-sm h-md-250">
							<div class="card-body event-link d-flex flex-column align-items-start">
								<strong class="d-inline-block mb-2 text-location">World</strong>
								<h3 class="mb-0">
									<a class="title-news" href="#">Featured post</a>
								</h3>
								<div class="mb-1 date-news font-size-70">Nov 12</div>
								<p class="card-text news-sub-title mb-auto">This is a wider card with supporting text below as a natural lead-in to additional content.</p>
								<a class="news-sub-title" href="#">Continue reading</a>
							</div>
						</div>
					</div>
					<div class="col-md-4">
						<div class="card flex-md-row mb-4 shadow-sm h-md-250">
							<div class="card-body event-link d-flex flex-column align-items-start">
								<strong class="d-inline-block mb-2 text-location">World</strong>
								<h3 class="mb-0">
									<a class="title-news" href="#">Featured post</a>
								</h3>
								<div class="mb-1 date-news font-size-70">Nov 12</div>
								<p class="card-text news-sub-title mb-auto">This is a wider card with supporting text below as a natural lead-in to additional content.</p>
								<a class="news-sub-title" href="#">Continue reading</a>
							</div>
						</div>
					</div>
					<div class="col-md-4">
						<div class="card flex-md-row mb-4 shadow-sm h-md-250">
							<div class="card-body event-link d-flex flex-column align-items-start">
								<strong class="d-inline-block mb-2 text-location">World</strong>
								<h3 class="mb-0">
									<a class="title-news" href="#">Featured post</a>
								</h3>
								<div class="mb-1 date-news font-size-70">Nov 12</div>
								<p class="card-text news-sub-title mb-auto">This is a wider card with supporting text below as a natural lead-in to additional content.</p>
								<a class="news-sub-title" href="#">Continue reading</a>
							</div>
						</div>
					</div>
				
				</div>
			</div>	
		</div>
		<hr class="container-fluid mb-0 mt-4" style="width:50%">
		
		<!--LINE FOR THE FEATURED SHOW the picture must be width:350 height:120 -->
		<div class="container-fluid" style="background-color:RGBA(40, 2, 22, 1.00);">	
			<div class="row justify-content-center p-0">
				<p class="banner-title p-2 m-0">Feautured shows</p>
			</div>
			<div class="row" style="background-color:RGBA(102, 2, 22, 1.00);">
				<section class="container center slider">
					<?php foreach ($showPicture as $showPicMain): ?>
						<div>
							<div class="col p-0 m-0">
								<img  class="align-middle" src="img/poster-square130x130/<?php echo $showPicMain['show_pic']; ?>" width="200" height="150">
								<div class="row mx-auto justify-content-center"><p class="text-center"></p></div>
							</div>
						</div>
					<?php endforeach; ?>
				</section>
			</div>
		</div>
		<div class="container mt-0">
			<div class="row">
				<div class="container my-5">
					<div class="row p-2">
						<div class="col mx-2 max-height-35vw"> 
							<div class="row my-3 h4 text-center">
								<div class="container-fluid">
									<a href="#" class="row my-2 mx-2 titleSection align-content-center view-all-home">
										<p class="col p-1 mx-2 my-0 montserrat">Opening Soon</p>
										<i class="col-1 container far fa-plus-square p-0 m-0 my-auto right-button-plus"></i>
									</a>
								</div>
							</div>
							<div class="container max-height-27vw">
								<?php foreach ($showOpeningDate as $openingDateShowList): ?>
									<div class="row m-0 p-1 align-items-center" min-heigth="50">
										<!--<div class="col-2 m-1 p-0" width="50" height="70">
										<img width="50" height="70" src="img/50x70.png" alt="logo">
										</div>  -->
										<div class="col m-1 small"><?php echo $openingDateShowList['show_title']; ?> <br><?php echo $openingDateShowList['production_name']; ?></div>
										<div class="col-2 m-1 p-0">
											<p class="m-0 p-0"><?php echo $openingDateShowList['production_opening']; ?></p>
										</div>
									</div>
									<hr class="container mt-2 mb-2" style="width:50%">
								<?php endforeach; ?>
							</div>
						</div>
						<div class="col mx-2 max-height-35vw left-line">
							<div class="row my-3 h4 text-center">
								<div class="container-fluid">
									<a href="#" class="row my-2 mx-2 titleSection align-content-center view-all-home">
										<p class="col p-1 mx-2 my-0 montserrat">
										Closing Soon
										</p>
										<i class="col-1 container far fa-plus-square p-0 m-0 my-auto right-button-plus"></i>
									</a>
								</div>
							</div>
							
							<div class="container max-height-27vw">
								<?php foreach ($showClosingDate as $closingDateShowList): ?>
									<div class="row m-0 p-1 align-items-center" min-heigth="50">
									<!--<div class="col-2 m-1 p-0" width="50" height="70">
									<img width="50" height="70" src="img/50x70.png" alt="logo">
									</div>  -->
										<div class="col m-1 small"><?php echo $closingDateShowList['show_title']; ?> <br><?php echo $closingDateShowList['production_name']; ?></div>
										<div class="col-2 m-1 p-0">
											<p class="m-0 p-0"><?php echo $closingDateShowList['production_opening']; ?></p>
										</div>
									</div>
									<hr class="container mt-2 mb-2" style="width:50%">
								<?php endforeach; ?>

							</div>
						</div>
					<div class="col mx-2 max-height-35vw left-line"> 
					<div class="row my-3 h4 text-center">
					<div class="container-fluid">
						<a href="#" class="row my-2 mx-2 titleSection align-content-center view-all-home">
							<p class="col p-1 mx-2 my-0 montserrat">Calendar</p>
							<i class="col-1 container far fa-plus-square p-0 m-0 my-auto right-button-plus"></i>
						</a>
					</div>
					</div>
					<div class="container max-height-27vw">
					<!--Row for today's event-->
					<div class="row day-group container m-0 p-1 align-items-center" min-height="50">
					  <div class="row container-fluid day-title">Today, 6th June</div>
					  <div class="row container m-0">
						<a class="row" href="#">
						  <div class="col"><i class="fas fa-birthday-cake"></i></div>
						  <div class="col">Name/Event</div>
						  </a>
						</div>              
					  </div>
					<div class="row day-group container m-0 p-1 align-items-center" min-height="50">
					  <div class="row container-fluid day-title">Tomorrow, 7th June</div>
					  <div class="row container m-0">
						<a class="row" href="#">
						  <div class="col"><i class="far fa-calendar-alt"></i></div>
						  <div class="col">Name/Event</div>
						  </a>
						</div>
					  <div class="row container m-0">
						<a class="row" href="#">
						  <div class="col"><i class="fas fa-birthday-cake"></i></div>
						  <div class="col">Name/Event</div>
						  </a>
						</div>
					  <div class="row container m-0">
						<a class="row" href="#">
						  <div class="col"><i class="far fa-calendar-alt"></i></div>
						  <div class="col">Name/Event</div>
						  </a>
						</div>
					  <div class="row container m-0">
						<a class="row" href="#">
						  <div class="col"><i class="far fa-calendar-alt"></i></div>
						  <div class="col">Name/Event</div>
						  </a>
						</div>
						</div>
						<div class="row day-group container m-0 p-1 align-items-center" min-height="50">
						<div class="row container-fluid day-title">Friday, 8th June</div>
					  <div class="row container m-0">
						<a class="row" href="#">
						  <div class="col"><i class="fas fa-birthday-cake"></i></div>
						  <div class="col">Name/Event</div>
						  </a>
						</div>
					  <div class="row container m-0">
						<a class="row" href="#">
						  <div class="col"><i class="fas fa-birthday-cake"></i></div>
						  <div class="col">Name/Event</div>
						  </a>
						</div>
					  <div class="row container m-0">
						<a class="row" href="#">
						  <div class="col"><i class="fas fa-birthday-cake"></i></div>
						  <div class="col">Name/Event</div>
						  </a>
						</div>
					  <div class="row container m-0">
						<a class="row" href="#">
						  <div class="col"><i class="fas fa-birthday-cake"></i></div>
						  <div class="col">Name/Event</div>
						  </a>
						</div>
					  <div class="row container m-0">
						<a class="row" href="#">
						  <div class="col"><i class="fas fa-birthday-cake"></i></div>
						  <div class="col">Name/Event</div>
						  </a>
						</div>
					  <div class="row container m-0">
						<a class="row" href="#">
						  <div class="col"><i class="fas fa-birthday-cake"></i></div>
						  <div class="col">Name/Event</div>
						  </a>
						</div>
					  <div class="row container m-0">
						<a class="row" href="#">
						  <div class="col"><i class="fas fa-birthday-cake"></i></div>
						  <div class="col">Name/Event</div>
						  </a>
						</div>  
					  </div>
					</div>
					</div>
					</div>
				</div>
			</div>
		</div>
		<div class="container-fluid full-banner">
			<img src="img/full-width-banner.png" class="full-banner m-0 p-0" alt="banner" height="250" overflow="hidden" >
		</div>
		<!--row for all the section show review, performr container and theatre container-->
		<div class="container mt-5">	
			<div class="row">
				<!-- COLUMN FOR SHOW REVIEW-->
				<div class="col"> 
					<div class="row my-3 h4 text-center">
						<div class="container-fluid">
							<a href="#" class="row my-2 mx-2 titleSection align-content-center view-all-home">
								<p class="col p-1 mx-2 my-0 montserrat">Production</p>
								<i class="col-1 container far fa-plus-square p-0 m-0 my-auto right-button-plus"></i>
							</a>
						</div>
					</div>
					<!--row for all the detail of the show related-->
					<!--<div class="row container p-3 show-review">
						<div class="row container-fluid">
							<div class="container-fluid">
							Harry Potter and the Cursed Child
							</div>
						</div>	
						<div class="row container font-size-70">
							<div class="col p-0">
							<p class="author-reviews">author</p>
							</div>
							<div class="col-3 p-0">
								<p>date</p>
							</div>
							<div class="col-3 p-0 align-content-between">
                              <div class="row">
                                <div class=" rating-show-fixed"><i class="fas fa-star"></i></div> <!--full star-->
                               <!-- <div class=" rating-show-fixed"><i class="fal fa-star"></i></div><!--empty star-->
                                <!--<div class=" rating-show-fixed"><i class="far fa-star"></i></div> <!--empty star-->
                                <!--<div class=" rating-show-fixed"><i class="far fa-star-half"></i></div> <!--half empty star-->
                                <!--<div class=" rating-show-fixed"><i class="fas fa-star"></i></div>
                              </div>
							</div>
						</div>
						<div class="row container-fluid font-size-70 p-0 m-0">
							<p class="m-0">Comment here related to the show, not more than a certain amount of characters as it cannot be too long, to fit the space predefined</p>
						</div>
					</div>-->
					
                    <div class="row mx-3">
                        <div class="container-fluid mt-4">
							<a href="#" class="row ">
								<div class="col">
									<div class="row">
										<div class="container">
											<img src="img/poster-square130x130/harry-potter-and-the-cursed-child.jpg" alt="headshot" height="130" width="130">
										</div>
									</div>
								</div>
								<div class="col">
									<div class="row"><p class="title-card-production p-0 m-0">Harry Potter and the cursed Child</p></div>
									<div class="row small"><p class="location-card-production p-0 m-0">London</p></div>
									<div class="row font-size-80">
										<div class="col-1"><i class="star-card-prod fas fa-star p-0 mr-2"></i></div>
										<div class="col star-card-prod p-0 m-0">4.75/5</div>
									</div>
									<div class="row font-size-80">
										<div class="col-1"><i class="fav-card-prod fas fa-heart p-0 mr-2"></i></div>
										<div class="col fav-card-prod p-0 m-0">1,250</div>
									</div>
									<div class="row bottom-div">
										<div class="col-1 m-o"><i class="fb-card-prod font-size-120 fab fa-facebook-square"></i></div>
										<div class="col-1 m-0"><i class="tw-card-prod font-size-120 fab fa-twitter-square"></i></div>
										<div class="col-1 m-0 rainbow"><i class="ig-card-prod font-size-120 p-0 fab fa-instagram"></i></div>
										<div class="col-1 m-0"><i class="yt-card-prod font-size-120 fab fa-youtube-square"></i></div>
										<!--<div class="col-2 m-0"><i class="fab fa-snapchat-square"></i></div> -->
									</div>
								</div>
							</a>
							<hr>
						<a href="#" class="row">
			                <div class="col">
			                    <div class="row">
				                    <div class="container">
				                        <img src="img/poster-square130x130/dear-evan-hansen.jpg" alt="headshot" height="130" width="130">
			                        </div>
		                        </div>
		                    </div>
			                <div class="col">
			                    <div class="row"><p class="title-card-production p-0 m-0">Dear Evan Hansen</p></div>
			                    <div class="row small"><p class="location-card-production p-0 m-0">New York</p></div>
								<div class="row font-size-80">
									<div class="col-1"><i class="star-card-prod fas fa-star p-0 mr-2"></i></div>
									<div class="col star-card-prod p-0 m-0">4.75/5</div>
								</div>
								<div class="row font-size-80">
									<div class="col-1"><i class="fav-card-prod fas fa-heart p-0 mr-2"></i></div>
									<div class="col fav-card-prod p-0 m-0">1,250</div>
								</div>
								<div class="row bottom-div">
									<div class="col-1 m-o"><i class="fb-card-prod font-size-120 fab fa-facebook-square"></i></div>
									<div class="col-1 m-0"><i class="tw-card-prod font-size-120 fab fa-twitter-square"></i></div>
									<div class="col-1 m-0 rainbow"><i class="ig-card-prod font-size-120 p-0 fab fa-instagram"></i></div>
									<div class="col-1 m-0"><i class="yt-card-prod font-size-120 fab fa-youtube-square"></i></div>
									<!--<div class="col-2 m-0"><i class="fab fa-snapchat-square"></i></div> -->
								</div>
		                    </div>
	                    </a>
                      </div>
                  </div>
				</div>

				<div class="col left-line">
					<div class="row my-3 h4 text-center">
						<div class="container-fluid">
							<a href="#" class="row my-2 mx-2 titleSection align-content-center view-all-home">
								<p class="col p-1 mx-2 my-0 montserrat">Performer</p>
								<i class="col-1 container far fa-plus-square p-0 m-0 my-auto right-button-plus"></i>
							</a>
						</div>
					</div>
					<div class="row mx-3">
						<div class="container-fluid mt-4">
							<!-- template below for the details-->
		                <a href="#" class="row">
			                <div class="col">
			                    <div class="row">
				                    <div class="container">
				                        <img src="img/headshot-square-130x130/ben-platt.jpg" alt="headshot" height="130" width="130">
			                        </div>
		                        </div>
		                    </div>
			                <div class="col">
			                    <div class="row"><p class="title-card-production m-0 p-0">Ben Platt</p></div>
			                    <div class="row small"><p class="location-card-production p-0 m-0">33</p></div>
								<div class="row font-size-80">
									<div class="col-1"><i class="star-card-prod fas fa-star"></i></div>
									<div class="col star-card-prod">4.95/5</div>
								</div>
								<div class="row font-size-80">
									<div class="col-1"><i class="fav-card-prod fas fa-heart"></i></div>
									<div class="col fav-card-prod">1.325.253</div>
								</div>
			                    <div class="row bottom-div">
									<div class="col-1 m-o"><i class="fb-card-prod font-size-120 fab fa-facebook-square"></i></div>
									<div class="col-1 m-0"><i class="tw-card-prod font-size-120 fab fa-twitter-square"></i></div>
									<div class="col-1 m-0 rainbow"><i class="ig-card-prod font-size-120 p-0 fab fa-instagram"></i></div>
									<div class="col-1 m-0"><i class="yt-card-prod font-size-120 fab fa-youtube-square"></i></div>
									<!--<div class="col-2 m-0"><i class="fab fa-snapchat-square"></i></div> -->
								</div>
		                    </div>
	                    </a>
						<hr>
						<a href="#" class="row">
			                <div class="col">
			                    <div class="row">
				                    <div class="container">
				                        <img src="img/headshot-square-130x130/cassandra-mccowan-300x300.jpg" alt="headshot" height="130" width="130">
			                        </div>
		                        </div>
		                    </div>
			                <div class="col">
			                    <div class="row"><p class="title-card-production m-0 p-0">Cassandra McCowan</p></div>
			                    <div class="row small"><p class="location-card-production p-0 m-0">26</p></div>
								<div class="row font-size-80">
									<div class="col-1"><i class="star-card-prod fas fa-star"></i></div>
									<div class="col star-card-prod">4.75/5</div>
								</div>
								<div class="row font-size-80">
									<div class="col-1"><i class="fav-card-prod fas fa-heart"></i></div>
									<div class="col fav-card-prod">1.365</div>
								</div>
			                    <div class="row bottom-div">
									<div class="col-1 m-o"><i class="fb-card-prod font-size-120 fab fa-facebook-square"></i></div>
									<div class="col-1 m-0"><i class="tw-card-prod font-size-120 fab fa-twitter-square"></i></div>
									<div class="col-1 m-0 rainbow"><i class="ig-card-prod font-size-120 p-0 fab fa-instagram"></i></div>
									<div class="col-1 m-0"><i class="yt-card-prod font-size-120 fab fa-youtube-square"></i></div>
									<!--<div class="col-2 m-0"><i class="fab fa-snapchat-square"></i></div> -->
								</div>
		                    </div>
	                    </a>
	              </div>
					</div>
				</div>

				<div class="col left-line">
					<div class="row my-3 h4 text-center">
						<div class="container-fluid">
							<a href="#" class="row my-2 mx-2 titleSection align-content-center view-all-home">
								<p class="col p-1 mx-2 my-0 montserrat">Theatre</p>
								<i class="col-1 container far fa-plus-square p-0 m-0 my-auto right-button-plus"></i>
							</a>
						</div>
					</div>
					<div class="row mx-3">
						<div class="container-fluid mt-4">
		                <div class="row">
			                <div class="col">
			                    <div class="row">
				                    <div class="container">
				                        <img src="img/theatre-square-130x130/victoria-palace-theatre-london-348x348.jpg" alt="headshot" height="130" width="130">
			                        </div>
		                        </div>
		                    </div>
			                <div class="col">
			                    <div class="row"><p class="title-card-production m-0 p-0">Victoria Palace Theatre</p></div>
			                    <div class="row small"><p class="location-card-production p-0 m-0">London</p></div>
								<div class="row font-size-80">
									<div class="col-1"><i class="star-card-prod fas fa-star"></i></div>
									<div class="col star-card-prod">4.75/5</div>
								</div>
								<div class="row font-size-80">
									<div class="col-1"><i class="fav-card-prod fas fa-heart"></i></div>
									<div class="col fav-card-prod">1.365.257</div>
								</div>
			                    <div class="row bottom-div">
									<div class="col-1 m-o"><i class="fb-card-prod font-size-120 fab fa-facebook-square"></i></div>
									<div class="col-1 m-0"><i class="tw-card-prod font-size-120 fab fa-twitter-square"></i></div>
									<div class="col-1 m-0 rainbow"><i class="ig-card-prod font-size-120 p-0 fab fa-instagram"></i></div>
									<div class="col-1 m-0"><i class="yt-card-prod font-size-120 fab fa-youtube-square"></i></div>
									<!--<div class="col-2 m-0"><i class="fab fa-snapchat-square"></i></div> -->
								</div>
		                    </div>
	                    </div>
						<hr>
						<div class="row">
			                <div class="col">
			                    <div class="row">
				                    <div class="container">
				                        <img src="img/theatre-square-130x130/the-other-palace-theatre-750x450.jpg" alt="headshot" height="130" width="130">
			                        </div>
		                        </div>
		                    </div>
			                <div class="col">
			                    <div class="row"><p class="title-card-production m-0 p-0">The Other Palace</p></div>
			                    <div class="row small"><p class="location-card-production p-0 m-0">London</p></div>
								<div class="row font-size-80">
									<div class="col-1"><i class="star-card-prod fas fa-star"></i></div>
									<div class="col star-card-prod">4.75/5</div>
								</div>
								<div class="row font-size-80">
									<div class="col-1"><i class="fav-card-prod fas fa-heart"></i></div>
									<div class="col fav-card-prod">875.254</div>
								</div>
			                    <div class="row bottom-div">
									<div class="col-1 m-o"><i class="fb-card-prod font-size-120 fab fa-facebook-square"></i></div>
									<div class="col-1 m-0"><i class="tw-card-prod font-size-120 fab fa-twitter-square"></i></div>
									<div class="col-1 m-0 rainbow"><i class="ig-card-prod font-size-120 p-0 fab fa-instagram"></i></div>
									<div class="col-1 m-0"><i class="yt-card-prod font-size-120 fab fa-youtube-square"></i></div>
									<!--<div class="col-2 m-0"><i class="fab fa-snapchat-square"></i></div> -->
								</div>
		                    </div>
	                    </div>
	              </div>
					</div>
				</div>

			</div>
		</div>



	
</main>
	<footer class="container-fluid mt-4 pt-4 karla">
		<div class="row text-center">
			<div class="col"><p class="container text-center">Who We Are</p></div>
			<div class="col white-left-line">
				<div class="row"><p class="container text-center">Help Us</p></div>
				<div class="row container mt-2">
					<p class="container text-center small">If you have any advice or you see that some details are wrong, do not hesitate to contact us and let us know what we should implement, or change about the website</p>
					
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
  <script src="./slick/slick.js" type="text/javascript" charset="utf-8"></script>
  <script type="text/javascript">
    $(document).on('ready', function() {
      $(".regular").slick({
        dots: true,
        infinite: true,
        slidesToShow: 5,
        slidesToScroll: 1
      });
      $(".center").slick({
        dots: true,
        infinite: true,
        centerMode: true,
        slidesToShow: 5,
        slidesToScroll: 1
      });
		$(".regular-double").slick({
        dots: true,
        infinite: true,
        slidesToShow: 2,
        slidesToScroll: 1
      });
	
      $(".variable").slick({
        dots: true,
        infinite: true,
        variableWidth: true
      });
      $(".lazy").slick({
        lazyLoad: 'ondemand', // ondemand progressive anticipated
        infinite: true
      });
    });
</script>
	
	
	
	
	
</body>
</html>