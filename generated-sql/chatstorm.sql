
# This is a fix for InnoDB in MySQL >= 4.1.x
# It "suspends judgement" for fkey relationships until are tables are set.
SET FOREIGN_KEY_CHECKS = 0;

-- ---------------------------------------------------------------------
-- RegisteredUser
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `RegisteredUser`;

CREATE TABLE `RegisteredUser`
(
    `RegisteredUserId` INTEGER NOT NULL AUTO_INCREMENT,
    `Email` VARCHAR(255) NOT NULL,
    `PasswordHash` VARCHAR(64) NOT NULL,
    `ActivationKey` VARCHAR(25) NOT NULL,
    `RegisteredDate` DATETIME NOT NULL,
    `ActivationDate` DATETIME,
    `Activated` TINYINT(1) NOT NULL,
    `Rating` INTEGER NOT NULL,
    `LocationLatitude` DOUBLE NOT NULL,
    `LocationLongitude` DOUBLE NOT NULL,
    `LocationAccuracy` INTEGER NOT NULL,
    `IMEI` VARCHAR(64) NOT NULL,
    PRIMARY KEY (`RegisteredUserId`)
) ENGINE=InnoDB;

-- ---------------------------------------------------------------------
-- Message
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `Message`;

CREATE TABLE `Message`
(
    `MessageId` INTEGER NOT NULL AUTO_INCREMENT,
    `Text` VARCHAR(1024) NOT NULL,
    `RoomUserId` INTEGER NOT NULL,
    `RoomId` INTEGER NOT NULL,
    `PostTime` DATETIME NOT NULL,
    PRIMARY KEY (`MessageId`),
    INDEX `Message_fi_041b9b` (`RoomUserId`),
    INDEX `Message_fi_41e335` (`RoomId`),
    CONSTRAINT `Message_fk_041b9b`
        FOREIGN KEY (`RoomUserId`)
        REFERENCES `RoomUser` (`RoomUserId`),
    CONSTRAINT `Message_fk_41e335`
        FOREIGN KEY (`RoomId`)
        REFERENCES `Room` (`RoomId`)
) ENGINE=InnoDB;

-- ---------------------------------------------------------------------
-- Room
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `Room`;

CREATE TABLE `Room`
(
    `RoomId` INTEGER NOT NULL AUTO_INCREMENT,
    `CreatedDate` DATETIME NOT NULL,
    `Timeout` DATETIME NOT NULL,
    `RoomUsersId` INTEGER NOT NULL,
    `Rating` INTEGER NOT NULL,
    `LocationLatitude` DOUBLE NOT NULL,
    `LocationLongitude` DOUBLE NOT NULL,
    `LocationAccuracy` INTEGER NOT NULL,
    PRIMARY KEY (`RoomId`)
) ENGINE=InnoDB;

-- ---------------------------------------------------------------------
-- RoomUser
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `RoomUser`;

CREATE TABLE `RoomUser`
(
    `RoomUserId` INTEGER NOT NULL AUTO_INCREMENT,
    `VisibleName` VARCHAR(32) NOT NULL,
    `RegisteredUserId` INTEGER NOT NULL,
    `RoomId` INTEGER NOT NULL,
    PRIMARY KEY (`RoomUserId`),
    INDEX `RoomUser_fi_bb0d7a` (`RegisteredUserId`),
    INDEX `RoomUser_fi_41e335` (`RoomId`),
    CONSTRAINT `RoomUser_fk_bb0d7a`
        FOREIGN KEY (`RegisteredUserId`)
        REFERENCES `RegisteredUser` (`RegisteredUserId`),
    CONSTRAINT `RoomUser_fk_41e335`
        FOREIGN KEY (`RoomId`)
        REFERENCES `Room` (`RoomId`)
) ENGINE=InnoDB;

# This restores the fkey checks, after having unset them earlier
SET FOREIGN_KEY_CHECKS = 1;
