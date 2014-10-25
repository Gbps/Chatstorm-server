<?php

namespace
    {
        function objectToArray( $d )
        {
            if ( is_object( $d ) ) {
                // Gets the properties of the given object
                // with get_object_vars function
                $d = get_object_vars( $d );
            }

            if ( is_array( $d ) ) {
                /*
                * Return array converted to object
                * Using __FUNCTION__ (Magic constant)
                * for recursive call
                */
                return array_map( __FUNCTION__, $d );
            } else {
                // Return array
                return $d;
            }
        }
    }

namespace Chatstorm
{

    class Util
    {
        public static function DieWithJSONError( $msg )
        {
            $convArray = array( 'success' => false, 'error' => $msg);
            die( json_encode( $convArray ) );
        }


        public static function ReturnJSON( $obj )
        {
            $objJsonArray = objectToArray( json_decode( $obj ));
            if( $objJsonArray == null ) Util::DieWithJSONError("Return was null.");

            $convArray = array( 'success' => true, 'error' => "");
            $newArray = array_merge( $objJsonArray, $convArray );

            return json_encode( $newArray );
        }

        public static function ReturnJSONSuccess(  )
        {
            $convArray = array( 'success' => true, 'error' => "");

            return json_encode( $convArray );
        }

        public static function GenerateActivationKey(  )
        {
            $length = 25;
            $chars = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
            $count = mb_strlen($chars);

            for ($i = 0, $result = ''; $i < $length; $i++) {
                $index = rand(0, $count - 1);
                $result .= mb_substr($chars, $index, 1);
            }

            return $result;
        }
    }

}

?>