<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liste des Etudiants</title>
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
            color: #fff;
        }
        .update-btn {
    background-color: #3498db;
    color: #fff;
    border: none;
    padding: 5px 10px;
    cursor: pointer;
    margin-right: 5px;
}

.update-btn:hover {
    background-color: #2980b9;
}
.delete-btn {
    background-color: #ff6347;
    color: #fff;
    border: none;
    padding: 5px 10px;
    cursor: pointer;
}

.delete-btn:hover {
    background-color: #e74c3c;
}
    </style>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
</head>
<body>
    <header>
        <h1>Etudiants</h1>
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
        $sql = "SELECT matricul,prenom,nom,tele_etudiant,email,tele_parent,nbr_seances_rest FROM etudiant";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            // Outputting table headers
            echo "<table>
                    <tr>
                        <th>ID</th>
                        <th>Prenom</th>
                        <th>Nom</th>
                        <th>Telephone</th>
                        <th>Email</th>
                        <th>Tele Parents</th>
                        <th>Nombre de Seances restantes</th>
                        <th>Action</th>
                    </tr>";

            // Outputting data rows
            while ($row = $result->fetch_assoc()) {
    echo "<tr>
            <td>" . $row["matricul"] . "</td>
            <td>" . $row["prenom"] . "</td>
            <td>" . $row["nom"] . "</td>
            <td>" . $row["tele_etudiant"] . "</td>
            <td>" . $row["email"] . "</td>
            <td>" . $row["tele_parent"] . "</td>
            <td>" . $row["nbr_seances_rest"] . "</td>
            <td>
                <button class='delete-btn' onclick='deleteStudent(" . $row["matricul"] . ")'>Delete</button>
                <button class='update-btn' onclick='updateStudent(" . $row["matricul"] . ")'>Update</button>
            </td>
          </tr>";
}


            echo "</table>";
        } else {
            echo "0 results";
        }

        $conn->close();
        ?>
    </main>
    <div style="text-align: center;">
        <div style="display: inline-block; margin-right: 20px;">
            <a href="Voir_etudiants_reserves.php">
                <button style="background-color: #ccc; color: #fff; padding: 8px 16px; border: none; font-size: 14px; cursor: pointer; margin-bottom: 0;">
                    Voir les étudiants réservés
                </button>
            </a>
        </div>
        <div style="display: inline-block;">
            <a href="Voir_anciens_etudiants.php">
                <button style="background-color: #333; color: #fff; padding: 8px 16px; border: none; font-size: 14px; cursor: pointer;">
                    Voir les anciens étudiants
                </button>
            </a>
        </div>
    </div>
    <script>
    function deleteStudent(matricul) {

               window.location.href = "delete_student.php?matricul=" + matricul;
    }

       function updateStudent(matricul) {
           // Redirect to the update page with the matricul parameter
           window.location.href = "update_student.php?matricul=" + matricul;
       }
</script>


</body>
</html>
