<?php

    require_once "chatstorm/chatstorm.php";
    require_once "vendor/autoload.php";
    require_once "generated-conf/config.php";

    $currentDate = new DateTime();
    $formatDate = $currentDate->format( "Y-m-d H:i:s" );
    RoomQuery::create()
        ->filterByTimeout(array( "max" => $currentDate) )
        ->find()
        ->toJson();
