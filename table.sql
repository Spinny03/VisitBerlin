CREATE DATABASE Last;

USE Last;


CREATE TABLE LDI(
    `id` int PRIMARY KEY AUTO_INCREMENT,
    `name` varchar(255),
    `description` varchar(255),
    `registrationDate` timestamp,
    `type` varchar(255),
    `value` varchar(255)
);


CREATE TABLE tipo(
    `id` int PRIMARY KEY AUTO_INCREMENT,
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


INSERT INTO `tipo`(`name`) VALUES (`dipinto`);
INSERT INTO `tipo`(`name`) VALUES (`memoriale`);
INSERT INTO `tipo`(`name`) VALUES (`edificio`);
INSERT INTO `tipo`(`name`) VALUES (`statua`);
INSERT INTO `tipo`(`name`) VALUES (`museo`);
INSERT INTO `ldi`(`name`, `description`, `registrationDate`, `type`, `value`) VALUES ([value-1],[value-2],[value-3],[value-4],[value-5],[value-6]);


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

