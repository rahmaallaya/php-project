<?php
include 'db.php';
class C_Matiere {
    private $conn;

    public function __construct($db) {
        $this->conn = $db;
    }

    public function getMatiereByName($matiere) {
        $sql = "SELECT CodeMatiere FROM T_Matiere WHERE NomMatiere = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("s", $matiere);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_assoc();
    }
}
?>
