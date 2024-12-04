<?php
class C_Etudiant {
    private $conn;

    public function __construct($db) {
        $this->conn = $db;
    }

    public function getEtudiantByName($nom, $prenom) {
        $sql = "SELECT CodeEtudiant FROM T_Etudiant WHERE Nom = ? AND Prenom = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("ss", $nom, $prenom);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_assoc();
    }
}
?>
