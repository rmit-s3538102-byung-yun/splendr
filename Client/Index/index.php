<!DOCTYPE html>
<?php
	session_start();
	$db = mysqli_connect("localhost", "root", "", "accounts");// db server connection

	$username = $_SESSION["username"];
	$similarhobbycount = 0;
	$score = 0;
	$year = date("Y"); // later used to determine the age of the user

	$get = "SELECT user_id FROM members WHERE username = '$username'";// selecting the user_id of the user logged in.
	$result = $db->query($get);

	if ($row = mysqli_fetch_assoc($result)) { // uf conditions are met, proceed to the code below
		$user_id = $row["user_id"];
	}else{
		echo "<script>alert('You have not logged in! We will take you to the login page!')</script>";
		header("location:../../Server/login/login.php");
	}
?>
<html>
	<head>
    <link href="https://fonts.googleapis.com/css?family=Lobster" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Raleway" rel="stylesheet">
		<link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
		<link rel ="stylesheet" type="text/css" href ="../css/index.css">
		<meta charset="utf-8">
		<title>Splendr</title>
		<?php include("../external/nav.php");?>
	</head>
	<body>
		<section class ="intro">
			<div class="inner">
				<div class="content">
					<h1>FIND YOUR MATCH</h1>
				</div>
			</div>
		</section>
		<section class="intro1">
			<div class ="inner1">
				<div class="content1">
					<h1>Quote of the Month</h1>
					<h1>"Love consists of this: two solitudes that meet, protect and greet each other." - Rainer Maria Rilke</h1>
				</div>
			</div>
		</section>
		<section class ="intro2">
			<div class = "inner2">
				<div class = "content2">
					<h1>"With our custom made algorithm, you are guranteed to have to highest matchmaking quality!" - Splendr</h1>
				</div>
			</div>
		</section>
	</body>
	<?php include("../external/footer.php");?>
</html>
