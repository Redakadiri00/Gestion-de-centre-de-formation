<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Student</title>
    <style>
        body {
            font-family: 'Rubik', sans-serif;
            color: #333;
            background: #fff;
            margin: 0;
            padding: 0;
        }

        header {
            background: linear-gradient(95deg, #5533ff 40%, #25ddf5 100%)!important;
            color: #fff;
            padding: 20px;
            text-align: center;
            font-size: 24px;
        }

        form {
            max-width: 600px;
            margin: 20px auto;
            padding: 20px;
            border: 1px solid #ddd;
            border-radius: 8px;
            background-color: #f9f9f9;
        }

        label {
            display: block;
            margin-bottom: 8px;
        }

        input {
            width: 100%;
            padding: 8px;
            margin-bottom: 16px;
            box-sizing: border-box;
        }

        input[type="submit"] {
            background-color: #3498db;
            color: #fff;
            border: none;
            padding: 10px 20px;
            cursor: pointer;
            border-radius: 4px;
        }

        input[type="submit"]:hover {
            background-color: #2980b9;
        }
    </style>
</head>
<body>
    <header>
        <h1>Update Student</h1>
    </header>

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

    // Get matricul parameter from the URL
    $matricul = $_GET['matricul'];

    // Fetch the student data based on the matricul
    $sql = "SELECT * FROM etudiant WHERE matricul = '$matricul'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        // Output a form with input fields pre-filled with the existing data
        echo "
        <form action='update_student_process.php' method='post'>
            <input type='hidden' name='matricul' value='" . $row['matricul'] . "'>
            <label for='prenom'>Prenom:</label>
            <input type='text' id='prenom' name='prenom' value='" . $row['prenom'] . "' required><br>
            <label for='nom'>Nom:</label>
            <input type='text' id='nom' name='nom' value='" . $row['nom'] . "' required><br>
            <label for='tele_etudiant'>Telephone:</label>
            <input type='text' id='tele_etudiant' name='tele_etudiant' value='" . $row['tele_etudiant'] . "' required><br>
            <label for='email'>Email:</label>
            <input type='email' id='email' name='email' value='" . $row['email'] . "' required><br>
            <label for='tele_parent'>Tele Parents:</label>
            <input type='text' id='tele_parent' name='tele_parent' value='" . $row['tele_parent'] . "' ><br>
            <label for='nbr_seances_rest'>Nombre de Seances restantes:</label>
            <input type='text' id='nbr_seances_rest' name='nbr_seances_rest' value='" . $row['nbr_seances_rest'] . "' required><br>
            <input type='submit' value='Update'>
        </form>";
    } else {
        echo "<p style='text-align: center;'>Student not found</p>";
    }

    $conn->close();
    ?>
</body>
</html>
