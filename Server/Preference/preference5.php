<!DOCTYPE html>
<?php
	session_start();
	$db = mysqli_connect("localhost", "root", "", "accounts" );
	$username = $_SESSION["username"];
	$get = "SELECT user_id FROM members WHERE username = '$username'";
	$result = $db->query($get);

	if ($row = mysqli_fetch_assoc($result)) {
		$user_id = $row["user_id"];
	}else{
		echo "Not working";
	}

	if ($_SESSION["update"] == TRUE) { // if its an update, update the ideal table with the update set of data
		$sql2 = "SELECT user_id FROM members WHERE user_id = $user_id";
		$result = $db->query($sql2);
		if($row = mysqli_fetch_assoc($result)){
			if (isset($_POST['pref_btn2'])) {
				$idealgender = mysqli_real_escape_string($db, $_POST['idealgender']);
				$idealage = mysqli_real_escape_string($db, $_POST['idealage']);
				$idealbtype = mysqli_real_escape_string($db, $_POST['idealbtype']);
				$idealeducation = mysqli_real_escape_string($db, $_POST['idealeducation']);
				$idealrace = mysqli_real_escape_string($db, $_POST['idealrace']);
			 	$idealdrink = mysqli_real_escape_string($db, $_POST['idealdrink']);
				$idealsmoke = mysqli_real_escape_string($db, $_POST['idealsmoke']);
				$idealgamble = mysqli_real_escape_string($db, $_POST['idealgamble']);
				$idealreligion = mysqli_real_escape_string($db, $_POST['idealreligion']);

				$sql = "UPDATE ideal SET idealgender ='$idealgender', idealage='$idealage', idealbtype='$idealbtype', idealeducation='$idealeducation', idealrace='$idealrace', idealdrink='$idealdrink', idealsmoke='$idealsmoke', idealgamble='$idealgamble', idealreligion='$idealreligion' WHERE user_id=$user_id";
				mysqli_query($db, $sql);
				header("Location:updateprofile.php");
			}
		}
	}else{ // else if its not, insert new informations
		$sql2 = "SELECT user_id FROM members WHERE user_id = $user_id";
		$result = $db->query($sql2);

		if($row = mysqli_fetch_assoc($result)){
			if (isset($_POST['pref_btn2'])) {
				$idealgender = mysqli_real_escape_string($db, $_POST['idealgender']);
				$idealage = mysqli_real_escape_string($db, $_POST['idealage']);
				$idealbtype = mysqli_real_escape_string($db, $_POST['idealbtype']);
				$idealeducation = mysqli_real_escape_string($db, $_POST['idealeducation']);
				$idealrace = mysqli_real_escape_string($db, $_POST['idealrace']);
			 	$idealdrink = mysqli_real_escape_string($db, $_POST['idealdrink']);
				$idealsmoke = mysqli_real_escape_string($db, $_POST['idealsmoke']);
				$idealgamble = mysqli_real_escape_string($db, $_POST['idealgamble']);
				$idealreligion = mysqli_real_escape_string($db, $_POST['idealreligion']);

				$sql = "INSERT INTO ideal(user_id, idealgender, idealage, idealbtype, idealeducation, idealrace, idealdrink, idealsmoke, idealgamble, idealreligion) VALUES('$user_id', '$idealgender', '$idealage', '$idealbtype', '$idealeducation', '$idealrace', '$idealdrink', '$idealsmoke', '$idealgamble', '$idealreligion')";
				mysqli_query($db, $sql);
				header('location:match.php');
			}
		}
	}
 ?>
<html>
	<head>
		<link rel="stylesheet" type="text/css" href="../../Client/css/preference.css">
		<link href="https://fonts.googleapis.com/css?family=Lobster" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Raleway" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
		<?php include("../../Client/external/nav.php");?>
	</head>
	<title>Preference</title>
  <body>
		<h1>Preferences</h1>
    <div id="pref" class = "preferences">
	    <form method="POST" action="preference5.php">
	      <p>I am looking for a</p>
	      <input type="radio" name="idealgender" value="male" required> Male
				<input type="radio" name="idealgender" value="female"required> Female
				<br><br>

	      <p>I would like my partner to be in this age range</p>
	        <select name="idealage"required>
	          <option></option>
	          <option value="young">18-26</option>
	          <option value="middle">27-35</option>
	          <option value="late">36-39</option>
	          <option value="old">40+</option>
	      	</select>

	      <p>My ideal body type is for my partner is</p>
	        <select name="idealbtype"required>
	          <option></option>
	          <option value="Slim">Slim</option>
	          <option value="Athletic">Athletic</option>
	          <option value="Average">Average</option>
	          <option value="Overweight">Overweight</option>
	          <option value="Obese">Obese</option>
	      	</select>
				<br><br>

	      <p>My ideal education level for my partner is</p>
	        <select name="idealeducation"required>
	          <option></option>
	          <option value="High School Graduate">High School Graduate</option>
	          <option value="Certificate Diploma">Certificate Diploma</option>
	          <option value="Bachelor's Degree">Bachelor's Degree</option>
	          <option value="Master's Degree">Master's Degree</option>
	          <option value="Doctorate">Doctorate</option>
	      	</select>
				<br><br>

	      <p>My preferred ethnicity for my partner is</p>
	        <select name="idealrace"required>
	          <option></option>
						<option value="Aboriginal">Aboriginal</option>
						<option value="Asian">Asian</option>
						<option value="African">African</option>
						<option value="Caucasian">Caucasian</option>
						<option value="Hispanic">Hispanic</option>
						<option value="Polynesian">Polynesian</option>
						<option value="Middle Eastern">Middle Eastern</option>
						<option value="Other">Other</option>
	        </select>
				<br><br>

	      <p>I'd like my partner to drink</p>
	        <select name="idealdrink"required>
	          <option></option>
	          <option value="Yes">Yes</option>
	          <option value="No">No</option>
	      	</select>
				<br><br>

	      <p>I'd like my partner to smoke</p>
	        <select name="idealsmoke"required>
	          <option></option>
	          <option value="Yes">Yes</option>
	          <option value="No">No</option>
	      	</select>
				<br><br>

	      <p>I'd like my partner to gamble</p>
	        <select name="idealgamble"required>
	          <option></option>
	          <option value="Yes">Yes</option>
	          <option value="No">No</option>
	      	</select>
				<br><br>

	      <p>My preferred religion for my partner is</p>
	        <select name="idealreligion"required>
	          <option></option>
	          <option value="Atheist">Atheist</option>
	          <option value="Agnostic">Agnostic</option>
	          <option value="Buddhism">Buddhism</option>
	          <option value="Catholic">Catholic</option>
	          <option value="Christianity">Christianity</option>
	          <option value="Hinduism">Hinduism</option>
	          <option value="Islam">Islam</option>
	          <option value="Judaism">Judaism</option>
	          <option value="Other">Other</option>
	          <option value="None">None</option>
	        </select>
				<br><br>

	      <input type ="submit" class ="nextbtn" name ="pref_btn2" value ="Next">

	    </form>
        <br>
  	</div>
	</body>
	<?php include("../../Client/external/footer.php");?>
</html>
