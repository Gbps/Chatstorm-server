<?php


require_once "../chatstorm/chatstorm.php";
require_once "../vendor/autoload.php";
require_once "../generated-conf/config.php";

use Chatstorm\Util as Util;

    if( isset($_POST['hash']) === false ||
        isset($_POST['topic']) === false ) Util::DieWithJSONError("Argument missing in request.");

    $imeiHash = $_POST['hash'];
    $roomTopic = $_POST['topic'];

    $creatingUser = RegisteredUserQuery::create()->findOneByImei( $imeiHash );

    if( $creatingUser == null ) Util::DieWithJSONError("Could not find registered user.");

    $res = Room::CreateRoom( $creatingUser, $roomTopic, 86400);

    if( $res )
        echo Util::ReturnJSONSuccess();
    else
        Util::DieWithJSONError("Could not create new room.");