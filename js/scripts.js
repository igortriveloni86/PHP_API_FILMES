let paginaAtual = 1;
let termoBusca = "";

document.getElementById("btnBuscar").addEventListener("click", function () {
  termoBusca = document.getElementById("busca").value.trim();
  if (termoBusca === "") return alert("Digite o nome de um filme!");
  paginaAtual = 1;
  buscarFilmes();
});

function buscarFilmes() {
  fetch(
    `buscar.php?titulo=${encodeURIComponent(termoBusca)}&page=${paginaAtual}`
  )
    .then((res) => res.json())
    .then((data) => {
      let container = document.getElementById("resultados");
      let paginacao = document.getElementById("paginacao");
      container.innerHTML = "";
      paginacao.innerHTML = "";

      if (data.Search && data.Search.length > 0) {
        // Renderizar filmes
        data.Search.forEach((filme) => {
          container.innerHTML += `
                                <div class="col-6 col-md-4 col-lg-3">
                                    <div class="card bg-secondary text-light h-100">
                                        <img src="${
                                          filme.Poster !== "N/A"
                                            ? filme.Poster
                                            : "https://via.placeholder.com/180x250?text=Sem+Imagem"
                                        }" 
                                             class="card-img-top" alt="${
                                               filme.Title
                                             }">
                                        <div class="card-body d-flex flex-column">
                                            <h5 class="card-title">${
                                              filme.Title
                                            }</h5>
                                            <p class="card-text">(${
                                              filme.Year
                                            })</p>
                                            <a href="detalhes.php?id=${
                                              filme.imdbID
                                            }" class="btn btn-warning mt-auto">Ver Detalhes</a>
                                        </div>
                                    </div>
                                </div>`;
        });

        // Paginação
        let totalResultados = parseInt(data.totalResults);
        let totalPaginas = Math.ceil(totalResultados / 10);

        let htmlPaginacao = `<div class="btn-group">`;
        if (paginaAtual > 1) {
          htmlPaginacao += `<button class="btn btn-outline-warning" onclick="mudarPagina(${
            paginaAtual - 1
          })">⬅ Anterior</button>`;
        }
        htmlPaginacao += `<span class="btn btn-dark disabled">Página ${paginaAtual} de ${totalPaginas}</span>`;
        if (paginaAtual < totalPaginas) {
          htmlPaginacao += `<button class="btn btn-outline-warning" onclick="mudarPagina(${
            paginaAtual + 1
          })">Próxima ➡</button>`;
        }
        htmlPaginacao += `</div>`;

        paginacao.innerHTML = htmlPaginacao;
      } else {
        container.innerHTML = `<p class="text-center">Nenhum filme encontrado 😢</p>`;
      }
    })
    .catch((err) => {
      console.error(err);
      alert("Erro ao buscar filmes.");
    });
}

function mudarPagina(pagina) {
  paginaAtual = pagina;
  buscarFilmes();
}
