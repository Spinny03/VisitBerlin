CREATE DATABASE Last;
USE Last;
CREATE TABLE LDI(
    `id` int PRIMARY KEY AUTO_INCREMENT,
    `name` varchar(255),
    `description` varchar(255),
    `registrationDate` timestamp,
    `lon` varchar(255),
    `lat` varchar(255)
);
CREATE TABLE tipo(
    `id` int PRIMARY KEY AUTO_INCREMENT,
    `name` varchar(255)
);
CREATE TABLE username(
    `email` varchar(255) PRIMARY KEY,
    `firstName` varchar(255),
    `surname` varchar(255),
    `notice` TINYINT(1),
    `notte` TINYINT(1),
    `gps` TINYINT(1),
    `token` int, 
    `pasw` varchar(255) NOT NULL
);
CREATE TABLE preferiti(
    `email` int NOT NULL REFERENCES username(email) ,
    `idLDI` int NOT NULL REFERENCES LDI(id),
    primary key(`email`, `idLDI`)
);

INSERT INTO `tipo`(`name`) VALUES (`dipinto`);
INSERT INTO `tipo`(`name`) VALUES (`memoriale`);
INSERT INTO `tipo`(`name`) VALUES (`edificio`);
INSERT INTO `tipo`(`name`) VALUES (`statua`);
INSERT INTO `tipo`(`name`) VALUES (`museo`);
INSERT INTO `ldi`(`name`, `description`, `lon`, `lat`) VALUES ("Pergamonmuseum","Museo di Storia","52.52118763491666","13.396887102137438");
INSERT INTO `ldi`(`name`, `description`, `lon`, `lat`) VALUES ("Memoriale per gli ebrei assassinati d'Europa","Memoriale ebrei","52.513960618478045","13.378650112228932");
INSERT INTO `ldi`(`name`, `description`, `lon`, `lat`) VALUES ("Porta di Brandeburgo","Famosa porta du Berlino","52.516263438555185","13.377663294044417");


Pergamonmuseum
Porta di Brandeburgo
Topographie des Terrors
Duomo di Berlino
Wasserturm Prenzlauer Berg
Monument to the Polish soldiers and German anti-fascists
Memoriale agli omosessuali perseguitati sotto il nazismo
Memoriale sovietico (Tiergarten)
Memorial to the Victims of National Socialist 'Euthanasia' Killings
Monument to the Polish soldiers and German anti-fascists
Museo del Muro
Muro di Berlino
Checkpoint Charlie
Palazzo del Reichstag
Memorial to May 10, 1933 Nazi Book Burning
Castello di Charlottenburg
Kaiser-Wilhelm-Gedächtniskirche
Skulptur "Berlin" Brigitte und Martin Matschinsky-Denninghoff
The Yellow Man (Os Gemeos)
Oberbaum Bridge
Skulptur Galileo
Haus der Kulturen der Welt
Urania Weltzeituhr
Brunnen der Völkerfreundschaft
Fontana di Nettuno
Marx-Engels-Forum
Volksbühne am Rosa-Luxemburg-Platz

