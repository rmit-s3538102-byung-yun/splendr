<?php session_start(); ?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>Login</title>
		<link rel="stylesheet" type="text/css" href="../../Client/css/login.css">
		<link href="https://fonts.googleapis.com/css?family=Lobster" rel="stylesheet">
		<link href="https://fonts.googleapis.com/css?family=Raleway" rel="stylesheet">
		<link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
	</head>
	<body>
		<div class="signup">
		<div class="signupbutton"><span><a href="../Registration/register.php"><button>Sign Up</button></a></span></div>
		</div>
		<form action = "validation.php" method="POST">
			<div class="login">
				<a href="../../Client/index/index.php"><h1>Splendr</h1></a>
					<?php
						if (isset($_SESSION["error"])){ //  SESSION["error"] is flagged in validation.php file
							echo "<p style=color:red;>"."Your username and password is incorrect!"."<p>";
							session_unset(); // unset any sessions stored as of this point if the login attempt has failed.
						}
					?>
      	<div class="user"><span><input type="text" name ="username" placeholder="Username" id="uname" required/></span></div>
      	<div class="pws"><span><input type="password" name="password" placeholder="Password" id="pword" required/></span></div>
    		<div class="logbutton"><span><button type ="submit" name ="login_btn">Log In</button></span></div>
    		<div class= "remember"><a href="#" class="forgot">Forgot password?</a></div>
      </div>
    </form>
		<?php include("../../Client/external/footer.php");?>
	</body>
</html>
