<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE-edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login</title>
  <link rel="preload" href="loginstylee.css" as="style" />
  <link rel = "stylesheet" type="text/css" href = "loginstylee.css">
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Sharp" rel="stylesheet">
</head>
<body>
  <div class="center">
    <h2>Login</h2>
    <form method="post" action = "login.php">
      <div class="txt_field">
        <input type="text" name="username" required />
        <span></span>
        <label>Username</label>
      </div>
      <div class="txt_field">
        <input type="password" name="password" required />
        <span></span>
        <label>Password</label>
      </div>
      <input type="submit" value="Login" />
    </form>
  </div>
  <?php
       session_start();
         $conn = mysqli_connect("localhost", "lacaprose5bin", "", "my_lacaprose5bin");
         if (!$conn) {
            die("Connection failed: " . mysqli_connect_error());
        }  
		$username = filter_input(INPUT_POST, 'username', FILTER_SANITIZE_STRING);
        $password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRING);
        if(!empty($username) && !empty($password)) {
            $pass = md5($password);
		    $sql = "SELECT * FROM Users WHERE UserName = '$username' AND Password = '$pass'";
		    $result = mysqli_query($conn, $sql);
		    if (mysqli_num_rows($result) > 0) {
                $_SESSION['username'] = $username;
                header("Location: advertisements.php"); 
            } else {
                echo '<script type = "text/javascript"> alert("You have entered an invalid username or password.") </script>';
            }
        }

        mysqli_close($conn);
  ?>
</body>
</html>
