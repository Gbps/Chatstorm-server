<?php

    require_once "chatstorm/chatstorm.php";
    require_once "vendor/autoload.php";
    require_once "generated-conf/config.php";


    $res = RegisteredUser::CreateUser( "gbps111@gmail.com", "testpass", "imeiimeiimeiimei" );
    if($res)
        echo "User Created<br />";
    else
        echo "Failed to create user.<br />";

    $newUser = RegisteredUserQuery::create()->findByEmail("gbps111@gmail.com")->limit(1)->find();

    $res = Room::CreateRoom( $newUser, "Some cool topic", 60000 );
    if($res)
        echo "Room Created<br />";
    else
        echo "Failed to create room.<br />";

?>