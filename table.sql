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