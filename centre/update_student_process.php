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

// Get form data
$matricul = $_POST['matricul'];
$prenom = $_POST['prenom'];
$nom = $_POST['nom'];
$tele_etudiant = $_POST['tele_etudiant'];
$email = $_POST['email'];
$tele_parent = $_POST['tele_parent'];
$nbr_seances_rest = $_POST['nbr_seances_rest'];

// SQL query to update the student data
$sql = "UPDATE etudiant SET prenom='$prenom', nom='$nom', tele_etudiant='$tele_etudiant',
        email='$email', tele_parent='$tele_parent', nbr_seances_rest='$nbr_seances_rest'
        WHERE matricul='$matricul'";

if ($conn->query($sql) === TRUE) {
    header("Location: voiretud.php?succes=L'étudiant numéro $matricul a été modifier avec succès");
} else {
    echo "Error de modification : " . $conn->error;
}

$conn->close();
?>
