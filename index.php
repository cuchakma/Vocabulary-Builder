<?php
/**
 * session variable used for login
 */
session_start();
$user_id = $_SESSION['id'] ?? 0;

if( $user_id ) {
    header("Location:words.php");
    die();
}

include_once 'functions.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Vocabulary Builder</title>
    <link rel="stylesheet" href="//fonts.googleapis.com/css?family=Roboto:300,300italic,700,700italic">
    <link rel="stylesheet" href="//cdn.rawgit.com/necolas/normalize.css/master/normalize.css">
    <link rel="stylesheet" href="//cdn.rawgit.com/milligram/milligram/master/dist/milligram.min.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css" integrity="sha384-oS3vJWv+0UjzBfQzYUhtDYW+Pj2yciDJxpsK1OYPAYjqT085Qq/1cq5FLXAZQ7Ay" crossorigin="anonymous">

    <link rel="stylesheet" href="assets/css/style.css">

</head>
<body class="home">
<div class="container" id="main">
    
    <h1 class="maintitle" style="text-align: center;">
        <i class="fas fa-language"></i></br>My Vocabularies
    </h1>

    <div class="row navigation">
        <div class="column column-60 column-offset-20">
            <div class="formaction">
                <a href="#" id="login">Login</a> | <a href="#" id="register">Register Account</a>
            </div>
            <div class="formc">
                <form id="form01" method="post" action="tasks.php">
                    <h3>Login</h3>
                    <fieldset>
                        <label for="email"></label>
                        <input type="text" placeholder="Email Address" id="email" name="email">
                        <label for="password">Password</label>
                        <input type="password" placeholder="Password" id="password" name="password">

                        <p>
                            <?php 
                                $status = $_GET['status'] ?? 0;
                                echo getStatusMessage($status);
                            ?>
                        </p>

                        <input class="button-primary" type="submit" value="Submit">
                        <input type="hidden" name="action" id="action" value="login">
                    </fieldset>
                </form>
            </div>
        </div>

    </div>
</div>
</body>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
<script src="assets/js/script.js"></script>
</html>