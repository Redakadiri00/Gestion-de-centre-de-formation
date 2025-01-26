<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Résultats de la recherche</title>
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
            font-size: 16px;
        }

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
        .action-buttons {
            display: flex;
            justify-content: space-between;
        }

        .action-buttons button {
            padding: 8px;
            margin: 5px;
            border: none;
            color: #fff;
            cursor: pointer;
            font-weight: bold;
            border-radius: 5px;
        }

        .edit-button {
            background-color: #4CAF50; /* Green */
        }

        .delete-button {
            background-color: #f44336; /* Red */
        }
    </style>
</head>
<body>
<header>
        <h1>VOTRE EMPLOIE DU TEMPS</h1>
    </header>
    <nav>
      <ul>
        <li><a href="http://localhost/centre/main.php">Revenir à l'acceuil</a></li>
      </ul>
    </nav>
    <?php
       if (isset($_POST['prenom']) && isset($_POST['nom']) && isset($_POST['code'])) {
           function validate($data) {
               $data = trim($data);
               $data = stripslashes($data);
               $data = htmlspecialchars($data);
               return $data;
           }

           $prenom = validate($_POST['prenom']);
           $nom = validate($_POST['nom']);
           $code = validate($_POST['code']);

           if (empty($prenom) || empty($nom) || empty($code)) {
               header("Location: loginprof.php?echec=Prenom, nom, and ID are required");
               exit();
           }

           try {
               $connexion = new PDO("mysql:host=localhost;dbname=centre-formation-rochd", "root", "");
               $connexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

               $sql = "SELECT * FROM professeur
                       WHERE prenom_prof = :prenom AND nom_prof = :nom AND idprofesseur = :code";

               $requete = $connexion->prepare($sql);
               $requete->bindParam(':prenom', $prenom, PDO::PARAM_STR);
               $requete->bindParam(':nom', $nom, PDO::PARAM_STR);
               $requete->bindParam(':code', $code, PDO::PARAM_STR);
               $requete->execute();
               $row = $requete->fetch(PDO::FETCH_ASSOC);

               if ($row && $prenom == $row['prenom_prof'] && $nom == $row['nom_prof'] && $code == $row['idprofesseur']) {
                   // Valid credentials, proceed to fetch and display schedule
                   $sql = "SELECT distinct num_seance, date_seance, heure_seance, num_salle1, idgroupe14, college_ou_lycee, filliere
                           FROM seance
                           JOIN groupe ON groupe.idgroupe = seance.idgroupe14
                           JOIN professeur ON groupe.idprof = professeur.idprofesseur
                           JOIN niveau ON groupe.code_niveau = niveau.code_niveau
                           join seance on seance.num_seance=payer.numseance69
                           WHERE prenom_prof = :prenom and nom_prof = :nom and idprofesseur = :code and groupe.etat=1 and seance.date_seance>=NOW() LIMIT 4 ";

                   $requete = $connexion->prepare($sql);
                   $requete->bindParam(':prenom', $prenom, PDO::PARAM_STR);
                   $requete->bindParam(':nom', $nom, PDO::PARAM_STR);
                   $requete->bindParam(':code', $code, PDO::PARAM_STR);
                   $requete->execute();
                   $resultats = array();

                   // Vérifier s'il y a des résultats
                   if ($requete->rowCount() > 0) {
                       // Parcourir les résultats
                       while ($row = $requete->fetch(PDO::FETCH_ASSOC)) {
                           // Ajouter chaque ligne de résultat au tableau
                           $resultats[] = $row;
                       }
                   }

                   if (!empty($resultats)) {
                       echo "<table border='1'>";
                       echo "<tr><th>num_seance</th><th>Date de Séance</th><th>Heure de seance</th><th>Numéro de Salle</th><th>Numéro de groupe</th><th>College ou Lycee</th><th>Filliere</th></tr>";
                       foreach ($resultats as $resultat) {
                           echo "<tr>";
                           echo "<td>{$resultat['num_seance']}</td>";
                           echo "<td>{$resultat['date_seance']}</td>";
                           echo "<td>{$resultat['heure_seance']}</td>";
                           echo "<td>{$resultat['num_salle1']}</td>";
                           echo "<td>{$resultat['idgroupe14']}</td>";
                           echo "<td>{$resultat['college_ou_lycee']}</td>";
                           echo "<td>{$resultat['filliere']}</td>";
                           echo "</tr>";
                       }
                       echo "</table>";
                   } else {
                       echo "<p>Aucun résultat trouvé.</p>";
                   }
               } else {
                   // Invalid credentials
                   header("Location: loginprof.php?echec=informations incorrectes");
                   exit();
               }
           } catch (PDOException $e) {
               // Database connection error
               header("Location: loginprof.php?error=Problème de connexion avec la base de données");
               exit();
           }
       } else {
           // Missing credentials
           header("Location: loginprof.php?echec=Missing credentials");
           exit();
       }
       ?>
   </body>
   </html>