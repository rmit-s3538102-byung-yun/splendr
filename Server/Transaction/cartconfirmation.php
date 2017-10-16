<?php
	session_start();
	$db = mysqli_connect("localhost", "root", "", "accounts");
	$username = $_SESSION["username"];
	$get = "SELECT user_id FROM members WHERE username = '$username'";
	$result = $db->query($get);
	if ($row = mysqli_fetch_assoc($result)) {
		$user_id = $row["user_id"];
	}
	$months = $_POST["months"];
	if($months == 15)
	{
		$_SESSION["subscription"] = 3;
	}
	else if($months == 25)
	{
			$_SESSION["subscription"] = 6;
	}
	else if($months == 40)
	{
			$_SESSION["subscription"] = 12;
	}

  ?>
<html>

	<head>
		<link rel="stylesheet" type="text/css" href="../../Client/css/transaction.css">
		<link href="https://fonts.googleapis.com/css?family=Lobster" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Raleway" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
		<?php include("../../Client/external/nav.php");?>
		<title>Confirmation</title>
	</head>
  <body>
		<h1>Message Plan</h1>
    <form class = "payForm" method ="post" action="confirmation.php">
      <table>
        <tr>
					<td><b>Name*</b></td>
				</tr>
        <tr>
          <td> <input type ="text" name="firstName" pattern="^[A-Za-z ]+$"title ="Please Type Your Name." placeholder="Name" class="inputText" required/></td>
        </tr>
        <tr>
					<td><b>Email*</b></td>
				</tr>
        <tr>
          <td><input type = "email" name = "email" title = "email" name = "email" placeholder="Email Address" class="inputText" required/></td>
        </tr>
        <tr>
					<td><b>Billing Address*</b></td>
				</tr>
        <tr>
          <td><input type = "text" placeholder="Billing Address" name = "billAddress" class="inputText"size = "30" required></td>
        </tr>
        <tr>
					<td><b>Credit Card Holder*</b></td>
				</tr>
        <tr>
          <td><input type ="text" pattern="^[A-Za-z ]+$" name = "ccHolder" placeholder="Name on your Credit Card" class="inputText"size = "30" required></td>
        </tr>
        <tr>
					<td><b>Credit Card Number*</b></td>
				</tr>
        <tr>
          <td><input type = "text" pattern="^([0-9]){16}$" title = "1234-5678-9123-0000 without the '-'!" name = "ccNo" class="inputText"size = "30" placeholder ="16 Credit Card Digit"required></td>
        </tr>
        <tr>
					<td><b>CVV*</b></td>
				</tr>
        <tr>
          <td><input type ="text" pattern="^([0-9]){3}" name = "cvv" title ="Please type your 3 digit CVV code" placeholder="CVV"class="inputText"size = "4" required></td>
        </tr>
      </table>
			<br><br>
      <input type="submit" name="checkout_btn" value="CHECKOUT" class = "submitbtn">
    </form>
	</body>
		<?php include("../../Client/external/footer.php");?>
</html>
