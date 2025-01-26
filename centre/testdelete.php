<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>etudiants in a Group</title>
    <style>
        @import url("https://fonts.googleapis.com/css?family=Poppins:400,500,600");
        body {
            font-family: 'Rubik', sans-serif;
            color: #000;
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

        table {
            width: 100%;
            margin: auto;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th, td {
            border: 1px solid #ddd;
            padding: 12px;
            text-align: center;
        }

        th {
            background-color: #3ecf8e;
        }

        h2 {
            margin-top: 20px;
        }

        nav {
            background-color: #263238;
            color: #fff;
            padding: 10px;
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
            border-radius: 10px;
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

        .form-container {
            max-width: 600px;
            margin: auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
    </style>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
</head>
<body>
    <header>
        <h1>Groupes</h1>
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
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "centre-formation-rochd";

    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $sql_distinct_groups = "SELECT DISTINCT idgroupe57 FROM groupe_etudiant";
    $result_distinct_groups = $conn->query($sql_distinct_groups);

    if ($result_distinct_groups->num_rows > 0) {
        while ($row_group = $result_distinct_groups->fetch_assoc()) {
            $specified_groupeid = $row_group['idgroupe57'];

            $sql = "SELECT e.matricul, e.prenom, e.nom,
            p.idprofesseur, p.nom_prof, p.prenom_prof,
            n.niveau_scholair, n.college_ou_lycee, n.filliere,
            m.nom_module, m.nomformation99
            FROM etudiant e, groupe_etudiant ge, groupe g, module m, niveau n, professeur p
            WHERE e.matricul = ge.matricul57
            AND ge.idgroupe57 = g.idgroupe
            AND g.nom_module21 = m.nom_module
            AND g.code_niveau = n.code_niveau
            AND g.idprof = p.idprofesseur
            AND g.idgroupe = '$specified_groupeid'";

            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                echo "<h2> Etudiants in Group ID: $specified_groupeid</h2>";
                echo "<table border='1'><tr>";


                echo "<th>Matricule</th>";
                echo "<th>Prenom</th>";
                echo "<th>Nom</th>";
                echo "<th>ID Prof</th>";
                echo "<th>Nom Prof</th>";
                echo "<th>Prenom prof</th>";
                echo "<th>Niveau scolaire</th>";
                echo "<th>College ou Lycee</th>";
                echo "<th>Fillire</th>";
                echo "<th>Nom module</th>";
                echo "<th>Nom formation</th>";

                $firstRow = true;

                while ($row = $result->fetch_assoc()) {
                    echo "<tr>";

                    echo "<td>" . $row['matricul'] . "</td>";
                    echo "<td>" . $row['prenom'] . "</td>";
                    echo "<td>" . $row['nom'] . "</td>";

                    if ($firstRow) {
                        $firstRow = false;
                        echo "<td rowspan='" . $result->num_rows . "'>" . $row['idprofesseur'] . "</td>";
                        echo "<td rowspan='" . $result->num_rows . "'>" . $row['nom_prof'] . "</td>";
                        echo "<td rowspan='" . $result->num_rows . "'>" . $row['prenom_prof'] . "</td>";
                        echo "<td rowspan='" . $result->num_rows . "'>" . $row['niveau_scholair'] . "</td>";
                        echo "<td rowspan='" . $result->num_rows . "'>" . $row['college_ou_lycee'] . "</td>";
                        echo "<td rowspan='" . $result->num_rows . "'>" . $row['filliere'] . "</td>";
                        echo "<td rowspan='" . $result->num_rows . "'>" . $row['nom_module'] . "</td>";
                        echo "<td rowspan='" . $result->num_rows . "'>" . $row['nomformation99'] . "</td>";
                    }

                    echo "</tr>";
                }

                echo "</table>";
            } else {
                echo "No etudiants found in Group ID: $specified_groupeid";
            }
        }
    } else {
        echo "Il n'y aucun groupe actif pour le moment";
    }

    $conn->close();
    ?>
    <div style="text-align: right; padding: 20px;">
        <a href="Voir_groupe_reserve.php">
            <button style="background-color: #ccc; color: #fff; padding: 8px 16px; border: none; font-size: 14px; cursor: pointer;">
                Voir les groupes réservés
            </button>
        </a>
    </div>
</body>
</html>
