<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "centre-formation-rochd";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


$select_query = $conn->query("
    SELECT a.*, e.prenom, e.nom , s.date_seance, s.idgroupe14
    FROM abscenter a
     JOIN etudiant e ON e.matricul = a.matricul44
   JOIN seance s ON a.num_seance44 = s.num_seance
");

$abscenter_rows = $select_query->fetch_all(MYSQLI_ASSOC);

$conn->close();
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Director Interface - View Absence</title>
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
            font-size: 16px;}

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
    </style>
</head>
<body>
<header>
        <h1>Liste des abscences</h1>
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

    <!-- Your body content here -->


    <?php if (isset($abscenter_rows) && !empty($abscenter_rows)): ?>

    <table border="1">
        <tr>
            <th>Matricule 44</th>
            <th>Numéro de Séance </th>
            <th>Prénom</th>
            <th>Nom</th>
            <th>Date de Séance</th>
            <th>Groupe ID</th>
        </tr>
        <?php foreach ($abscenter_rows as $row): ?>
            <tr>
                <td><?php echo $row['matricul44']; ?></td>
                <td><?php echo $row['num_seance44']; ?></td>
                <td><?php echo $row['prenom']; ?></td>
                <td><?php echo $row['nom']; ?></td>
                <td><?php echo $row['date_seance']; ?></td>
                <td><?php echo $row['idgroupe14']; ?></td>
            </tr>
        <?php endforeach; ?>
    </table>
    <?php endif; ?>
</body>
</html>
