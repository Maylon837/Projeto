// ============================================================
// CM.ESG — Layout compartilhado (cabeçalho + rodapé)
// Como o site agora é HTML puro (sem servidor PHP), o cabeçalho
// e o rodapé ficam centralizados aqui e são inseridos nas páginas
// via JavaScript, evitando copiar o mesmo HTML em cada arquivo.
//
// Uso em cada página, logo antes de fechar </body>:
//   <div id="cabecalho-container"></div>   (no lugar do cabeçalho)
//   <div id="rodape-container"></div>      (no lugar do rodapé)
//   <script src="../js/layout.js"></script>
//
// Opções (defina ANTES do script de layout, se precisar):
//   <script>var CONFIG_CABECALHO = { barraProgresso: true, busca: true };</script>
// ============================================================

function htmlCabecalho(opcoes) {
    opcoes = opcoes || {};

    const barraProgresso = opcoes.barraProgresso ? `
        <div class="progresso-container">
            <div class="barra-progresso" id="progressoBarra"></div>
        </div>` : "";

    const busca = opcoes.busca ? `
            <div class="busca-container">
                <input type="text" id="campo-busca" class="campo-busca" placeholder="Pesquisar por tópico... (ex: governança, conclusão)" autocomplete="off">
                <div id="resultados-busca" class="resultados-busca"></div>
            </div>` : "";

    return `
${barraProgresso}
<header class="cabecalho-site" id="cabecalho-site">
    <div class="cabecalho-conteudo">
        <a href="index.html" class="cabecalho-logo">
            <img src="../imagens/logo-branca.png" alt="Logo CM ESG">
            <span>CM<strong>.ESG</strong></span>
        </a>
${busca}
        <button id="btn-menu-mobile" class="btn-menu-mobile" aria-label="Abrir menu">
            <span></span><span></span><span></span>
        </button>

        <nav class="cabecalho-nav" id="cabecalho-nav">
            <a href="index.html" class="nav-link">Home</a>
            <a href="sobre.html" class="nav-link">Sobre Nós</a>
            <a href="faleconosco.html" class="nav-link">Fale Conosco</a>
        </nav>
    </div>
</header>`;
}

function htmlRodape() {
    return `
<footer class="rodape-site">
    <div class="rodape-conteudo">

        <div class="rodape-newsletter">
            <h3>💬 Receba novidades sobre ESG</h3>
            <p>Assine nossa newsletter e fique por dentro de atualizações sobre sustentabilidade e governança.</p>
            <div class="ml-embedded" data-form="ekd6Mo"></div>
        </div>

        <div class="rodape-base">
            <span>🌿 &copy; 2025 CM.ESG — Todos os direitos reservados</span>
            <nav class="rodape-nav">
                <a href="index.html">Home</a>
                <a href="sobre.html">Sobre Nós</a>
                <a href="faleconosco.html">Fale Conosco</a>
            </nav>
        </div>

    </div>
</footer>`;
}

function carregarMailerLite() {
    if (window.__mailerliteCarregado) return;
    window.__mailerliteCarregado = true;
    (function(w,d,e,u,f,l,n){w[f]=w[f]||function(){(w[f].q=w[f].q||[])
    .push(arguments);},l=d.createElement(e),l.async=1,l.src=u,
    n=d.getElementsByTagName(e)[0],n.parentNode.insertBefore(l,n);})
    (window,document,'script','https://assets.mailerlite.com/js/universal.js','ml');
    ml('account', '1936898');
}

document.addEventListener("DOMContentLoaded", function () {
    const cabecalhoEl = document.getElementById("cabecalho-container");
    const rodapeEl = document.getElementById("rodape-container");

    if (cabecalhoEl) {
        cabecalhoEl.innerHTML = htmlCabecalho(window.CONFIG_CABECALHO || {});
    }
    if (rodapeEl) {
        rodapeEl.innerHTML = htmlRodape();
        carregarMailerLite();
    }

    // Avisa as outras telas de que o layout já está pronto no DOM
    // (a barra de progresso, a busca e o menu mobile dependem disso).
    document.dispatchEvent(new Event("layoutPronto"));
});
