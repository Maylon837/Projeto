<?php
/**
 * Cabeçalho do site (logo + navegação + busca).
 * Inclua este arquivo dentro de <body>, nas páginas que ficam em /paginas.
 *
 * Antes de incluir, defina (opcional):
 *   $mostrar_barra_progresso = true;  // mostra a barrinha de progresso de leitura no topo
 *   $mostrar_busca = true;            // mostra a barra de pesquisa por tópicos (só faz sentido na index)
 */
?>
<?php if (!empty($mostrar_barra_progresso)): ?>
    <div class="progresso-container">
        <div class="barra-progresso" id="progressoBarra"></div>
    </div>
<?php endif; ?>

<header class="cabecalho-site" id="cabecalho-site">
    <div class="cabecalho-conteudo">
        <a href="index.php" class="cabecalho-logo">
            <img src="../imagens/logo-branca.png" alt="Logo CM ESG">
            <span>CM<strong>.ESG</strong></span>
        </a>

        <?php if (!empty($mostrar_busca)): ?>
            <div class="busca-container">
                <input type="text" id="campo-busca" class="campo-busca" placeholder="Pesquisar por tópico... (ex: governança, conclusão)" autocomplete="off">
                <div id="resultados-busca" class="resultados-busca"></div>
            </div>
        <?php endif; ?>

        <button id="btn-menu-mobile" class="btn-menu-mobile" aria-label="Abrir menu">
            <span></span><span></span><span></span>
        </button>

        <nav class="cabecalho-nav" id="cabecalho-nav">
            <a href="index.php" class="nav-link">Home</a>
            <a href="sobre.php" class="nav-link">Sobre Nós</a>
            <a href="faleconosco.php" class="nav-link">Fale Conosco</a>
        </nav>
    </div>
</header>
