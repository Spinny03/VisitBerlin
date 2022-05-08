CREATE DATABASE Last;
USE Last;
CREATE TABLE LDI(
    `id` int PRIMARY KEY AUTO_INCREMENT,
    `name` varchar(255),
    `description` varchar(255),
    `registrationDate` timestamp,
    `lon` varchar(255),
    `lat` varchar(255),
    `image` varchar(255),
    `mainTipo` int NOT NULL REFERENCES tipo(id)
);
CREATE TABLE tipo(
    `id` int PRIMARY KEY AUTO_INCREMENT,
    `name` varchar(255),
    `image` varchar(255)
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
    `ldi_id` int NOT NULL REFERENCES LDI(id),
    primary key(`email`, `ldi_id`)
);

INSERT INTO `tipo`(`name`, `image`) VALUES ("StreetArts", "1.svg"); 
INSERT INTO `tipo`(`name`, `image`) VALUES ("Memoriali", "2.svg");
INSERT INTO `tipo`(`name`, `image`) VALUES ("Edifici", "3.svg");
INSERT INTO `tipo`(`name`, `image`) VALUES ("Statue", "4.svg");
INSERT INTO `tipo`(`name`, `image`) VALUES ("Musei", "5.svg");
INSERT INTO `tipo`(`name`, `image`) VALUES ("Fontane", "6.svg");
INSERT INTO `ldi`(`name`, `description`, `lon`, `lat`, `image`,`mainTipo`) VALUES ("Pergamonmuseum","Museo di Storia","52.52118763491666","13.396887102137438","1.jpg","5");
INSERT INTO `tipo_ldi`(`ldi_id`,`tipo_id`) VALUES (1,5);
INSERT INTO `tipo_ldi`(`ldi_id`,`tipo_id`) VALUES (1,3);
INSERT INTO `ldi`(`name`, `description`, `lon`, `lat`, `image`,`mainTipo`) VALUES ("Memoriale per gli ebrei assassinati d'Europa","Memoriale ebrei","52.513960618478045","13.378650112228932","2.jpg","2");
INSERT INTO `tipo_ldi`(`ldi_id`,`tipo_id`) VALUES (2,2);
INSERT INTO `tipo_ldi`(`ldi_id`,`tipo_id`) VALUES (2,3);
INSERT INTO `ldi`(`name`, `description`, `lon`, `lat`, `image`,`mainTipo`) VALUES ("Porta di Brandeburgo","Famosa porta du Berlino","52.516263438555185","13.377663294044417","3.jpg","3");
INSERT INTO `tipo_ldi`(`ldi_id`,`tipo_id`) VALUES (3,3);
INSERT INTO `ldi`(`name`, `description`, `lon`, `lat`, `image`,`mainTipo`) VALUES ("Topografia del terrore","è un progetto nato a Berlino nel 1987 per documentare e ricercare il sistema del terrore instaurato dai nazionalsocialisti in Germania","52.50663393901613","13.383581631216389","4.jpg","5");
INSERT INTO `tipo_ldi`(`ldi_id`,`tipo_id`) VALUES (4,2);
INSERT INTO `tipo_ldi`(`ldi_id`,`tipo_id`) VALUES (4,5);
INSERT INTO `tipo_ldi`(`ldi_id`,`tipo_id`) VALUES (4,3);
INSERT INTO `ldi`(`name`, `description`, `lon`, `lat`, `image`,`mainTipo`) VALUES ("Duomo di Berlino","Memoriale ebrei","52.51911423602293","13.401001642425646","5.jpg","3");
INSERT INTO `tipo_ldi`(`ldi_id`,`tipo_id`) VALUES (5,3);
INSERT INTO `tipo_ldi`(`ldi_id`,`tipo_id`) VALUES (5,5);
INSERT INTO `ldi`(`name`, `description`, `lon`, `lat`, `image`,`mainTipo`) VALUES ("Torre dell'acqua di Prenzlauer Berg","Torre","52.534187788678985","13.418663585412373","6.jpg","3");
INSERT INTO `tipo_ldi`(`ldi_id`,`tipo_id`) VALUES (6,1);
INSERT INTO `ldi`(`name`, `description`, `lon`, `lat`, `image`,`mainTipo`) VALUES ("Monumento ai soldati polacchi e agli antifascisti tedeschi","Descrizione","52.52874531071378","13.437773436423308","7.jpg","2");
INSERT INTO `tipo_ldi`(`ldi_id`,`tipo_id`) VALUES (7,2);
INSERT INTO `ldi`(`name`, `description`, `lon`, `lat`, `image`,`mainTipo`) VALUES ("Memoriale agli omosessuali perseguitati sotto il nazismo","Descrizione","52.513251728691856","13.376121538989821","8.jpg","2");
INSERT INTO `tipo_ldi`(`ldi_id`,`tipo_id`) VALUES (8,2);
INSERT INTO `ldi`(`name`, `description`, `lon`, `lat`, `image`,`mainTipo`) VALUES ("Memoriale sovietico (Tiergarten)","Descrizione","52.5166195461566","13.371907227215877","9.jpg","2");
INSERT INTO `tipo_ldi`(`ldi_id`,`tipo_id`) VALUES (9,2);
INSERT INTO `tipo_ldi`(`ldi_id`,`tipo_id`) VALUES (9,3);
INSERT INTO `ldi`(`name`, `description`, `lon`, `lat`, `image`,`mainTipo`) VALUES ("Museo del Muro (East Side)","Museo dedidcato al ex muro di berlino","52.507394540273374","13.390616285939664","10.jpg","5");
INSERT INTO `tipo_ldi`(`ldi_id`,`tipo_id`) VALUES (10,2);
INSERT INTO `tipo_ldi`(`ldi_id`,`tipo_id`) VALUES (10,5);
INSERT INTO `ldi`(`name`, `description`, `lon`, `lat`, `image`,`mainTipo`) VALUES ("Memoriale per le vittime degli omicidi nazionalsocialisti per 'eutanasia'","DESCRIZIONE","52.51055121632733","13.369435937906566","11.jpg","2");
INSERT INTO `tipo_ldi`(`ldi_id`,`tipo_id`) VALUES (11,2);
INSERT INTO `ldi`(`name`, `description`, `lon`, `lat`, `image`,`mainTipo`) VALUES ("Muro di Berlino","DESCRIZIONE","52.50363265076556","13.443069460855533","12.jpg","2");
INSERT INTO `tipo_ldi`(`ldi_id`,`tipo_id`) VALUES (12,2);
INSERT INTO `tipo_ldi`(`ldi_id`,`tipo_id`) VALUES (12,4);
INSERT INTO `tipo_ldi`(`ldi_id`,`tipo_id`) VALUES (12,1);
INSERT INTO `ldi`(`name`, `description`, `lon`, `lat`, `image`,`mainTipo`) VALUES ("Checkpoint Charlie","DESCRIZIONE","52.507440527747924","13.390380012509274","13.jpg","2");
INSERT INTO `tipo_ldi`(`ldi_id`,`tipo_id`) VALUES (13,2);
INSERT INTO `ldi`(`name`, `description`, `lon`, `lat`, `image`,`mainTipo`) VALUES ("Palazzo del Reichstag","DESCRIZIONE","52.51862364553466","13.376084701564771","14.jpg","3");
INSERT INTO `tipo_ldi`(`ldi_id`,`tipo_id`) VALUES (14,3);
INSERT INTO `tipo_ldi`(`ldi_id`,`tipo_id`) VALUES (14,5);
INSERT INTO `ldi`(`name`, `description`, `lon`, `lat`, `image`,`mainTipo`) VALUES ("Memoriale al 10 maggio 1933 incendio del libro nazista","DESCRIZIONE","52.51649783872776","13.393924576216783","15.jpg","2");
INSERT INTO `tipo_ldi`(`ldi_id`,`tipo_id`) VALUES (15,2);
INSERT INTO `tipo_ldi`(`ldi_id`,`tipo_id`) VALUES (15,1);
INSERT INTO `ldi`(`name`, `description`, `lon`, `lat`, `image`,`mainTipo`) VALUES ("Castello di Charlottenburg","DESCRIZIONE","52.52091384333513","13.295687375418117","16.jpg","3");
INSERT INTO `tipo_ldi`(`ldi_id`,`tipo_id`) VALUES (16,3);
INSERT INTO `ldi`(`name`, `description`, `lon`, `lat`, `image`,`mainTipo`) VALUES ("Kaiser-Wilhelm-Gedächtniskirche","DESCRIZIONE","52.5047321396465","13.335069812216597","17.jpg","3");
INSERT INTO `tipo_ldi`(`ldi_id`,`tipo_id`) VALUES (17,3);
INSERT INTO `ldi`(`name`, `description`, `lon`, `lat`, `image`,`mainTipo`) VALUES ("Scultura 'Berlino'","DESCRIZIONE","52.50339467749301","13.338666588285806","18.jpg","4");
INSERT INTO `tipo_ldi`(`ldi_id`,`tipo_id`) VALUES (18,4);
INSERT INTO `tipo_ldi`(`ldi_id`,`tipo_id`) VALUES (18,1);
INSERT INTO `ldi`(`name`, `description`, `lon`, `lat`, `image`,`mainTipo`) VALUES ("The Yellow Man (Os Gemeos)","DESCRIZIONE","52.50004721573544","13.440871821263118","19.jpg","1");
INSERT INTO `tipo_ldi`(`ldi_id`,`tipo_id`) VALUES (19,1);
INSERT INTO `ldi`(`name`, `description`, `lon`, `lat`, `image`,`mainTipo`) VALUES ("Ponte Oberbaum","DESCRIZIONE","52.50172901005705","13.445570757855258","20.jpg","3");
INSERT INTO `tipo_ldi`(`ldi_id`,`tipo_id`) VALUES (20,3);
INSERT INTO `ldi`(`name`, `description`, `lon`, `lat`, `image`,`mainTipo`) VALUES ("Scultura Galileo","DESCRIZIONE","52.50652644936063","13.372366952718885","21.jpg","4");
INSERT INTO `tipo_ldi`(`ldi_id`,`tipo_id`) VALUES (21,4);
INSERT INTO `ldi`(`name`, `description`, `lon`, `lat`, `image`,`mainTipo`) VALUES ("Casa delle Culture del Mondo","DESCRIZIONE","52.51851738349084","13.364454982761172","22.jpg","3");
INSERT INTO `tipo_ldi`(`ldi_id`,`tipo_id`) VALUES (22,3);
INSERT INTO `tipo_ldi`(`ldi_id`,`tipo_id`) VALUES (22,5);
INSERT INTO `ldi`(`name`, `description`, `lon`, `lat`, `image`,`mainTipo`) VALUES ("Fontana dell'amicizia delle nazioni","DESCRIZIONE","52.52198260072916","13.412765890990732","23.jpg","6");
INSERT INTO `tipo_ldi`(`ldi_id`,`tipo_id`) VALUES (23,6);
INSERT INTO `ldi`(`name`, `description`, `lon`, `lat`, `image`,`mainTipo`) VALUES ("Ora mondiale di Urania","DESCRIZIONE","52.52115968180372","13.413303413852317","24.jpg","4");
INSERT INTO `tipo_ldi`(`ldi_id`,`tipo_id`) VALUES (24,4);
INSERT INTO `ldi`(`name`, `description`, `lon`, `lat`, `image`,`mainTipo`) VALUES ("Fontana di Nettuno","DESCRIZIONE","52.51958096168126","13.406839350692549","25.jpg","6");
INSERT INTO `tipo_ldi`(`ldi_id`,`tipo_id`) VALUES (25,6);
INSERT INTO `ldi`(`name`, `description`, `lon`, `lat`, `image`,`mainTipo`) VALUES ("Marx-Engels-Forum","DESCRIZIONE","52.5188087992573","13.403457024139026","26.jpg","4");
INSERT INTO `tipo_ldi`(`ldi_id`,`tipo_id`) VALUES (26,4);
INSERT INTO `tipo_ldi`(`ldi_id`,`tipo_id`) VALUES (26,2);
INSERT INTO `ldi`(`name`, `description`, `lon`, `lat`, `image`,`mainTipo`) VALUES ("La Volksbühne","DESCRIZIONE","52.52680289731485","13.411739106632703","27.jpg","3");
INSERT INTO `tipo_ldi`(`ldi_id`,`tipo_id`) VALUES (27,4);
INSERT INTO `ldi`(`name`, `description`, `lon`, `lat`, `image`,`mainTipo`) VALUES ("Märchenbrunnen","DESCRIZIONE","52.52790475180105","13.426902299424047","28.jpg","6");
INSERT INTO `tipo_ldi`(`ldi_id`,`tipo_id`) VALUES (28,6);
INSERT INTO `preferiti`(`ldi_id`,`email`) VALUES (1,"filippo.spinella.2003@calvino.edu.it");
INSERT INTO `preferiti`(`ldi_id`,`email`) VALUES (2,"filippo.spinella.2003@calvino.edu.it");
INSERT INTO `preferiti`(`ldi_id`,`email`) VALUES (3,"filippo.spinella.2003@calvino.edu.it");
INSERT INTO `preferiti`(`ldi_id`,`email`) VALUES (13,"filippo.spinella.2003@calvino.edu.it");
INSERT INTO `preferiti`(`ldi_id`,`email`) VALUES (8,"filippo.spinella.2003@calvino.edu.it");
INSERT INTO `preferiti`(`ldi_id`,`email`) VALUES (6,"filippo.spinella.2003@calvino.edu.it");
INSERT INTO `preferiti`(`ldi_id`,`email`) VALUES (7,"filippo.spinella.2003@calvino.edu.it");
INSERT INTO `preferiti`(`ldi_id`,`email`) VALUES (17,"filippo.spinella.2003@calvino.edu.it");
INSERT INTO `preferiti`(`ldi_id`,`email`) VALUES (9,"filippo.spinella.2003@calvino.edu.it");
INSERT INTO `preferiti`(`ldi_id`,`email`) VALUES (21,"filippo.spinella.2003@calvino.edu.it");
