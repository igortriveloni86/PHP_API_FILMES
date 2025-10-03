<?php
$apiKey = "KEY_AQUI";
$filme = null;

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $url = "http://www.omdbapi.com/?apikey={$apiKey}&i={$id}&plot=full";
    $response = file_get_contents($url);
    $filme = json_decode($response, true);
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Detalhes do Filme</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-dark text-light">
    <div class="container py-4">
        <?php if ($filme): ?>
            <div class="row">
                <div class="col-md-4">
                    <img src="<?= $filme['Poster'] !== "N/A" ? $filme['Poster'] : 'https://via.placeholder.com/300x450?text=Sem+Imagem' ?>" 
                         class="img-fluid rounded shadow">
                </div>
                <div class="col-md-8">
                    <h1 class="text-warning"><?= $filme['Title'] ?> (<?= $filme['Year'] ?>)</h1>
                    <p><strong>Gênero:</strong> <?= $filme['Genre'] ?></p>
                    <p><strong>Duração:</strong> <?= $filme['Runtime'] ?></p>
                    <p><strong>Diretor:</strong> <?= $filme['Director'] ?></p>
                    <p><strong>Atores:</strong> <?= $filme['Actors'] ?></p>
                    <p><strong>Nota IMDb:</strong> ⭐ <?= $filme['imdbRating'] ?>/10</p>
                    <p><strong>Enredo:</strong> <?= $filme['Plot'] ?></p>
                    <a href="index.php" class="btn btn-secondary mt-3">Voltar</a>
                </div>
            </div>
        <?php else: ?>
            <p class="text-center">Filme não encontrado 😢</p>
            <a href="index.php" class="btn btn-secondary">Voltar</a>
        <?php endif; ?>
    </div>
</body>
</html>
