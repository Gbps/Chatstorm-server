<?php

    require_once "chatstorm/chatstorm.php";
    require_once "vendor/autoload.php";
    require_once "/autoload.php";

$res = RegisteredUser::CreateUser( "test@test.com", "testpass", "imeiimeiimeiimei" );

    if($res)
        echo "User Created";
    else
        echo "Failed to create user.";

?>