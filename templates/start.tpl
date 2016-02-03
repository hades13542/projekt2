<!DOCTYPE HTML>
<html>
<head>
    <meta http-equiv="content-type" content="text/html" charset="UTF-8">
    <script type="text/JavaScript" src="js/skrypt.js"></script>
    <link rel="stylesheet" href="css/main.css" type="text/css" media="screen" >
    <title>Projekt 2</title>
    <?php echo $css ; ?>
</head>
<body>
<header>
    <h1>Zamówienia online</h1>
</header>
<ul>
    <li><a href="index.php?sub=start&action=index">Strona startowa</a></li>
    <li><a href="index.php?sub=start&action=rejestracja">Rejestracja</a></li>
    <li><a href="index.php?sub=start&action=logowanie">Logowanie</a></li>
    <li><a href="index.php?sub=start&action=zapis">Zamówienie</a></li>
    <li><a href="index.php?sub=start&action=wypisywanie">Twoje zamówienia</a></li>
    <li><a href="index.php?sub=start&action=wyloguj">Wyloguj</a></li>
</ul>
<main id="main">
    <?php echo $content ; ?>
</main>
</body>
</html>
