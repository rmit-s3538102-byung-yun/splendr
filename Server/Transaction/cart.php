<!DOCTYPE html>
<?php
	session_start();
	$db = mysqli_connect("localhost", "root", "", "accounts");
	$username = $_SESSION["username"];
	$get = "SELECT user_id FROM members WHERE username = '$username'";
	$result = $db->query($get);
	if ($row = mysqli_fetch_assoc($result)) {
		$user_id = $row["user_id"];
	}
?>
<html>
	<style media="screen">
		#footerContainer {
			position: absolute;
		}
	</style>
<script type="text/javascript">
	function updateTotal()
	{
	    var usersChoice = document.getElementsByName('months'); //get element by name using months
	    for (var i = 0, length = usersChoice.length; i < length; i++)
	    {
	        if (usersChoice[i].checked) // if its checked
	        {
	            cost = parseInt(usersChoice[i].value); // then the cost will be assigned
	            break;
	        }
	    }
	    document.getElementById('total').innerHTML = cost; // and print out the total using cost
	}
</script>
  <head>
    <meta charset="utf-8">
    <title>Cart</title>
    <link href="https://fonts.googleapis.com/css?family=Lobster" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Raleway" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
    <link rel="stylesheet" href="../../Client/css/transaction.css">
  </head>
    <?php include("../../Client/external/nav.php");?>
  <body>
    <h1>Message Plan</h1>
    <p>Get Unlimited Messages For Your Profile</p>
    <form method = "post" action = "cartconfirmation.php">
      <h2>Choose Your Message Plan</h2>
      <input type="radio" name="months" value="15"  onclick="updateTotal()" required/> 3 Months<br>
      <input type="radio" name="months" value="25"  onclick="updateTotal()" required/> 6 Months<br>
      <input type="radio" name="months" value="40"  onclick="updateTotal();"required/> 12 Months<br>
      <b>Total:</b> = $<span id="total">0</span>
      <br><br>
      <a href="cart.php"><button class = "submitbtn" name ="AddCart">Add to Cart</button></a>
    </form>
  </body>
<?php include("../../Client/external/footer.php");?>
</html>
