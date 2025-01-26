<?php
// Connect to your database (replace with your database credentials)
$conn = mysqli_connect("localhost", "root", "", "centre-formation-rochd");

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Delete rows based on the specified criteria
$deleteQuery = "
    DELETE payer
    FROM payer
    JOIN seance ON payer.numseance69 = seance.num_seance
    WHERE seance.date_seance < CURDATE()
";

if (mysqli_query($conn, $deleteQuery)) {
    echo "Rows deleted successfully.\n";
} else {
    echo "Error deleting rows: " . mysqli_error($conn) . "\n";
}

// Update etudiant table
$updateQuery = "
    UPDATE etudiant
    SET nbr_seances_rest = (
        SELECT COUNT(p.numseance69)
        FROM payer AS p
        WHERE p.matricu5 = etudiant.matricul
    )
";

if (mysqli_query($conn, $updateQuery)) {
    echo "Update successful.\n";
} else {
    echo "Error updating etudiant table: " . mysqli_error($conn) . "\n";
}

// Insert rows into ancient_etudiant and delete from etudiant
$insertDeleteQuery = "
    INSERT INTO ancient_etudiant (matricule0, prenom0, nom0, tele_etudiant0, email0, code_niveau0)
    SELECT matricul, prenom, nom, tele_etudiant, email, code_niveau15
    FROM etudiant
    WHERE nbr_seances_rest = 0;

    DELETE FROM etudiant
    WHERE nbr_seances_rest = 0 ;
";

// Execute the multi-query
if (mysqli_multi_query($conn, $insertDeleteQuery)) {
    // Consume all result sets
    do {
        if ($result = mysqli_store_result($conn)) {
            mysqli_free_result($result);
        }
    } while (mysqli_next_result($conn));

    echo "Insert and delete operations successful.\n";
} else {
    echo "Error performing insert and delete operations: " . mysqli_error($conn) . "\n";
}

$selectInactifQuery = "
    SELECT idgroupe
    FROM groupe
    LEFT JOIN groupe_etudiant ON groupe.idgroupe = groupe_etudiant.idgroupe57
    WHERE groupe_etudiant.idgroupe57 IS NULL
";

// Execute the SELECT query
$result = $conn->query($selectInactifQuery);

// Check if there are results
if ($result->num_rows > 0) {
    // Loop through the results and update the 'etat' column to 0 for each 'idgroupe'
    while ($row = $result->fetch_assoc()) {
        $idgroupe = $row['idgroupe'];

        // Your UPDATE query
        $updateEtatQuery = "UPDATE groupe SET etat = 0 WHERE idgroupe = $idgroupe";

        // Execute the UPDATE query
        $conn->query($updateEtatQuery);
    }

    echo "Update successful!";
} else {
    echo "No rows found.";
}
$conn = mysqli_connect("localhost", "root", "", "centre-formation-rochd");

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}


mysqli_close($conn);
?>
