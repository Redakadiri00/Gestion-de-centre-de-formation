<?php

$Code = $_POST['Code'];

try {
    $connexion = new PDO("mysql:host=localhost;dbname=centre-formation-rochd", "root", "");
    $connexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $sql = "SELECT etudiant.matricul,etudiant.prenom, etudiant.nom, etudiant.tele_etudiant, etudiant.email, etudiant.tele_parent
        FROM etudiant
        WHERE etudiant.matricul LIKE :code OR etudiant.matricul LIKE :code";

        $stmt = $connexion->prepare($sql);
        $stmt->bindValue(':code', '%' . $Code . '%', PDO::PARAM_STR);

        $stmt->execute();

    $resultat = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    header("Location: ajouter.php?error=Problème de connexion avec la base de données");
    exit(); // Arrêter l'exécution du script en cas d'erreur de connexion
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Résultats de la recherche</title>
    <style>
@import url("https://fonts.googleapis.com/css?family=Poppins:400,500,600");
body {
      font-family: 'Rubik', sans-serif;
      color: #333;
      background: #fff;
      margin: 0;
      padding: 0;
    }

header {
            background: linear-gradient(95deg,#5533ff 40%,#25ddf5 100%)!important;
            color: #fff;
            padding: 20px;
            text-align: center;
            font-size: 24px;
        }

        nav {
            background: linear-gradient(95deg,#5533ff 40%,#25ddf5 100%)!important;;
            color: #fff;
            padding: 20px;
            text-align: center;
        }

        nav ul {
            list-style: none;
            padding: 0;
            margin: 0;
            display: flex;
            justify-content: center;
        }

        nav li {
            margin: 0 15px;
        }

        nav a {
            text-decoration: none;
            color: #fff;
            font-weight: bold;
            font-size: 16px;
        }

        main {
            padding: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th, td {
            border: 1px solid #ddd;
            padding: 12px;
            text-align: left;
        }

        th {
            background-color: #3ecf8e;
            color: #fff;
        }
        .action-buttons {
            display: flex;
            justify-content: space-between;
        }

        .action-buttons button {
            padding: 8px;
            margin: 5px;
            border: none;
            color: #fff;
            cursor: pointer;
            font-weight: bold;
            border-radius: 5px;
        }

        .edit-button {
            background-color: #4CAF50; /* Green */
        }

        .delete-button {
            background-color: #f44336; /* Red */
        }
    </style>
</head>
<body>
<header>
        <h1>Affichage</h1>
    </header>
    <nav>
      <ul>
      <li><a href="http://localhost/centre/ajouter.php#">Ajouter un étudiant</a></li>
          <li><a href="http://localhost/centre/search.php#">Chercher un étudiant</a></li>
          <li><a href="http://localhost/centre/addabscent.php#">Ajouter abscence</a></li>
          <li><a href="http://localhost/centre/abscent.php">Voir les abscences</a></li>
          <li><a href="http://localhost/centre/emploie.php">Voir emploies</a></li>
          <li><a href="http://localhost/centre/testdelete.php#">Voir les groupes</a></li>
          <li><a href="http://localhost/centre/voiretud.php">Voir les etudiants</a></li>
          <li><a href="http://localhost/centre/voirProfs.php">Voir les profs</a></li>
          <li><a href="http://localhost/centre/main.php">Revenir à l'acceuil</a></li>
      </ul>
    </nav>
    <?php
    if (!empty($resultat)) {
        echo "<table>";
        echo "<tr><th>Matricul</th><th>Prenom</th><th>Nom</th><th>Tele etudiant</th><th>Email</th><th>Tele parent</th></tr>";
        foreach ($resultat as $ligne) {
            echo "<tr>";
            echo "<td>" . $ligne["matricul"] . "</td>";
            echo "<td>" . $ligne["prenom"] . "</td>";
            echo "<td>" . $ligne["nom"] . "</td>";
            echo "<td>" . $ligne["tele_etudiant"] . "</td>";
            echo "<td>" . $ligne["email"] . "</td>";
            echo "<td>" . $ligne["tele_parent"] . "</td>";
            echo "</tr>";
        }
        echo "</table>";
    } else {
        echo "Aucun résultat trouvé.";
    }
    ?>
</body>
</html>
