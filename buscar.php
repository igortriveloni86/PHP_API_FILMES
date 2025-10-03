<?php
header("Content-Type: application/json");

$apiKey = "KEY_AQUI";

$resultado = [];

if (isset($_GET['titulo']) && !empty($_GET['titulo'])) {
    $titulo = urlencode($_GET['titulo']);
    $pagina = isset($_GET['page']) ? (int)$_GET['page'] : 1;
    
    $url = "http://www.omdbapi.com/?apikey={$apiKey}&s={$titulo}&type=movie&page={$pagina}";
    $response = file_get_contents($url);
    $resultado = json_decode($response, true);
}

echo json_encode($resultado);
