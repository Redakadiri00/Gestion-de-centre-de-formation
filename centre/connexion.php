<?php
$firstName = $_POST['firstName'];
$lastName = $_POST['lastName'];
$studentPhone = $_POST['studentPhone'];
$parentPhone = $_POST['parentPhone'];
$email = $_POST['email'];
$college_ou_lycee = $_POST['type'];
$formation = $_POST['formation'];
$module = $_POST['module'];
$niveau_scholair = $_POST['academicLevel'];
$filliere = $_POST['major'];
$codeniveau = "";
$nombreseance=$_POST['nombreSeances'];


if ($niveau_scholair == "deuxième année" && $college_ou_lycee == "Collège" && $filliere == "") {
    $codeniveau = 1;
} elseif ($niveau_scholair == "première année" && $college_ou_lycee == "Collège" && $filliere == "") {
    $codeniveau = 2;
} elseif ($niveau_scholair == "troisième année" && $college_ou_lycee == "Collège" && $filliere == "") {
    $codeniveau = 3;
} elseif ($niveau_scholair == "" && $college_ou_lycee == "" && $filliere == "") {
    $codeniveau = 4;
} elseif ($niveau_scholair == "deuxième année" && $college_ou_lycee == "Lycée" && $filliere == "Science mathématique") {
    $codeniveau = 5;
} elseif ($niveau_scholair == "deuxième année" && $college_ou_lycee == "Lycée" && $filliere == "Science X") {
    $codeniveau = 6;
} elseif ($niveau_scholair == "première année" && $college_ou_lycee == "Lycée" && $filliere == "Science") {
    $codeniveau = 7;
} elseif ($niveau_scholair == "troisième année" && $college_ou_lycee == "Lycée" && $filliere == "Science de la vie et de la terre") {
    $codeniveau = 8;
} elseif ($niveau_scholair == "troisième année" && $college_ou_lycee == "Lycée" && $filliere == "Science math A") {
    $codeniveau = 9;
} elseif ($niveau_scholair == "troisième année" && $college_ou_lycee == "Lycée" && $filliere == "Science math B") {
    $codeniveau = 10;
} elseif ($niveau_scholair == "troisième année" && $college_ou_lycee == "Lycée" && $filliere == "Science physique") {
    $codeniveau = 11;
}
if ($college_ou_lycee !== "Lycée" AND $college_ou_lycee !== "Collège" AND $college_ou_lycee !== "" ){
  header("Location: ajouter.php?echec=L'étudiant n'a pas été ajouté");
  exit();
}
if ($formation !== "Soutient" AND $formation !== "Langue et Communication" AND $formation !== "Soft Skills et Informatique" ){
  header("Location: ajouter.php?echec=L'étudiant n'a pas été ajouté");
  exit();
}
if ($formation == "Langue et Communication"){
  if ($module !== "Allemand" && $module !== "Anglais" && $module !== "Espagnol"  && $module !== "Français"){
    header("Location: ajouter.php?echec=L'étudiant n'est pas ajouté. Veuillez sélectionner un module dans la liste du module");
    exit();
  }}
if ($formation == "Soft Skills et Informatique"){
    if ($module !== "C++" && $module !== "C" && $module !== "Java" && $module !== "Python"  && $module !== "PHP"  && $module !== "JavaScript"  && $module !== "HTML" && $module !== "Soft Skills" && $module !== "CSS"){
      header("Location: ajouter.php?echec=L'étudiant n'est pas ajouté. Veuillez sélectionner un module dans la liste du module");
      exit();
    }}
if ($formation == "Soutient"){
  if ($module !== "Éducation Islamique" && $module !== "Histoire-Géographie" && $module !== "Langue anglaise" && $module !== "Langue arabe"  && $module !== "Langue française"  && $module !== "Mathématiques"  && $module !== "Philosophie" && $module !== "Physique et Chimie" && $module !== "Sciences de la Vie et de la Terre (SVT)"
  && $module !== "Sciences industrielles"){
    header("Location: ajouter.php?echec=L'étudiant n'est pas ajouté. Veuillez sélectionner un module dans la liste du module ");
    exit();
  }}
if ($module == "Éducation Islamique" OR $module == "Histoire-Géographie" OR $module == "Langue française" OR $module == "Langue arabe"){
  if ( ($college_ou_lycee!=="Collège" OR $niveau_scholair !=="troisième année") AND ($college_ou_lycee!=="Lycée" OR $niveau_scholair !=="deuxième année")){
    header("Location: ajouter.php?echec=Ce module n'est valable que pour les étudiants de troisième année du collège et les étudiants de première année du baccalauréat");
    exit();
  }}
if ($module == "Philosophie" OR  $module == "Langue anglaise"){
    if( 11 < $codeniveau OR $codeniveau < 8 OR $codeniveau==""){
      header("Location: ajouter.php?echec=Ce module n'est valable que pour les étudiants de deuxième année du baccalauréat");
      exit();
    }}
if ($module == "Sciences industrielles"){
        if( $codeniveau!== 10 ){
          header("Location: ajouter.php?echec=Ce module n'est valable que pour les étudiants en Science mathématiques B");
          exit();
        }}
if (($module == "Mathématiques" OR $module == "Physique et Chimie" OR $module == "Sciences de la Vie et de la Terre (SVT)") && ($codeniveau == 4 OR $codeniveau == "")) {
         header("Location: ajouter.php?echec=Veuillez spécifier le niveau et la filière de l'étudiant");
         exit();
     }
if ($nombreseance== 0){
         header("Location: ajouter.php?echec=Vous êtes sûre que le nombre de seance que vous avez entré est résonable ?");
         exit();
     }
if ($nombreseance<= 7 AND ($formation == "Langue et Communication" OR $formation == "Soft Skills et Informatique")) {
         header("Location: ajouter.php?echec=Il faut au moins payer 8 séances pour accéder à cette formation");
         exit();
     }




try{
    $connexion = new PDO("mysql:host=localhost;dbname=centre-formation-rochd", "root", "");
    $connexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);



        $checkExistenceQuery = "SELECT * FROM etudiant WHERE prenom = ? AND nom = ? AND email = ?";
        $checkExistenceStmt = $connexion->prepare($checkExistenceQuery);
        $checkExistenceStmt->execute([$firstName, $lastName, $email]);


    if ($checkExistenceStmt->rowCount() == 0) {
          $insertion = $connexion->prepare("INSERT INTO etudiant (prenom, nom, tele_etudiant, email, tele_parent, code_niveau15,nbr_seances_rest) VALUES (?, ?, ?, ?, ?, ?,?)");
          $insertion->execute([$firstName, $lastName, $studentPhone, $email, $parentPhone, $codeniveau,$nombreseance]);

            // Get the last inserted ID
          $lastInsertedId = $connexion->lastInsertId();}


    if ($checkExistenceStmt->rowCount() == 1 ) {
          // Student exists, retrieve the matricul (ID)
          $studentData = $checkExistenceStmt->fetch(PDO::FETCH_ASSOC);
          $studentId = $studentData['matricul'];
          $lastInsertedId = $studentId;



      }


    // Count occurrences of matricule57 in groupe_etudiant for each idgroupe57
    $countQuery = "SELECT idgroupe57, COUNT(matricul57) AS nombre_etudiant FROM groupe_etudiant GROUP BY idgroupe57 HAVING nombre_etudiant <= 7 and 1 <= nombre_etudiant;";
    $countResult = $connexion->query($countQuery);



    if ($countResult  ) {
        while ($countRow = $countResult->fetch(PDO::FETCH_ASSOC)) {
            $idgroupe57 = $countRow['idgroupe57'];


                // Check if code_niveau matches
                $checkCodeNiveauQuery = "SELECT code_niveau FROM groupe WHERE idgroupe = ?";
                $checkCodeNiveauStmt = $connexion->prepare($checkCodeNiveauQuery);
                $checkCodeNiveauStmt->execute([$idgroupe57]);
                $codeNiveauRow = $checkCodeNiveauStmt->fetch(PDO::FETCH_ASSOC);

                $checknomModuleQuery = "SELECT nom_module21 FROM groupe WHERE idgroupe = ?";
                $checknomModuleStmt = $connexion->prepare($checknomModuleQuery);
                $checknomModuleStmt->execute([$idgroupe57]);
                $nomModuleRow = $checknomModuleStmt->fetch(PDO::FETCH_ASSOC);

                $checkExistenceQuery6 = "SELECT * FROM groupe_etudiant WHERE idgroupe57 = ? AND matricul57 = ? ";
                $checkExistenceStmt6 = $connexion->prepare($checkExistenceQuery6);
                $checkExistenceStmt6->execute([$idgroupe57,$lastInsertedId]);

                if ($codeNiveauRow['code_niveau'] == $codeniveau && $nomModuleRow['nom_module21'] == $module AND $checkExistenceStmt6->rowCount() == 0) {

                    // Insert new row into groupe_etudiant
                    $insertGroupe = $connexion->prepare("INSERT INTO groupe_etudiant(idgroupe57, matricul57) VALUES (?, ?)");
                    $insertGroupe->execute([$idgroupe57, $lastInsertedId]);
                    header("Location: ajouter.php?succes=L'étudiant a été ajouté avec succès au groupe numero $idgroupe57");

                    $sql = "INSERT INTO paiment(date_paiment, nbr_seances_payees) VALUES (CURRENT_TIMESTAMP, $nombreseance)";
                    $requete1 = $connexion->prepare($sql);
                    $requete1->execute();
                    $lastInsertedIdrecu = $connexion->lastInsertId();

                    $query = "SELECT num_seance FROM seance WHERE idgroupe14 = $idgroupe57 AND date_seance >= CURRENT_DATE AND heure_seance > CURRENT_DATE() LIMIT $nombreseance";
                    $statement = $connexion->prepare($query);
                    $statement->execute();



                    $resultArray = $statement->fetchAll(PDO::FETCH_ASSOC);
                    $numSeanceArray = array_column($resultArray, 'num_seance');


                    foreach ($numSeanceArray as $numSeance) {

                    $insertQuery = "INSERT INTO payer(idreçu5,numseance69, matricu5) VALUES ($lastInsertedIdrecu ,$numSeance ,$lastInsertedId)";

                    $connexion->exec($insertQuery);
			               }
                    exit();
                }

            }

            }




$insertion = $connexion->prepare("INSERT INTO etudiant_reserve (prenom33, nom33, tele_etudiant33, email33, tele_parent33, code_niveau33,nbr_seances_rest33) VALUES (?, ?, ?, ?, ?, ?,?)");
$insertion->execute([$firstName, $lastName, $studentPhone, $email, $parentPhone, $codeniveau,$nombreseance]);



$lastInsertedIdER = $connexion->lastInsertId();

$checkifexistgroupQuery = "SELECT idgroupe FROM groupe WHERE code_niveau = ? AND nom_module21 = ? AND etat = 0 LIMIT 1 ";
$checkgeStmt0 = $connexion->prepare($checkifexistgroupQuery);
$checkgeStmt0->execute([$codeniveau, $module]);
$result = $checkgeStmt0->fetch(PDO::FETCH_ASSOC);




$checkifexistgroupQuery1 = "SELECT idgroupe FROM groupe WHERE code_niveau = ? AND nom_module21 = ? AND etat = 0 ORDER BY idgroupe DESC LIMIT 1 ";
$checkgeStmt01 = $connexion->prepare($checkifexistgroupQuery1);
$checkgeStmt01->execute([$codeniveau, $module]);
$result1 = $checkgeStmt01->fetch(PDO::FETCH_ASSOC);

if (!$result AND !$result1 AND $checkExistenceStmt->rowCount() == 0 ){header("Location: ajouter.php?echec=Attention il n'y a aucune place vide dans les groupes de ce modules");
  $deleteQuery = "DELETE FROM etudiant_reserve WHERE matricule33= ?";
  $deleteStmt = $connexion->prepare($deleteQuery);
  $deleteStmt->execute([$lastInsertedIdER]);
  $deleteQuery3 = "DELETE FROM etudiant WHERE matricul= ?";
  $deleteStmt3 = $connexion->prepare($deleteQuery3);
  $deleteStmt3->execute([$lastInsertedId]);
  exit();}

if (!$result AND !$result1 AND $checkExistenceStmt->rowCount() == 1 ){header("Location: ajouter.php?echec=Etudiant deja s'inscrit dans tous les groupes de ce module ou bien il n'y a aucune place vide dans les groupes de ce modules");
  $deleteQuery = "DELETE FROM etudiant_reserve WHERE matricule33= ?";
  $deleteStmt = $connexion->prepare($deleteQuery);
  $deleteStmt->execute([$lastInsertedIdER]);
exit();}

if ($result AND $result1){$idGroupe1 = $result1['idgroupe'];
                          $idGroupe = $result['idgroupe'];
                          }



$checkreserveQuery = "SELECT idgroupe10 FROM groupe_etudiant_reserve JOIN etudiant_reserve
                      ON groupe_etudiant_reserve.matricule10=etudiant_reserve.matricule33
                      WHERE idgroupe10 = ? AND  prenom33 = ? AND nom33 = ? AND email33 = ?";
                $checkStmt = $connexion->prepare($checkreserveQuery);
                $checkStmt->execute([$idGroupe,$firstName,$lastName,$email]);
                $Chekstore = $checkStmt->fetch(PDO::FETCH_ASSOC);

$checkreserveQuery1 = "SELECT idgroupe10 FROM groupe_etudiant_reserve JOIN etudiant_reserve
                      ON groupe_etudiant_reserve.matricule10=etudiant_reserve.matricule33
                      WHERE idgroupe10 = ? AND  prenom33 = ? AND nom33 = ? AND email33 = ?";
                $checkStmt1 = $connexion->prepare($checkreserveQuery1);
                $checkStmt1->execute([$idGroupe1,$firstName,$lastName,$email]);
                $Chekstore1 = $checkStmt1->fetch(PDO::FETCH_ASSOC);



if ($Chekstore and $Chekstore1)  {header("Location: ajouter.php?echec=Attention cet etudiant est deja s'inscrit dans tous les groupes de ce module");
$deleteQuery = "DELETE FROM etudiant_reserve WHERE matricule33= ?";
$deleteStmt = $connexion->prepare($deleteQuery);
$deleteStmt->execute([$lastInsertedIdER]);
exit();}

if ($Chekstore and !$Chekstore1){$idGroupe=$idGroupe1;}

$insertGroupe = $connexion->prepare("INSERT INTO groupe_etudiant_reserve(idgroupe10, matricule10) VALUES (?, ?)");
$insertGroupe->execute([$idGroupe, $lastInsertedIdER]);


$sql = "INSERT INTO paiment(date_paiment, nbr_seances_payees) VALUES (CURRENT_TIMESTAMP, $nombreseance)";
$requete1 = $connexion->prepare($sql);
$requete1->execute();
$lastInsertedIdrecu = $connexion->lastInsertId();

$sql = "INSERT INTO payer_avance(idreçu99, nbr_seances_payees33 ,matricul99) VALUES ($lastInsertedIdrecu ,$nombreseance, $lastInsertedIdER )";
$requete1 = $connexion->prepare($sql);
$requete1->execute();



if ($checkExistenceStmt->rowCount() == 0) {

$deleteQuery = "DELETE FROM etudiant WHERE matricul = ?";
$deleteStmt = $connexion->prepare($deleteQuery);
$deleteStmt->execute([$lastInsertedId]);


$checkexistgrpreQuery =
    "SELECT COUNT(matricule10) AS nombre_etudiant10
     FROM groupe_etudiant_reserve
     WHERE idgroupe10 = ?
     GROUP BY idgroupe10 ";

$checkgeStmt0 = $connexion->prepare($checkexistgrpreQuery);
$checkgeStmt0->execute([$idGroupe]);
$result = $checkgeStmt0->fetch(PDO::FETCH_ASSOC);
$COUNTRESERVE = $result['nombre_etudiant10'];


if ($result && $COUNTRESERVE== 4) {
    $SELECTQuery1 = "SELECT matricule33, prenom33, nom33, tele_etudiant33, email33, tele_parent33, code_niveau33, nbr_seances_rest33
                    FROM groupe_etudiant_reserve
                    JOIN etudiant_reserve ON groupe_etudiant_reserve.matricule10=etudiant_reserve.matricule33
                    WHERE idgroupe10 = ?";
                    $selectStmt = $connexion->prepare($SELECTQuery1);
                    $selectStmt->execute([$idGroupe]);  // Assuming $idGroupe is your parameter

    $a=0;
    while ($row = $selectStmt->fetch(PDO::FETCH_ASSOC)) {

        $checkExistenceQuery = "SELECT * FROM etudiant WHERE prenom = ? AND nom = ? AND email = ?";
        $checkExistenceStmt = $connexion->prepare($checkExistenceQuery);
        $checkExistenceStmt->execute([$row['prenom33'], $row['nom33'], $row['email33']]);
        $ROW = $checkExistenceStmt->fetch(PDO::FETCH_ASSOC);

        if ($checkExistenceStmt->rowCount() == 0){
        // Insert each row into the 'etudiant' table
        $insertQuery1 = "INSERT INTO etudiant (prenom, nom, tele_etudiant, email, tele_parent, code_niveau15, nbr_seances_rest)
                        VALUES (?, ?, ?, ?, ?, ?, ?)";
        $insertStmt = $connexion->prepare($insertQuery1);
        $insertStmt->execute([
            $row['prenom33'],
            $row['nom33'],
            $row['tele_etudiant33'],
            $row['email33'],
            $row['tele_parent33'],
            $row['code_niveau33'],
            $row['nbr_seances_rest33']]);
      $lastInsertedId = $connexion->lastInsertId();}

          if ($checkExistenceStmt->rowCount() == 1){
        $lastInsertedId = $ROW['matricul'];
        $updateQuery = "UPDATE etudiant SET nbr_seances_rest = ? + nbr_seances_rest WHERE matricul = ?";
        $updateStmt = $connexion->prepare($updateQuery);
        $updateStmt->execute([$nombreseance, $lastInsertedId]);
    }



      $MATDATA = $row['matricule33'];


      $insertQuery2 = "INSERT INTO groupe_etudiant(idgroupe57, matricul57) VALUES (?, ?)";
      $insertStmt = $connexion->prepare($insertQuery2);
      $insertStmt->execute([$idGroupe, $lastInsertedId]);

      $sql = "SELECT idreçu99 FROM payer_avance WHERE matricul99= $MATDATA ";
      $requete1 = $connexion->prepare($sql);
      $requete1->execute();
      $RID = $requete1->fetch(PDO::FETCH_ASSOC);
      $RecueId = $RID['idreçu99'];

      $query = "SELECT num_seance FROM seance WHERE idgroupe14 = :idGroupe AND date_seance > CURRENT_DATE LIMIT :limit";
      $statement = $connexion->prepare($query);
      $statement->bindParam(':idGroupe', $idGroupe, PDO::PARAM_INT);
      $statement->bindParam(':limit', $row['nbr_seances_rest33'], PDO::PARAM_INT);
      $statement->execute();
      $resultArray = $statement->fetchAll(PDO::FETCH_ASSOC);
      $numSeanceArray = array_column($resultArray, 'num_seance');

      foreach ($numSeanceArray as $numSeance) {

        $insertQuery = "INSERT INTO payer(idreçu5, numseance69, matricu5) VALUES (?, ?, ?)";
        $insertStmt = $connexion->prepare($insertQuery);
        $insertStmt->execute([$RecueId, $numSeance, $lastInsertedId]);

       }
       $deleteQuery = "DELETE FROM groupe_etudiant_reserve WHERE matricule10= ? AND idgroupe10 = ?";
       $deleteStmt = $connexion->prepare($deleteQuery);
       $deleteStmt->execute([$MATDATA,$idGroupe]);

       $deleteQuery = "DELETE FROM payer_avance WHERE idreçu99= ? AND matricul99 = ?";
       $deleteStmt = $connexion->prepare($deleteQuery);
       $deleteStmt->execute([$RecueId,$MATDATA]);

       $deleteQuery = "DELETE FROM etudiant_reserve WHERE matricule33= ?";
       $deleteStmt = $connexion->prepare($deleteQuery);
       $deleteStmt->execute([$MATDATA]);


       $a++;


       if($a==1){
       $i1=$row['prenom33'];
       $j1=$row['nom33'];
       $k1=$row['tele_etudiant33'];}

       if($a==2){
       $i2=$row['prenom33'];
       $j2=$row['nom33'];
       $k2=$row['tele_etudiant33'];}

       if($a==3){
       $i3=$row['prenom33'];
       $j3=$row['nom33'];
       $k3=$row['tele_etudiant33'];}

       if($a==4){
       $i4=$row['prenom33'];
       $j4=$row['nom33'];
       $k4=$row['tele_etudiant33'];}






}
$updateetatQuery = "UPDATE groupe SET etat=1 WHERE idgroupe = ?";
$updateStmt = $connexion->prepare($updateetatQuery);
$updateStmt->execute([$idGroupe]);
header("Location: ajouter.php?annonce=Le nombre d'étudiants du groupe $idGroupe a atteint 4 , il est maintenant actif. Veuillez appeler les étudiants...... $i1...$j1...$k1 et $i2...$j2...$k2 et $i3...$j3...$k3 et $i4...$j4...$k4 pour qu'ils puissent commencer les cours");

exit();
}

if ($result && $COUNTRESERVE!== 4){
  header("Location: ajouter.php?succes=L'étudiant a reserve avec succes attendez jusqu'a que le groupe attend 4 membre");
exit();
}
if (!$result){
  header("Location: ajouter.php?echec=Malheureusement il n'y a aucune place restante dans notre centre poure cette formation");
exit();
}



}if ($checkExistenceStmt->rowCount() == 1){





  $checkexistgrpreQuery =
      "SELECT COUNT(matricule10) AS nombre_etudiant10
       FROM groupe_etudiant_reserve
       WHERE idgroupe10 = ?
       GROUP BY idgroupe10 ";

  $checkgeStmt0 = $connexion->prepare($checkexistgrpreQuery);
  $checkgeStmt0->execute([$idGroupe]);
  $result = $checkgeStmt0->fetch(PDO::FETCH_ASSOC);
  $COUNTRESERVE = $result['nombre_etudiant10'];


  if ($result && $COUNTRESERVE== 4) {
      $SELECTQuery1 = "SELECT matricule33, prenom33, nom33, tele_etudiant33, email33, tele_parent33, code_niveau33, nbr_seances_rest33
                      FROM groupe_etudiant_reserve
                      JOIN etudiant_reserve ON groupe_etudiant_reserve.matricule10=etudiant_reserve.matricule33
                      WHERE idgroupe10 = ?";
                      $selectStmt = $connexion->prepare($SELECTQuery1);
                      $selectStmt->execute([$idGroupe]);  // Assuming $idGroupe is your parameter

      $a=0;
      while ($row = $selectStmt->fetch(PDO::FETCH_ASSOC)) {

        $checkExistenceQuery = "SELECT * FROM etudiant WHERE prenom = ? AND nom = ? AND email = ?";
        $checkExistenceStmt = $connexion->prepare($checkExistenceQuery);
        $checkExistenceStmt->execute([$row['prenom33'], $row['nom33'], $row['email33']]);
        $ROW = $checkExistenceStmt->fetch(PDO::FETCH_ASSOC);

        if ($checkExistenceStmt->rowCount() == 0){
        // Insert each row into the 'etudiant' table
        $insertQuery1 = "INSERT INTO etudiant (prenom, nom, tele_etudiant, email, tele_parent, code_niveau15, nbr_seances_rest)
                        VALUES (?, ?, ?, ?, ?, ?, ?)";
        $insertStmt = $connexion->prepare($insertQuery1);
        $insertStmt->execute([
            $row['prenom33'],
            $row['nom33'],
            $row['tele_etudiant33'],
            $row['email33'],
            $row['tele_parent33'],
            $row['code_niveau33'],
            $row['nbr_seances_rest33']]);
      $lastInsertedId = $connexion->lastInsertId();}
        if ($checkExistenceStmt->rowCount() == 1){
          $lastInsertedId = $ROW['matricul'];
          $updateQuery = "UPDATE etudiant SET nbr_seances_rest= $nombreseance + nbr_seances_rest WHERE matricul = $lastInsertedId";
          $selectStmt = $connexion->prepare($updateQuery);
          $selectStmt->execute();
                              }


        $MATDATA = $row['matricule33'];


        $insertQuery2 = "INSERT INTO groupe_etudiant(idgroupe57, matricul57) VALUES (?, ?)";
        $insertStmt = $connexion->prepare($insertQuery2);
        $insertStmt->execute([$idGroupe, $MATDATA]);

        $sql = "SELECT idreçu99 FROM payer_avance WHERE matricul99= $MATDATA ";
        $requete1 = $connexion->prepare($sql);
        $requete1->execute();
        $RID = $requete1->fetch(PDO::FETCH_ASSOC);
        $RecueId = $RID['idreçu99'];

        $query = "SELECT num_seance FROM seance WHERE idgroupe14 = :idGroupe AND date_seance > CURRENT_DATE LIMIT :limit";
        $statement = $connexion->prepare($query);
        $statement->bindParam(':idGroupe', $idGroupe, PDO::PARAM_INT);
        $statement->bindParam(':limit', $row['nbr_seances_rest33'], PDO::PARAM_INT);
        $statement->execute();
        $resultArray = $statement->fetchAll(PDO::FETCH_ASSOC);
        $numSeanceArray = array_column($resultArray, 'num_seance');

        foreach ($numSeanceArray as $numSeance) {

          $insertQuery = "INSERT INTO payer(idreçu5, numseance69, matricu5) VALUES (?, ?, ?)";
          $insertStmt = $connexion->prepare($insertQuery);
          $insertStmt->execute([$RecueId, $numSeance, $MATDATA]);

         }
         $deleteQuery = "DELETE FROM groupe_etudiant_reserve WHERE matricule10= ? AND idgroupe10 = ?";
         $deleteStmt = $connexion->prepare($deleteQuery);
         $deleteStmt->execute([$MATDATA,$idGroupe]);

         $deleteQuery = "DELETE FROM payer_avance WHERE idreçu99= ? AND matricul99 = ?";
         $deleteStmt = $connexion->prepare($deleteQuery);
         $deleteStmt->execute([$RecueId,$MATDATA]);

         $deleteQuery = "DELETE FROM etudiant_reserve WHERE matricule33= ?";
         $deleteStmt = $connexion->prepare($deleteQuery);
         $deleteStmt->execute([$MATDATA]);

         $a++;


         if($a==1){
         $i1=$row['prenom33'];
         $j1=$row['nom33'];
         $k1=$row['tele_etudiant33'];}

         if($a==2){
         $i2=$row['prenom33'];
         $j2=$row['nom33'];
         $k2=$row['tele_etudiant33'];}

         if($a==3){
         $i3=$row['prenom33'];
         $j3=$row['nom33'];
         $k3=$row['tele_etudiant33'];}

         if($a==4){
         $i4=$row['prenom33'];
         $j4=$row['nom33'];
         $k4=$row['tele_etudiant33'];}
  }
  $updateetatQuery = "UPDATE groupe SET etat=1 WHERE idgroupe = ?";
        $updateStmt = $connexion->prepare($updateetatQuery);
        $updateStmt->execute([$idGroupe]);
  header("Location: ajouter.php?annonce=Le nombre d'étudiants du groupe $idGroupe a atteint 4 , il est maintenant actif. Veuillez appeler les étudiants...... $i1...$j1...$k1 et $i2...$j2...$k2 et $i3...$j3...$k3 et $i4...$j4...$k4 pour qu'ils puissent commencer les cours");

  exit();
  }

  if ($result && $COUNTRESERVE!== 4){
    header("Location: ajouter.php?succes=L'étudiant a reserve avec succes attendez jusqu'a que le groupe attend 4 membre");
  exit();
  }
  if (!$result){
    header("Location: ajouter.php?echec=Malheureusement il n'y a aucune place restante dans notre centre poure cette formation");
  exit();
  }}
}
catch (PDOException $e) {
    // Handle PDO exceptions
    echo "PDO Exception: " . $e->getMessage();
} catch (Exception $e) {
    // Handle other types of exceptions
    echo "Exception: " . $e->getMessage();
}
?>
