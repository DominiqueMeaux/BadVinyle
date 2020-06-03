/**
*	Script Insertion de données
*
*	Fil Rouge
*
*
*/

/* Categories */
INSERT INTO `categories` VALUES 
(1, "Metal",0),
(101, "Black Metal", 1),
(102, "Power Metal", 1),
(103, "Thrash Metal", 1),
(2, "Musique Française", 0),
(201, "Bal Musette", 2),
(202, "Chanson Française", 2),
(203, "Jazz Manouche", 2),
(3, "Electro", 0),
(301, "House", 3),
(302, "Tribe", 3),
(303, "Expérimentale", 3),
(4, "Folk", 0),
(401, "Musique Bretonne", 4),
(402, "Musique Latine", 4 );

/* Group */
INSERT INTO `group` VALUES
(1, "Summoning", "Groupe de Black Metal Autrichien. Groupe connu pour prendre son inspiration dans le monde de J R R Tolkien."),
(2, "Rhapsody of Fire", "Groupe de Power Metal Symphonique Italien."),
(3, "Slayer", "Groupe de Thrash Metal Américain originaire de Californie."),
(4, "Louis Corchia", "Joueur D'accordéon"),
(5, "Edith Piaf", "Chanteuse, parolière et compositrice française"),
(6, "Django Reinhardt", "Guitariste de Jazz"),
(7, "Frankie Knuckles", "Dj et compositeur Américian de musique électronique"),
(8, "Psylotribe", "Compositeur de TribeCore"),
(9, "Throbbling Gristle", "Groupe de musique Expérimentale et Bruitiste Anglais"),
(10, "Tri Yann", "Groupe de folk rock Breton"),
(11, "Arsenio Rodriguez", "Musicien Cubain et Compositeur");

/* type address */
INSERT INTO `type_address` VALUES
(1, "Utilisateur"),
(2, "Fournisseur"),
(3, "Label"),
(4, "Facturation"),
(5, "Livraison");

/*address */
INSERT INTO `address` VALUES
(1, 3, "Paris", "France", "75000", "6 rue contrebasse"),
(2, 3, "Abbeville", "France", "80000", "18 avenue du Saxophone"),
(3, 3, "Nice", "France", "06000", "24 Impasse du chat noir"), 
(4, 3, "Brest", "France", "29200", "42 rue de l univers"),
(5, 2, "Toulouse", "France", "31000", "16  impasse du bas"),
(6, 2, "Caen", "France", "14000", "31 rue du savon");

/*label*/
INSERT INTO `label` VALUES
("145789632", 2, "Metal hurlant", "m.hurlant@daposte.com", "label spécialisé dans le metal"),
("976316472", 1, "Frenchy Touchy", "fre.ouch@gamel.fr", "Label spécialisé dans la musique française"),
("456123789", 4, "Tonerre de brest", "toner.de.brest@lapoust.net", "label spécialisé en musique eletro "),
("159483548", 3, "Ambiani", "amb.iani@gtmail.com", "label spécialisé dansl es musique folk de tout horizon");

/*type promo*/
INSERT INTO `type_promo` VALUES
(1, "Promo Noel"),
(2, "Promo Rentré"),
(3, "Promo Metal"),
(4, "Promo Paques"),
(5, "Saint Valentin");

/*promo*/
INSERT INTO `promotions` VALUES 
( 1, 1, 30, "un noel incroyable", 0, "2020-01-01"),
(2, 2, 15, "Rentré Super" , 0, "2019-10-01"),
(3, 3, 13, "Diablo Promo", 1, "2020-07-14"),
(4, 4, 30, "Promo Gourmande", 0, "2020-05-01"),
(5, 5, 25, "Romantique", 0, "2020-02-20");

/*photo*/
INSERT INTO `photo` VALUES
(1, "jpg", "Vinyl collector Summoning"),
(2, "jpg", "Vinyl rare Rhapsody OF Fire - Best of"),
(3, "jpg", "Album De Slayer"),
(4, "jpg", "Album de Best of de Louis Corchia"),
(5, "jpg", "Album de best of de Edith Piaf"),
(6, "jpg", "Album de Django Reinhardt"),
(7, "jpg", "Album de Frankie Knuckles"),
(8, "jpg", "Album Featuring Psylotribe"),
(9, "jpg", "Album de Throbbling Gristle"),
(10, "jpg", "Album de Tri Yann Ancien"),
(11, "jpg", "Album de Arsenio Rodriguez");

/*type fournisseur*/
INSERT INTO `type_provider` VALUES
(1, "Détaillant"),
(2, "Grossiste");

/*fournisseur*/
INSERT INTO `provider` VALUES
("159785863", 1,  5, "DétailVin", "detailtout@vinylism.com", "0322457896", "Détaillant De vinyl"),
("321654987", 2, 6,"MassVin", "massdetout@lapostiere.fr", "0155789631", "Grossite De vinyl");

/*products*/
INSERT INTO `products` VALUES
(1, 1, 101, "145789632", 1, "159785863", "Minas Morgul", "Album de Black  metal Atmospherique", 25.50, 1, 150),
(2, 2, 102, "145789632", 2, "321654987", "Legendary Years", "Power Metal Epic Album retracant la carrière du groupe", 30.00, 1, 20),
(3, 3, 103, "145789632", 3, "159785863", "Repentless", "", 20.10, 1, 155),
(4, 4, 201, "976316472", 4, "321654987","Hit Parade Accordeon", "", 5.50, 1, 5),
(5, 5, 202, "976316472", 5, "159785863", "The Very Best OF", "", 35.20, 1, 5),
(6, 6, 203, "976316472", 6, "321654987","24 Classic Jazz Perfomances", "", 45.20, 1, 40),
(7, 7, 301, "456123789", 7, "159785863", "Your Love Bady Wants to ride", "", 18.90, 1, 25),
(8, 8, 302, "456123789", 8, "321654987", "The New Challengers", "",  11.60, 1, 8),
(9, 9, 303, "456123789", 9, "159785863", "Very Friendly", "", 18.99, 1, 21),
(10, 10, 401, "159483548", 10, "321654987","Ann Noaded", "", 25.33, 1, 11),
(11, 11, 402, "159483548", 11, "159785863", "Y Su Conjunto", "", 65.20, 1, 18);

/*promo product*/
INSERT INTO `promo_products` VALUES
(1,3),
(6,5);

/*coef price */
INSERT INTO `coef_price` VALUES
(1, 1),
(2, 0.8);

/*user type*/
INSERT INTO `user_type` VALUES
(1, 1, "Client"),
(2, 2, "Adminstrateur"),
(3, 2, "Commercial");

/*order status*/
INSERT INTO `order_status` VALUES
(1, "En préparation"),
(2, "En attente"),
(3, "En  cours de livraison"),
(4, "livré"),
(5, "Annulé");