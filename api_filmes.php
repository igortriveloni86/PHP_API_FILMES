<?php
// Substitua pela sua chave da OMDb
$apiKey = "b4acede7";

// Verifica se o usuário digitou algo
$filmes = [];
if (isset($_GET['titulo']) && !empty($_GET['titulo'])) {
    $titulo = urlencode($_GET['titulo']);
    $url = "http://www.omdbapi.com/?apikey={$apiKey}&s={$titulo}&type=movie";
    $response = file_get_contents($url);
    $dados = json_decode($response, true);

    if (isset($dados['Search'])) {
        $filmes = $dados['Search'];
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Catálogo de Filmes</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <h1>🎬 Catálogo de Filmes</h1>
    <form method="GET">
        <input type="text" name="titulo" placeholder="Digite o nome do filme..." value="<?= isset($_GET['titulo']) ? htmlspecialchars($_GET['titulo']) : '' ?>">
        <button type="submit">Buscar</button>
    </form>

    <div class="grid">
        <?php if (!empty($filmes)): ?>
            <?php foreach ($filmes as $filme): ?>
                <div class="card">
                    <img src="<?= $filme['Poster'] !== "N/A" ? $filme['Poster'] : 'https://via.placeholder.com/180x250?text=Sem+Imagem' ?>" alt="<?= $filme['Title'] ?>">
                    <h3><?= $filme['Title'] ?></h3>
                    <p>(<?= $filme['Year'] ?>)</p>
                </div>
            <?php endforeach; ?>
        <?php elseif (isset($_GET['titulo'])): ?>
            <p>Nenhum filme encontrado 😢</p>
        <?php endif; ?>
    </div>
</body>
</html>
