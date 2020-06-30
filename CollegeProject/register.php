<?php
  // echo $_SERVER['QUERY_STRING'];
  require('dbcon.php');
  require('config.php');

  /**GET SQL DATA */
  $query = 'SELECT * FROM userscard';

  $result = mysqli_query($conn,$query);

  $posts = mysqli_fetch_all($result,MYSQLI_ASSOC);

  mysqli_free_result($result);

  

  if(isset($_POST['submit'])){
    
    $firstName = mysqli_real_escape_string($conn,$_POST['first']);
    $lastName = mysqli_real_escape_string($conn,$_POST['last']);
    $email = mysqli_real_escape_string($conn,$_POST['email']);
    $username = mysqli_real_escape_string($conn,$_POST['username']);
    $password = mysqli_real_escape_string($conn,$_POST['password']);
    $photoUrl = mysqli_real_escape_string($conn,$_POST['fileToUpload']);
  
    $Current_On = date('Y-m-d H:i:s');

    $query = ("INSERT INTO userscard (firstName,lastName,username,password,email,Created_On,Picture) 
                VALUES ('$firstName','$lastName','$username','$password','$email','$Current_On','$photoUrl')");


    $count = 0;
    foreach($posts as $post ){
      if($post['username']==$username){
       
          $count++;
          break;
        }
    }  
    if($count==0){
      if(mysqli_query($conn,$query)){
        session_start();//start of session
        $_SESSION['status'] = 1;//if logged in
        $_SESSION['username'] = $username;
        header('Location: '.ROOT_URL.'');
      }else{
        echo 'ERROR: '.mysqli_error($conn);
      }
    }else{
      echo "<div class=\"alert alert-warning alert-dismissible fade show\" role=\"alert\">
      <strong>Sorry!</strong> You have to use a different username.
      <button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Close\">
      <span aria-hidden=\"true\">&times;</span>
      </button>
       </div>";
    }
  }
  

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration Form</title>

    <!-- Font Awesome -->
    <script src="https://kit.fontawesome.com/3fc76d7947.js" crossorigin="anonymous"></script>

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css"
        integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    
    <!-- Google Fonts -->
    
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;900&display=swap"
    rel="stylesheet">

    <!-- CSS link -->
    <link rel="stylesheet" type="text/css" href="css/stylesheet.css">

</head>
<body>
<div class="top-back">
  <a href="index.php"><button type="button" class="back-button btn btn-warning btn-lg"> < Home</button></a>
</div>
<form class="form-class" action="<?php $_SERVER['PHP_SELF'];?>" method="POST" onsubmit="return checkForm(this);">

    <div class="register-ui">
      <h2 class="Register-head">Register </h2>
      <br>
        <div class="form-row">
          <div class="col">
            <input type="text" class="form-control" placeholder="First name" name="first" 
             value="<?php echo isset($_POST['first'])? $firstName:''; ?>">
          </div>
          <div class="col">
            <input type="text" class="form-control" placeholder="Last name" name="last"
            value="<?php echo isset($_POST['last'])? $lastName:''; ?>">
          </div>
        </div>
        <br>
        <div class="form-group">
          <label for="exampleInputEmail1">Email address</label>
          <input type="email" name = "email" class="form-control" id="exampleInputEmail1" 
          aria-describedby="emailHelp" placeholder="Enter email" value="<?php echo isset($_POST['email'])? $email:''; ?>">
          <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
        </div>

        <div class="form-group">
          <label for="username">Choose a Username</label>
          <input type="text" name = "username" class="form-control" id="exampleInputEmail1"  placeholder="example@username">
        </div>

        <div class="form-group">
          <label for="exampleInputPassword1">Password</label>
          <input type="password" name="password" class="form-control" id="exampleInputPassword1" placeholder="Password">
        </div>
      
        <p>Select image for profile picture:</p>
        <input type="file" name="fileToUpload" id="fileToUpload" 
        value="<?php echo isset($_POST['fileToUpload'])? $photoUrl:''; ?>">
        <input type="submit" value="Upload Image" name="photo">
        <small id="emailHelp" class="form-text text-muted">This feature will be added soon!.</small>
        <br>

        <div class="form-check">
          <input type="checkbox" class="form-check-input" id="exampleCheck1" name="terms">
          <label class="form-check-label" for="exampleCheck1">By clicking you accept all <a href="#">terms and conditions</a></label>
        </div>

      <button name="submit" type="submit" class="btn btn-primary">Submit</button>
  </div>
</form>
    

     <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->

    <script>

  function checkForm(form)
  {
    ...
    if(!form.terms.checked) {
      alert("Please indicate that you accept the Terms and Conditions");
      form.terms.focus();
      return false;
    }
    return true;
  }

</script>





    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js"
        integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n"
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"
        integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo"
        crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"
        integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6"
        crossorigin="anonymous"></script>
        
    <!-- CUSTOM SCRIPT  -->
    <script src="js/script.js"></script>
</body>
</html>