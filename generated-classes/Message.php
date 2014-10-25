<?php

use Base\Message as BaseMessage;

/**
 * Skeleton subclass for representing a row from the 'Message' table.
 *
 *
 *
 * You should add additional methods to this class to meet the
 * application requirements.  This class will only be generated as
 * long as it does not already exist in the output directory.
 *
 */
class Message extends BaseMessage
{
    public static function CreateMessageToRoom( Room $room, RoomUser $creator, $message )
    {
        $newMessage = new Message();
        $newMessage->setText( $message );
        $newMessage->setRoomuserid( $creator->getRoomuserid() );
        $newMessage->setRoom( $room );
        $newMessage->setPosttime( new DateTime() );

        $newMessage->save();

        $room->addMessage( $newMessage );

        $room->save();

        return true;
    }
}
