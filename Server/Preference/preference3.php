<?php
	session_start();

	$db = mysqli_connect("localhost", "root", "", "accounts" );
	$username = $_SESSION["username"];

	$get = "SELECT user_id FROM members WHERE username = '$username'";
	$result = $db->query($get);

	if ($row = mysqli_fetch_assoc($result)){
		$user_id = $row["user_id"];
	}else{
		echo "Not working";
	}

	if ($_SESSION["update"] == TRUE){ // if the user wants to UPDATE their profile
		$sql2 = "SELECT user_id FROM members WHERE user_id = $user_id";
		$result = $db->query($sql2);

		if($row = mysqli_fetch_assoc($result)){//update the table favourites with new set of data
			if (isset($_POST['pref_btn'])) {
				$movgenre = mysqli_real_escape_string($db, $_POST['movgenre']);
				$favmovie = mysqli_real_escape_string($db, $_POST['favmovie']);
				$musgenre = mysqli_real_escape_string($db, $_POST['musgenre']);
				$favsong = mysqli_real_escape_string($db, $_POST['favsong']);

				$sql = "UPDATE favourites SET movgenre='$movgenre', favmovie='$favmovie', musgenre='$musgenre', favsong='$favsong' WHERE user_id=$user_id";
				mysqli_query($db, $sql);

				header("Location:updateprofile.php");
			}
		}
	}else{ // else if its NOT an update, INSERT new information into favourites table then head to the next page
		$sql2 = "SELECT user_id FROM members WHERE user_id = $user_id";
		$result = $db->query($sql2);

		if($row = mysqli_fetch_assoc($result)){
			if (isset($_POST['pref_btn'])){
				$movgenre = mysqli_real_escape_string($db, $_POST['movgenre']);
				$favmovie = mysqli_real_escape_string($db, $_POST['favmovie']);
				$musgenre = mysqli_real_escape_string($db, $_POST['musgenre']);
				$favsong = mysqli_real_escape_string($db, $_POST['favsong']);

				$sql = "INSERT INTO favourites(user_id, movgenre, favmovie, musgenre, favsong) VALUES('$user_id', '$movgenre', '$favmovie', '$musgenre', '$favsong')";
				mysqli_query($db, $sql);

				header("Location:preference4.php");
			}
		}
	}
?>
<!DOCTYPE html>
<html>
	<head>
		<link rel="stylesheet" type="text/css" href="../../Client/css/preference.css">
		<link href="https://fonts.googleapis.com/css?family=Lobster" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Raleway" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
		<?php include("../../Client/external/nav.php");?>
	</head>
  <body>
  	<h1>About Me</h1>
  	<div id="pref" class = "preferences">
    	<form method="POST" action="preference3.php">
        <p>What is your favourite movie genre?</p>
          <select name="movgenre"required>
            <option></option>
    				<option value="Action">Action</option>
    				<option value="Adventure">Adventure</option>
            <option value="Comedy">Comedy</option>
            <option value="Crime">Crime</option>
            <option value="Drama">Drama</option>
            <option value="Fantasy">Fantasy</option>
            <option value="Horror">Horror</option>
            <option value="Romance">Romance</option>
            <option value="Satire">Satire</option>
            <option value="Thriller">Thriller</option>
          </select>
				<br><br>

        <p>What is your favourite movie?</p>
          <input  type="text" value="" placeholder="" name="favmovie" id="movie" style="width: 70%;"required/>
				<br>

        <p>What is your favourite music genre?</p>
         	<select name="musgenre"required/>
            <option></option>
		    		<option value="alt">Alternative</option>
		    		<option value="blu">Blues</option>
            <option value="class">Classical</option>
            <option value="com">Comedy</option>
            <option value="Country">Country</option>
            <option value="Dance">Dance</option>
            <option value="Electronic">Electronic</option>
            <option value="Hip-Hop">Hip-Hop</option>
            <option value="Indie">Indie</option>
            <option value="Jazz">Jazz</option>
            <option value="K-Pop">K-Pop</option>
    				<option value="Latin">Latin</option>
            <option value="Pop">Pop</option>
	    <option value="Rap">Rap</option>
            <option value="Reggae">Reggae</option>
            <option value="Rock">Rock</option>
            <option value="Soundtrack">Soundtrack</option>
            <option value="World">World</option>
        	</select>
				<br><br>

        <p>What is your favourite song?</p>
          <input  type="text" value="" placeholder="" name ="favsong" id="song" style="width: 70%;"required/><br>

        <input type ="submit" class ="nextbtn" name ="pref_btn" value ="Next">
      </form>
    <br>

  	</div>
	</body>
	<?php include("../../Client/external/footer.php");?>
</html>
