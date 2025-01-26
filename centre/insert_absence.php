<?php
$idetudiant=$_POST['idetudiant'];
$numero_seance=$_POST['numero_seance'];
try {

    $connexion = new PDO("mysql:host=localhost;dbname=centre-formation-rochd", "root", "");
    $connexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $checkExistenceQuery = "SELECT numseance69 FROM payer WHERE matricu5 = ? AND numseance69= ?";
    $checkExistenceStmt = $connexion->prepare($checkExistenceQuery);
    $checkExistenceStmt->execute([$idetudiant,$numero_seance]);
    $result = $checkExistenceStmt->fetch(PDO::FETCH_ASSOC);
    if (!$result){header('Location:addabscent.php?echec=les informations incorrectes');
                  exit();}

    $checkExistenceQuery = "SELECT num_seance44 FROM abscenter Where matricul44= ? AND num_seance44= ?";
    $checkExistenceStmt = $connexion->prepare($checkExistenceQuery);
    $checkExistenceStmt->execute([$idetudiant,$numero_seance]);
    $result = $checkExistenceStmt->fetch(PDO::FETCH_ASSOC);
    if ($result){header('Location:addabscent.php?echec=Attention cet etudiant est deja marque abscent pour cette seance');
                exit();}

    $requete = $connexion->prepare("INSERT INTO abscenter(matricul44,num_seance44) VALUES (?, ?)");
    $requete->execute([$idetudiant, $numero_seance]);



    $countQuery = "SELECT   COUNT(num_seance44) AS nombre_seance FROM abscenter Where matricul44=$idetudiant GROUP BY matricul44 ;";
    $countResult = $connexion->query($countQuery);
    $result = $countResult->fetch(PDO::FETCH_ASSOC);
    $nbrabs=$result['nombre_seance'];
    if($nbrabs == 1){
    $checkExistenceQuery = "SELECT numseance69 FROM payer WHERE matricu5 = ? ORDER BY numseance69 DESC LIMIT 1 ";
    $checkExistenceStmt = $connexion->prepare($checkExistenceQuery);
    $checkExistenceStmt->execute([$idetudiant]);


    $result = $checkExistenceStmt->fetch(PDO::FETCH_ASSOC);
    $num_last_seance = $result['numseance69'];

    $checkExistenceQuery0 = "SELECT idreçu5 FROM payer WHERE matricu5 = ? LIMIT 1 ";
    $checkExistenceStmt0 = $connexion->prepare($checkExistenceQuery0);
    $checkExistenceStmt0->execute([$idetudiant]);


    $result = $checkExistenceStmt0->fetch(PDO::FETCH_ASSOC);
    $id_recu = $result['idreçu5'];


    $insertQuery = "INSERT INTO payer(idreçu5,numseance69, matricu5)
     VALUES ($id_recu ,$num_last_seance+84 ,$idetudiant )";

    $connexion->exec($insertQuery);
}

    header('Location:addabscent.php?succes=abscence marque avec succes avec succes');
    exit();




} catch (PDOException $e) {
    header('Location:addabscent.php?echec=invalide');
    exit();
}









?>
