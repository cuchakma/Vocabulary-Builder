<?php

/**
 * including the constants to be used for mysql connection
 */
include_once 'config.php';
$action = $_POST['action'] ?? '';

/**
 * making a connection with mysql
 */
$connection = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);

/**
 * if connection is established else not established
 */
if( !$connection ) {

    throw new Exception('Cannot connect to database');

} else {
    if( 'register' ==  $action ) {

        $username = $_POST['email'] ?? '';
        $password = $_POST['password'] ?? '';

        if( $username && $password ) {
            $hash = password_hash($password, PASSWORD_BCRYPT);
            $query = "INSERT INTO users(email, password) VALUES('{$username}', '{$hash}')";
            mysqli_query($connection, $query);

            /**
             * if same duplicate emails are used, mysqli throws error
             */
            if( mysqli_error($connection) ) {
                $status = 1;
            } else {
                $status = 3;
            }
        } else {
            $status = 2;
        }
        header("Location:index.php?status={$status}");
    }
}