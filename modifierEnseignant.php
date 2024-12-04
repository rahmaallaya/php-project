<?php
include 'navbar.php';  // Inclure la barre de navigation
include 'C_Stat.php';  // Inclure la classe Stat

// Création d'une instance de la classe Stat
$stat = new Stat("127.0.0.1", "root", "", "projet"); 

// Vérifier si l'ID de l'enseignant est passé en GET
if (isset($_GET['id'])) {
    $id = $_GET['id'];  // Récupérer l'ID de l'enseignant

    // Récupérer les informations de l'enseignant par son ID
    $teacher = $stat->fetchEnseignant($id);
    
    // Si l'enseignant n'existe pas, afficher un message
    if (!$teacher) {
        echo "L'enseignant n'a pas été trouvé !";
        exit; // Arrêter l'exécution si l'enseignant n'est pas trouvé
    }
}

// Si le formulaire est soumis en POST, mettre à jour l'enseignant
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $stat->modifierEnseignant($_POST['id'], $_POST['nom'], $_POST['prenom'], $_POST['date_recrutement'], $_POST['adresse'], $_POST['mail'], $_POST['tel'], $_POST['code_departement'], $_POST['code_grade']);
    header("Location: listeEnseignants.php"); // Rediriger vers la liste des enseignants après la modification
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifier l'enseignant</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h1 class="text-center">Modifier l'enseignant</h1>

        <!-- Formulaire pour rechercher un enseignant -->
        <form action="" method="GET">
            <div class="mb-3">
                <label for="id" class="form-label">Code Enseignant</label>
                <input type="number" class="form-control" name="id" required>
            </div>
            <button type="submit" class="btn btn-primary">Rechercher</button>
        </form>

        <?php if (isset($teacher)) { ?>
            <!-- Formulaire de modification de l'enseignant -->
            <form method="POST" class="mt-5">
                <input type="hidden" name="id" value="<?= $teacher['CodeEnseignant'] ?>">

                <div class="mb-3">
                    <label for="nom" class="form-label">Nom</label>
                    <input type="text" class="form-control" name="nom" value="<?= $teacher['Nom'] ?>" required>
                </div>
                <div class="mb-3">
                    <label for="prenom" class="form-label">Prénom</label>
                    <input type="text" class="form-control" name="prenom" value="<?= $teacher['Prenom'] ?>" required>
                </div>
                <div class="mb-3">
                    <label for="date_recrutement" class="form-label">Date de recrutement</label>
                    <input type="date" class="form-control" name="date_recrutement" value="<?= $teacher['DateRecrutement'] ?>" required>
                </div>
                <div class="mb-3">
                    <label for="adresse" class="form-label">Adresse</label>
                    <input type="text" class="form-control" name="adresse" value="<?= $teacher['Adresse'] ?>" required>
                </div>
                <div class="mb-3">
                    <label for="mail" class="form-label">Email</label>
                    <input type="email" class="form-control" name="mail" value="<?= $teacher['Mail'] ?>" required>
                </div>
                <div class="mb-3">
                    <label for="tel" class="form-label">Téléphone</label>
                    <input type="tel" class="form-control" name="tel" value="<?= $teacher['Tel'] ?>" required>
                </div>
                <div class="mb-3">
                    <label for="code_departement" class="form-label">Code Département</label>
                    <input type="number" class="form-control" name="code_departement" value="<?= $teacher['CodeDepartement'] ?>" required>
                </div>
                <div class="mb-3">
                    <label for="code_grade" class="form-label">Code Grade</label>
                    <input type="number" class="form-control" name="code_grade" value="<?= $teacher['CodeGrade'] ?>" required>
                </div>
                <button type="submit" class="btn btn-primary">Modifier</button>
            </form>
        <?php } ?>
    </div>
</body>
</html>
