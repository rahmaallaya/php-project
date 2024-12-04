<?php include 'navbar.php'; ?>

<?php
include 'C_Stat.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get form data using isset() to avoid undefined index warnings
    $nom = isset($_POST['nom']) ? $_POST['nom'] : '';
    $prenom = isset($_POST['prenom']) ? $_POST['prenom'] : '';
    $classe = isset($_POST['classe']) ? $_POST['classe'] : '';
    $date_debut = isset($_POST['date_debut']) ? $_POST['date_debut'] : '';
    $date_fin = isset($_POST['date_fin']) ? $_POST['date_fin'] : '';

    $stat = new Stat("127.0.0.1", "root", "", "projet");
    $result = $stat->List_absence_etudiant($nom, $prenom, $classe, $date_debut, $date_fin);
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rechercher les absences par étudiant</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h1 class="text-center">Rechercher les absences par étudiant</h1>
        <form method="POST">
            <div class="mb-3">
                <label for="nom" class="form-label">Nom :</label>
                <input type="text" id="nom" name="nom" class="form-control" required>
            </div>

            <div class="mb-3">
                <label for="prenom" class="form-label">Prénom :</label>
                <input type="text" id="prenom" name="prenom" class="form-control" required>
            </div>

            <div class="mb-3">
                <label for="classe" class="form-label">Classe :</label>
                <input type="text" id="classe" name="classe" class="form-control" required>
            </div>

            <div class="mb-3">
                <label for="date_debut" class="form-label">Date début :</label>
                <input type="date" id="date_debut" name="date_debut" class="form-control" required>
            </div>

            <div class="mb-3">
                <label for="date_fin" class="form-label">Date fin :</label>
                <input type="date" id="date_fin" name="date_fin" class="form-control" required>
            </div>

            <button type="submit" class="btn btn-primary">Rechercher</button>
        </form>

        <?php
        if (isset($result)) {
            if ($result->num_rows > 0) {
                echo "<h2>Résultats</h2><table class='table table-striped'><thead><tr><th>Nom</th><th>Prénom</th><th>Classe</th><th>Date d'absence</th></tr></thead><tbody>";
                while ($row = $result->fetch_assoc()) {
                    // Displaying the data from the query result
                    echo "<tr><td>" . htmlspecialchars($row['Nom']) . "</td><td>" . htmlspecialchars($row['Prenom']) . "</td><td>" . htmlspecialchars($row['NomClasse']) . "</td><td>" . htmlspecialchars($row['DateJour']) . "</td></tr>";
                }
                echo "</tbody></table>";
            } else {
                echo "<div class='alert alert-warning'>Aucune absence trouvée pour cet étudiant dans la période spécifiée.</div>";
            }
        }
        ?>
    </div>
</body>
</html>
