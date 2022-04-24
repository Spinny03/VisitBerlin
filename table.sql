CREATE DATABASE Last;
USE Last;
CREATE TABLE LDI(
    `id` INTEGER PRIMARY KEY,
    `name` varchar(255),
    `description` varchar(255),
    `registrationDate` timestamp,
    `type` varchar(255),
    `value` varchar(255)
);

CREATE TABLE tipo(
    `id` INTEGER PRIMARY KEY,
    `name` varchar(255)
);

CREATE TABLE username(
    `email` varchar(255) PRIMARY KEY,
    `firstName` varchar(255),
    `surname` varchar(255),
    `registrationDate` timestamp,
    `notice` TINYINT(1),
    `pasw` varchar(255) NOT NULL
);
INSERT INTO `tipo`(`id`, `name`) VALUES (`1`,`dipinto`);
INSERT INTO `tipo`(`id`, `name`) VALUES (`2`,`memoriale`);
INSERT INTO `tipo`(`id`, `name`) VALUES (`3`,`edificio`);
INSERT INTO `tipo`(`id`, `name`) VALUES (`4`,`statua`);
INSERT INTO `tipo`(`id`, `name`) VALUES (`5`,`museo`);
INSERT INTO `ldi`(`id`, `name`, `description`, `registrationDate`, `type`, `value`) VALUES ([value-1],[value-2],[value-3],[value-4],[value-5],[value-6]);