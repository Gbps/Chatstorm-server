<?php

include_once __DIR__."/../chatstorm/chatstorm.php";

use Base\RegisteredUser as BaseRegisteredUser;
use Chatstorm\Validators as Validators;
use Chatstorm\Util as Util;

/**
 * Skeleton subclass for representing a row from the 'RegisteredUser' table.
 *
 *
 *
 * You should add additional methods to this class to meet the
 * application requirements.  This class will only be generated as
 * long as it does not already exist in the output directory.
 *
 */
class RegisteredUser extends BaseRegisteredUser
{
    public static function CreateUser( $email, $password, $imeiHash )
    {
        if( !Validators::ValidateEmail( $email ) ) return false;
        if( !Validators::ValidatePassword( $password ) ) return false;

        $passwordHash = hash( "sha256", $password );

        $newUser = new RegisteredUser();
        $newUser->setEmail( $email );
        $newUser->setPasswordhash( $passwordHash );
        $newUser->setActivationkey( Util::GenerateActivationKey() );
        $newUser->setRegistereddate( new DateTime() );
        $newUser->setActivationdate( null );
        $newUser->setActivated( false );
        $newUser->setRating( 0 );
        $newUser->setLocationlatitude( 0.0 );
        $newUser->setLocationlongitude( 0.0 );
        $newUser->setLocationaccuracy( 0 );
        $newUser->setImei( $imeiHash );

        $newUser->save();

        return true;
    }
}
