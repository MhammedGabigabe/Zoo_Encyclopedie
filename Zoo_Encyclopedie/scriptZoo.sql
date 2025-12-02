------Creation de la base de donnée---------

create database zoo_encyclopedie;
use zoo_encyclopedie;

-------Creation de la table Habitat---------

create table habitat(
    id_habitat int PRIMARY KEY AUTO_INCREMENT,
    nom_habitat varchar(50),
    descrip_habitat text
    );

-------Creation de la table Animal---------

create table animal(
    id_animal int PRIMARY KEY AUTO_INCREMENT,
    nom_animal varchar(30),
    image_animal varchar(100),
    type_alimen_animal varchar(50),
    id_hab_animal int, 
    FOREIGN KEY (id_hab_animal) REFERENCES habitat (id_habitat)
    );

--------Script d'insertion des abitats--------------------

INSERT INTO habitat (nom_habitat,descrip_habitat)
VALUES ('Savane','La savane est un habitat de prairie chaude avec des herbes hautes et des arbres épars');

INSERT INTO habitat (nom_habitat,descrip_habitat)
VALUES ('Jungle','La jungle est un écosystème dense et humide, caractérisé par une végétation luxuriante et une biodiversité exceptionnelle, avec des zones comme la canopée (hautes branches), le sous-bois et les clairières marécageuses');

INSERT INTO habitat (nom_habitat,descrip_habitat)
VALUES ('Désert',"L'habitat désertique se caractérise par des températures extrêmes, des précipitations très faibles et une rareté de l'eau, forçant les animaux à développer des adaptations pour survivre");

INSERT INTO habitat (nom_habitat,descrip_habitat)
VALUES ('Océan',"L'océan est un habitat très diversifié qui abrite des millions d'espèces animales dans des zones allant des côtes peu profondes aux abysses les plus profonds");


-----------Script d'insertion des animaux---------------

insert into animal (nom_animal,image_animal,type_alimen_animal,id_hab_animal)
VALUES('Dauphin','https://planetedauphins.com/wp-content/uploads/2023/06/caracterisitique-dauphin.jpeg','Carnivore',4),
	  ('Requins','https://www.fishipedia.fr/wp-content/uploads/2019/06/REQUIN-BLANC_AP5A9973_FGUERIN.jpg','Carnivore',4),
      ('Tortue marine','https://cdn.shopify.com/s/files/1/0569/0615/4154/files/sea-turtle-underwater-facing-    	   	camera.jpg','Herbivore',4),
      ('Le dromadaire','https://www.jaitoutcompris.com/img/encyclo/dromadaire.jpg','Herbivore',3),
      ('Le fennec','https://upload.wikimedia.org/wikipedia/commons/9/9f/Fennec_Fox_Vulpes_zerda.jpg','Omnivore',3),
      ('Le cheval de Przewalski','https://upload.wikimedia.org/wikipedia/commons/thumb/8/84/Takhi_Hustai.jpg/250px-Takhi_Hustai.jpg','Herbivore',3),
      ('Éléphant','https://www.worldanimalprotection.ca/siteassets/shutterstock_1859164087_1200x630.jpg','Herbivore',2),
      ('Renard','https://lemagdesanimaux.ouest-france.fr/images/dossiers/2018-04/mini/renard-roux-070923-1200-738.jpg','Omnivore',2);

insert into animal (nom_animal,image_animal,type_alimen_animal,id_hab_animal)
VALUES('Jaguar','https://www.monde-animal.fr/wp-content/uploads/2021/04/jaguar-carre.jpg','Carnivore',2),  ('Lien','https://upload.wikimedia.org/wikipedia/commons/6/6f/011_The_lion_king_Tryggve_in_the_Serengeti_National_Park_Photo_by_Giles_Laurent.jpg','Carnivore',2),
      ('Léopards','https://www.zoologiste.com/images/xl/leopard.jpg','Carnivore',2),
      ('Singe','https://upload.wikimedia.org/wikipedia/commons/thumb/d/d2/Erythrocebus-patas-patas-Burkina-faso.JPG/960px-Erythrocebus-patas-patas-Burkina-faso.JPG','Omnivore',2),
      ('Loup','https://www.lapyramideduloup.com/wp-content/uploads/2023/11/wolf-8142720_1280-1024x712.jpg','Carnivore',2);    


------------Modifier les détails d'un animal-----------------------      

select * from animal where id_animal = 11;

UPDATE animal
SET nom_animal = 'Léopard'
where id_animal = 11;

select * from animal where id_animal = 11;

select * from animal where id_animal = 2;

UPDATE animal
SET nom_animal = 'Requin'
where id_animal = 2;

select * from animal where id_animal = 2;

UPDATE animal
SET id_hab_animal = 1
where nom_animal = 'singe';

--------------------------Supprimer un animal-----------------------

DELETE FROM animal where nom_animal='Le cheval de Przewalski';

--------------------------Afficher la liste des animaux du zoo avec leurs images---------------------------

select * from animal;

select nom_animal as "Nom d'animal", image_animal as "URL d'image" from animal;







