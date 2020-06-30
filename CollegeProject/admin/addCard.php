<?php
    require('../dbcon.php');
    require('../config.php');
    session_start();

    /**GET SQL DATA */
    $query1 = 'SELECT * FROM carddetails';

    $result = mysqli_query($conn,$query1);

    $posts = mysqli_fetch_all($result,MYSQLI_ASSOC);
    //   var_dump($posts);

    mysqli_free_result($result);

    //   mysqli_close($conn);


    if(isset($_POST['submit'])){

        $name = mysqli_real_escape_string($conn,$_POST['first-name']);
        $number = mysqli_real_escape_string($conn,$_POST['number']);
        echo $number;
        $expiry = mysqli_real_escape_string($conn,$_POST['expiry']);
        $cvc = mysqli_real_escape_string($conn,$_POST['cvc']);
        $cardName = mysqli_real_escape_string($conn,$_POST['cardName']);
        $phoneNumber = mysqli_real_escape_string($conn,$_POST['phone']);

        $stringUser = $_SESSION['username'];
        $id_query = "SELECT id FROM userscard WHERE userscard.username = \"$stringUser\"";
        $userid_result = mysqli_query($conn,$id_query);
        $posts_userid = mysqli_fetch_all($userid_result,MYSQLI_ASSOC);
        mysqli_free_result($userid_result);
       
        foreach($posts_userid as $post){
            $id_num = $post["id"];
            break;
        }
        // echo $id_num;

        $query = ("INSERT INTO carddetails (cardName,NameOnCard,CardNumber,ExpiryDate,cvv,PhoneNumberForOTP,userid) 
                VALUES ('$cardName','$name','$number','$expiry','$cvc','$phoneNumber','$id_num')");
                

        $count = 0;
        foreach($posts as $post){
        if($post['CardNumber']==$number){
        
            $count++;
            break;
            }
        }  
        if($count==0){
            if(mysqli_query($conn,$query)){
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
    <title> Add Your Card Here </title>

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
    <link rel="stylesheet" type="text/css" href="../css/stylesheet.css">


    <script src="../assests/card.js"></script>


</head>

<body>
    <div class="top-back">
    <a href="../index.php"><button type="button" class="back-button btn btn-warning btn-lg"> < Home</button></a>
    </div>

    <h2 class="addCard-head"> ADD YOUR CARD </h2>
    <div class='card-wrapper'></div>
    <!-- CSS is included via this JavaScript file -->

    <form class="form-class" action="<?php $_SERVER['PHP_SELF'];?>" method="POST">
        <div class="register-ui">
        <br>
        <div class="form-group">
                <label for="exampleInputEmail1">Give A Name To Your Card</label>
                <input type="text" name = "cardName" class="form-control">
                <small id="emailHelp" class="form-text text-muted">*This will help us to recognize your card.</small>
            </div>
        <div class="form-group">
            <label for="username">Enter Card Number</label>
            <input type="text" name = "number" class="form-control" placeholder="**** **** **** ****">
        </div>
        <div class="form-row">
            <div class="col">
            <input type="text" class="form-control" placeholder="Name On The Card" name="first-name" 
                value="<?php echo isset($_POST['first'])? $firstName:''; ?>">
            </div>
        </div>
        <br>
        <div class="form-row">
            <div class="col">
            <label for="username">Expiry</label>
            <input type="text" class="form-control" placeholder="- - / - -" name="expiry" 
                value="<?php echo isset($_POST['first'])? $firstName:''; ?>">
            </div>
            <div class="col">
            <label for="username">CVV</label>
            <input type="text" class="form-control" placeholder=" * * * " name="cvc" 
                value="<?php echo isset($_POST['first'])? $firstName:''; ?>">
            </div>
            </div>
            <br>
            
            <div class="form-group">
                <label for="exampleInputEmail1">Phone Number</label>
                <input type="text" name = "phone" class="form-control">
            </div>
            <button name="submit" type="submit" class="btn btn-primary">Submit</button>
        </div>
        

        
    </form>















    <script>
    var card = new Card({
        form: 'form',
        container: '.card-wrapper',

        formSelectors: {
            nameInput: 'input[name="first-name"], input[name="last-name"]'
        }
    });

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
        <script src="../js/script.js"></script>
</body>
</html>