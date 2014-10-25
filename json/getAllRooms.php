<?php

    require_once "../chatstorm/chatstorm.php";
    require_once "../vendor/autoload.php";
    require_once "../generated-conf/config.php";

    use Chatstorm\Util as Util;

    $currentDate = new DateTime();
    $formatDate = $currentDate->format( "Y-m-d H:i:s" );
    echo Util::ReturnJSON(
        RoomQuery::create()
        ->select(array('RoomId', 'Topic', 'Rating'))
        ->filterByTimeout(array( "min" => $currentDate) )
        ->find()
        ->toJson()
    );
