<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8"/>
    <title>Tableau de bord - Campus IT</title>
    <link rel="stylesheet" type="text/css" href="style.css" />
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
        /* Un peu de style pour les tableaux */
        table { width: 100%; border-collapse: collapse; margin-top: 20px; margin-bottom: 40px; }
        th, td { border: 1px solid #ccc; padding: 10px; text-align: left; }
        th { background-color: #f4f4f4; }
        /* Conteneur pour limiter la taille des graphiques */
        .chart-container { width: 70%; margin: 0 auto 30px auto; }
    </style>
</head>
<body>
<body>
<div class="tab">
    <button class="tablinks" onclick="openTab(event, 'Tab1')" id="defaultOpen">Top 5 Applications</button>
    <button class="tablinks" onclick="openTab(event, 'Tab2')">Évolution Mensuelle</button>
    <button class="tablinks" onclick="openTab(event, 'Tab3')">Comparaison Ressources</button>
</div>

<div id="Tab1" class="tabcontent">
    <?php include("../presentation/topAPP.php"); ?>
</div>

<div id="Tab2" class="tabcontent">
    <?php include("../presentation/evolutionMensuelle.php"); ?>
</div>

<div id="Tab3" class="tabcontent">
    <?php include("../presentation/comparaisonRessources.php"); ?>
</div>

<script src="script.js"></script>
<script>document.getElementById("defaultOpen").click();</script>
</body>

</html>