<?php

    include "include/includes.php";

    var_dump( RegisteredUser );

    $res = RegisteredUser::CreateUser( "test@test.com", "testpass", "imeiimeiimeiimei" );

    if($res)
        echo "User Created";
    else
        echo "Failed to create user.";

?>