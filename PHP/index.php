<?php
session_start();
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CM.ESG</title>
    <link rel="stylesheet" href="../css/home.css">
    <link rel="stylesheet" href="../css/cabecalho.css">

</head>

<body>

    <div class="progresso-container">
        <div class="barra-progresso" id="progressoBarra"></div>
    </div>

    <header class="logo">
        <a href="../index.php">
            <img src="../IMAGENS/logo-branca.png" alt="Logo CM ESG" href="#index.php">
        </a>

        <nav>
            <a href="index.php" class="home">Home</a>
            <a href="../PHP/faleconosco.php" class="contato">Fale Conosco</a>
            <?php if (isset($_SESSION['user_id'])): ?>
                <div class="menu-perfil">
                    <button id="btn-perfil" onclick="toggleMenu()" class="home"> Conta </button>
                    <div id="menu-opcoes" class="menu-perfil-opcoes">
                        <a href="configuracao.php" class="menu-perfil-link">⚙️Configurações</a>
                        <a href="logout.php" class="menu-perfil-link">🚪 Sair</a>
                    </div>
                </div>
            <?php else: ?>
                <a href="cadastro.php" class="btn-cadastro">Cadastro</a>
                <a href="login.php" class="btn-login">Login</a>
            <?php endif; ?>
        </nav>
    </header>


    <div id="indice-lateral" class="indice-fechado">
        <button id="btn-alternar" onclick="alternarVisivel()">
            &raquo;
        </button>

        <div id="conteudo-indice">
            <h1>ÍNDICE</h1>
            <ul>
                <li><a href="#Introdução">Introdução</a></li>
                <li><a href="#O_que_e_esg">O que é ESG</a></li>
                <li><a href="#ESG_sigla">ESG sigla</a></li>
                <li><a href="#Aplicando">ESG na prática</a></li>
                <li><a href="#comprovar">Como comprovar praticas</a></li>
                <li><a href="#Objetivo_do_esg">Objetivo do ESG</a></li>
                <li><a href="#beneficio">Benefícios para as empresas</a></li>
                <li><a href="#conclusao">Conclusão</a></li>
            </ul>
        </div>
    </div>

    <main>

        <img src="../IMAGENS/principal.png" alt="Imagem principal" class="imagem-principal">
        <h1>ESG: Ambiental, Social e Governança</h1>


        <hr class="divisor-padrao" id="Introdução">


        <h2>Introdução</h2>

        <p>Nas últimas décadas, a preocupação com a sustentabilidade
            e a responsabilidade corporativa vem ganhando espaço em
            todo o mundo. Nesse contexto, o conceito de ESG
            (Ambiental, Social e Governança) tem se consolidado como
            um dos principais indicadores de comprometimento das
            empresas com práticas éticas e sustentáveis.
            A adoção de critérios ESG está crescendo de forma
            significativa, tanto no mercado internacional quanto no
            Brasil, impulsionada por investidores, consumidores e
            instituições que valorizam negócios mais conscientes. No
            cenário brasileiro, cada vez mais organizações estão
            incorporando estratégias voltadas à sustentabilidade
            ambiental, à inclusão social e à governança transparente,
            tornando o ESG um diferencial competitivo e um requisito
            para a perenidade das empresas.
        </p>


        <hr class="divisor-padrao" id="O_que_e_esg">


        <h2>O que é ESG?</h2>

        <p>ESG significa Environmental, Social and Governance — em
            português, Ambiental, Social e Governança.
        </p>
        <p>Essa sigla é usada para avaliar o quanto uma empresa está
            comprometida com práticas sustentáveis e responsáveis em
            três dimensões: meio ambiente, sociedade e gestão
            corporativa.
        </p>
        <p>O conceito de ESG ganhou força globalmente por reunir
            fatores que indicam como uma organização se posiciona
            diante dos desafios sociais e ambientais, alinhando suas
            ações aos **Objetivos de Desenvolvimento Sustentável (ODS)
            propostos pela ONU.
        </p>
        <p class="p-unico">**Os ODS são 17 metas criadas pela ONU para promover
            um mundo mais justo, sustentável e equilibrado até 2030.
        </p>
        <p>Mais do que um conjunto de regras, o ESG representa uma
            mudança de mentalidade empresarial, em que o lucro é
            buscado de forma ética, equilibrada e em harmonia com o
            meio ambiente e a sociedade.
        </p>


        <hr class="divisor-padrao" id="ESG_sigla">


        <h2>Sigla ESG</h2>

        <div>
            <img src="../IMAGENS/pilares3.jpg" alt="Os 3 pilares" class="imagem-pilares">
        </div>

        <h2>E - Ambiental (Environmental)</h2>

        <p>O pilar Ambiental avalia como a organização impacta o meio ambiente e de que forma integra práticas
            sustentáveis à sua estratégia de negócios.Esse aspecto envolve o uso eficiente de recursos naturais, a
            redução das emissões de gases de efeito estufa, a gestão responsável de resíduos e a adoção de tecnologias
            limpas e renováveis.
        </p>
        <p>Empresas bem avaliadas nesse pilar demonstram comprometimento com a mitigação de riscos ambientais,
            adaptação às mudanças climáticas e equilíbrio entre desenvolvimento econômico e preservação ambiental.
        </p>

        <p>Exemplos de ações ambientais:</p>
        <ul class="lista-pilares">
            <li><strong>Mudanças climáticas:</strong> implementação de políticas para reduzir impactos e emissões globais.</li>
            <li><strong>Emissões de carbono:</strong> monitoramento e compensação da pegada de carbono corporativa.</li>
            <li><strong>Poluição do ar e da água:</strong> controle e tratamento de efluentes e gases poluentes.</li>
            <li><strong>Consumo e uso responsável da energia:</strong> eficiência energética e priorização de fontes renováveis.</li>
            <li><strong>Gestão de resíduos:</strong> reciclagem, reutilização e descarte ambientalmente correto.</li>
            <li><strong>Embalagens sustentáveis:</strong> uso de materiais recicláveis e redução de plásticos de uso único.</li>
            <li><strong>Biodiversidade:</strong> proteção de ecossistemas e conservação de espécies nativas.</li>
            <li><strong>Desmatamento:</strong> prevenção de práticas de desmatamento e incentivo à restauração florestal.</li>
        </ul>

        <hr class="divisor-pilares">

        <h2>S - Social (Social)</h2>
        <p>O pilar Social analisa como a empresa se relaciona com pessoas e comunidades, tanto internamente (colaboradores)
            quanto externamente (clientes, fornecedores e sociedade).Esse aspecto está ligado à valorização do capital humano,
            respeito aos direitos humanos, inclusão social e contribuição positiva para o desenvolvimento das comunidades em que atua.
        </p>
        <p>Empresas com bom desempenho social se destacam por promover ambientes de trabalho justos e seguros,
            diversidade e igualdade de oportunidades, além de impactos sociais positivos.
        </p>

        <p>Exemplos de práticas sociais:</p>
        <ul class="lista-pilares">
            <li><strong>Diversidade e inclusão:</strong> políticas que valorizam gênero, raça, etnia, idade e acessibilidade.</li>
            <li><strong>Direitos humanos:</strong> garantia de condições dignas de trabalho e combate a práticas discriminatórias.</li>
            <li><strong>Engajamento comunitário:</strong> apoio a projetos sociais, culturais e educacionais nas comunidades locais.</li>
            <li><strong>Capacitação e desenvolvimento:</strong> treinamentos e oportunidades de crescimento para colaboradores.</li>
            <li><strong>Saúde e bem-estar:</strong> programas de qualidade de vida, apoio psicológico e benefícios sociais.</li>
            <li><strong>Responsabilidade com o consumidor:</strong> transparência, segurança e respeito nas relações de consumo.</li>
            <li><strong>Proteção de dados:</strong> cumprimento de normas como a LGPD, garantindo privacidade e segurança da informação.</li>
            <li><strong>Voluntariado corporativo:</strong> incentivo à participação de funcionários em ações sociais.</li>
        </ul>

        <hr class="divisor-pilares">

        <h2>G - Governaça (Governance)</h2>
        <p>O pilar Governança refere-se à estrutura de gestão e às práticas que garantem transparência, ética e responsabilidade nas decisões da empresa.
            Ele estabelece regras claras sobre como a organização é administrada, como os riscos são gerenciados e como os gestores prestam contas de suas ações.
        </p>
        <p>Empresas com boa governança se destacam por adotar práticas transparentes, decisões éticas e responsáveis, gestão eficaz de riscos e conformidade legal,
            fortalecendo a confiança de investidores, clientes e parceiros.
        </p>

        <p>Exemplos de boas práticas de governança:</p>
        <ul class="lista-pilares">
            <li><strong>Transparência:</strong> divulgação clara de relatórios financeiros e resultados.</li>
            <li><strong>Conformidade legal:</strong> cumprimento das leis, normas e políticas internas, evitando irregularidades.</li>
            <li><strong>Conselhos independentes:</strong> participação de membros que garantem decisões imparciais.</li>
            <li><strong>Auditorias internas e externas:</strong> verificação regular de processos e controles.</li>
            <li><strong>Gestão de riscos:</strong> identificação e mitigação de riscos operacionais, sociais e ambientais.</li>
            <li><strong>Ética corporativa:</strong> códigos de conduta e canais de denúncia eficazes.</li>
            <li><strong>Transparência com investidores:</strong> comunicação clara sobre estratégias e resultados.</li>
            <li><strong>Responsabilidade legal e regulatória:</strong> cumprimento das leis e normas vigentes.</li>
        </ul>


        <hr class="divisor-padrao" id="Aplicando">


        <h2>ESG na prática</h2>
        <p>Implementar o ESG exige planejamento e comprometimento, mas pode começar com passos simples e evoluir de forma gradual.</p>
        <ul type="square" class="lista-praticas">
            <li><strong>Diagnóstico:</strong> observe o que a empresa já faz nas áreas ambiental, social e de
                governança. Avalie pontos fortes e o que precisa ser aprimorado, como uso de recursos, políticas
                internas e impacto na comunidade.</li>

            <li><strong>Definição de metas:</strong> estabeleça objetivos claros e mensuráveis. <br><strong>Por exemplo:</strong>
                reduzir o consumo de energia, implantar coleta seletiva, promover diversidade no time ou aumentar a transparência na gestão.</li>

            <li><strong>Planejamento de ações:</strong> defina iniciativas práticas e envolva toda a equipe. Isso pode incluir campanhas
                de conscientização, treinamentos sobre ética e inclusão, revisão de fornecedores ou programas sociais.</li>

            <li><strong>Monitoramento e transparência:</strong> acompanhe os resultados, registre as melhorias e comunique os avanços de forma
                aberta e acessível. Ser transparente fortalece a confiança e a credibilidade da empresa.</li>

            <li><strong>Melhoria contínua:</strong>revise as ações regularmente e busque novas oportunidades para evoluir. ESG não é um projeto
                com fim — é um processo constante de crescimento e responsabilidade.</li>
        </ul>

        <hr class="divisor-padrao">


        <h2 id="comprovar">Como Comprovar Práticas ESG:</h2>
        <p>Não existe um “certificado ESG” único para todas as empresas, mas o mercado exige comprovação das práticas adotadas.
        </p>
        <p>Essa comprovação ocorre por meio de relatórios transparentes, certificações reconhecidas (como ISO 14001, SA8000 ou B Corp), auditorias externas,
            indicadores de desempenho (consumo de energia, diversidade, segurança no trabalho) e políticas internas documentadas (códigos de conduta, programas
            de inclusão, gestão de resíduos). Tudo isso valida o compromisso da empresa com os pilares Ambiental, Social e de Governança.
        </p>
        <p>Seguindo esses passos, a empresa inicia sua jornada sustentável, fortalece a cultura organizacional e demonstra responsabilidade
            social, ética e ambiental a colaboradores, clientes e sociedade.
        </p>

        <hr class="divisor-padrao" id="Objetivo_do_esg">


        <div class="container-objetivo">
            <h2>Objetivo do ESG</h2>
            <img src="../IMAGENS/objetivo.png" alt="" class="img-objetivo">

            <p>O principal objetivo do ESG é promover o desenvolvimento
                sustentável nas organizações, integrando fatores ambientais,
                sociais e de governança às estratégias de gestão.
                A proposta é incentivar empresas a atuarem de forma
                responsável, transparente e equilibrada, conciliando
                resultados econômicos com o respeito ao meio ambiente e à
                sociedade.
            </p>
            <p>Com isso, o ESG contribui para a longevidade dos negócios, o
                fortalecimento da reputação corporativa e o impacto positivo
                na comunidade e no planeta.
            </p>
        </div>


        <hr class="divisor-padrao" id="beneficio">


        <h2>Benefícios para as empresas</h2>
        <p>Empresas que investem em boas práticas ESG facilitam o
            caminho para atrair investimentos, fortalecer sua marca e
            reduzir custos operacionais.
        </p>
        <p>Nos últimos anos, a sigla ESG (Ambiental, Social e
            Governança) tornou-se um pilar essencial para empresas
            que não apenas prosperar financeiramente, mas
            também contribuir positivamente para a sociedade e o meio
            ambiente.
        </p>
        <p>Estudos recentes mostram que empresas que implementam
            práticas de ESG eficazes não apenas se destacam no
            mercado, mas também constroem uma reputação sólida e
            uma base de clientes fiéis. Além de melhorar sua imagem
            perante clientes e parceiros, essas empresas tornam-se mais
            eficientes, inovadoras e resilientes frente às mudanças do
            mercado.
        </p>


        <hr class="divisor-padrao" id="conclusao">


        <h2>Conclusão</h2>
        <p>O ESG representa uma nova forma de pensar o papel das
            empresas na sociedade.
            Mais do que uma tendência global, é uma estratégia
            essencial para garantir crescimento sustentável,
            transparência e responsabilidade corporativa.
        </p>
        <p>Ao integrar os pilares ambiental, social e de governança, as
            organizações assumem o compromisso de gerar valor não
            apenas econômico, mas também humano e ambiental.
            Adotar o ESG é investir em um futuro mais ético, equilibrado
            e sustentável — para as empresas, para as pessoas e para o
            planeta.
        </p>
        <img src="../IMAGENS/conclusao.png" alt="" class="conclusao">

    </main>

    <footer>
        <div class="direitos"><strong>&copy; 2025 CM - Todos os direitos reservados</strong></div>
        <div class="link-sobre-nos"><a href="sobre.php" class="link-rodape">Sobre Nós</a></div>
    </footer>

    <script src="../JS/progressoScroll.js"></script>
    <script src="../JS/indice.js"></script>
</body>

</html>