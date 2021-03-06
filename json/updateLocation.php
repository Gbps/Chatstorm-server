<?php


    require_once "../chatstorm/chatstorm.php";
    require_once "../vendor/autoload.php";
    require_once "../generated-conf/config.php";

    use Chatstorm\Util as Util;

    if( isset($_POST['lati']) === false ||
        isset($_POST['long']) === false ||
        isset($_POST['accu']) === false ||
        isset($_POST['hash']) === false
    ) Util::DieWithJSONError("Argument missing in request.");


    $latitude = floatval($_POST['lati']);
    $longitude = floatval($_POST['long']);
    $accuracy = intval($_POST['accu']);
    $imeiHash = $_POST['hash'];

    if( $longitude == 0 ||
        $latitude == 0)
        Util::DieWithJSONError("Invalid longitude/latitude format.");

    $user = RegisteredUserQuery::create()->findOneByImei( $imeiHash );

    if( $user == null ) Util::DieWithJSONError("Could not find user by IMEI.");

    $user->setLocationlatitude( $latitude );
    $user->setLocationlongitude( $latitude );
    $user->setLocationaccuracy( $accuracy );

    $user->save();

    echo Util::ReturnJSONSuccess();

