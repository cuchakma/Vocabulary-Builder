<?php

include_once "config.php";

$connection = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);

mysqli_set_charset($connection, "utf-8");

/**
 * if connection is established else not established
 */
if( !$connection ) {

    throw new Exception('Cannot connect to database');

} 

    function getStatusMessage( $statusCode = 0 ) {
        $errors = [
            '0' => '',
            '1' => 'Duplicate Email Address',
            '2' => 'Username Or Password Empty',
            '3' => 'User Created Successfully',
            '4' => "Username And Password didn't match",
            '5' => "Username Doesn't exist"  
        ];

        return $errors[$statusCode];
    }

    function getWords($user_id) {
       global $connection;
       $query  = "Select * FROM words where user_id ='{$user_id}'";
       $result = mysqli_query($connection, $query);
       $data   = [];
       while( $_data = mysqli_fetch_assoc($result) ){
           array_push( $data, $_data );
       } 
       return $data;
    }
