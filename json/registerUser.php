<?php

    require_once "../chatstorm/chatstorm.php";
    require_once "../vendor/autoload.php";
    require_once "../generated-conf/config.php";

    use Chatstorm\Util as Util;

    if( isset($_POST['hash']) === false) Util::DieWithJSONError("Argument missing in request.");

    $newUser = RegisteredUser::CreateUser( "", "", $_POST['hash']);

    return Util::ReturnJSONSuccess();