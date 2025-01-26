<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Delete Student</title>
    <style>
        body {
            font-family: 'Rubik', sans-serif;
            color: #333;
            background: #fff;
            margin: 0;
            padding: 0;
        }

        h2 {
            background: linear-gradient(95deg, #5533ff 40%, #25ddf5 100%) !important;
            color: #fff;
            padding: 30px;
            text-align: center;
            font-size: 30px;
        }

        p {
            padding: 10px;
            font-size: 24px;
            text-align: center;
        }

        form {
            text-align: center;
        }

        button {
            background-color: #ff6347;
            color: #fff;
            border: none;
            padding: 20px 40px;
            cursor: pointer;
        }

        button:hover {
            background-color: #e74c3c;
        }
    </style>
</head>
<body>
    <?php
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "centre-formation-rochd";

    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    if ($_SERVER["REQUEST_METHOD"] === "GET" && isset($_GET['matricul'])) {
        $matricul = $_GET['matricul'];

        // Display student information
        $sql = "SELECT * FROM etudiant WHERE matricul = '$matricul'";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            echo "<h2>Suppression d'étudiant</h2>";
            echo "<p>Êtes-vous sûr de vouloir supprimer cet étudiant ?</p>";
            echo "<p>Matricul : " . $row["matricul"] . "<br>";
            echo "Prenom : " . $row["prenom"] . "<br>";
            echo "Nom : " . $row["nom"] . "</p>";
            echo "<form method='post' action=''>";
            echo "<input type='hidden' name='matricul' value='$matricul' />";
            echo "<button type='submit'>Oui, supprimer cet étudiant</button>";
            echo "</form>";
        } else {
            echo "Étudiant non trouvé.";
        }
    } elseif ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['matricul'])) {
        $matricul = $_POST['matricul'];

        // SQL query to delete the student with the specified matricul
        $sql = "DELETE FROM etudiant WHERE matricul = '$matricul'";

        if ($conn->query($sql) === TRUE) {
            header("Location: voiretud.php?succes=L'étudiant numéro $matricul a été supprimé avec succès");
        } else {
            echo "Erreur " . $conn->error;
        }
    }

    $conn->close();
    ?>
</body>
</html>
