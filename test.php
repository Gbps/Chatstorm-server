<?php

    include "include/includes.php";
    include "vendor/autoload.php";

    $res = RegisteredUser::CreateUser( "test@test.com", "testpass", "imeiimeiimeiimei" );

    if($res)
        echo "User Created";
    else
        echo "Failed to create user.";

?>