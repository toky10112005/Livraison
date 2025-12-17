<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bénéfice par Période</title>
    <link href="/Assets/CSS/bootstrap/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container my-4">
        <h1 class="mb-4 text-center">Bénéfice par Période</h1>

        <!-- Bénéfice par Jour -->
        <section class="mb-5">
            <h2 class="mb-3">Bénéfice par Jour</h2>
            <?php if (!empty($Jour)): ?>
                <div class="table-responsive">
                    <table class="table table-bordered table-striped text-center align-middle">
                        <thead class="table-light">
                            <tr>
                                <th>Jour</th>
                                <th>Chiffre d'Affaire</th>
                                <th>Coût Total</th>
                                <th>Bénéfice</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach($Jour as $row): ?>
                            <tr>
                                <td><?= htmlspecialchars($row['jour'] ?? '') ?></td>
                                <td><?= htmlspecialchars($row['chiffre_affaire'] ?? '') ?></td>
                                <td><?= htmlspecialchars($row['cout_total'] ?? '') ?></td>
                                <td class="<?= ($row['benefice'] ?? 0) >= 0 ? 'text-success fw-bold' : 'text-danger fw-bold' ?>">
                                    <?= htmlspecialchars($row['benefice'] ?? '') ?>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            <?php else: ?>
                <div class="alert alert-info">Aucune livraison terminée n'est disponible pour le calcul du bénéfice par jour.</div>
            <?php endif; ?>
        </section>

        <!-- Bénéfice par Mois -->
        <section class="mb-5">
            <h2 class="mb-3">Bénéfice par Mois</h2>
            <?php if (!empty($Mois)): ?>
                <div class="table-responsive">
                    <table class="table table-bordered table-striped text-center align-middle">
                        <thead class="table-light">
                            <tr>
                                <th>Année</th>
                                <th>Mois</th>
                                <th>Bénéfice</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach($Mois as $row): ?>
                            <tr>
                                <td><?= htmlspecialchars($row['annee'] ?? '') ?></td>
                                <td><?= htmlspecialchars($row['mois'] ?? '') ?></td>
                                <td class="<?= ($row['benefice'] ?? 0) >= 0 ? 'text-success fw-bold' : 'text-danger fw-bold' ?>">
                                    <?= htmlspecialchars($row['benefice'] ?? '') ?>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            <?php else: ?>
                <div class="alert alert-info">Aucune donnée disponible pour le bénéfice par mois.</div>
            <?php endif; ?>
        </section>

        <!-- Bénéfice par Année -->
        <section>
            <h2 class="mb-3">Bénéfice par Année</h2>
            <?php if (!empty($Annee)): ?>
                <div class="table-responsive">
                    <table class="table table-bordered table-striped text-center align-middle">
                        <thead class="table-light">
                            <tr>
                                <th>Année</th>
                                <th>Bénéfice</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach($Annee as $row): ?>
                            <tr>
                                <td><?= htmlspecialchars($row['annee'] ?? '') ?></td>
                                <td class="<?= ($row['benefice'] ?? 0) >= 0 ? 'text-success fw-bold' : 'text-danger fw-bold' ?>">
                                    <?= htmlspecialchars($row['benefice'] ?? '') ?>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            <?php else: ?>
                <div class="alert alert-info">Aucune donnée disponible pour le bénéfice par année.</div>
            <?php endif; ?>
        </section>
    </div>

   
</body>
</html>