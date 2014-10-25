
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
    `ActivationDate` DATETIME NOT NULL,
    `Activated` TINYINT(1) NOT NULL,
    `Rating` INTEGER NOT NULL,
    `LocationLatitude` DOUBLE NOT NULL,
    `LocationLongitude` DOUBLE NOT NULL,
    `LocationAccuracy` INTEGER NOT NULL,
    `IMEI` VARCHAR(14) NOT NULL,
    PRIMARY KEY (`RegisteredUserId`)
) ENGINE=InnoDB;

# This restores the fkey checks, after having unset them earlier
SET FOREIGN_KEY_CHECKS = 1;
