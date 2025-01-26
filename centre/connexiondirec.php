<?php
if (isset($_POST['username']) && isset($_POST['password'])) {
    function validate($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    $username = validate($_POST['username']);
    $password = validate($_POST['password']);

    // Assuming you have a PDO connection named $connexion
    try {
        $connexion = new PDO("mysql:host=localhost;dbname=centre-formation-rochd", "root", "");
        $connexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // Utiliser des requêtes paramétrées
        $query = "SELECT username, password FROM logine LIMIT 1";
        $stmt = $connexion->prepare($query);
        $stmt->execute();

        // Récupérer le résultat
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        if (empty($username) && empty($password)) {
            header("Location: logindirecteur.php?error=Password and Username are required");
            exit();
        } else if (empty($password)) {
            header("Location: logindirecteur.php?error=Password is required");
            exit();
        } else if (empty($username)) {
            header("Location: logindirecteur.php?error=Username is required");
            exit();
        } else if ($row && $username == $row['username'] && $password == $row['password']) {
            header("location: ajouter.php");
            exit();
        } else if ($row && $username !== $row['username'] && $password !== $row['password']) {
            header("location: logindirecteur.php?error=Password and Username are incorrects");
            exit();
        } else if ($row && $username !== $row['username'] && $password == $row['password']) {
            header("location: logindirecteur.php?error=Username is incorrect");
            exit();
        } else if ($row && $username == $row['username'] && $password !== $row['password']) {
            header("location: logindirecteur.php?error=Password is incorrect");
            exit();
        } else {
            header("Location: logindirecteur.php");
            exit();
        }
    } catch (PDOException $e) {
        echo "Connection failed: " . $e->getMessage();
    }
}
?>
