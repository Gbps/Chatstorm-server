<?php

namespace Chatstorm
{

    class Validators
    {
        public static function ValidateEmail( $email )
        {
           return (filter_var($email, FILTER_VALIDATE_EMAIL) != false);
        }

        public static function ValidatePassword( $password )
        {
            // Length 6 - 15
            if( strlen( $password ) < 5 ) return false;
            if( strlen( $password ) > 15 ) return false;

            return true;
        }

        public static function ValidateMessage( $message )
        {
            // Length <1024
            if( strlen( $message ) > 1024 || strlen( $message ) == 0 ) return false;

            return true;
        }

        public static function ValidateTopic( $topic )
        {
            // Length <124
            if( strlen( $topic ) > 124 || strlen( $topic ) == 0 ) return false;

            return true;
        }
    }


}

?>