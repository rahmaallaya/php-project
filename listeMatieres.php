<?php include 'navbar.php'; ?>
<?php
include 'C_Stat.php';

$stat = new Stat("127.0.0.1", "root", "", "projet");
$result = $stat->listerMatieres();  // Fetch the list of subjects
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liste des matières</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h1 class="text-center">Liste des matières</h1>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Code</th>
                    <th>Nom</th>
                    <th>Heures de cours</th>
                    <th>Heures de TD</th>
                    <th>Heures de TP</th>
                </tr>
            </thead>
            <tbody>
                <?php
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>
                            <td>" . htmlspecialchars($row['CodeMatiere']) . "</td>
                            <td>" . htmlspecialchars($row['NomMatiere']) . "</td>
                            <td>" . htmlspecialchars($row['NbreHeureCoursParSemaine']) . "</td>
                            <td>" . htmlspecialchars($row['NbreHeureTDParSemaine']) . "</td>
                            <td>" . htmlspecialchars($row['NbreHeureTPParSemaine']) . "</td>
                        </tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
</body>
</html>
