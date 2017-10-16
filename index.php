<!DOCTYPE html>
<?php session_start();
$db = mysqli_connect("localhost", "root", "ybk2588098", "accounts");
$username = $_SESSION["id"];
$get = "SELECT user_id FROM members WHERE username = '$username'";
$result = $db->query($get);
$similarhobbycount = 0;
$score = 0;
$year = date("Y");
if ($row = mysqli_fetch_assoc($result)) {
	$user_id = $row["user_id"];
}else{
	echo "Not working";
}
?>
<html>
	<head>
    <link rel ="stylesheet" type="text/css" href ="css/style.css">
    <link href="https://fonts.googleapis.com/css?family=Lobster" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Raleway" rel="stylesheet">
		<meta charset="utf-8">
		<title>

		</title>
	</head>
	<body>
		<section class ="intro">
      <ul class ="nav">
        <li><a href="Preference/preferencefinish.php">Match</a></li>
        <li><a href="#">Example 1</a></li>
        <li><a href="#">Example 2</a></li>
        <li><a href="#">Example 3</a></li>
				<?php if(isset($_SESSION["loggedin"])){
						echo"<li><a href ='Profile/profilepage.php?user=$user_id'>Profile</a></li>";
				}else{
						echo"<li><a href ='Login/login.php'>Log in</a></li>";
				} ?>
      </ul>
			<div class="inner">
				<div class="content">
					<h1>FIND YOUR MATCH</h1>
				</div>
			</div>
		</section>
	</body>
</html>
