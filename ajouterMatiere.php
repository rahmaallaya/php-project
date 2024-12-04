<?php
include 'navbar.php';  // Inclure la barre de navigation
include 'C_Stat.php';  // Inclure la classe Stat qui gère les opérations sur la base de données

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Récupérer les données du formulaire
    $nom_matiere = $_POST['nom_matiere'];
    $nbre_heures_cours = $_POST['nbre_heures_cours'];
    $nbre_heures_td = $_POST['nbre_heures_td'];
    $nbre_heures_tp = $_POST['nbre_heures_tp'];

    // Création d'une instance de la classe Stat pour connecter à la base de données
    $stat = new Stat("127.0.0.1", "root", "", "projet"); 

    // Ajouter la matière dans la base de données
    if ($stat->ajouterMatiere($nom_matiere, $nbre_heures_cours, $nbre_heures_td, $nbre_heures_tp)) {
        // Rediriger vers la page listeMatieres.php si l'ajout est réussi
        header("Location: listeMatieres.php");

        exit();
    } else {
        // Afficher un message d'erreur si l'insertion échoue
        echo "Erreur lors de l'ajout de la matière.";
    }

    // Fermer la connexion à la base de données
    $stat->close();
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajouter une matière</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h1 class="text-center">Ajouter une matière</h1>
        <form method="POST">
            <div class="mb-3">
                <label for="nom_matiere" class="form-label">Nom de la matière</label>
                <input type="text" class="form-control" name="nom_matiere" required>
            </div>
            <div class="mb-3">
                <label for="nbre_heures_cours" class="form-label">Nombre d'heures de cours</label>
                <input type="number" class="form-control" name="nbre_heures_cours" required>
            </div>
            <div class="mb-3">
                <label for="nbre_heures_td" class="form-label">Nombre d'heures de TD</label>
                <input type="number" class="form-control" name="nbre_heures_td" required>
            </div>
            <div class="mb-3">
                <label for="nbre_heures_tp" class="form-label">Nombre d'heures de TP</label>
                <input type="number" class="form-control" name="nbre_heures_tp" required>
            </div>
            <button type="submit" class="btn btn-primary">Ajouter</button>
        </form>
    </div>
</body>
</html>
