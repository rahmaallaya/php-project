<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container-fluid">
        <a class="navbar-brand" href="#">Gestion Scolaire</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="absencesDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">Gestion des absences</a>
                    <ul class="dropdown-menu" aria-labelledby="absencesDropdown">
                        <li><a class="dropdown-item" href="rapport1.php">Rechercher par étudiant</a></li>
                        <li><a class="dropdown-item" href="rapport2.php">Rechercher par matière</a></li>
                        <li><a class="dropdown-item" href="absences_jour.php">Voir les absences du jour</a></li>
                    </ul>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="etudiantsDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">Gestion des étudiants</a>
                    <ul class="dropdown-menu" aria-labelledby="etudiantsDropdown">
                        <li><a class="dropdown-item" href="ajoutEtudiant.php">Ajouter un étudiant</a></li>
                        <li><a class="dropdown-item" href="modifierEtudiant.php">Modifier un étudiant</a></li>
                        <li><a class="dropdown-item" href="supprimerEtudiant.php">Supprimer un étudiant</a></li>
                        <li><a class="dropdown-item" href="listeEtudiants.php">Lister tous les étudiants</a></li>
                    </ul>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="matieresDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">Gestion des matières</a>
                    <ul class="dropdown-menu" aria-labelledby="matieresDropdown">
                        <li><a class="dropdown-item" href="ajouterMatiere.php">Ajouter une matière</a></li>
                        <li><a class="dropdown-item" href="modifierMatiere.php">Modifier une matière</a></li>
                        <li><a class="dropdown-item" href="supprimerMatiere.php">Supprimer une matière</a></li>
                        <li><a class="dropdown-item" href="listeMatieres.php">Lister toutes les matières</a></li>
                    </ul>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="enseignantsDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">Gestion des enseignants</a>
                    <ul class="dropdown-menu" aria-labelledby="enseignantsDropdown">
                        <li><a class="dropdown-item" href="ajouterEnseignant.php">Ajouter un enseignant</a></li>
                        <li><a class="dropdown-item" href="modifierEnseignant.php">Modifier un enseignant</a></li>
                        <li><a class="dropdown-item" href="supprimerEnseignant.php">Supprimer un enseignant</a></li>
                        <li><a class="dropdown-item" href="listeEnseignants.php">Lister tous les enseignants</a></li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</nav>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
