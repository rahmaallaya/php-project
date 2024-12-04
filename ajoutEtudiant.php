<?php
include 'navbar.php'; 
include 'C_Stat.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $stat = new Stat("127.0.0.1", "root", "", "projet");
    $stat->ajouterEtudiant($_POST['nom'], $_POST['prenom'], $_POST['date_naissance'], $_POST['classe'], $_POST['num_inscription'], $_POST['adresse'], $_POST['mail'], $_POST['tel']);
    header("Location: listeEtudiants.php"); // Redirect after successful insertion
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajouter un étudiant</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h1 class="text-center">Ajouter un étudiant</h1>
        <form method="POST">
            <div class="mb-3">
                <label for="nom" class="form-label">Nom</label>
                <input type="text" class="form-control" name="nom" required>
            </div>
            <div class="mb-3">
                <label for="prenom" class="form-label">Prénom</label>
                <input type="text" class="form-control" name="prenom" required>
            </div>
            <div class="mb-3">
                <label for="date_naissance" class="form-label">Date de naissance</label>
                <input type="date" class="form-control" name="date_naissance" required>
            </div>
            <div class="mb-3">
                <label for="classe" class="form-label">Classe</label>
                <input type="number" class="form-control" name="classe" required>
            </div>
            <div class="mb-3">
                <label for="num_inscription" class="form-label">Numéro d'inscription</label>
                <input type="number" class="form-control" name="num_inscription" required>
            </div>
            <div class="mb-3">
                <label for="adresse" class="form-label">Adresse</label>
                <input type="text" class="form-control" name="adresse" required>
            </div>
            <div class="mb-3">
                <label for="mail" class="form-label">Email</label>
                <input type="email" class="form-control" name="mail" required>
            </div>
            <div class="mb-3">
                <label for="tel" class="form-label">Téléphone</label>
                <input type="tel" class="form-control" name="tel" required>
            </div>
            <button type="submit" class="btn btn-primary">Ajouter</button>
        </form>
    </div>
</body>
</html>
