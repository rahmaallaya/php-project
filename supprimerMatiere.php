<?php
include 'navbar.php';  // Inclure la barre de navigation
include 'C_Stat.php';  // Inclure la classe Stat qui gère les opérations sur la base de données

// Création d'une instance de la classe Stat
$stat = new Stat("127.0.0.1", "root", "", "projet");

// Vérifier si l'ID de la matière est passé en POST (saisi par l'utilisateur)
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Récupérer l'ID saisi par l'utilisateur
    $id = $_POST['id'];

    // Vérifier si la matière existe
    $matiere = $stat->fetchMatiere($id);
    
    if (!$matiere) {
        echo "La matière avec l'ID $id n'a pas été trouvée !";
        exit; // Si la matière n'est pas trouvée, arrête l'exécution du script
    }

    // Si le formulaire est soumis en POST, supprimer la matière
    if (isset($_POST['delete'])) {
        $result = $stat->supprimerMatiere($id);
        if ($result) {
            echo "La matière a été supprimée avec succès !";
            header("Location: listeMatieres.php"); // Rediriger vers la liste des matières après la suppression
            exit;  // Arrêter l'exécution pour éviter de dupliquer l'affichage
        } else {
            echo "Erreur lors de la suppression de la matière.";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Supprimer la matière</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h1 class="text-center">Supprimer la matière</h1>

        <!-- Formulaire pour saisir l'ID de la matière -->
        <form method="POST">
            <div class="mb-3">
                <label for="id" class="form-label">Code Matière</label>
                <input type="number" class="form-control" name="id" required>
            </div>
            <button type="submit" class="btn btn-primary">Rechercher</button>
        </form>

        <?php if (isset($matiere)) { ?>
            <!-- Si la matière existe, afficher ses informations et demander confirmation -->
            <form method="POST">
                <input type="hidden" name="id" value="<?= $matiere['CodeMatiere'] ?>">

                <div class="mb-3">
                    <label for="nom" class="form-label">Nom de la matière</label>
                    <input type="text" class="form-control" name="nom" value="<?= $matiere['NomMatiere'] ?>" disabled>
                </div>

                <div class="alert alert-warning">
                    <strong>Attention!</strong> Vous êtes sur le point de supprimer cette matière. Cette action est irréversible.
                </div>

                <button type="submit" name="delete" class="btn btn-danger">Supprimer</button>
                <a href="listeMatieres.php" class="btn btn-secondary">Annuler</a>
            </form>
        <?php } ?>
    </div>
</body>
</html>
