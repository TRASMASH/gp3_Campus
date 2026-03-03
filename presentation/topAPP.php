<?php
require_once '../dialogueBD.php';
try {
    $undlg = new DialogueBD();
    $res = $undlg->getTop5Applications();

    // On prépare deux tableaux vides pour le graphique JS
    $labels_app = [];
    $data_app = [];

    foreach ($res as $ligne) {
        $labels_app[] = $ligne['nom'];
        $data_app[] = round($ligne['total_volume'], 2);
    }
} catch (Exception $ex) {
    $erreur = $ex->getMessage();
}
?>

<?php if (isset($erreur)) echo "<p style='color:red;'>Erreur : $erreur</p>"; ?>

<h2>Top 5 des applications les plus consommatrices</h2>

<div class="chart-container">
    <canvas id="chartTopApp"></canvas>
</div>

<table>
    <tr>
        <th>Nom de l'application</th>
        <th>Consommation Totale</th>
    </tr>
    <?php foreach ($res as $ligne): ?>
        <tr>
            <td><?= htmlspecialchars($ligne['nom']) ?></td>
            <td><?= round($ligne['total_volume'], 2) ?></td>
        </tr>
    <?php endforeach; ?>
</table>

<script>
    new Chart(document.getElementById('chartTopApp'), {
        type: 'bar', // Type de graphique (barres)
        data: {
            labels: <?= json_encode($labels_app) ?>, // On injecte les noms depuis PHP
            datasets: [{
                label: 'Consommation Totale',
                data: <?= json_encode($data_app) ?>, // On injecte les volumes depuis PHP
                backgroundColor: 'rgba(54, 162, 235, 0.5)',
                borderColor: 'rgba(54, 162, 235, 1)',
                borderWidth: 1
            }]
        }
    });

</script>