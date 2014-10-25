<?php
    echo "hello"
    include "include/includes.php";

    $res = RegisteredUser::CreateUser( "test@test.com", "testpass", "imeiimeiimeiimei" );

    if($res)
        echo "User Created";
    else
        echo "Failed to create user.";

?>