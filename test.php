<?php

    require_once "chatstorm/chatstorm.php";
    require_once "vendor/autoload.php";
    require_once "generated-conf/config.php";


    MessageQuery::create()->doDeleteAll();
    RoomUserQuery::create()->doDeleteAll();
    RoomQuery::create()->doDeleteAll();
    RegisteredUserQuery::create()->doDeleteAll();

    $res = RegisteredUser::CreateUser( "gbps111@gmail.com", "testpass", "imeiimeiimeiimei" );
    if($res)
        echo "User Created<br />";
    else
        echo "Failed to create user.<br />";

    $newUser = RegisteredUserQuery::create()->findOneByEmail("gbps111@gmail.com");

    $newRoom = Room::CreateRoom( $newUser, "Some cool topic", 60000 );
    if($newRoom != 0)
        echo "Room Created<br />";
    else
        echo "Failed to create room.<br />";

    $roomUser = RoomUser::CreateRoomUser( $newRoom, $newUser );

    Message::CreateMessageToRoom( $newRoom, $roomUser, "Asdf Cool Message" );

    echo "Message Created<br />";
?>