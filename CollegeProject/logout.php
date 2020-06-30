<?php

echo"Watashi ba daiski";
require('dbcon.php');
require('config.php');

session_start();

    $_SESSION['status'] = 0;

header('Location: '.ROOT_URL.'');

?>