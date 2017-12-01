-- Database: fly_pfe
-- USERNAME: testuser
-- PASSWORD: password

-- Disable FOREIGN KEY CHECK
SET FOREIGN_KEY_CHECKS = 0;

--
-- Table structrue for table `users`
--

DROP TABLE IF EXISTS users;

CREATE TABLE users (
	id int(10) NOT NULL AUTO_INCREMENT, 
	nom varchar(50) NOT NULL,
	prenom varchar(50) NOT NULL,
	CIN varchar(10),
	adresse varchar(100),
	admin tinyint(1) NOT NULL DEFAULT 0,
	user_name varchar(50) NOT NULL,
	password varchar(50) NOT NULL,
	image varchar(200) DEFAULT "images/admin/admin_img.jpg",
	num_tel varchar(500) DEFAULT NULL,
	UNIQUE (user_name),
	UNIQUE(CIN),
	PRIMARY KEY(id)
);

INSERT INTO users (nom, prenom, admin, user_name, password) VALUES ("admin", "admin", 1, "admin", "password");
INSERT INTO users (nom, prenom, admin, user_name, password) VALUES ("dmidma", "dmidma", 0, "dmidma", "password");




--
-- Table structrue for table `reservation`
--

-- What do we need `validite` for?
DROP TABLE IF EXISTS reservation;

CREATE TABLE reservation (
	id int(10) NOT NULL AUTO_INCREMENT, 
	id_user int(10) NOT NULL,
	date_reservation DATETIME DEFAULT CURRENT_TIMESTAMP,
	date_debut DATETIME NOT NULL,
	nbr_jour int(10) unsigned NOT NULL,
	validite tinyint(1) DEFAULT 0,
	FOREIGN KEY (id_user) REFERENCES users(id),
	PRIMARY KEY(id)
);



--
-- Table structrue for table `hotel`
--

DROP TABLE IF EXISTS hotel;

CREATE TABLE hotel (
	id int(10) NOT NULL AUTO_INCREMENT, 
	nom varchar(50) NOT NULL,
	stars SMALLINT(10) unsigned NOT NULL,
	adresse varchar(100),
	description varchar(1000) NOT NULL DEFAULT "N/A",
	latitude varchar(20),
	longitude varchar(20),
	price_night FLOAT(5, 2) NOT NULL,
	UNIQUE (nom),
	PRIMARY KEY(id)
);


INSERT INTO hotel (id, nom, stars, adresse, description, price_night) VALUES (1, "test_hotel", 5, "ibiza", "Good!", 149.5);


--
-- Table structrue for table `hotel_images`
--

DROP TABLE IF EXISTS hotel_images;

CREATE TABLE hotel_images (
	id int(10) NOT NULL AUTO_INCREMENT, 
	id_hotel int(10) NOT NULL,
	image varchar(250) DEFAULT "images/hotels/default_hotel.jpg",
	PRIMARY KEY(id),
	FOREIGN KEY(id_hotel) REFERENCES hotel(id)
);


INSERT INTO hotel_images (id_hotel, image) VALUES (1, "images/hotels/test_hotel.jpg");


--
-- Table structrue for table `voiture`
--

DROP TABLE IF EXISTS voiture;

CREATE TABLE voiture (
	id int(10) NOT NULL AUTO_INCREMENT, 
	nom varchar(50) NOT NULL,
	marque varchar(50) NOT NULL,
	puissance INT(5) NOT NULL,
	carburant varchar(50) NOT NULL,
	prix FLOAT(15,3) NOT NULL,
	description varchar(1000) NOT NULL DEFAULT "N/A",
	UNIQUE (nom, marque),
	PRIMARY KEY(id)
);


INSERT INTO voiture (id, nom, marque, puissance, carburant, prix, description) VALUES (1, "Polo GT", "volkswagen", 6, "Sans Plomb", 50, "Good!");


--
-- Table structrue for table `voiture_images`
--

DROP TABLE IF EXISTS voiture_images;

CREATE TABLE voiture_images (
	id int(10) NOT NULL AUTO_INCREMENT, 
	id_voiture int(10) NOT NULL,
	image varchar(250) DEFAULT "images/voitures/default_voiture.jpg",
	PRIMARY KEY(id),
	FOREIGN KEY(id_voiture) REFERENCES voiture(id)
);


INSERT INTO voiture_images (id_voiture, image) VALUES (1, "images/voitures/Polo_GT.jpg");



--
-- Table structrue for table `circuit`
--

DROP TABLE IF EXISTS circuit;

CREATE TABLE circuit (
	id int(10) NOT NULL AUTO_INCREMENT, 
	nom varchar(50) NOT NULL,
	plan varchar(100) NOT NULL,
	depart varchar(200) NOT NULL,
	date_depart DATETIME NOT NULL,
	date_arrive DATETIME NOT NULL,
	prix FLOAT(15,3) NOT NULL,
	description varchar(1000) NOT NULL DEFAULT "N/A",
	PRIMARY KEY(id)
);

-- Add plan for each day in the Description
-- Search on the description
-- 



--
-- Table structrue for table `circuit_images`
--

DROP TABLE IF EXISTS circuit_images;

CREATE TABLE circuit_images (
	id int(10) NOT NULL AUTO_INCREMENT, 
	id_circuit int(10) NOT NULL,
	image varchar(250) DEFAULT "images/circuits/default_circuit.jpg",
	PRIMARY KEY(id),
	FOREIGN KEY(id_circuit) REFERENCES circuit(id)
);





--
-- Table structrue for table `reservation_circuit`
--

DROP TABLE IF EXISTS reservation_circuit;

CREATE TABLE reservation_circuit (
	id_circuit int(10) NOT NULL,
	id_reservation int(10) NOT NULL,
	promo FLOAT(5, 2),
	nbr_people int(10) unsigned,
	FOREIGN KEY (id_circuit) REFERENCES circuit(id),
	FOREIGN KEY (id_reservation) REFERENCES reservation(id),
	PRIMARY KEY(id_circuit, id_reservation)
);

-- populate the nubmer of people



--
-- Table structrue for table `reservation_hotel`
--

-- `type`  What for?
-- `type` is NULL by default.
DROP TABLE IF EXISTS reservation_hotel;

CREATE TABLE reservation_hotel (
	id_hotel int(10) NOT NULL,
	id_reservation int(10) NOT NULL,
	type varchar(50) DEFAULT NULL,
	pension varchar(50),
	nbr_rooms int(10) unsigned,
	promotion FLOAT(5,2) DEFAULT 0,
	FOREIGN KEY (id_hotel) REFERENCES hotel(id),
	FOREIGN KEY (id_reservation) REFERENCES reservation(id),
	PRIMARY KEY(id_hotel, id_reservation)
);

--
-- Table structrue for table `reservation_voiture`
--

DROP TABLE IF EXISTS reservation_voiture;

CREATE TABLE reservation_voiture (
	id_voiture int(10) NOT NULL,
	id_reservation int(10) NOT NULL,
	promo FLOAT(5, 2),
	FOREIGN KEY (id_voiture) REFERENCES voiture(id),
	FOREIGN KEY (id_reservation) REFERENCES reservation(id),
	PRIMARY KEY(id_voiture, id_reservation)
);


	
--
-- Table structrue for table `promotion_hotel`
--

DROP TABLE IF EXISTS promotion_hotel;

CREATE TABLE promotion_hotel (
	id int(10) NOT NULL AUTO_INCREMENT, 
	id_hotel int(10) NOT NULL,
	promo FLOAT(5,2),
	date_deb_promotion DATETIME DEFAULT CURRENT_TIMESTAMP,
	date_fin_promotion DATETIME DEFAULT NULL,
	FOREIGN KEY (id_hotel) REFERENCES hotel(id),
	PRIMARY KEY(id)
);


--
-- Table structrue for table `promotion_voiture`
--

DROP TABLE IF EXISTS promotion_voiture;

CREATE TABLE promotion_voiture (
	id int(10) NOT NULL AUTO_INCREMENT, 
	id_voiture int(10) NOT NULL,
	promo FLOAT(5,2),
	date_deb_promotion DATETIME DEFAULT CURRENT_TIMESTAMP,
	date_fin_promotion DATETIME DEFAULT NULL,
	FOREIGN KEY (id_voiture) REFERENCES voiture(id),
	PRIMARY KEY(id)
);

--
-- Table structrue for table `promotion_circuit`
--

DROP TABLE IF EXISTS promotion_circuit;

CREATE TABLE promotion_circuit (
	id int(10) NOT NULL AUTO_INCREMENT, 
	id_circuit int(10) NOT NULL,
	promo FLOAT(5,2),
	date_deb_promotion DATETIME DEFAULT CURRENT_TIMESTAMP,
	date_fin_promotion DATETIME DEFAULT NULL,
	FOREIGN KEY (id_circuit) REFERENCES circuit(id),
	PRIMARY KEY(id)
);

--
-- Table structrue for table `contactez_nous`
--

DROP TABLE IF EXISTS contactez_nous;

CREATE TABLE contactez_nous (
	id int(10) NOT NULL AUTO_INCREMENT, 
	nom varchar(100) NOT NULL,
	email varchar(100) NOT NULL,
	sujet varchar(100) NOT NULL,
	message varchar(500) NOT NULL,
	PRIMARY KEY(id)
);


-- 
-- Table structure for table `code_reservation`
--

DROP TABLE IF EXISTS code_reservation;

CREATE TABLE code_reservation (
	id int(10) NOT NULL AUTO_INCREMENT,
	id_user int(10) NOT NULL,
	type varchar(50) NOT NULL,
	id_reservation int(100) NOT NULL,
	code varchar(100) NOT NULL,
	PRIMARY KEY(id),
	FOREIGN KEY(id_user) REFERENCES users(id)
);




-- Enable FOREIGN KEY CHECK
SET FOREIGN_KEY_CHECKS = 1;
