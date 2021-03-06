<?php

/**
 * session variable used for login
 */
session_start();

/**
 * including the constants to be used for mysql connection
 */
include_once 'config.php';
$action = $_POST['action'] ?? '';

/**
 * making a connection with mysql
 */
$connection = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
mysqli_set_charset($connection, "utf-8");
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
        
    } elseif( 'login' == $action ) {

        $username = $_POST['email'] ?? '';
        $password = $_POST['password'] ?? '';

        if( $username && $password ) {
            $query          = "SELECT id, password FROM users WHERE email = '{$username}' ";
            $result         = mysqli_query($connection, $query);
            $data           = mysqli_fetch_assoc($result);
            $_SESSION['id'] = $data['id'];
            if( count($data) == 0 ) {
                $status = 5;
            }

            elseif( password_verify( $password, $data['password'] )) {
               header("Location:words.php");
               die();
            } 
            elseif( !( count($data) == 0 ) && !password_verify( $password, $data['password'])) {
                $status = 4;
            }
        } else {
            $status = 2;
        }
        header("Location:index.php?status={$status}");

    } elseif( 'addword' == $action ) {
        $word    = $_REQUEST['word'] ?? '';
        $meaning = $_REQUEST['meaning']?? '';
        $user_id = $_SESSION['id'] ?? 0;
        if( $word && $meaning && $user_id ) {
            $query = "INSERT into words(user_id, word, meaning) VALUES ('{$user_id}','{$word}','{$meaning}')"; //query to insert word and meaning
            mysqli_query($connection, $query); // connection with database and pushing the query using the mysql connection
        }
        header("Location:words.php");
    }
}