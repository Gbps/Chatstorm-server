<?php

    require_once "chatstorm/chatstorm.php";
    require_once "vendor/autoload.php";
    require_once "generated-conf/config.php";

$res = RegisteredUser::CreateUser( "test@test.com", "testpass", "imeiimeiimeiimei" );

    if($res)
        echo "User Created";
    else
        echo "Failed to create user.";

?>