<?php
include 'navbar.php';  
include 'C_Stat.php';  

$stat = new Stat("127.0.0.1", "root", "", "projet");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Récupérer l'ID saisi par l'utilisateur
    $id = $_POST['id'];

    // Vérifier si l'enseignant existe
    $teacher = $stat->fetchEnseignant($id);
    
    if (!$teacher) {
        echo "L'enseignant avec l'ID $id n'a pas été trouvé !";
        exit; // Si l'enseignant n'est pas trouvé, arrête l'exécution du script
    }

    // Si le formulaire est soumis en POST, supprimer l'enseignant
    if (isset($_POST['delete'])) {
        $result = $stat->supprimerEnseignant($id);
        if ($result) {
            echo "L'enseignant a été supprimé avec succès !";
            header("Location: listeEnseignants.php"); // Rediriger vers la liste des enseignants après la suppression
            exit;  // Arrêter l'exécution pour éviter de dupliquer l'affichage
        } else {
            echo "Erreur lors de la suppression de l'enseignant.";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Supprimer l'enseignant</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h1 class="text-center">Supprimer l'enseignant</h1>

        <!-- Formulaire pour saisir l'ID de l'enseignant -->
        <form method="POST">
            <div class="mb-3">
                <label for="id" class="form-label">Code Enseignant</label>
                <input type="number" class="form-control" name="id" required>
            </div>
            <button type="submit" class="btn btn-primary">Rechercher</button>
        </form>

        <?php if (isset($teacher)) { ?>
            <!-- Si l'enseignant existe, afficher ses informations et demander confirmation -->
            <form method="POST">
                <input type="hidden" name="id" value="<?= $teacher['CodeEnseignant'] ?>">

                <div class="mb-3">
                    <label for="nom" class="form-label">Nom</label>
                    <input type="text" class="form-control" name="nom" value="<?= $teacher['Nom'] ?>" disabled>
                </div>
                <div class="mb-3">
                    <label for="prenom" class="form-label">Prénom</label>
                    <input type="text" class="form-control" name="prenom" value="<?= $teacher['Prenom'] ?>" disabled>
                </div>

                <div class="alert alert-warning">
                    <strong>Attention!</strong> Vous êtes sur le point de supprimer cet enseignant. Cette action est irréversible.
                </div>

                <button type="submit" name="delete" class="btn btn-danger">Supprimer</button>
                <a href="listeEnseignants.php" class="btn btn-secondary">Annuler</a>
            </form>
        <?php } ?>
    </div>
</body>
</html>
