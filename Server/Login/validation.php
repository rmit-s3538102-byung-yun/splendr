<?php
  session_start();

  $db = mysqli_connect("localhost", "root", "", "accounts");

  $username = $_POST['username'];
  $pwrd = $_POST['password'];
  $_SESSION['username'] = $username; //used later in other php files to check user_id
  $password = md5($pwrd); //securing password using md5

  $sql = "SELECT * FROM members WHERE username ='$username'AND password='$password'"; //login verification, checking the username and hashed password is exactly same as database
  $result = $db->query($sql);

  if (!$row = mysqli_fetch_assoc($result)) { // if condition above is met, run the code below
    $_SESSION["error"] = FALSE; //login attempt failed
    $_SESSION["loggedin"] = FALSE; //not logged in

    header("Location:login.php");//head back to login page
  }else{
    $_SESSION["loggedin"] = TRUE; // logged in
    $_SESSION["loggedid"] = $row["user_id"]; //save logged in user's id
    $_SESSION["username"] = $row["username"];
    // store
    header("Location:../../Client/index/index.php");
  }
?>
