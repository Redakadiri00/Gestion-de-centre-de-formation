<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liste des Professeurs</title>
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
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
</head>
<body>
    <header>
        <h1>Emploie du temps</h1>
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
    <main>
        <?php
        // Replace these variables with your database credentials
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "centre-formation-rochd";

        // Create connection
        $conn = new mysqli($servername, $username, $password, $dbname);

        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        // SQL query to retrieve data from the professeur table
        $sql = "SELECT DISTINCT num_seance	,date_seance	,heure_seance	, code_niveau77	, num_salle1	, idgroupe14
         FROM seance
          JOIN groupe ON seance.idgroupe14=groupe.idgroupe
          JOIN payer ON seance.num_seance=payer.numseance69
         ";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            // Outputting table headers
            echo "<table>
                    <tr>
                        <th>Num seance</th>
                        <th>Date seance</th>
                        <th>Heure seance</th>
                        <th>Num salle</th>
                        <th>ID groupe</th>
                    </tr>";

            // Outputting data rows
            while ($row = $result->fetch_assoc()) {
                echo "<tr>
                        <td>" . $row["num_seance"] . "</td>
                        <td>" . $row["date_seance"] . "</td>
                        <td>" . $row["heure_seance"] . "</td>
                        <td>" . $row["num_salle1"] . "</td>
                        <td>" . $row["idgroupe14"] . "</td>

                      </tr>";
            }

            echo "</table>";
        } else {
            echo "0 results";
        }

        $conn->close();
        ?>
    </main>
</body>
</html>