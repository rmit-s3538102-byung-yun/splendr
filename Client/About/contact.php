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
<?php
  if (isset($_POST['contact_btn']))
  {
    $name = mysqli_real_escape_string($db, $_POST['name']);
		$email = mysqli_real_escape_string($db, $_POST['email']);
    $subject = mysqli_real_escape_string($db, $_POST['subject']);
    $messageForm = mysqli_real_escape_string($db, $_POST['message']);
		$message = $name. "\n\n" .$email. "\n\n". "Their message: ".$messageForm;
    $to = 'splendrmatch@gmail.com';
    $headers = 'From:'.$email;
    mail($to, $subject, $message, $headers);
  }
?>

<html>
	<head>
    <link href="https://fonts.googleapis.com/css?family=Lobster" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Raleway" rel="stylesheet">
		<link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
		<link rel ="stylesheet" type="text/css" href ="../css/registration.css">
		<meta charset="utf-8">
		<title>Splendr</title>
		<?php include("../external/nav.php");?>
	</head>
	<body>
		<section class ="intro5">
			<div class="regcontainer">
        <h1>Contact Us</h1>
        <form class = "regform" method = "post" action = "contact.php">
          <label>Your Name</label>
          <br><input type="text" name="name" class="inputText" placeholder="Name" required><br><br>
          <label>Your Email</label>
          <br><input type="email" name="email" class="inputText" placeholder="Email" required><br><br>
          <label>Subject</label>
          <br><select name="subject" class="inputText" required>
            <option value="general">General</option>
            <option value="payment">Payment</option>
            <option value="report">Report</option>
            <option value="feedback">Feedback</option>
          </select><br><br>
          <label>Your Message</label>
          <br><textarea name="message"  class="inputTextArea"  style="width: 500px; height: 200px; resize: none" placeholder="Write Something" required></textarea><br>
          <br>
          <div class="submitbutton"><input type ="submit" class ="submitbtn" name ="contact_btn" value ="Send"></div>
        </form>
			</div>
		</section>
	</body>
	<?php include("../external/footer.php");?>
</html>
