<?php
require_once '../dialogueBD.php';
try {
    $undlg = new DialogueBD();
    //$application  = $_POST['nom'];
    //$volume= $_POST['volume'];

    $res =$undlg->getTop5Applications();
} catch (Exception $ex) {
    $erreur = $ex->getMessage();
}
?>


<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8"/>
    <title>Top 5 des application consommatrice </title>
</head>
<body>
<?php
if (isset($erreur)) {
    echo "Erreur : $erreur";
}
?>
<h2>Top 5 des application consommatrice</h2>
<table>
    <?php
    foreach ($res as $ligne) {
        $nom1 = $ligne ['nom'];
        $volume1 = $ligne ['total_volume'];

        echo "<tr><td>$nom1</td><td>$volume1</td></tr> ";
    }

    ?>
</table>
</body>
</html>
