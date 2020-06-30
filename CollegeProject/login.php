<?php
    session_start();

    require('dbcon.php');
    require('config.php');


    if(isset($_POST['submit'])){
        $username = mysqli_real_escape_string($conn,$_POST['username']);
        $password = mysqli_real_escape_string($conn,$_POST['password']);
        
        //check for the username in the same column

        $sql = "SELECT id FROM userscard WHERE username = '$username' and password = '$password'";
        echo $sql;
        $result = mysqli_query($conn,$sql);
        $row = mysqli_fetch_array($result,MYSQLI_ASSOC);
        var_dump($row);
        
        
        $count = mysqli_num_rows($result);
      
      // If result matched $myusername and $mypassword, table row must be 1 row
		
      if($count == 1) {
          $_SESSION['img-url'] = $
         $_SESSION['username'] = $username;
         $_SESSION['status'] = 1;
         
         header("location: index.php");
      }else {
        echo "<div class=\"alert alert-danger\" role=\"alert\">
            Your Login Name or Password is invalid!
            </div>";
      }
    
    
    
    }
    
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    
    <!-- Font Awesome -->
    <script src="https://kit.fontawesome.com/3fc76d7947.js" crossorigin="anonymous"></script>

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css"
        integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    
    <!-- Google Fonts -->
    
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;900&display=swap"
    rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&display=swap" rel="stylesheet">
    <!-- CSS link -->
    <link rel="stylesheet" type="text/css" href="css/stylesheet.css">

</head>
<body>
<div class="login-ui">
    <h2 class="login-head">Log-In</h2>
    <br>
    <form class="form-class" action="<?php $_SERVER['PHP_SELF'];?>" method="POST">
        <div class="form-group">
            <label for="username">Enter Your Username</label>
            <input type="text" name = "username" class="form-control" id="exampleInputEmail1" placeholder="example@username">
            </div>

        <div class="form-group">
          <label for="exampleInputPassword1">Enter Your Password</label>
          <input type="password" name = "password" class="form-control" id="exampleInputPassword1" placeholder="Password">
        </div>
        <button name = "submit" type="submit" class="btn btn-primary">Submit</button>
    </form>

</div>

</body>
</html>