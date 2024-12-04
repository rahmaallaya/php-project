<?php

class Stat {
    private $conn;

    public function __construct($host, $username, $password, $dbname) {
        // Connexion à la base de données
        $this->conn = new mysqli($host, $username, $password, $dbname);
        if ($this->conn->connect_error) {
            die("Connexion échouée : " . $this->conn->connect_error);
        }
    }

    // Méthode pour lister les absences par étudiant
    public function List_absence_etudiant($nom, $prenom, $classe, $date_debut, $date_fin) {
        $sql = "
        SELECT 
            T_Etudiant.Nom AS Nom,
            T_Etudiant.Prenom AS Prenom,
            T_Classe.NomClasse AS NomClasse,
            T_FicheAbsence.DateJour AS DateJour
        FROM 
            T_FicheAbsence
        JOIN 
            T_LigneFicheAbsence ON T_FicheAbsence.CodeFicheAbsence = T_LigneFicheAbsence.CodeFicheAbsence
        JOIN 
            T_Etudiant ON T_LigneFicheAbsence.CodeEtudiant = T_Etudiant.CodeEtudiant
        JOIN 
            T_Classe ON T_Etudiant.CodeClasse = T_Classe.CodeClasse
        WHERE 
            T_Etudiant.Nom = ? 
            AND T_Etudiant.Prenom = ? 
            AND T_Classe.NomClasse = ? 
            AND T_FicheAbsence.DateJour BETWEEN ? AND ? 
        ";
    
        // Préparer et exécuter la requête
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("sssss", $nom, $prenom, $classe, $date_debut, $date_fin);
        $stmt->execute();
        $result = $stmt->get_result();
    
        return $result;
    }

    // Méthode pour lister les absences par matière
    public function List_absence_etudiant_parMatiere($nom, $prenom, $matiere, $date_debut, $date_fin) {
        $sql = "
        SELECT 
            T_FicheAbsence.DateJour AS DateAbsence,
            CONCAT(T_Enseignant.Nom, ' ', T_Enseignant.Prenom) AS Enseignant,
            T_Seance.NomSeance AS Seance
        FROM 
            T_FicheAbsence
        JOIN 
            T_FicheAbsenceSeance ON T_FicheAbsence.CodeFicheAbsence = T_FicheAbsenceSeance.CodeFicheAbsence
        JOIN 
            T_Seance ON T_FicheAbsenceSeance.CodeSeance = T_Seance.CodeSeance
        JOIN 
            T_Enseignant ON T_FicheAbsence.CodeEnseignant = T_Enseignant.CodeEnseignant
        JOIN 
            T_Matiere ON T_FicheAbsence.CodeMatiere = T_Matiere.CodeMatiere
        JOIN 
            T_LigneFicheAbsence ON T_FicheAbsence.CodeFicheAbsence = T_LigneFicheAbsence.CodeFicheAbsence
        JOIN
            T_Etudiant ON T_LigneFicheAbsence.CodeEtudiant = T_Etudiant.CodeEtudiant
        WHERE 
            T_Matiere.NomMatiere = ? 
            AND T_FicheAbsence.DateJour BETWEEN ? AND ? 
            AND T_Etudiant.Nom = ? 
            AND T_Etudiant.Prenom = ?
        ORDER BY 
            T_FicheAbsence.DateJour, T_Seance.NomSeance";

        // Préparer et exécuter la requête
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("sssss", $matiere, $date_debut, $date_fin, $nom, $prenom);
        $stmt->execute();
        $result = $stmt->get_result();

        // Retourner les résultats
        return $result;
    }

    // Méthode pour lister les absences du jour
    public function absencesDuJour($date) {
        $sql = "
        SELECT 
            T_Etudiant.Nom AS Nom,
            T_Etudiant.Prenom AS Prenom,
            T_Matiere.NomMatiere AS Matiere,
            T_FicheAbsence.DateJour AS DateJour
        FROM 
            T_FicheAbsence
        JOIN 
            T_LigneFicheAbsence ON T_FicheAbsence.CodeFicheAbsence = T_LigneFicheAbsence.CodeFicheAbsence
        JOIN 
            T_Etudiant ON T_LigneFicheAbsence.CodeEtudiant = T_Etudiant.CodeEtudiant
        JOIN 
            T_Matiere ON T_FicheAbsence.CodeMatiere = T_Matiere.CodeMatiere
        WHERE 
            T_FicheAbsence.DateJour = ?";  // Utilise la date fournie
    
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("s", $date);  // Lier le paramètre de date
        $stmt->execute();
        $result = $stmt->get_result();
    
        return $result;
    }

    // Méthode pour ajouter un étudiant
    public function ajouterEtudiant($nom, $prenom, $date_naissance, $code_classe, $num_inscription, $adresse, $mail, $tel) {
        $sql = "INSERT INTO t_etudiant (Nom, Prenom, DateNaissance, CodeClasse, NumInscription, Adresse, Mail, Tel) 
                VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("sssiisss", $nom, $prenom, $date_naissance, $code_classe, $num_inscription, $adresse, $mail, $tel);
        return $stmt->execute();
    }

    // Méthode pour ajouter un enseignant
    public function ajouterEnseignant($nom, $prenom, $date_recrutement, $adresse, $mail, $tel, $code_departement, $code_grade) {
        $sql = "INSERT INTO t_enseignant (Nom, Prenom, DateRecrutement, Adresse, Mail, Tel, CodeDepartement, CodeGrade) 
                VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("ssssssii", $nom, $prenom, $date_recrutement, $adresse, $mail, $tel, $code_departement, $code_grade);
        return $stmt->execute();  // Exécute la requête pour ajouter l'enseignant
    }
    

    // Méthode pour ajouter une matière
    public function ajouterMatiere($nom_matiere, $nbre_heures_cours, $nbre_heures_td, $nbre_heures_tp) {
        $sql = "INSERT INTO t_matiere (NomMatiere, NbreHeureCoursParSemaine, NbreHeureTDParSemaine, NbreHeureTPParSemaine) 
                VALUES (?, ?, ?, ?)";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("siii", $nom_matiere, $nbre_heures_cours, $nbre_heures_td, $nbre_heures_tp);
        return $stmt->execute();
    }

    // Méthode pour lister les enseignants
    public function listerEnseignants() {
        $sql = "
        SELECT 
            t_enseignant.CodeEnseignant, 
            t_enseignant.Nom, 
            t_enseignant.Prenom, 
            t_grade.NomGrade, 
            t_enseignant.Mail, 
            t_enseignant.Tel 
        FROM 
            t_enseignant
        JOIN 
            t_grade ON t_enseignant.CodeGrade = t_grade.CodeGrade";  // Join with t_grade to get grade name
        
        $stmt = $this->conn->prepare($sql);
        
        if ($stmt->execute()) {
            $result = $stmt->get_result();
        } else {
            echo "Error: " . $stmt->error;  // Show any SQL execution errors
            return null;
        }
        
        return $result;
    }

    // Méthode pour lister les matières
    public function listerMatieres() {
        $sql = "
        SELECT 
            t_matiere.CodeMatiere, 
            t_matiere.NomMatiere, 
            t_matiere.NbreHeureCoursParSemaine, 
            t_matiere.NbreHeureTDParSemaine, 
            t_matiere.NbreHeureTPParSemaine 
        FROM 
            t_matiere";
        
        $stmt = $this->conn->prepare($sql);
        
        if ($stmt->execute()) {
            $result = $stmt->get_result();
        } else {
            echo "Error: " . $stmt->error;  // Show any SQL execution errors
            return null;
        }
        
        return $result;
    }
    public function listerEtudiants() {
        $sql = "
        SELECT 
            t_etudiant.CodeEtudiant, 
            t_etudiant.Nom, 
            t_etudiant.Prenom, 
            t_etudiant.DateNaissance, 
            t_classe.NomClasse, 
            t_etudiant.NumInscription, 
            t_etudiant.Adresse, 
            t_etudiant.Mail, 
            t_etudiant.Tel 
        FROM 
            t_etudiant
        JOIN 
            t_classe ON t_etudiant.CodeClasse = t_classe.CodeClasse"; // Jointure avec t_classe pour obtenir le nom de la classe
    
        $stmt = $this->conn->prepare($sql);
    
        if ($stmt->execute()) {
            return $stmt->get_result();  // Retourne les résultats
        } else {
            echo "Error: " . $stmt->error;  // Affiche les erreurs d'exécution SQL
            return null;
        }
    }
    public function fetchEtudiant($id) {
        // SQL pour récupérer les informations d'un étudiant par son ID
        $sql = "SELECT * FROM t_etudiant WHERE CodeEtudiant = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("i", $id);  // Lier l'ID à la requête
        $stmt->execute();
        $result = $stmt->get_result();
        
        // Vérifier si l'étudiant a été trouvé
        if ($result->num_rows > 0) {
            return $result->fetch_assoc();  // Retourner les informations de l'étudiant
        } else {
            return null;  // Aucun étudiant trouvé
        }
    }
    public function modifierEtudiant($id, $nom, $prenom, $date_naissance, $classe, $num_inscription, $adresse, $mail, $tel) {
        $sql = "UPDATE t_etudiant SET 
                Nom = ?, 
                Prenom = ?, 
                DateNaissance = ?, 
                CodeClasse = ?, 
                NumInscription = ?, 
                Adresse = ?, 
                Mail = ?, 
                Tel = ? 
                WHERE CodeEtudiant = ?";
        
        // Préparation de la requête
        $stmt = $this->conn->prepare($sql);
    
        // Lier les paramètres à la requête préparée
        $stmt->bind_param("sssiisssi", $nom, $prenom, $date_naissance, $classe, $num_inscription, $adresse, $mail, $tel, $id);
    
        // Exécution de la requête
        if ($stmt->execute()) {
            return true;  // Mise à jour réussie
        } else {
            return false; // Échec de la mise à jour
        }
    }
    public function supprimerEnseignant($id) {
        $sql = "DELETE FROM t_enseignant WHERE CodeEnseignant = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("i", $id);  // Lier l'ID de l'enseignant à la requête
        return $stmt->execute();  // Exécuter la requête et retourner true/false
    }
    public function supprimerEtudiant($id) {
        $sql = "DELETE FROM t_etudiant WHERE CodeEtudiant = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("i", $id);  // Lier l'ID de l'étudiant à la requête
        return $stmt->execute();  // Exécuter la requête et retourner true/false
    }
    public function supprimerMatiere($id) {
        // Requête SQL pour supprimer une matière par son ID
        $sql = "DELETE FROM t_matiere WHERE CodeMatiere = ?";
        
        // Préparer la requête
        $stmt = $this->conn->prepare($sql);
        
        if ($stmt === false) {
            die("Erreur de préparation de la requête : " . $this->conn->error);
        }
    
        // Lier le paramètre à la requête
        $stmt->bind_param("i", $id);
    
        // Exécuter la requête
        return $stmt->execute();  // Retourne true si l'exécution est réussie
    }
    
    public function fetchMatiere($id) {
        $sql = "SELECT * FROM t_matiere WHERE CodeMatiere = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("i", $id);  // Liaison de l'ID à la requête
        $stmt->execute();
        $result = $stmt->get_result();
    
        // Vérifier si la matière existe
        if ($result->num_rows > 0) {
            return $result->fetch_assoc();  // Retourner la matière trouvée
        } else {
            return null;  // Aucun résultat trouvé
        }
    }
    public function modifierMatiere($id, $nom_matiere, $nbre_heures_cours, $nbre_heures_td, $nbre_heures_tp) {
        $sql = "UPDATE t_matiere SET 
                NomMatiere = ?, 
                NbreHeureCoursParSemaine = ?, 
                NbreHeureTDParSemaine = ?, 
                NbreHeureTPParSemaine = ? 
                WHERE CodeMatiere = ?";
    
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("siiii", $nom_matiere, $nbre_heures_cours, $nbre_heures_td, $nbre_heures_tp, $id);
        
        return $stmt->execute();  // Retourner true si la mise à jour est réussie
    }
        
                           

    public function fetchEnseignant($id) {
        $sql = "SELECT * FROM t_enseignant WHERE CodeEnseignant = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();
    
        if ($result->num_rows > 0) {
            return $result->fetch_assoc();  // Retourne l'enseignant trouvé
        } else {
            return null;  // Aucun enseignant trouvé
        }
    }
    
    public function modifierEnseignant($id, $nom, $prenom, $date_recrutement, $adresse, $mail, $tel, $code_departement, $code_grade) {
        $sql = "UPDATE t_enseignant SET 
                Nom = ?, 
                Prenom = ?, 
                DateRecrutement = ?, 
                Adresse = ?, 
                Mail = ?, 
                Tel = ?, 
                CodeDepartement = ?, 
                CodeGrade = ? 
                WHERE CodeEnseignant = ?";
    
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("ssssssiii", $nom, $prenom, $date_recrutement, $adresse, $mail, $tel, $code_departement, $code_grade, $id);
    
        return $stmt->execute();  // Retourner true si la mise à jour est réussie
    }
    



    // Fermer la connexion
    public function close() {
        $this->conn->close();
    }
}
?>
