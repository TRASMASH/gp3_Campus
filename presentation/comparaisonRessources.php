<?php
require_once '../dialogueBD.php';
try {
    $undlg = new DialogueBD();
    $res = $undlg->getComparaisonRessources();

    $labels_comp = [];
    $data_stockage = [];
    $data_reseau = [];

    foreach ($res as $ligne) {
        $labels_comp[] = date('m/Y', strtotime($ligne['mois']));
        $data_stockage[] = round($ligne['vol_stockage'], 2);
        $data_reseau[] = round($ligne['vol_reseau'], 2);
    }
} catch (Exception $ex) {
    $erreur = $ex->getMessage();
}
?>

<?php if (isset($erreur)) echo "<p style='color:red;'>Erreur : $erreur</p>"; ?>

<h2>Comparaison Stockage vs Réseau</h2>

<div class="chart-container">
    <canvas id="chartComparaison"></canvas>
</div>

<table>
    <tr>
        <th>Mois</th>
        <th>Volume Stockage</th>
        <th>Volume Réseau</th>
    </tr>
    <?php foreach ($res as $ligne): ?>
        <tr>
            <td><?= date('m/Y', strtotime($ligne['mois'])) ?></td>
            <td><?= round($ligne['vol_stockage'], 2) ?></td>
            <td><?= round($ligne['vol_reseau'], 2) ?></td>
        </tr>
    <?php endforeach; ?>
</table>

<script>
    new Chart(document.getElementById('chartComparaison'), {
        type: 'bar',
        data: {
            labels: <?= json_encode($labels_comp) ?>,
            datasets: [
                {
                    label: 'Stockage',
                    data: <?= json_encode($data_stockage) ?>,
                    backgroundColor: 'rgba(255, 99, 132, 0.6)',
                    borderColor: 'rgba(255, 99, 132, 1)',
                    borderWidth: 1
                },
                {
                    label: 'Réseau',
                    data: <?= json_encode($data_reseau) ?>,
                    backgroundColor: 'rgba(153, 102, 255, 0.6)',
                    borderColor: 'rgba(153, 102, 255, 1)',
                    borderWidth: 1
                }
            ]
        }
    });
</script>