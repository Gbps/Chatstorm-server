<?php

    require_once "../chatstorm/chatstorm.php";
    require_once "../vendor/autoload.php";
    require_once "../generated-conf/config.php";

    use Chatstorm\Util as Util;

    if( isset($_POST['hash']) === false ||
        isset($_POST['message']) === false ||
        isset($_POST['RoomId']) === false ) Util::DieWithJSONError("Argument missing in request.");

    $imeiHash = $_POST['hash'];
    $message = $_POST['message'];
    $roomId = intval( $_POST['RoomId'] );

    $room = RoomQuery::create()->findOneByRoomid( $roomId );

    if( $room == null ) Util::DieWithJSONError("Could not find room.");

    $registeredUser = RegisteredUserQuery::create()->findOneByImei( $imeiHash );

    if( $registeredUser == null ) Util::DieWithJSONError("Could not find registered user.");

    $roomUser = RoomUserQuery::create()
        ->filterByRoomId( $room->getRoomId() )
        ->findOneByRegistereduserid( $registeredUser->getRegistereduserid() );

    if( $roomUser == null )
    {
        $roomUser = RoomUser::CreateRoomUser( $room, $registeredUser);
        if( $roomUser == null ) Util::DieWithJSONError("Could not create room user.");
    }

    Message::CreateMessageToRoom( $room, $roomUser, $message);

    echo Util::ReturnJSONSuccess();
