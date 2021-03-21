<?php

function getStatusMessage( $statusCode = 0 ) {
    $errors = [
        '0' => '',
        '1' => 'Duplicate Email Address',
        '2' => 'Username Or Password Empty',
        '3' => 'User Created Successfully'  
    ];

    return $errors[$statusCode];
}