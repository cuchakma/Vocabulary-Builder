<?php

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