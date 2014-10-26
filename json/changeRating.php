<?php


require_once "../chatstorm/chatstorm.php";
require_once "../vendor/autoload.php";
require_once "../generated-conf/config.php";

use Chatstorm\Util as Util;

    if( isset($_POST['hash']) === false ||
        isset($_POST['RoomId']) === false ||
        isset($_POST['Rating']) === false) Util::DieWithJSONError("Argument missing in request.");

    $imeiHash = $_POST['hash'];
    $roomId = intval($_POST['RoomId']);
    $rating = intval($_POST['Rating']);

    $registeredUser = RegisteredUserQuery::create()->findOneByImei( $imeiHash );

    if( $registeredUser == null ) Util::DieWithJSONError("Could not find registered user.");

    $room = RoomQuery::create()->findOneByRoomid( $roomId );

    if( $room == null ) Util::DieWithJSONError("Could not find room.");

    $roomUser = RoomUserQuery::create()
        ->filterByRoomId( $room->getRoomId() )
        ->findOneByRegistereduserid( $registeredUser->getRegistereduserid() );

    if( $roomUser == null )
    {
        $roomUser = RoomUser::CreateRoomUser( $room, $registeredUser);
        if( $roomUser == null ) Util::DieWithJSONError("Could not create room user.");
    }

    if( $rating != -1 && $rating != 1  ) Util::DieWithJSONError("Invalid rating.");

    if( $roomUser->getHasvoted() === true )  Util::DieWithJSONError("User already voted.");

    $room->setRating( $room->getRating() + $rating);

    $room->save();

    $roomUser->setHasvoted( true );
    $roomUser->save();

if( $res )
        echo Util::ReturnJSONSuccess();
    else
        Util::DieWithJSONError("Could not create new room.");