<?php
require_once 'connexion.php';

class DialogueBD
{
    // Onglet 1 : Top 5 des applications (toutes ressources et mois confondus)
    public function getTop5Applications()
    {
        try {
            $conn = Connexion::getConnexion();

            $sql = "SELECT a.nom, SUM(c.volume) AS total_volume 
                    FROM application a
                    JOIN consommation c ON a.app_id = c.app_id
                    GROUP BY a.app_id, a.nom
                    ORDER BY total_volume DESC
                    LIMIT 5";
            $sth = $conn->prepare($sql);
            $sth->execute();
            return $sth->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            die("Erreur Onglet 1 : " . $e->getMessage());
        }
    }

    // Onglet 2 : Évolution mensuelle (janvier à juin 2025)
    public function getEvolutionMensuelle()
    {
        try {
            $conn = Connexion::getConnexion();

            $sql = "SELECT mois, SUM(volume) AS total_volume 
                    FROM consommation 
                    WHERE mois BETWEEN '2025-01-01' AND '2025-06-30'
                    GROUP BY mois
                    ORDER BY mois ASC";
            $sth = $conn->prepare($sql);
            $sth->execute();
            return $sth->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            die("Erreur Onglet 2 : " . $e->getMessage());
        }
    }

    // Onglet 3 : Comparaison Stockage vs Réseau
    public function getComparaisonRessources()
    {
        try {
            $conn = Connexion::getConnexion();

            $sql = "SELECT c.mois, 
                           SUM(CASE WHEN r.nom = 'Stockage' THEN c.volume ELSE 0 END) AS vol_stockage,
                           SUM(CASE WHEN r.nom = 'Réseau' THEN c.volume ELSE 0 END) AS vol_reseau
                    FROM consommation c
                    JOIN ressource r ON c.res_id = r.res_id
                    WHERE r.nom IN ('Stockage', 'Réseau')
                    GROUP BY c.mois
                    ORDER BY c.mois ASC";
            $sth = $conn->prepare($sql);
            $sth->execute();
            return $sth->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            die("Erreur Onglet 3 : " . $e->getMessage());
        }
    }
}
?>