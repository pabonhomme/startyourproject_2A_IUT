<html>
<head>
    <title>Erreur</title>
</head>
<body>
<h1>Erreur !!!!!</h1>
<?php
if (isset($Vueerreur)) {
    foreach ($Vueerreur as $value) {
        echo $value;
    }
}
if (isset($erreur)) {
    echo $erreur;
}
?>
</body>
</html>