<?php include 'navbar.php'; ?>
<?php
include 'C_Stat.php';

$stat = new Stat("127.0.0.1", "root", "", "projet");
$result = $stat->listerEtudiants();  // Fetch the list of students

?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liste des étudiants</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h1 class="text-center">Liste des étudiants</h1>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Code</th>
                    <th>Nom</th>
                    <th>Prénom</th>
                    <th>Classe</th>
                    <th>Email</th>
                    <th>Téléphone</th>
                </tr>
            </thead>
            <tbody>
                <?php
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>
                            <td>" . htmlspecialchars($row['CodeEtudiant']) . "</td>
                            <td>" . htmlspecialchars($row['Nom']) . "</td>
                            <td>" . htmlspecialchars($row['Prenom']) . "</td>
                            <td>" . htmlspecialchars($row['NomClasse']) . "</td>
                            <td>" . htmlspecialchars($row['Mail']) . "</td>
                            <td>" . htmlspecialchars($row['Tel']) . "</td>
                        </tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
</body>
</html>
