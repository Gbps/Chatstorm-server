<?php

    require_once "../chatstorm/chatstorm.php";
    require_once "../vendor/autoload.php";
    require_once "../generated-conf/config.php";

    RoomQuery::create()->doDeleteAll();
    RegisteredUserQuery::create()->doDeleteAll();

    $res = RegisteredUser::CreateUser( "gbps111@gmail.com", "testpass", "imeiimeiimeiimei" );
    if($res)
        echo "User Created<br />";
    else
        echo "Failed to create user.<br />";

    $newUser = RegisteredUserQuery::create()->findOneByEmail("gbps111@gmail.com");

    $res = Room::CreateRoom( $newUser, "Some cool topic", 60000 );
    if($res)
        echo "Room Created<br />";
    else
        echo "Failed to create room.<br />";

?>