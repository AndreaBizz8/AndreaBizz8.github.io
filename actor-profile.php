<?php
/*DATABASE CONNECTION*/
require_once('database.php');

/*SELECTING DETAILS OF THE ACTORS*/
$queryActor = 'SELECT * FROM actor WHERE actor_ID = 2';
$statement = $db->prepare($queryActor);
$statement->execute();
$actorInfo = $statement->fetch();
$statement->closeCursor();

/*SELECTING DETAILS OF THE ACTORS' SKILL*/
$queryActorSkill = 'SELECT actor_skill.actor_skill_ID, actor_skill.actor_ID, actor_skill.skill_ID, skill.skills_name, actor_skill.level_name_ID, level_name.level_name_type
FROM actor_skill
INNER JOIN skill ON skill.skill_ID = actor_skill.skill_ID
INNER JOIN level_name ON level_name.level_name_ID = actor_skill.level_name_ID
WHERE actor_ID = 2
GROUP BY actor_skill_ID';
$statement2 = $db->prepare($queryActorSkill);
$statement2->execute();
$actorInfoSkill = $statement2->fetchAll();
$statement2->closeCursor();

/*SELECTING DETAILS OF THE ACTORS' LANGUAGES*/
$queryActorLanguage = 'SELECT actor_language.actor_language_ID, actor_language.language_ID, language.language_name
FROM actor_language
INNER JOIN language ON language.language_ID = actor_language.language_ID
WHERE actor_ID = 2
GROUP BY actor_language_ID';
$statement3 = $db->prepare($queryActorLanguage);
$statement3->execute();
$actorInfoLanguage = $statement3->fetchAll();
$statement3->closeCursor();

/*SELECTING DETAILS OF THE ACTORS' ACCENT*/
$queryActorAccent = 'SELECT actor_accent.actor_accent_ID, actor_accent.accent_ID, accent.accent_name
FROM actor_accent
INNER JOIN accent ON accent.accent_ID = actor_accent.accent_ID
WHERE actor_ID = 2
GROUP BY actor_accent_ID';
$statement3 = $db->prepare($queryActorAccent);
$statement3->execute();
$actorInfoAccent = $statement3->fetchAll();
$statement3->closeCursor();
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
		<link href="css/bootstrap.min.css" rel="stylesheet" type="text/css"> <!--STYLESHEET FOR BOOTSTRAP-->
		
		<!--JAAVASCRIPT FOR THE BUTTONS FEEDS -->
		<script>
		var socials = ["social1", "social2","social3","social4"]
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
		<!--JAAVASCRIPT FOR THE BUTTONS WORK EXPERIENCE -->
		<script>
		var experiences = ["experience1", "experience2","experience3"]
		function selectWorkExperience(s, event){
			for (var experience in experiences) {
				if (experience != s) {
					document.getElementById(experiences[experience]).style.display = "none";
					document.getElementById("btn"+experiences[experience]).style.background = "rgba(40, 2, 22, 1.00)";
					document.getElementById("btn"+experiences[experience]).style.color = "white";
				}
			}
			document.getElementById(s).style.display = "block";
			document.getElementById("btn"+s).style.background = "rgba(143, 27, 50, 1.00)";	
		}
		</script>
		<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
		
		<title>Actor</title>
	</head>

<body>
	<header class="fixed-top">
		<nav class="navbar navbar-nav navbar-expand-md fixed-top mb-4 px-3" style="line-height: 100px">
			<a class="navbar-brand" href="#">
				<img src="img/logo.png" alt="logo" width="300">
			</a>
			<div id="navbarCollapse" class="collapse navbar-collapse container-fluid float-right">
				<ul class="navbar navbar-nav mr-auto align-items-end container align-items-center">
					<li class="nav-item mx-2"><a class="nav-link font-size-180" data-toggle="collapse" href="#navbar-header-search" role="button" aria-expanded="false" aria-controls="navbar-header-search"><i class="fas fa-search"></i></a></li>
					<li class="nav-item mx-2"><a class="nav-link" href="news.html">News</a></li>
					<li class="nav-item mx-2"><a class="nav-link" href="theatre.html">Theatre</a></li>
					<li class="nav-item mx-2"><a class="nav-link" href="production.html">Production</a></li>
					<li class="nav-item mx-2"><a class="nav-link" href="calendar.html">Calendar</a></li>
					<li class="nav-item mx-2"><a class="nav-link" href="#"><i class="fas fa-sign-in-alt font-size-150"></i> Login</a></li>
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
		<!--line for title, address, rating and favorite-->
		<div class="container mt-3 pt-0 mb-2">
			<div class="row">
			  <div class="col mr-3">
					<div class="row">
						<div class="col h4 paragraphTitle"><?php echo $actorInfo['actor_name']; ?> <?php echo $actorInfo['actor_lastname']; ?></div>
						<div class="col-2 text-right">(age)</div>
					</div>
					<div class="row">
						<div class="col-4 mx-3">
							<img src="img/actor-profile/<?php echo $actorInfo['actor_profile_pic']; ?>" alt="user-avatar" height="200" width="200">
						</div>
						<div class="col mx-3">
							<div class="row"><?php echo $actorInfo['actor_dob']; ?></div>
							<div class="row small"><?php echo $actorInfo['actor_pob']; ?></div>
							<div class="row"><?php echo $actorInfo['gender_ID']; ?></div>
							<div class="row"><?php echo $actorInfo['actor_height']; ?> cm</div>
							<div class="row">Country (State - Region)</div>
							<div class="row">School Attended (State - Region)</div>
							<div class="row"><?php echo $actorInfo['actor_website']; ?></div>
						</div>
					</div>
					<div class="row">
						<div class="col">
							<div class="container-fluid mt-2 p-2">
								<div class="titleSection mb-2">Personal Contacts</div>
								
								<div class="row no-gutters px-2">
									<i class="fab fa-twitter-square font-size-180 px-2"></i>
									<span class="text-center">Followers</span>
								</div>
								<hr class="container-fluid p-0 m-1 align-self-center" style="width:80%;">
								<div class="row no-gutters px-2">
									<i class="fab fa-facebook-square font-size-180 px-2"></i>
									<span class="text-center">Followers</span>
								</div>
								<hr class="container-fluid p-0 m-1 align-self-center" style="width:80%;">
								<div class="row no-gutters px-2">
									<i class="fab fa-instagram font-size-180 px-2"></i>
									<span class="text-center">Followers</span>
								</div>
								<hr class="container-fluid p-0 m-1 align-self-center" style="width:80%;">
								<div class="row no-gutters px-2">
									<i class="fab fa-youtube-square font-size-180 px-2"></i>
									<span class="text-center">Followers</span>
								</div>
								<hr class="container-fluid p-0 m-1 align-self-center" style="width:80%;">
								<div class="row no-gutters px-2">
									<i class="fa fa-envelope font-size-180 px-2"></i>
									<span class="text-center">Fan Email</span>
								</div>
							</div>
						</div>

						<div class="col">
							<div class="container-fluid mt-2 p-2">
								<div class="titleSection mb-2">Agents Contacts</div>
								<div class="row no-gutters px-2">
									<div class="news-title">You Management Limited</div>
									<div class="">1st Floor Holborn Gate, 330 High Holborn</div>
									<div class="">WC1V 7QT</div>
									<div class="">England (UK)</div>
									<div class="">020 7849 6997</div>
									<div class="">info@you-management.com</div>
									<div class="">@youmanagement</div>
								</div>
							</div>
						</div>

					</div>
					
				  	
				</div>
				<div class="col-5" style="width:100%; height: 450px">
				<!--<div class="row h5 titleSection">Social Feeds</div> -->
					<div class="container">
						<div class="">
							<div class="container-fluid p-0 inline-list-user-profile">
								<ul class="list-inline container-fluid d-flex justify-content-around align-items-end mb-0">
									<li onClick="selectSocial('social1')" id="btnsocial1" class="list-inline-item paragraphTitle m-0 py-1"><div class="text-center"><i class="fab fa-facebook-square font-size-200"></i></div></li>
									<li onClick="selectSocial('social2')" id="btnsocial2" class="list-inline-item paragraphTitle m-0 py-1"><div class="text-center"><i class="fab fa-instagram font-size-200"></i></div></li>
									<li onClick="selectSocial('social3')" id="btnsocial3" class="list-inline-item paragraphTitle m-0 py-1"><div class="text-center"><i class="fab fa-twitter-square font-size-200"></i></div></li>
									<li onClick="selectSocial('social4')" id="btnsocial4" class="list-inline-item paragraphTitle m-0 py-1"><div class="text-center"><i class="fab fa-youtube-square font-size-200"></i></div></li>
								</ul>
							</div>
							<div class="container-fluid" id="social1" style="display:block">
								<iframe src="https://www.facebook.com/plugins/page.php?href=https%3A%2F%2Fwww.facebook.com%2FBenPlattOfficial%2F&tabs=timeline&width=340&height=500&small_header=false&adapt_container_width=true&hide_cover=false&show_facepile=true&appId" width="650" height="400" style="border:none;overflow:hidden" scrolling="no" frameborder="0" allowTransparency="true" allow="encrypted-media"></iframe>
							</div>
							<div class="container-fluid" id="social2" style="display:none">
								<blockquote class="instagram-media" data-instgrm-captioned data-instgrm-permalink="https://www.instagram.com/p/BwubVXbBzH9/" data-instgrm-version="12" style=" background:#FFF; border:0; border-radius:3px; box-shadow:0 0 1px 0 rgba(0,0,0,0.5),0 1px 10px 0 rgba(0,0,0,0.15); margin: 1px; max-width:540px; min-width:326px; padding:0; width:99.375%; width:-webkit-calc(100% - 2px); width:calc(100% - 2px);height: 300px"><div style="padding:16px;"> <a href="https://www.instagram.com/p/BwubVXbBzH9/" style=" background:#FFFFFF; line-height:0; padding:0 0; text-align:center; text-decoration:none; width:100%;" target="_blank"> <div style=" display: flex; flex-direction: row; align-items: center;"> <div style="background-color: #F4F4F4; border-radius: 50%; flex-grow: 0; height: 40px; margin-right: 14px; width: 40px;"></div> <div style="display: flex; flex-direction: column; flex-grow: 1; justify-content: center;"> <div style=" background-color: #F4F4F4; border-radius: 4px; flex-grow: 0; height: 14px; margin-bottom: 6px; width: 100px;"></div> <div style=" background-color: #F4F4F4; border-radius: 4px; flex-grow: 0; height: 14px; width: 60px;"></div></div></div><div style="padding: 19% 0;"></div> <div style="display:block; height:50px; margin:0 auto 12px; width:50px;"><svg width="50px" height="50px" viewBox="0 0 60 60" version="1.1" xmlns="https://www.w3.org/2000/svg" xmlns:xlink="https://www.w3.org/1999/xlink"><g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><g transform="translate(-511.000000, -20.000000)" fill="#000000"><g><path d="M556.869,30.41 C554.814,30.41 553.148,32.076 553.148,34.131 C553.148,36.186 554.814,37.852 556.869,37.852 C558.924,37.852 560.59,36.186 560.59,34.131 C560.59,32.076 558.924,30.41 556.869,30.41 M541,60.657 C535.114,60.657 530.342,55.887 530.342,50 C530.342,44.114 535.114,39.342 541,39.342 C546.887,39.342 551.658,44.114 551.658,50 C551.658,55.887 546.887,60.657 541,60.657 M541,33.886 C532.1,33.886 524.886,41.1 524.886,50 C524.886,58.899 532.1,66.113 541,66.113 C549.9,66.113 557.115,58.899 557.115,50 C557.115,41.1 549.9,33.886 541,33.886 M565.378,62.101 C565.244,65.022 564.756,66.606 564.346,67.663 C563.803,69.06 563.154,70.057 562.106,71.106 C561.058,72.155 560.06,72.803 558.662,73.347 C557.607,73.757 556.021,74.244 553.102,74.378 C549.944,74.521 548.997,74.552 541,74.552 C533.003,74.552 532.056,74.521 528.898,74.378 C525.979,74.244 524.393,73.757 523.338,73.347 C521.94,72.803 520.942,72.155 519.894,71.106 C518.846,70.057 518.197,69.06 517.654,67.663 C517.244,66.606 516.755,65.022 516.623,62.101 C516.479,58.943 516.448,57.996 516.448,50 C516.448,42.003 516.479,41.056 516.623,37.899 C516.755,34.978 517.244,33.391 517.654,32.338 C518.197,30.938 518.846,29.942 519.894,28.894 C520.942,27.846 521.94,27.196 523.338,26.654 C524.393,26.244 525.979,25.756 528.898,25.623 C532.057,25.479 533.004,25.448 541,25.448 C548.997,25.448 549.943,25.479 553.102,25.623 C556.021,25.756 557.607,26.244 558.662,26.654 C560.06,27.196 561.058,27.846 562.106,28.894 C563.154,29.942 563.803,30.938 564.346,32.338 C564.756,33.391 565.244,34.978 565.378,37.899 C565.522,41.056 565.552,42.003 565.552,50 C565.552,57.996 565.522,58.943 565.378,62.101 M570.82,37.631 C570.674,34.438 570.167,32.258 569.425,30.349 C568.659,28.377 567.633,26.702 565.965,25.035 C564.297,23.368 562.623,22.342 560.652,21.575 C558.743,20.834 556.562,20.326 553.369,20.18 C550.169,20.033 549.148,20 541,20 C532.853,20 531.831,20.033 528.631,20.18 C525.438,20.326 523.257,20.834 521.349,21.575 C519.376,22.342 517.703,23.368 516.035,25.035 C514.368,26.702 513.342,28.377 512.574,30.349 C511.834,32.258 511.326,34.438 511.181,37.631 C511.035,40.831 511,41.851 511,50 C511,58.147 511.035,59.17 511.181,62.369 C511.326,65.562 511.834,67.743 512.574,69.651 C513.342,71.625 514.368,73.296 516.035,74.965 C517.703,76.634 519.376,77.658 521.349,78.425 C523.257,79.167 525.438,79.673 528.631,79.82 C531.831,79.965 532.853,80.001 541,80.001 C549.148,80.001 550.169,79.965 553.369,79.82 C556.562,79.673 558.743,79.167 560.652,78.425 C562.623,77.658 564.297,76.634 565.965,74.965 C567.633,73.296 568.659,71.625 569.425,69.651 C570.167,67.743 570.674,65.562 570.82,62.369 C570.966,59.17 571,58.147 571,50 C571,41.851 570.966,40.831 570.82,37.631"></path></g></g></g></svg></div><div style="padding-top: 8px;"> <div style=" color:#3897f0; font-family:Arial,sans-serif; font-size:14px; font-style:normal; font-weight:550; line-height:18px;"> View this post on Instagram</div></div><div style="padding: 4.5% 0;"></div> <div style="display: flex; flex-direction: row; margin-bottom: 14px; align-items: center;"><div> <div style="background-color: #F4F4F4; border-radius: 50%; height: 12.5px; width: 12.5px; transform: translateX(0px) translateY(7px);"></div> <div style="background-color: #F4F4F4; height: 12.5px; transform: rotate(-45deg) translateX(3px) translateY(1px); width: 12.5px; flex-grow: 0; margin-right: 14px; margin-left: 2px;"></div> <div style="background-color: #F4F4F4; border-radius: 50%; height: 12.5px; width: 12.5px; transform: translateX(9px) translateY(-18px);"></div></div><div style="margin-left: 8px;"> <div style=" background-color: #F4F4F4; border-radius: 50%; flex-grow: 0; height: 20px; width: 20px;"></div> <div style=" width: 0; height: 0; border-top: 2px solid transparent; border-left: 6px solid #f4f4f4; border-bottom: 2px solid transparent; transform: translateX(16px) translateY(-4px) rotate(30deg)"></div></div><div style="margin-left: auto;"> <div style=" width: 0px; border-top: 8px solid #F4F4F4; border-right: 8px solid transparent; transform: translateY(16px);"></div> <div style=" background-color: #F4F4F4; flex-grow: 0; height: 12px; width: 16px; transform: translateY(-4px);"></div> <div style=" width: 0; height: 0; border-top: 8px solid #F4F4F4; border-left: 8px solid transparent; transform: translateY(-4px) translateX(8px);"></div></div></div></a> <p style=" margin:8px 0 0 0; padding:0 4px;"> <a href="https://www.instagram.com/p/BwubVXbBzH9/" style=" color:#000; font-family:Arial,sans-serif; font-size:14px; font-style:normal; font-weight:normal; line-height:17px; text-decoration:none; word-wrap:break-word;" target="_blank">I ❤️ tour rehearsal</a></p> <p style=" color:#c9c8cd; font-family:Arial,sans-serif; font-size:14px; line-height:17px; margin-bottom:0; margin-top:8px; overflow:hidden; padding:8px 0 7px; text-align:center; text-overflow:ellipsis; white-space:nowrap;">A post shared by <a href="https://www.instagram.com/bensplatt/" style=" color:#c9c8cd; font-family:Arial,sans-serif; font-size:14px; font-style:normal; font-weight:normal; line-height:17px;" target="_blank"> Ben Platt</a> (@bensplatt) on <time style=" font-family:Arial,sans-serif; font-size:14px; line-height:17px;" datetime="2019-04-26T16:27:04+00:00">Apr 26, 2019 at 9:27am PDT</time></p></div></blockquote> <script async src="//www.instagram.com/embed.js"></script>
							</div>
							<div class="container-fluid" id="social3" style="display:none">
								<a class="twitter-timeline" href="https://twitter.com/BenSPLATT" height="400" width="500">Tweets by Ben Platt</a> <script async src="https://platform.twitter.com/widgets.js" charset="utf-8"></script>
							</div>
							<div class="container-fluid" id="social4" style="display:none">youtube feed</div>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="container mt-3">
						<div class="row h5 paragraphTitle">Biography</div>
						<div class="row font-size-90">
							<p>
							Ben Platt started his carreer at a young age, studing music since he was a kid, developing and strengthning his voice. Appearing in different movies, helped his confidence. Getting his role as Evan in Dear Evan Hansen, helped enormously his carreer.
							</p>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="container-fluid py-3" style="background-color:RGBA(102, 2, 22, 1.00);">
			<div class="container">
				<div class="row">
					<!--SECTION FOR THE DIFFERENT PRODUCTIONS-->
					<div class="col">
						<div class="row justify-content-center mb-4"><p class="h4 paragraphTitle" style="color:white!important">Skills</p></div>
						<?php foreach ($actorInfoSkill as $skill) :?>
							<div class="row justify-content-center"><p class="paragraphTitle" style="color:white!important"><?php echo $skill['skills_name'];?> (<?php echo $skill['level_name_type'];?>)</p></div>
						<?php endforeach ?>
						<!--
						<div class="row justify-content-center"><p class="paragraphTitle" style="color:white!important">Dance (Begineer)</p></div>
						<div class="row justify-content-center"><p class="paragraphTitle" style="color:white!important">Comedy (Intermediate)</p></div>
						<div class="row justify-content-center"><p class="paragraphTitle" style="color:white!important">Singing (Expert)</p></div>
						-->
					</div>
					<div class="col white-left-line">
						<div class="row justify-content-center mb-4"><p class="h4 paragraphTitle" style="color:white!important">Languages</p></div>
						<?php foreach ($actorInfoLanguage as $language) :?>
							<div class="row justify-content-center"><p class="paragraphTitle" style="color:white!important"><?php echo $language['language_name'];?></p></div>
						<?php endforeach ?>
					</div>
					<div class="col white-left-line">
						<div class="row justify-content-center mb-4"><p class="h4 paragraphTitle" style="color:white!important">Accents</p></div>
						<?php foreach ($actorInfoAccent as $accent) :?>
							<div class="row justify-content-center"><p class="paragraphTitle" style="color:white!important"><?php echo $accent['accent_name'];?></p></div>
						<?php endforeach ?>
					</div>
				</div>
			</div>
		</div>
		
		<div class="container-fluid my-4">
			<div class="container">
				<div class="row">
					<div class="h2 paragraphTitle container-fluid">Rewards</div>
				</div>
				<div class="row">
					<table class="table">
						<thead>
							<tr>
								<th scope="">Year</th>
								<th scope="">Award</th>
								<th scope="">Category</th>
								<th scope="">Result</th>
							</tr>
						</thead>
						<tbody>
							<tr>
								<td class="">2018</td>
								<td class="">Oustanding Musical Performance in a Daytime Program</td>
								<td class="">Daytime Emmy Award</td>
								<td class="">Won</td>
							</tr>
							<tr>
								<td class="">2018</td>
								<td class="">Best Musical Theatre Album</td>
								<td class="">Grammy Awards</td>
								<td class="">Won</td>
							</tr>
							<tr>
								<td class="">2017</td>
								<td class="">Best Actor in a Musical</td>
								<td class="">Tony Awards</td>
								<td class="">Won</td>
							</tr>
							<tr>
								<td class="">2013</td>
								<td class="">Choice Movie: Male Scene Stealer</td>
								<td class="">Teen Choice Awards</td>
								<td class="">Nominated</td>
							</tr>
						</tbody>
					</table>
				</div>
			</div>
		</div>
		
		<div class="container-fluid p-0 inline-list-user-profile">
			
			<ul class="list-inline container-fluid d-flex justify-content-around align-items-end mb-0">
			  <li onClick="selectWorkExperience('experience1')" id="btnexperience1" class="list-inline-item paragraphTitle h4 m-0 py-3"><div class="text-center">Theatre</div></li>
			  <li onClick="selectWorkExperience('experience2')" id="btnexperience2" class="list-inline-item paragraphTitle h4 m-0 py-3"><div class="text-center">Television</div></li>
			  <li onClick="selectWorkExperience('experience3')" id="btnexperience3" class="list-inline-item paragraphTitle h4 m-0 py-3"><div class="text-center">Credit</div></li>
			  
			</ul>
		</div>
		<!--CONTAINER FOR Theatre Experiences-->
		<div class="container-fluid" id="experience1" style="display:block">
			<div class="row no-gutters">
				<div class="col">

				<table class="table">
					<thead>
						<tr class="">
							<th scope="col" class="align-middle paragraphTitle font-size-110">Title</th>
							<th scope="col" class="align-middle paragraphTitle font-size-110">Production</th>
							<th scope="col" class="align-middle paragraphTitle font-size-110">Role</th>
							<th scope="col" class="align-middle paragraphTitle font-size-110">Debut</th>
							<th scope="col" class="align-middle paragraphTitle font-size-110">Final</th>
							<th scope="col" class="align-middle paragraphTitle font-size-110">Rating</th>
							<!--<th scope="col">Edit</th> -->
						</tr>
					</thead>
					<tbody>
						<!-- .. Template to add a row in the table

						<tr>
						<th scope="col" class="align-middle paragraphTitle font-size-110">Title</th>
							<th scope="col" class="align-middle paragraphTitle font-size-110">Production</th>
							<th scope="col" class="align-middle paragraphTitle font-size-110">Role</th>
							<th scope="col" class="align-middle paragraphTitle font-size-110">Debut</th>
							<th scope="col" class="align-middle paragraphTitle font-size-110">Final</th>
							<th scope="col" class="align-middle paragraphTitle font-size-110">Rating</th>
						</tr>
						-->
						<tr>
							<td scope="">Dear Evan Hansen</td>
							<td>Broadway</td>
							<td>Evan Hansen</td>
							<td>15-OCT-16</td>
							<td>19-NOV-18</td>
							<td><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i></td>
						</tr>
						<tr>
							<td scope="">The Secret Garden</td>
							<td>Broadway</td>
							<td>Dickon</td>
							<td>15-AUG-2015</td>
							<td>15-JUL-2016</td>
							<td><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i></td>
						</tr>
					</tbody>
				</table>				
				</div>
			</div>
		</div>
		<!--CONTAINER FOR Television Experiences-->
		<div class="container-fluid mt-3" id="experience2" style="display:none">
			<table class="table">
					<thead>
						<tr class="">
							<th scope="col" class="align-middle paragraphTitle font-size-110">Title</th>
							<th scope="col" class="align-middle paragraphTitle font-size-110">Category</th>
							<th scope="col" class="align-middle paragraphTitle font-size-110">Role Type</th>
							<th scope="col" class="align-middle paragraphTitle font-size-110">Role Name</th>
							<th scope="col" class="align-middle paragraphTitle font-size-110">Company</th>
							<th scope="col" class="align-middle paragraphTitle font-size-110">Release</th>
							<th scope="col" class="align-middle paragraphTitle font-size-110">Rating</th>
							<!--<th scope="col">Edit</th> -->
						</tr>
					</thead>
					<tbody>
						<!-- .. Template to add a row in the table

						<tr>
						<th scope="col" class="align-middle paragraphTitle font-size-110">Title</th>
							<th scope="col" class="align-middle paragraphTitle font-size-110">Production</th>
							<th scope="col" class="align-middle paragraphTitle font-size-110">Role</th>
							<th scope="col" class="align-middle paragraphTitle font-size-110">Debut</th>
							<th scope="col" class="align-middle paragraphTitle font-size-110">Final</th>
							<th scope="col" class="align-middle paragraphTitle font-size-110">Rating</th>
						</tr>
						-->
						<tr>
							<td scope="">Pitch Perfect</td>
							<td>Movie</td>
							<td>Appeareance</td>
							<td>Boy Scout #1</td>
							<td>Gold Circle Film</td>
							<td>2012</td>
							<td><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i></td>
						</tr>
						<tr>
							<td scope="">Pitch Perfect 2</td>
							<td>Movie</td>
							<td>Supporting Role</td>
							<td>Benji Applenaum</td>
							<td>Gold Circle Film</td>
							<td>2015</td>
							<td><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i></td>
						</tr>
						<tr>
							<td scope="">Run This Town</td>
							<td>Movie</td>
							<td>Supporting Role</td>
							<td>Bram</td>
							<td>CounterNarrative Films</td>
							<td>2019</td>
							<td>Unknown</td>
						</tr>
					</tbody>
				</table>				
		</div>
		<!--CONTAINER FOR Credit experiences -->
		<div class="container-fluid mt-3"  id="experience3" style="display:none">
			<table class="table">
					<thead>
						<tr class="">
							<th scope="col" class="align-middle paragraphTitle font-size-110">Title</th>
							<th scope="col" class="align-middle paragraphTitle font-size-110">Type</th>
							<th scope="col" class="align-middle paragraphTitle font-size-110">Yeat</th>
							<th scope="col" class="align-middle paragraphTitle font-size-110">Rating</th>
							<!--<th scope="col">Edit</th> -->
						</tr>
					</thead>
					<tbody>
						<!-- .. Template to add a row in the table

						<tr>
						<th scope="col" class="align-middle paragraphTitle font-size-110">Title</th>
							<th scope="col" class="align-middle paragraphTitle font-size-110">Production</th>
							<th scope="col" class="align-middle paragraphTitle font-size-110">Role</th>
							<th scope="col" class="align-middle paragraphTitle font-size-110">Debut</th>
							<th scope="col" class="align-middle paragraphTitle font-size-110">Final</th>
							<th scope="col" class="align-middle paragraphTitle font-size-110">Rating</th>
						</tr>
						-->
						<tr>
							<td scope="">Sing to me instead</td>
							<td>Album</td>
							<td>2019</td>
							<td><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i></td>
						</tr>
						<tr>
							<td scope="">Waving Through A Window</td>
							<td>Single</td>
							<td>2017</td>
							<td><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i></td>
						</tr>
						<tr>
							<td scope="">Found/Tonight</td>
							<td>Single</td>
							<td>2018</td>
							<td><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i></td>
						</tr>
					</tbody>
				</table>				
		</div>
		<!--CONTAINER FOR Rewards that means nominated and won-->	
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
<div id="fb-root"></div>
<script async defer crossorigin="anonymous" src="https://connect.facebook.net/it_IT/sdk.js#xfbml=1&version=v3.2"></script>
<script>
twttr.widgets.createTimeline(
  {
    sourceType: "profile",
    screenName: "Ben Platt"
  },
  document.getElementById("social3")
);
</script>

</body>
</html>