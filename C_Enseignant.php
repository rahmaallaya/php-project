<?php
class C_Enseignant {
    private $conn;

    public function __construct($db) {
        $this->conn = $db;
    }

    public function getEnseignantByName($enseignant) {
        $sql = "SELECT CodeEnseignant FROM T_Enseignant WHERE CONCAT(Nom, ' ', Prenom) = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("s", $enseignant);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_assoc();
    }
}
?>
