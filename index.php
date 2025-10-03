<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Catálogo de Filmes</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-dark text-light">
    <div class="container py-4">
        <h1 class="text-warning text-center mb-4">🎬 Catálogo de Filmes</h1>
        
        <!-- Busca -->
        <div class="d-flex justify-content-center mb-4">
            <input type="text" id="busca" class="form-control w-50 me-2" placeholder="Digite o nome do filme...">
            <button id="btnBuscar" class="btn btn-warning">Buscar</button>
        </div>

        <!-- Resultados -->
        <div id="resultados" class="row g-4"></div>

        <!-- Paginação -->
        <div id="paginacao" class="d-flex justify-content-center mt-4"></div>
    </div>

   <script src="js/scripts.js"></script>
</body>
</html>
