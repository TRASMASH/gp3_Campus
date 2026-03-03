<?php
require_once '../dialogueBD.php';
try {
    $undlg = new DialogueBD();
    $res = $undlg->getEvolutionMensuelle();

    $labels_mois = [];
    $data_evo = [];

    foreach ($res as $ligne) {
        $labels_mois[] = date('m/Y', strtotime($ligne['mois']));
        $data_evo[] = round($ligne['total_volume'], 2);
    }
} catch (Exception $ex) {
    $erreur = $ex->getMessage();
}
?>

<?php if (isset($erreur)) echo "<p style='color:red;'>Erreur : $erreur</p>"; ?>

<h2>Évolution mensuelle (Janvier - Juin 2025)</h2>

<div class="chart-container">
    <canvas id="chartEvolution"></canvas>
</div>

<table>
    <tr>
        <th>Mois</th>
        <th>Consommation Totale</th>
    </tr>
    <?php foreach ($res as $ligne): ?>
        <tr>
            <td><?= date('m/Y', strtotime($ligne['mois'])) ?></td>
            <td><?= round($ligne['total_volume'], 2) ?></td>
        </tr>
    <?php endforeach; ?>
</table>

<script>
    new Chart(document.getElementById('chartEvolution'), {
        type: 'line', // Courbe pour montrer une évolution
        data: {
            labels: <?= json_encode($labels_mois) ?>,
            datasets: [{
                label: 'Consommation globale',
                data: <?= json_encode($data_evo) ?>,
                backgroundColor: 'rgba(75, 192, 192, 0.2)',
                borderColor: 'rgba(75, 192, 192, 1)',
                borderWidth: 2,
                tension: 0.3 // Rend la courbe légèrement arrondie
            }]
        }
    });
</script>