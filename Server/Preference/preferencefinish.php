<?php
	session_start();

	$db = mysqli_connect("localhost", "root", "", "accounts");
	$username = $_SESSION["username"];
	$_SESSION["update"] = FALSE;

	$get = "SELECT user_id FROM members WHERE username = '$username'";
	$result = $db->query($get);
	$similarhobbycount = 0;
	$score = 0;
	$year = date("Y");

	if ($row = mysqli_fetch_assoc($result)) {
		$user_id = $row["user_id"];
	}else{
		echo "User ";
	}

	$delete = " DELETE FROM result WHERE user_id = '$user_id'"; // reset the result everytime when the user reaches match.php to ensure the latest version of data from database
	mysqli_query($db, $delete);

	$query = "SELECT * FROM members AS m INNER JOIN ideal AS i ON m.user_id=i.user_id INNER JOIN information AS f ON m.user_id = f.user_id INNER JOIN hobby as h ON m.user_id = h.user_id WHERE m.user_id ='$user_id'";
	$result2 = $db->query($query); // join members, ideal, information, hobby tables together

	if ($result2->num_rows > 0) {
	  // output data of each row
	  while($row = $result2->fetch_assoc()) { //when the conditions are met, assign data to variables.
			$age = $year - $row["doby"];
			$gender = $row["gender"];
			$idealgender = $row["idealgender"]; // store the ideal gender of the user into the variable
			$btype = $row["idealbtype"]; // store the ideal body type of the user into the varable
			$education = $row["idealeducation"]; //store education information from the user
			$idealrace = $row["idealrace"];
			$idealage = $row["idealage"];
			$idealreligion = $row["idealreligion"];
			$idealdrink = $row["idealdrink"];
			$idealsmoke = $row["idealsmoke"];
			$idealgamble = $row["idealgamble"];
			$state = $row["state"];
			$hobby1 = $row["hobby1"];
			$hobby2 = $row["hobby2"];
			$hobby3 = $row["hobby3"];
			$hobby4 = $row["hobby4"];
			$hobby5 = $row["hobby5"];
			if($row["idealgender"] == $row["idealgender"]){ // Matchmaking algorithm : Checking the ideal gender of the user.
				$search = "SELECT * FROM members AS m INNER JOIN ideal AS i ON m.user_id=i.user_id INNER JOIN information AS f ON m.user_id = f.user_id INNER JOIN hobby as h ON m.user_id = h.user_id WHERE m.gender='$idealgender' AND i.idealgender = '$gender' AND m.user_id != '$user_id'";
				//search database to select everything from members, ideal, information table all joined together and make sure the gender is what the user is looking for and vice versa, as well as making sure the user doesn't display themselves
				$result2 = $db->query($search);
				if ($result2 -> num_rows > 0) {// if the conditions are all met
					while ($row = $result2->fetch_assoc()) { //
						$age = $year - $row["doby"]; // calculate age
						$partnerid = $row["user_id"];

						if ($row["body"] == $btype){ // if body type is what user is looking for, +15 score
							$score += 15;
						}

						if ($row["ethnic"] == $idealrace) { // if ethnicity is what user is looking for, +20 score
							$score += 20;
						}

						if ($row["religion"] == $idealreligion) { // if religion is what user is looking for, +10 score
							$score+=10;
						}

						if($row["drink"] == $idealdrink){ // if drinking is what user is looking for, +5 score
							$score +=5;
						}

						if ($row["smoke"] == $idealsmoke) { // if smoking is what user is looking for, +5 score
							$score+=5;
						}

						if ($row["gamble"] == $idealgamble) { // if gambling is what user is looking for, +5 score
							$score+=5;
						}

						if ($row["education"] == $education) { // if education is what user is looking for, +15 score
							$score+=15;
						}

						if($age >= 18 && $age <=26){
							$userage = "young";
						}else if($age >=27 && $age <=35){
							$userage = "middle";
						}else if($age >=36 && $age <=39){
							$userage ="late";
						}else{
							$userage = "old";
						}

						if ($userage == $idealage){
							$score+=10; // if the age is what user is looking for +10 score
						}

						if($row["state"] == $state){
							$score+=10; // if they live in the same state, +10 score
						}else{
							$score+=5; // else +5 score
						}
						if (in_array($hobby1, array($row["hobby1"], $row["hobby2"], $row["hobby3"], $row["hobby4"], $row["hobby5"]))){ // if any 5 of the user's and potential partner's hobbies match, +1 score
							$similarhobbycount = $similarhobbycount + 1;  // add 1 to similarhobbycount
							$score += 1;
						}
						if (in_array($hobby2, array($row["hobby1"], $row["hobby2"], $row["hobby3"], $row["hobby4"], $row["hobby5"]))) { // if any 5 of the user's and potential partner's hobbies match, +1 score
							$similarhobbycount = $similarhobbycount + 1;  // add 1 to similarhobbycount
							$score +=1;
						}
						if (in_array($hobby3, array($row["hobby1"], $row["hobby2"], $row["hobby3"], $row["hobby4"], $row["hobby5"]))) { // if any 5 of the user's and potential partner's hobbies match, +1 score
							$similarhobbycount = $similarhobbycount+1;  // add 1 to similarhobbycount
							$score +=1;
						}
						if (in_array($hobby4, array($row["hobby1"], $row["hobby2"], $row["hobby3"], $row["hobby4"], $row["hobby5"]))) { // if any 5 of the user's and potential partner's hobbies match, +1 score
							$similarhobbycount = $similarhobbycount+1;  // add 1 to similarhobbycount
							$score +=1;
						}
						if (in_array($hobby5, array($row["hobby1"], $row["hobby2"], $row["hobby3"], $row["hobby4"], $row["hobby5"]))) { // if any 5 of the user's and potential partner's hobbies match, +1 score
							$similarhobbycount = $similarhobbycount+1;  // add 1 to similarhobbycount
							$score +=1;
						}
						$partner_id = mysqli_real_escape_string($db, $partnerid);
						$match = "INSERT INTO result(user_id, partner_id, score, similarint) VALUES('$user_id', '$partner_id', '$score', '$similarhobbycount')"; // calculate everything and insert it into the results table,
						mysqli_query($db, $match);
						$similarhobbycount = 0; // reset the count to 0 and start again for a new user
						$score = 0;
					}
				}else{
				}
			}
		}
	}

	$sql = "INSERT INTO image(user_id, image) VALUES ('$user_id', NULL)"; // INITIALLY insert value NULL into image table
	mysqli_query($db, $sql);

	$defaultimage = "../img/default.png";

	$sql = "SELECT * FROM image WHERE user_id = '$user_id'"; // select the user
	$result = $db->query($sql);
	if ($result->num_rows > 0) {

		while($row = $result->fetch_assoc()) {
			if ($row["image"] == NULL) { // if the user hasnt uploaded their image, set the image as a default image
				$sql = "UPDATE image SET user_id = '$user_id', image = '$defaultimage' WHERE user_id = '$user_id'";//update
				mysqli_query($db, $sql);
			}else{
			}
		}
	}

?>
