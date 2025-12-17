CREATE DATABASE livraison;
USE livraison;

CREATE TABLE entrepot (
    id INT PRIMARY KEY AUTO_INCREMENT,
    nom VARCHAR(100) NOT NULL,
    adresse TEXT NOT NULL
);


CREATE TABLE chauffeur (
    id INT PRIMARY KEY AUTO_INCREMENT,
    nom VARCHAR(100) NOT NULL,
    prenom VARCHAR(100),
    salaire_par_livraison DECIMAL(10, 2) NOT NULL
);


CREATE TABLE vehicule (
    id INT PRIMARY KEY AUTO_INCREMENT,
    immatriculation VARCHAR(20) NOT NULL UNIQUE,
    type VARCHAR(50),
    cout_par_livraison DECIMAL(10, 2) NOT NULL
);


CREATE TABLE colis (
    id INT PRIMARY KEY AUTO_INCREMENT,
    poids_kg DECIMAL(6, 2) NOT NULL CHECK (poids_kg > 0),
    tarif_par_kg DECIMAL(6, 2) NOT NULL CHECK (tarif_par_kg >= 0)
);


CREATE TABLE statut_livraison (
    id INT AUTO_INCREMENT PRIMARY KEY,
    valeur_status ENUM('en_attente','livré','annulé') NOT NULL
) ;


CREATE TABLE livraison (
    id INT PRIMARY KEY AUTO_INCREMENT,
    id_colis INT NOT NULL,
    id_chauffeur INT NOT NULL,
    id_vehicule INT NOT NULL,
    id_entrepot INT NOT NULL,
    adresse_destination TEXT NOT NULL,
    id_statut INT NOT NULL,
    date_livraison DATE NOT NULL,

 
    FOREIGN KEY (id_colis) REFERENCES colis(id) ON DELETE CASCADE,
    FOREIGN KEY (id_chauffeur) REFERENCES chauffeur(id),
    FOREIGN KEY (id_vehicule) REFERENCES vehicule(id),
    FOREIGN KEY (id_entrepot) REFERENCES entrepot(id),
    FOREIGN KEY (id_statut) REFERENCES statut_livraison(id)
);


INSERT INTO entrepot (nom, adresse) VALUES ('Entrepôt Central', '123 Rue, Analakely');


INSERT INTO chauffeur (nom, prenom, salaire_par_livraison) VALUES
('Dupont', 'Jean', 25.00),
('Martin', 'Claire', 30.00);


INSERT INTO vehicule (immatriculation, type, cout_par_livraison) VALUES
('AB-123-CD', 'Camion', 40.00),
('XY-789-ZW', 'Van', 20.00);

INSERT INTO colis (poids_kg, tarif_par_kg) VALUES
(10.50, 5.00),
(5.00, 6.00);

INSERT INTO statut_livraison (valeur_status) VALUES
('en_attente'),
('livré'),
('annulé');


INSERT INTO livraison (
    id_colis, id_chauffeur, id_vehicule, id_entrepot,
    adresse_destination, id_statut, date_livraison
) VALUES
(1, 1, 1, 1, '456 Avenue Client, Lyon', 2, '2025-12-10'),
(2, 2, 2, 1, '789 Rue Destinataire, Marseille', 1, '2025-12-18');

--Benefice par jours,seulement pour les colis livrés
SELECT
    l.date_livraison AS jour,
    SUM(c.poids_kg * c.tarif_par_kg) AS chiffre_affaire,
    SUM(ch.salaire_par_livraison + v.cout_par_livraison) AS cout_total,
    SUM((c.poids_kg * c.tarif_par_kg) - (ch.salaire_par_livraison + v.cout_par_livraison)) AS benefice
FROM livraison l
JOIN colis c ON l.id_colis = c.id
JOIN chauffeur ch ON l.id_chauffeur = ch.id
JOIN vehicule v ON l.id_vehicule = v.id
JOIN statut_livraison s ON l.id_statut = s.id
WHERE s.valeur_status  = 'livré'
GROUP BY l.date_livraison
ORDER BY jour;

--Benefice par mois, seulement pour les colis livrés
SELECT
    YEAR(l.date_livraison) AS annee,
    MONTH(l.date_livraison) AS mois,
    SUM((c.poids_kg * c.tarif_par_kg) - (ch.salaire_par_livraison + v.cout_par_livraison)) AS benefice
FROM livraison l
JOIN colis c ON l.id_colis = c.id
JOIN chauffeur ch ON l.id_chauffeur = ch.id
JOIN vehicule v ON l.id_vehicule = v.id
JOIN statut_livraison s ON l.id_statut = s.id
WHERE s.valeur_status  = 'livré'
GROUP BY annee, mois
ORDER BY annee, mois;

--Benefice par an, seulement pour les colis livrés
SELECT
    YEAR(l.date_livraison) AS annee,
    SUM((c.poids_kg * c.tarif_par_kg) - (ch.salaire_par_livraison + v.cout_par_livraison)) AS benefice
FROM livraison l
JOIN colis c ON l.id_colis = c.id
JOIN chauffeur ch ON l.id_chauffeur = ch.id
JOIN vehicule v ON l.id_vehicule = v.id
JOIN statut_livraison s ON l.id_statut = s.id
WHERE s.valeur_status  = 'livré'
GROUP BY annee
ORDER BY annee;