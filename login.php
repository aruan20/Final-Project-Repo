<?php

$error = '';
if ($_SERVER ["REQUEST_METHOD"] == "POST" && isset($_POST['submit'])){
  $username = trim($_POST['username']);
  $pwd = trim($_POST['pwd']);
  if (empty($username)) {
    $error .= '<p class = "error">Please enter username.</p>';
  }
  if (empty($pwd)) {
    $error .= '<p class = "error">Please enter password.</p>';
  }
  if (empty($error)) {
    if ($query = $db -> prepare("SELECT * FROM users")){
      $query -> bing_param('s', $username);
      $query -> execute();
      $row = $query -> fetch();
      if ($row) {
        if (password_verify ($pwd, $row['pwd'])) {
          header("location: welcome.php");
          exit;
        }
        else {
          $error .= '<p class = "error">The username or password is not valid.</p>';
        }
      }
      else {
        $error .= '<p class = "error">The username or password is not valid.</p>';
      }
    }
    $query->close();
  }
  mysqli_close($db);
}


<!DOCTYPE html>
<html>
<head>
  <title>Exploding Cheetos</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>

<body>
  <form>
    <label for ="username">Username: </label>
    <input type="text" id="username" name="username"><br>
    <label for ="pwd">Password: </label>
    <input type="text" id="pwd" name="pwd"><br>
    <
  </form>

</html>
