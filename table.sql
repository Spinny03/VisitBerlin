CREATE DATABASE Last;
USE Last;
CREATE TABLE LDI(
    `id` int PRIMARY KEY AUTO_INCREMENT,
    `name` varchar(255),
    `description` varchar(255),
    `registrationDate` timestamp,
    `lon` varchar(255),
    `lat` varchar(255),
    `image` varchar(255)
);
CREATE TABLE tipo(
    `id` int PRIMARY KEY AUTO_INCREMENT,
    `name` varchar(255)
);
CREATE TABLE tipo_ldi(
    `ldi_id` int REFERENCES LDI(id),
    `tipo_id` int REFERENCES tipo(id),
    PRIMARY KEY (`ldi_id`, `tipo_id`)
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

INSERT INTO `tipo`(`name`) VALUES ("Dipinti");
INSERT INTO `tipo`(`name`) VALUES ("Memoriali");
INSERT INTO `tipo`(`name`) VALUES ("Edifici");
INSERT INTO `tipo`(`name`) VALUES ("Statue");
INSERT INTO `tipo`(`name`) VALUES ("Musei");
INSERT INTO `ldi`(`name`, `description`, `lon`, `lat`, `image`) VALUES ("Pergamonmuseum","Museo di Storia","52.52118763491666","13.396887102137438","1.jpg");
INSERT INTO `tipo_ldi`(`ldi_id`,`tipo_id`) VALUES (1,1);
INSERT INTO `tipo_ldi`(`ldi_id`,`tipo_id`) VALUES (1,2);
INSERT INTO `tipo_ldi`(`ldi_id`,`tipo_id`) VALUES (1,3);
INSERT INTO `ldi`(`name`, `description`, `lon`, `lat`, `image`) VALUES ("Memoriale per gli ebrei assassinati d'Europa","Memoriale ebrei","52.513960618478045","13.378650112228932","2.jpg");
INSERT INTO `tipo_ldi`(`ldi_id`,`tipo_id`) VALUES (2,1);
INSERT INTO `tipo_ldi`(`ldi_id`,`tipo_id`) VALUES (2,3);
INSERT INTO `tipo_ldi`(`ldi_id`,`tipo_id`) VALUES (2,4);
INSERT INTO `ldi`(`name`, `description`, `lon`, `lat`, `image`) VALUES ("Porta di Brandeburgo","Famosa porta du Berlino","52.516263438555185","13.377663294044417","3.jpg");
INSERT INTO `tipo_ldi`(`ldi_id`,`tipo_id`) VALUES (3,1);
INSERT INTO `tipo_ldi`(`ldi_id`,`tipo_id`) VALUES (3,3);
INSERT INTO `tipo_ldi`(`ldi_id`,`tipo_id`) VALUES (3,5);
INSERT INTO `ldi`(`name`, `description`, `lon`, `lat`, `image`) VALUES ("Topografia del terrore","è un progetto nato a Berlino nel 1987 per documentare e ricercare il sistema del terrore instaurato dai nazionalsocialisti in Germania","52.50663393901613","13.383581631216389","4.jpg");
INSERT INTO `tipo_ldi`(`ldi_id`,`tipo_id`) VALUES (4,1);
INSERT INTO `tipo_ldi`(`ldi_id`,`tipo_id`) VALUES (4,3);
INSERT INTO `tipo_ldi`(`ldi_id`,`tipo_id`) VALUES (4,4);
INSERT INTO `ldi`(`name`, `description`, `lon`, `lat`, `image`) VALUES ("Duomo di Berlino","Memoriale ebrei","52.51911423602293","13.401001642425646","5.jpg");
INSERT INTO `tipo_ldi`(`ldi_id`,`tipo_id`) VALUES (5,1);
INSERT INTO `tipo_ldi`(`ldi_id`,`tipo_id`) VALUES (5,4);
INSERT INTO `tipo_ldi`(`ldi_id`,`tipo_id`) VALUES (5,5);
INSERT INTO `ldi`(`name`, `description`, `lon`, `lat`, `image`) VALUES ("Torre dell'acqua di Prenzlauer Berg","Torre","52.534187788678985","13.418663585412373","6.jpg");
INSERT INTO `tipo_ldi`(`ldi_id`,`tipo_id`) VALUES (6,1);
INSERT INTO `tipo_ldi`(`ldi_id`,`tipo_id`) VALUES (6,2);
INSERT INTO `tipo_ldi`(`ldi_id`,`tipo_id`) VALUES (6,5);
INSERT INTO `ldi`(`name`, `description`, `lon`, `lat`, `image`) VALUES ("Monumento ai soldati polacchi e agli antifascisti tedeschi","Descrizione","52.52874531071378","13.437773436423308","7.jpg");
INSERT INTO `tipo_ldi`(`ldi_id`,`tipo_id`) VALUES (7,1);
INSERT INTO `tipo_ldi`(`ldi_id`,`tipo_id`) VALUES (7,3);
INSERT INTO `ldi`(`name`, `description`, `lon`, `lat`, `image`) VALUES ("Memoriale agli omosessuali perseguitati sotto il nazismo","Descrizione","52.513251728691856","13.376121538989821","8.jpg");
INSERT INTO `tipo_ldi`(`ldi_id`,`tipo_id`) VALUES (8,1);
INSERT INTO `tipo_ldi`(`ldi_id`,`tipo_id`) VALUES (8,2);
INSERT INTO `tipo_ldi`(`ldi_id`,`tipo_id`) VALUES (8,4);
INSERT INTO `tipo_ldi`(`ldi_id`,`tipo_id`) VALUES (8,5);
INSERT INTO `ldi`(`name`, `description`, `lon`, `lat`, `image`) VALUES ("Tiergarten","Descrizione","52.5166195461566","13.371907227215877","9.jpg");
INSERT INTO `tipo_ldi`(`ldi_id`,`tipo_id`) VALUES (9,1);
INSERT INTO `tipo_ldi`(`ldi_id`,`tipo_id`) VALUES (9,3);
INSERT INTO `tipo_ldi`(`ldi_id`,`tipo_id`) VALUES (9,4);
INSERT INTO `tipo_ldi`(`ldi_id`,`tipo_id`) VALUES (9,5);
INSERT INTO `ldi`(`name`, `description`, `lon`, `lat`, `image`) VALUES ("Museo del Muro","Museo dedidcato al ex muro di berlino","52.507394540273374","13.390616285939664","10.jpg");
INSERT INTO `tipo_ldi`(`ldi_id`,`tipo_id`) VALUES (10,1);
INSERT INTO `tipo_ldi`(`ldi_id`,`tipo_id`) VALUES (10,3);
INSERT INTO `tipo_ldi`(`ldi_id`,`tipo_id`) VALUES (10,4);
INSERT INTO `tipo_ldi`(`ldi_id`,`tipo_id`) VALUES (10,5);






Pergamonmuseum X
Memoriale per gli ebrei assassinati dEuropa  X
Porta di Brandeburgo X
Topografia del terrore X
Duomo di Berlino X
Torre dell acqua di Prenzlauer Berg X
Monumento ai soldati polacchi e agli antifascisti tedeschi X
Memoriale agli omosessuali perseguitati sotto il nazismo X
Memoriale sovietico (Tiergarten) X
Muro di Berlino X

Memorial to the Victims of National Socialist 'Euthanasia' Killings
Museo del Muro
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

