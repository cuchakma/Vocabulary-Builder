<?php

include_once "config.php";

$connection = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);

mysqli_set_charset($connection, "utf-8");

$chars = ['All Words', 'A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J', 'K', 'L', 'M', 'N', 'O', 'P', 'Q', 'R', 'S', 'T', 'U', 'V', 'W', 'X', 'Y', 'Z'];

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

    function getWords($user_id, $search = null) {
       global $connection;
       if( $search ) {
            $query  = "Select * FROM words where user_id ='{$user_id}'AND word LIKE '{$search}%' ORDER BY word";
       } else {
            $query  = "Select * FROM words where user_id ='{$user_id}' ORDER BY word";
       }
      
       $result = mysqli_query($connection, $query);
       $data   = [];
       while( $_data = mysqli_fetch_assoc($result) ){
           array_push( $data, $_data );
       } 
       return $data;
    }
