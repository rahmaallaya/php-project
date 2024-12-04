<?php include 'navbar.php'; ?>

<?php
include 'C_Stat.php';

$date = $_POST['date'] ?? date('Y-m-d');  // Default to today if no date is provided

$stat = new Stat("127.0.0.1", "root", "", "projet");
$result = $stat->absencesDuJour($date);  // Call the method with the date parameter
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Absences du jour</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h1 class="text-center">Absences du jour</h1>

        <!-- Date selection form -->
        <form method="POST">
            <div class="mb-3">
                <label for="date" class="form-label">Sélectionner une date :</label>
                <input type="date" id="date" name="date" class="form-control" value="<?= $date ?>" required>
            </div>
            <button type="submit" class="btn btn-primary">Rechercher</button>
        </form>

        <?php
        if ($result->num_rows > 0) {
            echo "<table class='table table-striped'>
                    <thead>
                        <tr>
                            <th>Nom</th>
                            <th>Prénom</th>
                            <th>Matière</th>
                            <th>Date d'absence</th>
                        </tr>
                    </thead>
                    <tbody>";
            while ($row = $result->fetch_assoc()) {
                echo "<tr>
                        <td>" . htmlspecialchars($row['Nom']) . "</td>
                        <td>" . htmlspecialchars($row['Prenom']) . "</td>
                        <td>" . htmlspecialchars($row['Matiere']) . "</td>
                        <td>" . htmlspecialchars($row['DateJour']) . "</td>
                    </tr>";
            }
            echo "</tbody></table>";
        } else {
            echo "<div class='alert alert-warning'>Aucune absence enregistrée pour cette date.</div>";
        }
        ?>
    </div>
</body>
</html>
