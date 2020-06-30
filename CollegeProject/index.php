<?php 
    session_start();
    // error_reporting (E_ALL ^ E_NOTICE);
    // error_reporting(0);
    // error_reporting(E_ALL & ~E_NOTICE);
    require('dbcon.php');
    require('config.php');

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

    // if (!$result) {
    //     printf("Error: %s\n", mysqli_error($conn));
    //     exit();
    // }

    $posts = mysqli_fetch_all($result,MYSQLI_ASSOC);

    mysqli_free_result($result);

    // mysqli_close($conn);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Card Saver</title>

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
    <link rel="stylesheet" type="text/css" href="assests/card.css">

</head>
<body>
    <section id = "title" class="vh-100">
        <div class="top-welcome" <?php echo ($_SESSION['status'] == 0) ? 'style="display:none;"' : '' ?>>
            <h2>Hello, <p style = "text-transform:capitalize; display:inline-block;">
            <?php echo $_SESSION['username'] ;?></p></h2>
        </div> 
        <div class="top-login" <?php echo ($_SESSION['status'] == 1) ? 'style="display:none;"' : '' ?>>
            <a href="login.php" class="top-login-btn btn btn-primary btn-md " role="button">Log In</a>
            <a href="register.php" class="top-login-btn btn btn-outline-danger btn-md " role="button">Sign up</a>
        </div>  
        <div class="top-logout" <?php echo ($_SESSION['status'] == 0) ? 'style="display:none;"' : '' ?>>
            <a href="logout.php" class="top-login-btn btn btn-outline-danger btn-md " onclick='logoutck();' role="button">Log Out</a>
        </div>
        <div class = "container-fluid ">
            <!-- Navbar -->
            <nav class= "navbar navbar-expand-lg navbar-dark" style="background-color: #255BCC80; opacity: 1;">
                <a class="navbar-brand" href=" ">Card Saver</a>

                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo02" aria-controls="navbarTogglerDemo02" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarTogglerDemo02">
                    <ul class="navbar-nav ml-auto">
                        <li class="nav-item active">
                            <a class="nav-link" href="#">Your Cards <span class="sr-only">(current)</span></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="admin/addCard.php" 
                            <?php echo ($_SESSION['status'] == 0) ? 'style="display:none;"' : '' ?>>Add Card</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="admin/deleteCard.php" 
                            <?php echo ($_SESSION['status'] == 0) ? 'style="display:none;"' : '' ?>>Delete Card</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">Contact Me</a>
                        </li>
                    </ul>     
                </div>
            </nav>
            
            <h1> Use Your Card Anywhere without Any Hassel </h1>

            <div class="card-div" <?php echo ($_SESSION['status'] == 0) ? 'style="display:none;"' : '' ?> >
            
                <div class="row card-list">
                    <!-- <div class="col-md-6"> -->
                        <?php foreach($posts as $post): ?>
                            <a href="" class="card-link-a" onclick="copyToClipboard(#card_number)">
                            <div class="card">
                                <figure class="card__figure">
                                <i class="fab fa-cc-visa fa-4x icon-feature"></i>
                                </figure>
                                <div class="card__reader">
                                <div class="card__reader--risk card__reader--risk-one"></div>
                                <div class="card__reader--risk card__reader--risk-two"></div>
                                <div class="card__reader--risk card__reader--risk-three"></div>
                                <div class="card__reader--risk card__reader--risk-four"></div>
                            </div>
                                <p class="card__number" id="card_number"><?php echo $post['CardNumber'];?></p>
                                <div class="card__dates">
                                    <span class="card__dates--first">Expiry</span>
                                    <span class="card__dates--second" id="expiry" ><?php echo $post['ExpiryDate'];?></span>
                                </div>
                                <p class="card__name" ><?php echo $post['NameOnCard'];?><p>
                                <div class="card__flag">
                                    <div class="card__flag--globe"></div>
                                    <div class="card__flag--red"></div>
                                    <div class="card__flag--yellow"></div>
                                </div>
                                </div>                                                      
                            
                             </a>
                        <?php endforeach; ?>
                    <!-- </div> -->
                </div>
            </div>
            
            <div class="card-view" <?php echo ($_SESSION['status'] == 1) ? 'style="display:none;"' : '' ?> >

                <div class="cards">
                    <div class ="card-body">
                        <h4 class="card-title">Register to get Started</h4>
                
                        <a href="register.php"><button type="button" class="register-button btn btn-primary btn-lg">Register</button></a>
                        <h6 class="card-subtitle">*Your Information is safe with us</h6>
                    
                    </div>
                </div>
            </div>
        </div>
   
    </section>

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