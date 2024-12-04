<?php
include 'navbar.php'; 
include 'C_Stat.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $stat = new Stat("127.0.0.1", "root", "", "projet");
    $stat->ajouterEnseignant($_POST['nom'], $_POST['prenom'], $_POST['date_recrutement'], $_POST['adresse'], $_POST['mail'], $_POST['tel'], $_POST['code_departement'], $_POST['code_grade']);
    header("Location: listeEnseignants.php"); // Redirect after successful insertion
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajouter un enseignant</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h1 class="text-center">Ajouter un enseignant</h1>
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
                <label for="date_recrutement" class="form-label">Date de recrutement</label>
                <input type="date" class="form-control" name="date_recrutement" required>
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
            <div class="mb-3">
                <label for="code_departement" class="form-label">Code Département</label>
                <input type="number" class="form-control" name="code_departement" required>
            </div>
            <div class="mb-3">
                <label for="code_grade" class="form-label">Code Grade</label>
                <input type="number" class="form-control" name="code_grade" required>
            </div>
            <button type="submit" class="btn btn-primary">Ajouter</button>
        </form>
    </div>
</body>
</html>
