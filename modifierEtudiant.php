<?php
include 'navbar.php';  
include 'C_Stat.php'; 

// Création d'une instance de la classe Stat
$stat = new Stat("127.0.0.1", "root", "", "projet"); 

// Vérifier si le CodeEtudiant est passé en GET
if (isset($_GET['id'])) {
    $id = $_GET['id'];  // Récupérer l'ID de l'étudiant

    // Récupérer les informations de l'étudiant par son CodeEtudiant
    $student = $stat->fetchEtudiant($id);
    
    if (!$student) {
        echo "L'étudiant n'a pas été trouvé !";
        exit; // Si l'étudiant n'est pas trouvé, arrête l'exécution du script
    }
}

// Si le formulaire est soumis en POST, mettre à jour l'étudiant
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $stat->modifierEtudiant($_POST['id'], $_POST['nom'], $_POST['prenom'], $_POST['date_naissance'], $_POST['classe'], $_POST['num_inscription'], $_POST['adresse'], $_POST['mail'], $_POST['tel']);
    header("Location: listeEtudiants.php"); // Rediriger vers la liste des étudiants après la modification
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifier l'étudiant</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h1 class="text-center">Modifier l'étudiant</h1>

        <!-- Formulaire pour rechercher un étudiant -->
        <form action="" method="GET">
            <div class="mb-3">
                <label for="id" class="form-label">Code Etudiant</label>
                <input type="number" class="form-control" name="id" required>
            </div>
            <button type="submit" class="btn btn-primary">Rechercher</button>
        </form>

        <?php if (isset($student)) { ?>
            <!-- Formulaire de modification de l'étudiant -->
            <form method="POST" class="mt-5">
                <input type="hidden" name="id" value="<?= $student['CodeEtudiant'] ?>">

                <div class="mb-3">
                    <label for="nom" class="form-label">Nom</label>
                    <input type="text" class="form-control" name="nom" value="<?= $student['Nom'] ?>" required>
                </div>
                <div class="mb-3">
                    <label for="prenom" class="form-label">Prénom</label>
                    <input type="text" class="form-control" name="prenom" value="<?= $student['Prenom'] ?>" required>
                </div>
                <div class="mb-3">
                    <label for="date_naissance" class="form-label">Date de naissance</label>
                    <input type="date" class="form-control" name="date_naissance" value="<?= $student['DateNaissance'] ?>" required>
                </div>
                <div class="mb-3">
                    <label for="classe" class="form-label">Classe</label>
                    <input type="number" class="form-control" name="classe" value="<?= $student['CodeClasse'] ?>" required>
                </div>
                <div class="mb-3">
                    <label for="num_inscription" class="form-label">Numéro d'inscription</label>
                    <input type="number" class="form-control" name="num_inscription" value="<?= $student['NumInscription'] ?>" required>
                </div>
                <div class="mb-3">
                    <label for="adresse" class="form-label">Adresse</label>
                    <input type="text" class="form-control" name="adresse" value="<?= $student['Adresse'] ?>" required>
                </div>
                <div class="mb-3">
                    <label for="mail" class="form-label">Email</label>
                    <input type="email" class="form-control" name="mail" value="<?= $student['Mail'] ?>" required>
                </div>
                <div class="mb-3">
                    <label for="tel" class="form-label">Téléphone</label>
                    <input type="tel" class="form-control" name="tel" value="<?= $student['Tel'] ?>" required>
                </div>
                <button type="submit" class="btn btn-primary">Modifier</button>
            </form>
        <?php } ?>
    </div>
</body>
</html>
