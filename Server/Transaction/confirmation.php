<?php
  session_start();

	$db = mysqli_connect("localhost", "root", "","accounts");

  $username = $_SESSION["username"];

  $get = "SELECT user_id FROM members WHERE username = '$username'";
  $result = $db->query($get);

  $similarhobbycount = 0;
  $score = 0;
  $year = date("Y");

  if ($row = mysqli_fetch_assoc($result)) {
  	$user_id = $row["user_id"];
  }else{
    echo "User ID has not been found OR You have not logged in yet";
  }
    $email = mysqli_real_escape_string($db, $_POST['email']);
    $billAddress = mysqli_real_escape_string($db, $_POST['billAddress']);
    $ccNo = mysqli_real_escape_string($db, $_POST['ccNo']);
    $cvv = mysqli_real_escape_string($db, $_POST['cvv']);
		$ccHolder = mysqli_real_escape_string($db, $_POST["ccHolder"]);
    $secureccNo = md5($ccNo); //ccNo are stored using md5 for security purposes
    $secureCVV = md5($cvv); //CVV are stored using md5 for security purposes
    $msgPlan = $_SESSION["subscription"];

    $sql = "INSERT INTO cart(user_id, email, billAddress, ccNo, ccHolder, cvv, msgPlan) VALUES('$user_id', '$email', '$billAddress', '$secureccNo','$ccHolder', '$secureCVV', '$msgPlan')";
    mysqli_query($db, $sql); // insert into cart

    $sql = "UPDATE members SET msglimit = 1, msgQty = NULL WHERE user_id = '$user_id'"; // once confirmed, set the msglimit to unlimited and msgQtyl, NULL
    mysqli_query($db, $sql);

 ?>
<!DOCTYPE html>
<html>
<style>
#footerContainer {
  position: absolute;
}

</style>
  <head>
    <link rel="stylesheet" type="text/css" href="../../Client/css/transaction.css">
    <link href="https://fonts.googleapis.com/css?family=Lobster" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Raleway" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
    <meta charset="utf-8">
    <title>
      Confirmation Page
    </title>
  </head>
  <?php include("../../Client/external/nav.php");?>
  <body>
    <h1>Thank you for purchasing our service!</h1>
  </body>
  <?php include("../../Client/external/footer.php");?>
</html>
