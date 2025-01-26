<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Director Interface</title>


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

        nav {
            background-color: #3ecf8e;
            color: #fff;
            padding: 10px;
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

        .form-container {
            max-width: 600px;
            margin: auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        h2 {
            color: #394240;
        }

        label {
            display: block;
            margin-bottom: 8px;
            color: #394240;
        }


        input {
            width: 100%;
            padding: 10px;
            margin-bottom: 16px;
            box-sizing: border-box;
        }

        button {
            background-color: #3ecf8e;
            color: #fff;
            padding: 12px 24px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
        }

        button:hover {
            background-color: #1a1d1e;
        }
        .succes {
    background-color: #DFF0D8;
    color: #3C763D;
    padding: 15px;
    border-radius: 8px;
    margin: 20px 0; /* Adjusted margin */
    width: calc(100% - 40px); /* Adjusted width calculation */
    text-align: center;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
}
      .echec {
    background: #F2DEDE;
    color: #A94442;
    padding: 15px;
    border-radius: 8px;
    margin: 20px 0;
    width: calc(100% - 40px);;
    text-align: center;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);}

    .annonce {
    background-color: #ffffb2; /* Yellow color code */
    color: #cccc00; /* Matching text color */
    padding: 15px;
    border-radius: 8px;
    margin: 20px 0;
    width: calc(100% - 40px);
    text-align: center;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
}
  nav a:hover {
      color: #4d565e; /* Lighter shade of the header background color */
      transition: color 0.3s ease;
  }



    </style>
</head>


<body>
  <header>
      <h1>Ajout d'etudiants</h1>
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
        <div class="form-container">
            <h2>Ajouter un étudiant</h2>

            <?php if (isset($_GET['succes'])){ ?>
                <p id="successMessage" class="succes"><?php echo $_GET['succes']; ?></p>
            <?php } ?>
            <?php if (isset($_GET['echec'])){ ?>
                <p id="echecMessage" class="echec"><?php echo $_GET['echec']; ?></p>
            <?php } ?>
            <?php if (isset($_GET['annonce'])){ ?>
                <p id="annonceMessage" class="annonce"><?php echo $_GET['annonce']; ?></p>
            <?php } ?>

            <form action="connexion.php" method="post">
                <label for="firstName">Prénom:</label>
                <input type="text" id="firstName" name="firstName" autocomplete="off" pattern="[A-Za-zÀ-ÖØ-öø-ÿ\s]+" required >

                <label for="lastName">Nom:</label>
                <input type="text" id="lastName" name="lastName" autocomplete="off" pattern="[A-Za-zÀ-ÖØ-öø-ÿ\s]+" required >

                <label for="studentPhone">Téléphone de l'étudiant:</label>
                <input type="tel" id="studentPhone" name="studentPhone" autocomplete="off" pattern="(\+212|0)[5-7]{1}[0-9]{8}" required>

                <label for="email">Email:</label>
                <input type="email" id="email" name="email" autocomplete="off" required >

                <label for="formation">Formation :</label>
                <input list="formationsList" id="formation" name="formation" onchange="updateModules()" autocomplete="off" required>
                <datalist id="formationsList">
                    <option value="Soutient">
                    <option value="Langue et Communication">
                    <option value="Soft Skills et Informatique">
                </datalist>

                <label for="module">Module:</label>
                <input type="text" list="modulesList" id="module" name="module" autocomplete="off" required>
                <datalist id="modulesList"></datalist>

                <label for="type">Type:</label>
                <input list="TypeList" id="type" name="type" onchange="updateModules()" autocomplete="off" >
                <datalist id="TypeList">
                    <option value="Lycée">
                    <option value="Collège">
                </datalist>

                <label for="academicLevel">Niveau Scolaire:</label>
                <input list="academicLevellist" id="academicLevel" name="academicLevel" onchange="updateModules()" autocomplete="off" >
                <datalist id="academicLevellist">
                    <option value="première année">
                    <option value="deuxième année">
                    <option value="troisième année">
                </datalist>

                <label for="major">Filière:</label>
                <input type="text" list="majorList" id="major" name="major" autocomplete="off" >
                <datalist id="majorList"></datalist>

                <label for="parentPhone">Téléphone du parent:</label>
                <input type="tel" id="parentPhone" name="parentPhone" autocomplete="off" pattern="(\+212|0)[5-7]{1}[0-9]{8}" >

                <div>
    <label for="nombreSeances">Nombre de séances:</label>
    <input type="number" id="nombreSeances" name="nombreSeances" autocomplete="off" >
</div>

<div id="priceContainer"></div>


                <script>
function updateModules() {
    var formationSelect = document.getElementById("formation");
    var moduleSelect = document.getElementById("module");
    var academicLevelInput = document.getElementById("academicLevel");
    var majorInput = document.getElementById("major");
    var modulesList = document.getElementById("modulesList");
    var Typelist = document.getElementById("type");
    var academicLevelSelect = document.getElementById("academicLevel");
    var majorList = document.getElementById("majorList");
    var parentPhoneInput = document.getElementById("parentPhone");
    // Effacer les options existantes
    modulesList.innerHTML = "";

    // Récupérer les inputs pour Niveau Scolaire et Filière
    var academicLevelLabel = document.querySelector("label[for='academicLevel']");
    var majorLabel = document.querySelector("label[for='major']");
    var TypeLabel = document.querySelector("label[for='type']");
    var parentPhoneLabel = document.querySelector("label[for='parentPhone']");

    // Ajouter de nouvelles options en fonction de la sélection
    if (formationSelect.value === "Soutient") {
                        addOption(modulesList, "Éducation Islamique");
                        addOption(modulesList, "Histoire-Géographie");
                        addOption(modulesList, "Langue anglaise");
                        addOption(modulesList, "Langue arabe");
                        addOption(modulesList, "Langue française");
                        addOption(modulesList, "Mathématiques");
                        addOption(modulesList, "Philosophie");
                        addOption(modulesList, "Physique et Chimie");
                        addOption(modulesList, "Sciences de la Vie et de la Terre (SVT)");
                        addOption(modulesList, "Sciences industrielles");
        showFields(academicLevelInput, academicLevelLabel, majorInput, majorLabel,Typelist,TypeLabel,parentPhoneLabel,parentPhoneInput);
    } else if (formationSelect.value === "Langue et Communication") {
                        addOption(modulesList, "Allemand");
                        addOption(modulesList, "Anglais");
                        addOption(modulesList, "Espagnol");
                        addOption(modulesList, "Français");
        // ... (other options for "Langue et Communication")
        hideFields(academicLevelInput, academicLevelLabel, majorInput, majorLabel,Typelist,TypeLabel,parentPhoneLabel,parentPhoneInput);
    } else if (formationSelect.value === "Soft Skills et Informatique") {
                        addOption(modulesList, "C++");
                        addOption(modulesList, "C");
                        addOption(modulesList, "CSS");
                        addOption(modulesList, "Java");
                        addOption(modulesList, "Python");
                        addOption(modulesList, "PHP");
                        addOption(modulesList, "JavaScript");
                        addOption(modulesList, "HTML");
                        addOption(modulesList, "Soft Skills");
        // ... (other options for "Soft Skills et Informatique")
        hideFields(academicLevelInput, academicLevelLabel, majorInput, majorLabel,Typelist,TypeLabel,parentPhoneLabel,parentPhoneInput);
    }
      if (academicLevelSelect.value === "première année") {
                        addOption(majorList, "Science");
  } else if (academicLevelSelect.value === "deuxième année") {
                        addOption(majorList, "Science mathématique");
                        addOption(majorList, "Science X");
  } else if (academicLevelSelect.value === "troisième année") {
                        addOption(majorList, "Science de la vie et de la terre");
                        addOption(majorList, "Science math A");
                        addOption(majorList, "Science math B");
                        addOption(majorList, "Science physique");                  }





    if (Typelist.value === "Collège") {

        hideFields(majorInput, majorLabel);
    }
      if (Typelist.value === "Lycée") {

        showFields(majorInput, majorLabel);
    }
}
function addOption(select, value) {
    var option = document.createElement("option");
    option.value = value;
    select.appendChild(option);
}

function showFields() {
    for (var i = 0; i < arguments.length; i++) {
        arguments[i].style.display = "block";
    }
}

function hideFields() {
    for (var i = 0; i < arguments.length; i++) {
        arguments[i].style.display = "none";
    }
}
document.addEventListener("DOMContentLoaded", function() {
        // Select the success message element
        var echecMessage = document.getElementById("echecMessage");

        // Check if the success message element exists
        if (echecMessage) {
            // Set the duration in milliseconds (e.g., 3000 milliseconds = 3 seconds)
            var duration = 4000;

            // Hide the success message after the specified duration
            setTimeout(function() {
                echecMessage.style.display = "none";
            }, duration);
        }
    });
document.addEventListener("DOMContentLoaded", function() {
            // Select the success message element
            var successMessage = document.getElementById("successMessage");

            // Check if the success message element exists
            if (successMessage) {
                // Set the duration in milliseconds (e.g., 3000 milliseconds = 3 seconds)
                var duration = 4000;

                // Hide the success message after the specified duration
                setTimeout(function() {
                    successMessage.style.display = "none";
                }, duration);
            }
        });
        document.addEventListener("DOMContentLoaded", function() {
                // Select the success message element
                var annonceMessage = document.getElementById("annonceMessage");

                // Check if the success message element exists
                if (annonceMessage) {
                    // Set the duration in milliseconds (e.g., 3000 milliseconds = 3 seconds)
                    var duration = 1000000;

                    // Hide the success message after the specified duration
                    setTimeout(function() {
                        annonceMessage.style.display = "none";
                    }, duration);
                }
            });
        document.addEventListener("DOMContentLoaded", function() {
      // Function to update the price based on the number of sessions
      function updatePrice() {
          var costPerSession = 149; // Replace this with your actual cost per session
          var nombreSeancesInput = document.getElementById("nombreSeances");
          var priceContainer = document.getElementById("priceContainer");

          // Check if the input is a valid number
          if (!isNaN(nombreSeancesInput.value) && nombreSeancesInput.value >= 0) {
              var numberOfSessions = parseInt(nombreSeancesInput.value);
              var totalPrice = costPerSession * numberOfSessions;

              // Display the price
              priceContainer.innerHTML = "Prix total: " + totalPrice + " DH";
          } else {
              // Display an error message or hide the price container if the input is invalid
              priceContainer.innerHTML = "Nombre de séances invalide";
          }
      }

      // Attach the updatePrice function to the input's input event
      var nombreSeancesInput = document.getElementById("nombreSeances");
      nombreSeancesInput.addEventListener("input", updatePrice);
  });

</script>



<button type="submit">Ajouter cet étudiant</button>

            </form>
        </div>
    </main>
</body>
</html>
