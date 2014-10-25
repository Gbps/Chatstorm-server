<?php

    require_once "../chatstorm/chatstorm.php";
    require_once "../vendor/autoload.php";
    require_once "../generated-conf/config.php";

    use Chatstorm\Util as Util;

    if( isset( $_GET['RoomId'] ) === false ) Util::DieWithJSONError("Argument missing in request.");

    $roomId = intval( $_GET['RoomId'] );

    $currentDate = new DateTime();
    $formatDate = $currentDate->format( "Y-m-d H:i:s" );

    $returnRoom = RoomQuery::create()->findOneByRoomid( $roomId );
    if( $returnRoom == null )  Util::DieWithJSONError("Could not find room.");

    $messages = $returnRoom->getMessages()->select(array('MessageId', 'Text', 'RoomUserId', 'PostTime')->toJson();

    echo Util::ReturnJSON($messages);

