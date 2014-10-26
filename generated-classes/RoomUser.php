<?php

use Base\RoomUser as BaseRoomUser;

/**
 * Skeleton subclass for representing a row from the 'RoomUser' table.
 *
 *
 *
 * You should add additional methods to this class to meet the
 * application requirements.  This class will only be generated as
 * long as it does not already exist in the output directory.
 *
 */
class RoomUser extends BaseRoomUser
{

    public static function GetAdjective()
    {
        $lines = file("../include/adjectives.txt", FILE_IGNORE_NEW_LINES);

        $randomFind = array_rand( $lines );

        $randomFind = ucfirst(str_replace(' ', '', $randomFind));

        return $randomFind;

    }

    public static function GetNoun()
    {
        $lines = file("../include/nouns.txt", FILE_IGNORE_NEW_LINES);

        $randomFind = array_rand( $lines );

        $randomFind = ucfirst(str_replace(' ', '', $randomFind));

        return $randomFind;

    }

    public static function CreateRoomUser( Room $room, RegisteredUser $user )
    {
        $newRoomUser = new RoomUser();
        $newRoomUser->setVisiblename( GetAdjective() + GetNoun() );
        $newRoomUser->setRegisteredUser( $user );
        $newRoomUser->setRoom( $room );
        $newRoomUser->save();

        $room->addRoomUser( $newRoomUser );
        $room->save();

        return $newRoomUser;

    }
}
