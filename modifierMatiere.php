<?php
include 'navbar.php';  // Inclure la barre de navigation
include 'C_Stat.php';  // Inclure la classe Stat

// Création d'une instance de la classe Stat
$stat = new Stat("127.0.0.1", "root", "", "projet");

// Vérifier si l'ID de la matière est passé en GET
if (isset($_GET['id'])) {
    $id = $_GET['id'];  // Récupérer l'ID de la matière

    // Récupérer les informations de la matière par son ID
    $matiere = $stat->fetchMatiere($id);

    if (!$matiere) {
        echo "La matière n'a pas été trouvée !";
        exit;  // Si la matière n'est pas trouvée, arrête l'exécution
    }
}

// Si le formulaire est soumis en POST, mettre à jour la matière
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $stat->modifierMatiere($_POST['id'], $_POST['nom_matiere'], $_POST['nbre_heures_cours'], $_POST['nbre_heures_td'], $_POST['nbre_heures_tp']);
    header("Location: listeMatieres.php"); // Rediriger vers la liste des matières après la modification
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifier la matière</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h1 class="text-center">Modifier la matière</h1>

        <!-- Formulaire pour rechercher une matière -->
        <form action="" method="GET">
            <div class="mb-3">
                <label for="id" class="form-label">Code Matière</label>
                <input type="number" class="form-control" name="id" required>
            </div>
            <button type="submit" class="btn btn-primary">Rechercher</button>
        </form>

        <?php if (isset($matiere)) { ?>
            <!-- Formulaire de modification de la matière -->
            <form method="POST" class="mt-5">
                <input type="hidden" name="id" value="<?= $matiere['CodeMatiere'] ?>">

                <div class="mb-3">
                    <label for="nom_matiere" class="form-label">Nom de la matière</label>
                    <input type="text" class="form-control" name="nom_matiere" value="<?= $matiere['NomMatiere'] ?>" required>
                </div>
                <div class="mb-3">
                    <label for="nbre_heures_cours" class="form-label">Nombre d'heures de cours</label>
                    <input type="number" class="form-control" name="nbre_heures_cours" value="<?= $matiere['NbreHeureCoursParSemaine'] ?>" required>
                </div>
                <div class="mb-3">
                    <label for="nbre_heures_td" class="form-label">Nombre d'heures de TD</label>
                    <input type="number" class="form-control" name="nbre_heures_td" value="<?= $matiere['NbreHeureTDParSemaine'] ?>" required>
                </div>
                <div class="mb-3">
                    <label for="nbre_heures_tp" class="form-label">Nombre d'heures de TP</label>
                    <input type="number" class="form-control" name="nbre_heures_tp" value="<?= $matiere['NbreHeureTPParSemaine'] ?>" required>
                </div>
                <button type="submit" class="btn btn-primary">Modifier</button>
            </form>
        <?php } ?>
    </div>
</body>
</html>
