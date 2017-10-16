<html>
	<header>
		<link rel="stylesheet" type="text/css" href="registrationstyle.css">
		<link href="https://fonts.googleapis.com/css?family=Quicksand" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
				<link href="https://fonts.googleapis.com/css?family=Lobster" rel="stylesheet">
        <body>
        <nav>
            <ul>
                <li class= "login"><a href="#">Log In</a></li>
                <li class ="sign"><a href="#">Sign Up</a></li>
            </ul>
        </nav>
            <section class="intro5">
            <div class ="regcontainer">
						<h1>Splendr</h1>

            <?php
              $db = mysqli_connect("localhost", "root", "ybk2588098","accounts");

							$code = $_GET['code'];
							$sql = "SELECT * FROM members WHERE confirmcode = '$code'";
							$result = mysqli_query($db, $sql);

							if($result)
							{
								$count = mysqli_num_rows($result);
								if($count == 1)
								{
									mysqli_query($db, "UPDATE members SET verified = '1' WHERE confirmcode = '$code'");
									mysqli_query($db, "UPDATE members SET confirmcode = '0' WHERE confirmcode = '$code'");

									echo "Your account is activated";
								}
								else
								{
									echo "Wrong Confirmation Code";
								}
							}
             ?>
				</div>
			</section>
		</body>
	</header>

</html>
