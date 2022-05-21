CREATE Database my_visitberlin;
USE my_visitberlin;
CREATE TABLE ldi(
    `id` int PRIMARY KEY AUTO_INCREMENT,
    `name` varchar(255),
    `description` varchar(255),
    `registrationDate` timestamp,
    `lon` varchar(255),
    `lat` varchar(255),
    `image` varchar(255),
    `audio` varchar(255),
    `maintipo` int NOT NULL REFERENCES tipo(id)
);
CREATE TABLE tipo(
    `id` int PRIMARY KEY AUTO_INCREMENT,
    `description` varchar(255),
    `name` varchar(255),
    `image` varchar(255)
);

CREATE TABLE tipo_ldi(
    `ldi_id` int REFERENCES ldi(id),
    `tipo_id` int REFERENCES tipo(id),
    PRIMARY KEY (`ldi_id`, `tipo_id`)
);
CREATE TABLE username(
    `email` varchar(100) PRIMARY KEY,
    `firstName` varchar(255),
    `surname` varchar(255),
    `notice` TINYINT(1),
    `notte` TINYINT(1),
    `gps` TINYINT(1),
    `token` int, 
    `image` varchar(255),
    `pasw` varchar(255) NOT NULL
);
CREATE TABLE preferiti(
    `email` varchar(100) NOT NULL REFERENCES username(email) ,
    `ldi_id` int NOT NULL REFERENCES ldi(id),
    primary key(`email`, `ldi_id`)
);
CREATE TABLE visitati(
    `email` varchar(100) NOT NULL REFERENCES username(email) ,
    `ldi_id` int NOT NULL REFERENCES ldi(id),
    `data` timestamp,
    primary key(`email`, `ldi_id`)
);
INSERT INTO `username`(`email`, `firstName`, `surname`, `notice`, `pasw`) VALUES ("filippo.spinella.2003@calvino.edu.it","Filippo0","Spinella0",1,"19513fdc9da4fb72a4a05eb66917548d3c90ff94d5419e1f2363eea89dfee1dd");
INSERT INTO `username`(`email`, `firstName`, `surname`, `notice`, `pasw`) VALUES ("fili.spin2003@gmail.com","Filippo1","Spinella1",1,"19513fdc9da4fb72a4a05eb66917548d3c90ff94d5419e1f2363eea89dfee1dd");
INSERT INTO `username`(`email`, `firstName`, `surname`, `notice`, `pasw`) VALUES ("filippo.spinella2003@hotmail.com","Filippo2","Spinella2",0,"19513fdc9da4fb72a4a05eb66917548d3c90ff94d5419e1f2363eea89dfee1dd");

INSERT INTO `tipo`(`name`, `image`, `description`) VALUES ("StreetArts", "1.svg", "Arte di strada"); 
INSERT INTO `tipo`(`name`, `image`, `description`) VALUES ("Memoriali", "2.svg", "Monumenti per ricordare le persone che hanno perso la vita"); 
INSERT INTO `tipo`(`name`, `image`, `description`) VALUES ("Edifici", "3.svg", "Palazzi storici o con una particolare importanza");
INSERT INTO `tipo`(`name`, `image`, `description`) VALUES ("Statue", "4.svg", "Statue in giro per le strade di Berlino"); 
INSERT INTO `tipo`(`name`, `image`, `description`) VALUES ("Musei", "5.svg", "Musei di Berlino");
INSERT INTO `tipo`(`name`, `image`, `description`) VALUES ("Fontane", "6.svg", "Fontane di Berlino");
INSERT INTO `ldi`(`name`, `description`, `lon`, `lat`, `image`, `audio`, `maintipo`) VALUES ("Pergamonmuseum","Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla a velit vitae lorem volutpat consectetur vel in mi. In sit amet felis et dolor semper ullamcorper eu vel diam. Pellentesque ultrices, sem eget suscipit hendrerit, ","52.52118763491666","13.396887102137438","1.jpg", "1.mp3", "5");
INSERT INTO `tipo_ldi`(`ldi_id`,`tipo_id`) VALUES (1,5);
INSERT INTO `tipo_ldi`(`ldi_id`,`tipo_id`) VALUES (1,3);
INSERT INTO `ldi`(`name`, `description`, `lon`, `lat`, `image`, `audio`, `maintipo`) VALUES ("Memoriale per gli ebrei assassinati d'Europa","Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla a velit vitae lorem volutpat consectetur vel in mi. In sit amet felis et dolor semper ullamcorper eu vel diam. Pellentesque ultrices, sem eget suscipit hendrerit, ","52.513960618478045","13.378650112228932","2.jpg", "2.mp3", "2");
INSERT INTO `tipo_ldi`(`ldi_id`,`tipo_id`) VALUES (2,2);
INSERT INTO `tipo_ldi`(`ldi_id`,`tipo_id`) VALUES (2,3);
INSERT INTO `ldi`(`name`, `description`, `lon`, `lat`, `image`, `audio`, `maintipo`) VALUES ("Porta di Brandeburgo","Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla a velit vitae lorem volutpat consectetur vel in mi. In sit amet felis et dolor semper ullamcorper eu vel diam. Pellentesque ultrices, sem eget suscipit hendrerit, ","52.516263438555185","13.377663294044417","3.jpg", "3.mp3", "3");
INSERT INTO `tipo_ldi`(`ldi_id`,`tipo_id`) VALUES (3,3);
INSERT INTO `ldi`(`name`, `description`, `lon`, `lat`, `image`, `audio`, `maintipo`) VALUES ("Topografia del terrore","Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla a velit vitae lorem volutpat consectetur vel in mi. In sit amet felis et dolor semper ullamcorper eu vel diam. Pellentesque ultrices, sem eget suscipit hendrerit, ","52.50663393901613","13.383581631216389","4.jpg", "4.mp3", "5");
INSERT INTO `tipo_ldi`(`ldi_id`,`tipo_id`) VALUES (4,2);
INSERT INTO `tipo_ldi`(`ldi_id`,`tipo_id`) VALUES (4,5);
INSERT INTO `tipo_ldi`(`ldi_id`,`tipo_id`) VALUES (4,3);
INSERT INTO `ldi`(`name`, `description`, `lon`, `lat`, `image`, `audio`, `maintipo`) VALUES ("Duomo di Berlino","Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla a velit vitae lorem volutpat consectetur vel in mi. In sit amet felis et dolor semper ullamcorper eu vel diam. Pellentesque ultrices, sem eget suscipit hendrerit, ","52.51911423602293","13.401001642425646","5.jpg", "5.mp3", "3");
INSERT INTO `tipo_ldi`(`ldi_id`,`tipo_id`) VALUES (5,3);
INSERT INTO `tipo_ldi`(`ldi_id`,`tipo_id`) VALUES (5,5);
INSERT INTO `ldi`(`name`, `description`, `lon`, `lat`, `image`, `audio`, `maintipo`) VALUES ("Torre dell'acqua di Prenzlauer Berg","Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla a velit vitae lorem volutpat consectetur vel in mi. In sit amet felis et dolor semper ullamcorper eu vel diam. Pellentesque ultrices, sem eget suscipit hendrerit, ","52.534187788678985","13.418663585412373","6.jpg", "6.mp3", "3");
INSERT INTO `tipo_ldi`(`ldi_id`,`tipo_id`) VALUES (6,1);
INSERT INTO `ldi`(`name`, `description`, `lon`, `lat`, `image`, `audio`, `maintipo`) VALUES ("Monumento ai soldati polacchi e agli antifascisti tedeschi","Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla a velit vitae lorem volutpat consectetur vel in mi. In sit amet felis et dolor semper ullamcorper eu vel diam. Pellentesque ultrices, sem eget suscipit hendrerit, ","52.52874531071378","13.437773436423308","7.jpg", "7.mp3", "2");
INSERT INTO `tipo_ldi`(`ldi_id`,`tipo_id`) VALUES (7,2);
INSERT INTO `ldi`(`name`, `description`, `lon`, `lat`, `image`, `audio`, `maintipo`) VALUES ("Memoriale agli omosessuali perseguitati sotto il nazismo","Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla a velit vitae lorem volutpat consectetur vel in mi. In sit amet felis et dolor semper ullamcorper eu vel diam. Pellentesque ultrices, sem eget suscipit hendrerit, ","52.513251728691856","13.376121538989821","8.jpg", "8.mp3", "2");
INSERT INTO `tipo_ldi`(`ldi_id`,`tipo_id`) VALUES (8,2);
INSERT INTO `ldi`(`name`, `description`, `lon`, `lat`, `image`, `audio`, `maintipo`) VALUES ("Memoriale sovietico (Tiergarten)","Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla a velit vitae lorem volutpat consectetur vel in mi. In sit amet felis et dolor semper ullamcorper eu vel diam. Pellentesque ultrices, sem eget suscipit hendrerit, ","52.5166195461566","13.371907227215877","9.jpg", "9.mp3", "2");
INSERT INTO `tipo_ldi`(`ldi_id`,`tipo_id`) VALUES (9,2);
INSERT INTO `tipo_ldi`(`ldi_id`,`tipo_id`) VALUES (9,3);
INSERT INTO `ldi`(`name`, `description`, `lon`, `lat`, `image`, `audio`, `maintipo`) VALUES ("Museo del Muro (East Side)","Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla a velit vitae lorem volutpat consectetur vel in mi. In sit amet felis et dolor semper ullamcorper eu vel diam. Pellentesque ultrices, sem eget suscipit hendrerit, ","52.50269845047007", "13.445295162790392","10.jpg", "10.mp3", "5");
INSERT INTO `tipo_ldi`(`ldi_id`,`tipo_id`) VALUES (10,2);
INSERT INTO `tipo_ldi`(`ldi_id`,`tipo_id`) VALUES (10,5);
INSERT INTO `ldi`(`name`, `description`, `lon`, `lat`, `image`, `audio`, `maintipo`) VALUES ("Memoriale per le vittime degli omicidi nazionalsocialisti per 'eutanasia'","Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla a velit vitae lorem volutpat consectetur vel in mi. In sit amet felis et dolor semper ullamcorper eu vel diam. Pellentesque ultrices, sem eget suscipit hendrerit, ","52.51055121632733","13.369435937906566","11.jpg", "11.mp3", "2");
INSERT INTO `tipo_ldi`(`ldi_id`,`tipo_id`) VALUES (11,2);
INSERT INTO `ldi`(`name`, `description`, `lon`, `lat`, `image`, `audio`, `maintipo`) VALUES ("Muro di Berlino","Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla a velit vitae lorem volutpat consectetur vel in mi. In sit amet felis et dolor semper ullamcorper eu vel diam. Pellentesque ultrices, sem eget suscipit hendrerit, ","52.50363265076556","13.443069460855533","12.jpg", "12.mp3", "2");
INSERT INTO `tipo_ldi`(`ldi_id`,`tipo_id`) VALUES (12,2);
INSERT INTO `tipo_ldi`(`ldi_id`,`tipo_id`) VALUES (12,4);
INSERT INTO `tipo_ldi`(`ldi_id`,`tipo_id`) VALUES (12,1);
INSERT INTO `ldi`(`name`, `description`, `lon`, `lat`, `image`, `audio`, `maintipo`) VALUES ("Checkpoint Charlie","Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla a velit vitae lorem volutpat consectetur vel in mi. In sit amet felis et dolor semper ullamcorper eu vel diam. Pellentesque ultrices, sem eget suscipit hendrerit, ","52.507440527747924","13.390380012509274","13.jpg", "13.mp3", "2");
INSERT INTO `tipo_ldi`(`ldi_id`,`tipo_id`) VALUES (13,2);
INSERT INTO `ldi`(`name`, `description`, `lon`, `lat`, `image`, `audio`, `maintipo`) VALUES ("Palazzo del Reichstag","Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla a velit vitae lorem volutpat consectetur vel in mi. In sit amet felis et dolor semper ullamcorper eu vel diam. Pellentesque ultrices, sem eget suscipit hendrerit, ","52.51862364553466","13.376084701564771","14.jpg", "14.mp3", "3");
INSERT INTO `tipo_ldi`(`ldi_id`,`tipo_id`) VALUES (14,3);
INSERT INTO `tipo_ldi`(`ldi_id`,`tipo_id`) VALUES (14,5);
INSERT INTO `ldi`(`name`, `description`, `lon`, `lat`, `image`, `audio`, `maintipo`) VALUES ("Memoriale al 10 maggio 1933 incendio del libro nazista","Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla a velit vitae lorem volutpat consectetur vel in mi. In sit amet felis et dolor semper ullamcorper eu vel diam. Pellentesque ultrices, sem eget suscipit hendrerit, ","52.51649783872776","13.393924576216783","15.jpg", "15.mp3", "2");
INSERT INTO `tipo_ldi`(`ldi_id`,`tipo_id`) VALUES (15,2);
INSERT INTO `tipo_ldi`(`ldi_id`,`tipo_id`) VALUES (15,1);
INSERT INTO `ldi`(`name`, `description`, `lon`, `lat`, `image`, `audio`, `maintipo`) VALUES ("Castello di Charlottenburg","Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla a velit vitae lorem volutpat consectetur vel in mi. In sit amet felis et dolor semper ullamcorper eu vel diam. Pellentesque ultrices, sem eget suscipit hendrerit, ","52.52091384333513","13.295687375418117","16.jpg", "16.mp3", "3");
INSERT INTO `tipo_ldi`(`ldi_id`,`tipo_id`) VALUES (16,3);
INSERT INTO `ldi`(`name`, `description`, `lon`, `lat`, `image`, `audio`, `maintipo`) VALUES ("Kaiser-Wilhelm-Gedächtniskirche","Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla a velit vitae lorem volutpat consectetur vel in mi. In sit amet felis et dolor semper ullamcorper eu vel diam. Pellentesque ultrices, sem eget suscipit hendrerit, ","52.5047321396465","13.335069812216597","17.jpg", "17.mp3", "3");
INSERT INTO `tipo_ldi`(`ldi_id`,`tipo_id`) VALUES (17,3);
INSERT INTO `ldi`(`name`, `description`, `lon`, `lat`, `image`, `audio`, `maintipo`) VALUES ("Scultura 'Berlino'","Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla a velit vitae lorem volutpat consectetur vel in mi. In sit amet felis et dolor semper ullamcorper eu vel diam. Pellentesque ultrices, sem eget suscipit hendrerit, ","52.50339467749301","13.338666588285806","18.jpg", "18.mp3", "4");
INSERT INTO `tipo_ldi`(`ldi_id`,`tipo_id`) VALUES (18,4);
INSERT INTO `tipo_ldi`(`ldi_id`,`tipo_id`) VALUES (18,1);
INSERT INTO `ldi`(`name`, `description`, `lon`, `lat`, `image`, `audio`, `maintipo`) VALUES ("The Yellow Man (Os Gemeos)","Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla a velit vitae lorem volutpat consectetur vel in mi. In sit amet felis et dolor semper ullamcorper eu vel diam. Pellentesque ultrices, sem eget suscipit hendrerit, ","52.50004721573544","13.440871821263118","19.jpg", "19.mp3", "1");
INSERT INTO `tipo_ldi`(`ldi_id`,`tipo_id`) VALUES (19,1);
INSERT INTO `ldi`(`name`, `description`, `lon`, `lat`, `image`, `audio`, `maintipo`) VALUES ("Ponte Oberbaum","Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla a velit vitae lorem volutpat consectetur vel in mi. In sit amet felis et dolor semper ullamcorper eu vel diam. Pellentesque ultrices, sem eget suscipit hendrerit, ","52.50172901005705","13.445570757855258","20.jpg", "20.mp3", "3");
INSERT INTO `tipo_ldi`(`ldi_id`,`tipo_id`) VALUES (20,3);
INSERT INTO `ldi`(`name`, `description`, `lon`, `lat`, `image`, `audio`, `maintipo`) VALUES ("Scultura Galileo","Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla a velit vitae lorem volutpat consectetur vel in mi. In sit amet felis et dolor semper ullamcorper eu vel diam. Pellentesque ultrices, sem eget suscipit hendrerit, ","52.50652644936063","13.372366952718885","21.jpg", "21.mp3", "4");
INSERT INTO `tipo_ldi`(`ldi_id`,`tipo_id`) VALUES (21,4);
INSERT INTO `ldi`(`name`, `description`, `lon`, `lat`, `image`, `audio`, `maintipo`) VALUES ("Casa delle Culture del Mondo","Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla a velit vitae lorem volutpat consectetur vel in mi. In sit amet felis et dolor semper ullamcorper eu vel diam. Pellentesque ultrices, sem eget suscipit hendrerit, ","52.51851738349084","13.364454982761172","22.jpg", "22.mp3", "3");
INSERT INTO `tipo_ldi`(`ldi_id`,`tipo_id`) VALUES (22,3);
INSERT INTO `tipo_ldi`(`ldi_id`,`tipo_id`) VALUES (22,5);
INSERT INTO `ldi`(`name`, `description`, `lon`, `lat`, `image`, `audio`, `maintipo`) VALUES ("Fontana dell'amicizia delle nazioni","Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla a velit vitae lorem volutpat consectetur vel in mi. In sit amet felis et dolor semper ullamcorper eu vel diam. Pellentesque ultrices, sem eget suscipit hendrerit, ","52.52198260072916","13.412765890990732","23.jpg", "23.mp3", "6");
INSERT INTO `tipo_ldi`(`ldi_id`,`tipo_id`) VALUES (23,6);
INSERT INTO `ldi`(`name`, `description`, `lon`, `lat`, `image`, `audio`, `maintipo`) VALUES ("Ora mondiale di Urania","Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla a velit vitae lorem volutpat consectetur vel in mi. In sit amet felis et dolor semper ullamcorper eu vel diam. Pellentesque ultrices, sem eget suscipit hendrerit, ","52.52115968180372","13.413303413852317","24.jpg", "24.mp3", "4");
INSERT INTO `tipo_ldi`(`ldi_id`,`tipo_id`) VALUES (24,4);
INSERT INTO `ldi`(`name`, `description`, `lon`, `lat`, `image`, `audio`, `maintipo`) VALUES ("Fontana di Nettuno","Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla a velit vitae lorem volutpat consectetur vel in mi. In sit amet felis et dolor semper ullamcorper eu vel diam. Pellentesque ultrices, sem eget suscipit hendrerit, ","52.51958096168126","13.406839350692549","25.jpg", "25.mp3", "6");
INSERT INTO `tipo_ldi`(`ldi_id`,`tipo_id`) VALUES (25,6);
INSERT INTO `ldi`(`name`, `description`, `lon`, `lat`, `image`, `audio`, `maintipo`) VALUES ("Marx-Engels-Forum","Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla a velit vitae lorem volutpat consectetur vel in mi. In sit amet felis et dolor semper ullamcorper eu vel diam. Pellentesque ultrices, sem eget suscipit hendrerit, ","52.5188087992573","13.403457024139026","26.jpg", "26.mp3", "4");
INSERT INTO `tipo_ldi`(`ldi_id`,`tipo_id`) VALUES (26,4);
INSERT INTO `tipo_ldi`(`ldi_id`,`tipo_id`) VALUES (26,2);
INSERT INTO `ldi`(`name`, `description`, `lon`, `lat`, `image`, `audio`, `maintipo`) VALUES ("La Volksbühne","Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla a velit vitae lorem volutpat consectetur vel in mi. In sit amet felis et dolor semper ullamcorper eu vel diam. Pellentesque ultrices, sem eget suscipit hendrerit, ","52.52680289731485","13.411739106632703","27.jpg", "27.mp3", "3");
INSERT INTO `tipo_ldi`(`ldi_id`,`tipo_id`) VALUES (27,4);
INSERT INTO `ldi`(`name`, `description`, `lon`, `lat`, `image`, `audio`, `maintipo`) VALUES ("Märchenbrunnen","Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla a velit vitae lorem volutpat consectetur vel in mi. In sit amet felis et dolor semper ullamcorper eu vel diam. Pellentesque ultrices, sem eget suscipit hendrerit, ","52.52790475180105","13.426902299424047","28.jpg", "28.mp3", "6");
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
INSERT INTO `visitati`(`ldi_id`,`email`) VALUES (1,"filippo.spinella2003@hotmail.com");
