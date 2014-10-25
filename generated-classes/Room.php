<?php

use Base\Room as BaseRoom;

/**
 * Skeleton subclass for representing a row from the 'Room' table.
 *
 *
 *
 * You should add additional methods to this class to meet the
 * application requirements.  This class will only be generated as
 * long as it does not already exist in the output directory.
 *
 */
class Room extends BaseRoom
{
    public static function CreateRoom( $creator, $topic, $lifetime )
    {

        $timeoutDate = new DateTime();
        $timeoutDate->add( DateInterval::createFromDateString( $lifetime . " seconds") );

        $newRoom = new Room();
        $newRoom->setCreateddate( new DateTime() );
        $newRoom->setCreator( $creator );
        $newRoom->setTopic( $topic );
        $newRoom->setTimeout( $timeoutDate );
        $newRoom->setRating( 0 );
        $newRoom->setLocationlatitude( 0 );
        $newRoom->setLocationaccuracy( 0 );
        $newRoom->setLocationlongitude( 0 );

        $newRoom->save();

        return $newRoom;
    }
}
