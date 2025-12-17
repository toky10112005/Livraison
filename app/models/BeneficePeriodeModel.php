<?php

namespace app\models;

use Flight;
use PDO;

    class BeneficePeriodeModel {
        private $db;

        public function __construct($db){
            $this->db=$db;
        }

        public function getBeneficeParJour(){
            $stmt=$this->db->query("SELECT
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
ORDER BY jour;");

            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }

        public function getBenenficeParMois(){
            $stmt=$this->db->query("SELECT
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
ORDER BY annee, mois;");
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }

        public function getBenenficeParAn(){
            $stmt=$this->db->query("SELECT
    YEAR(l.date_livraison) AS annee,
    SUM((c.poids_kg * c.tarif_par_kg) - (ch.salaire_par_livraison + v.cout_par_livraison)) AS benefice
FROM livraison l
JOIN colis c ON l.id_colis = c.id
JOIN chauffeur ch ON l.id_chauffeur = ch.id
JOIN vehicule v ON l.id_vehicule = v.id
JOIN statut_livraison s ON l.id_statut = s.id
WHERE s.valeur_status  = 'livré'
GROUP BY annee
ORDER BY annee;");

            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }


}