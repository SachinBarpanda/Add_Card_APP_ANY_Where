<?php
    session_start();
    // error_reporting (E_ALL ^ E_NOTICE);
    require('../dbcon.php');
    require('../config.php');

    /**GET SQL DATA */

    $stringUser = $_SESSION['username'];
    $id_query = "SELECT id FROM userscard WHERE userscard.username = \"$stringUser\"";
    $userid_result = mysqli_query($conn,$id_query);
    $posts_userid = mysqli_fetch_all($userid_result,MYSQLI_ASSOC);
    mysqli_free_result($userid_result);

    foreach($posts_userid as $post_id){
        $id_num = $post_id["id"];
        break;
    }   
    $query = "SELECT * FROM carddetails WHERE userid = $id_num";

    $result = mysqli_query($conn,$query);
    if (!$result) {
        printf("Error: %s\n", mysqli_error($conn));
        exit();
    }

    $posts = mysqli_fetch_all($result,MYSQLI_ASSOC);


    //Deleting the Item


    if(isset($_POST['delete'])){
        $delete_id = $_POST['checkbox'];
         $id = count($delete_id);
         if ($id > 0){
             foreach ($delete_id as $id_d):
                $sql = "DELETE FROM carddetails WHERE id='$id_d'";
                $delete = mysqli_query($conn,$sql);
             endforeach;
             header('Location: deleteCard.php');
        }
        
    }

    mysqli_free_result($result);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Delete Card</title>

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
    <div class="top-back">
    <a href="../index.php"><button type="button" class="back-button btn btn-warning btn-lg"> < Home</button></a>
    </div>
    <h2 class="addCard-head" style="text-align:center;"> DELETE A CARD </h2>
    <form action="<?php $_SERVER['PHP_SELF'];?>" method="POST">

        <div class="container-fluid ">
            <table class="table table-dark table-hover">
            <thead>
                <tr>
                    <th></th>
                    <th scope="col">id</th>
                    <th scope="col">Name</th>
                    <th scope="col">Card Number</th>
                    <th scope="col">Expiry</th>
                    <th scope="col">Name On Card</th>
                    <th scope="col">cvv</th>
                    <th scope="col">Phone Number</th>
                    <th scope="col">userid</th>
                </tr>
            </thead>
            <tbody>
            <?php foreach($posts as $post): ?>
                <tr>
                    <td><input name="checkbox[]" type="checkbox" id="checkbox[]" value=<?php echo $post['id'];?>></td>
                    <th name ="name_id" scope="row"><?php echo $post['id'];?></th>
                    <td><?php echo $post['cardName'];?></td>
                    <td><?php echo $post['CardNumber'];?></td>
                    <td><?php echo $post['ExpiryDate'];?></td>
                    <td><?php echo $post['NameOnCard'];?></td>
                    <td><?php echo $post['cvv'];?></td>
                    <td><?php echo $post['PhoneNumberForOTP'];?></td>
                    <td><?php echo $post['userid'];?></td>
                </tr>
            <?php endforeach;?>
            <tr><td><input class="btn btn-warning" type="submit" name="delete" value="Delete" id="delete"></td></tr></tr></table>
            </tbody>
            </table>                                                                            
        </div>
    </form>
    







<!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
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