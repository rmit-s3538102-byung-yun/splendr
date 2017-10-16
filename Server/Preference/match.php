<!DOCTYPE html>
<?php
  require("preferencefinish.php");

  $db = mysqli_connect("localhost", "root", "", "accounts");
  $username = $_SESSION["username"];
  $year = date("Y");//used to calculate age later

  $get = "SELECT user_id FROM members WHERE username = '$username'";
  $result = $db->query($get);

  if ($row = mysqli_fetch_assoc($result)) {
    $user_id = $row["user_id"];
  }
?>
<html>
  <?php include("../../Client/external/nav.php");
    foreach($db->query("SELECT COUNT(message) FROM message WHERE friend_id ='$myid' AND status= '1'") as $row) { //  check how many unread messages the user has
	    $notification = $row['COUNT(message)'];
    }
  ?>
  <head>
		<link rel ="stylesheet" type="text/css" href ="../../Client/css/match.css">
    <link href="https://fonts.googleapis.com/css?family=Lobster" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Raleway" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
    <meta charset="utf-8">
    <title>Match</title>
  </head>
  <body>
  	<h1>FIND YOUR MATCH</h1>
  	<?php
  	$query = "SELECT * FROM members AS m INNER JOIN ideal AS i ON m.user_id=i.user_id INNER JOIN information AS f ON m.user_id = f.user_id INNER JOIN hobby as h ON m.user_id = h.user_id WHERE m.user_id='$user_id'";
  	$result2 = $db->query($query);
  	if ($result2->num_rows > 0) {
  	    // output data of each row
  	  while($row = $result2->fetch_assoc()) {
        if ($row["idealgender"] == "female") {
          $gender = "Female"; // rewriting the value with Upper case at the front
        }else{
          $gender = "Male";
        }
  			$age = $year - $row["doby"]; // calculating age, using the date of birth year in database and current year

        echo "<p class='asd'>Name: ".$row["fname"]." ".$row["lname"]."<br>"."Gender: ".$row["gender"]."<br>"."Age: ".$age."<br>"."Height: ".$row["height"]."<br>"; // this is for the user that is using the system currently.
        echo "Looking for: ".$gender."<br>";
        echo "Ideal Body Type: ".$btype."<br></p>";
  		}
      echo "<h2>YOUR MATCHES</h2><br><br>";
  	}
  	$sql = "SELECT * FROM members AS m INNER JOIN ideal AS i ON m.user_id=i.user_id INNER JOIN information AS f ON m.user_id = f.user_id INNER JOIN hobby as h ON m.user_id = h.user_id INNER JOIN result as s ON m.user_id = s.user_id
  	INNER JOIN members as m2 ON m2.user_id=s.partner_id INNER JOIN information AS f2 ON m2.user_id = f2.user_id  INNER JOIN ideal AS i2 ON m2.user_id = i2.user_id INNER JOIN hobby as h2 ON m2.user_id = h2.user_id WHERE m.user_id = $user_id order by s.score desc";
  	$result = $db->query($sql); // joining member, ideal, information, hobby, result to display list of users matched and their informations.
    //THIS IS FOR THE MATCHED USERS
  	echo "<table>
            <tr style='background: #FFCFD1;'>
    	 	      <th>GENDER</th>
    		      <th>NAME</th>
    		      <th>AGE</th>
    		      <th>HEIGHT</th>
    		      <th>LOOKING FOR</th>
    		      <th>BODY TYPE</th>
              <th>ETHNICITY</th>
    		      <th>COMMON INTERESTS</th>
    		      <th>SCORE</th>
                  <th></th>
  	       </tr>";
  	if ($result -> num_rows > 0) {// if the conditions are all met
  		while ($row = $result->fetch_assoc()) { // print every sin\
  			if ($row["idealgender"] == "male") {
  				$idealgender = "Male";
  			}else{
  				$idealgender = "Female";
  			}
        $ethnic = $row["ethnic"];
  			$age = $year - $row["doby"];
  			$id = $row["user_id"];

        echo "<tr><td>".$row["gender"]."</td>".
  			"<td>".$row["fname"]." ".$row["lname"]."</td>".
  			"<td>".$age."</td>".
  			"<td>".$row["height"]."</td>".
  			"<td>".$idealgender."</td>".
  			"<td>".$btype."</td>".
        "<td>".$ethnic."</td>".
  			"<td>".$row["similarint"]."</td>".
  			"<td>".$row["score"]."%"."</td>";

        foreach($db->query("SELECT COUNT(*) FROM message WHERE friend_id ='$myid' AND status= '1'") as $row) {
        	$notification = $row['COUNT(*)'];
        } // if the matched user with this id has sent the logged in user a message, display how many unread messages there are
        $sql2 = "SELECT * FROM message WHERE user_id = $id AND status = '1'";
        $result2 = $db->query($sql2);
        if ($row2 = mysqli_fetch_assoc($result2)) { // if the user has messages from a certain person, display how many from such user
          echo "<td><form action='../Profile/profilepage.php?user=$id' method='post'>
  				<a href='../Profile/profilepage.php?user=$id' class='profiletest'>View Profile</a><br>
          <a href='chat.php?user=$id' class='profiletest'>Send Message($notification)</a></td></tr>";
  		    echo "</form>";
        }else{ // else just display the normal buttons
          echo "
          <td><form action='../Profile/profilepage.php?user=$id' method='post'>
          <a href='../Profile/profilepage.php?user=$id' class='profiletest'>View Profile</a><br>
          <a href='chat.php?user=$id' class='profiletest'>Send Message</a></td></tr>";
          echo "</form>";
        }
      }
    }
  	echo "</table>";
    ?>
  </body>
  <?php include("../../Client/external/footer.php");?>
</html>
