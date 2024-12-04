<?php
include 'navbar.php';  // Inclure la barre de navigation
include 'C_Stat.php';  // Inclure la classe Stat qui gère les opérations sur la base de données

// Création d'une instance de la classe Stat
$stat = new Stat("127.0.0.1", "root", "", "projet");

// Vérifier si l'ID de l'étudiant est passé en POST (saisi par l'utilisateur)
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Récupérer l'ID saisi par l'utilisateur
    $id = $_POST['id'];

    // Vérifier si l'étudiant existe
    $student = $stat->fetchEtudiant($id);
    
    if (!$student) {
        echo "L'étudiant avec l'ID $id n'a pas été trouvé !";
        exit; // Si l'étudiant n'est pas trouvé, arrête l'exécution du script
    }

    // Si le formulaire est soumis en POST, supprimer l'étudiant
    if (isset($_POST['delete'])) {
        $result = $stat->supprimerEtudiant($id);
        if ($result) {
            echo "L'étudiant a été supprimé avec succès !";
            header("Location: listeEtudiants.php"); // Rediriger vers la liste des étudiants après la suppression
            exit;  // Arrêter l'exécution pour éviter de dupliquer l'affichage
        } else {
            echo "Erreur lors de la suppression de l'étudiant.";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Supprimer l'étudiant</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h1 class="text-center">Supprimer l'étudiant</h1>

        <!-- Formulaire pour saisir l'ID de l'étudiant -->
        <form method="POST">
            <div class="mb-3">
                <label for="id" class="form-label">Code Etudiant</label>
                <input type="number" class="form-control" name="id" required>
            </div>
            <button type="submit" class="btn btn-primary">Rechercher</button>
        </form>

        <?php if (isset($student)) { ?>
            <!-- Si l'étudiant existe, afficher ses informations et demander confirmation -->
            <form method="POST">
                <input type="hidden" name="id" value="<?= $student['CodeEtudiant'] ?>">

                <div class="mb-3">
                    <label for="nom" class="form-label">Nom</label>
                    <input type="text" class="form-control" name="nom" value="<?= $student['Nom'] ?>" disabled>
                </div>
                <div class="mb-3">
                    <label for="prenom" class="form-label">Prénom</label>
                    <input type="text" class="form-control" name="prenom" value="<?= $student['Prenom'] ?>" disabled>
                </div>

                <div class="alert alert-warning">
                    <strong>Attention!</strong> Vous êtes sur le point de supprimer cet étudiant. Cette action est irréversible.
                </div>

                <button type="submit" name="delete" class="btn btn-danger">Supprimer</button>
                <a href="listeEtudiants.php" class="btn btn-secondary">Annuler</a>
            </form>
        <?php } ?>
    </div>
</body>
</html>
