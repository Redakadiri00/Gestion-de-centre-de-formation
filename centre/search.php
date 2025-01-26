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

        header, nav {
            background: linear-gradient(95deg, #5533ff 40%, #25ddf5 100%);
            color: #fff;
            text-align: center;
            padding: 20px;
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

        .search-container {
            max-width: 600px;
            margin: auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .search-container h2, .search-container label {
            color: #394240;
        }

        .search-container input {
            width: 100%;
            padding: 10px;
            margin-bottom: 16px;
            box-sizing: border-box;
        }

        .search-container button {
            background-color: #3ecf8e;
            color: #fff;
            padding: 12px 24px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
            transition: background-color 0.3s ease;
        }

        .search-container button:hover {
            background-color: #1a1d1e;
        }

        .button-container {
            text-align: center;
            margin-top: 20px;
        }

        .button-container a {
            text-decoration: none;
        }

        .button-container button {
            display: inline-block;
            background-color: #ccc;
            color: #fff;
            padding: 8px 16px;
            border: none;
            font-size: 14px;
            cursor: pointer;
            margin-right: 10px;
            transition: background-color 0.3s ease;
        }

        .button-container button:hover {
            background-color: #555;
        }
    </style>
</head>
<body>
    <header>
        <h1>Recherche d'étudiants</h1>
    </header>
    <nav>
        <ul>
            <li><a href="http://localhost/centre/ajouter.php#">Ajouter un étudiant</a></li>
            <li><a href="http://localhost/centre/search.php#">Chercher un étudiant</a></li>
            <li><a href="http://localhost/centre/addabscent.php#">Ajouter absence</a></li>
            <li><a href="http://localhost/centre/abscent.php">Voir les absences</a></li>
            <li><a href="http://localhost/centre/emploie.php">Voir emplois</a></li>
            <li><a href="http://localhost/centre/testdelete.php#">Voir les groupes</a></li>
            <li><a href="http://localhost/centre/voiretud.php">Voir les étudiants</a></li>
            <li><a href="http://localhost/centre/voirProfs.php">Voir les profs</a></li>
            <li><a href="http://localhost/centre/main.php">Revenir à l'accueil</a></li>
        </ul>
    </nav>
    <main>
        <div class="search-container">
            <h2>Chercher un étudiant</h2>
            <form action="testsearch.php" method="post">
                <label for="searchByCode">Chercher par le nom :</label><br><br>
                <input type="text" id="searchByCode" name="Code" required>
                <button type="submit">Chercher</button>
            </form>
        </div>
        <div class="button-container">
            <a href="chercherprenom.php">
                <button style="background-color: #ccc; color: #fff; padding: 8px 16px; border: none; font-size: 14px; cursor: pointer;">
                    Chercher par le prénom ?
                </button>
            </a>
            <a href="chercherid.php">
                <button style="background-color: #2E7D32; color: #fff; padding: 8px 16px; border: none; font-size: 14px; cursor: pointer;">
                    Chercher par l'ID ?
                </button>
            </a>
        </div>
    </main>
</body>
</html>
