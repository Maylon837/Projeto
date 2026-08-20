// ============================================================
// CM.ESG — Busca por tópicos dentro da página
// Pesquisa nos títulos (h2) e nos pilares do ESG, e rola a
// página até o trecho encontrado.
// ============================================================

document.addEventListener("DOMContentLoaded", function () {

    const campo = document.getElementById("campo-busca");
    const caixaResultados = document.getElementById("resultados-busca");
    if (!campo || !caixaResultados) return; // busca não está nesta página

    // Monta o índice de itens pesquisáveis a partir do próprio conteúdo.
    const itens = [];

    document.querySelectorAll("main h2[id]").forEach((el) => {
        itens.push({
            id: el.id,
            titulo: el.textContent.trim(),
            categoria: "Seção",
            palavras: normalizar(el.textContent + " " + (el.dataset.busca || "")),
            tipo: "secao",
        });
    });

    document.querySelectorAll(".pilar-cabecalho[data-busca]").forEach((el) => {
        const titulo = el.querySelector(".pilar-titulo").textContent.trim();
        itens.push({
            id: el.closest(".pilar").id,
            titulo: titulo,
            categoria: "Pilar do ESG",
            palavras: normalizar(titulo + " " + el.dataset.busca),
            tipo: "pilar",
        });
    });

    function normalizar(texto) {
        return texto
            .toLowerCase()
            .normalize("NFD")
            .replace(/[\u0300-\u036f]/g, ""); // remove acentos
    }

    function buscar(consulta) {
        const termo = normalizar(consulta.trim());
        if (!termo) return [];
        return itens.filter((item) => item.palavras.includes(termo));
    }

    function renderizarResultados(lista, consulta) {
        caixaResultados.innerHTML = "";

        if (!consulta.trim()) {
            caixaResultados.classList.remove("aberto");
            return;
        }

        if (lista.length === 0) {
            const vazio = document.createElement("div");
            vazio.className = "resultado-busca-vazio";
            vazio.textContent = "Nenhum tópico encontrado para \"" + consulta + "\".";
            caixaResultados.appendChild(vazio);
            caixaResultados.classList.add("aberto");
            return;
        }

        lista.slice(0, 8).forEach((item) => {
            const link = document.createElement("a");
            link.href = "#" + item.id;
            link.className = "resultado-busca-item";
            link.innerHTML = item.titulo + "<small>" + item.categoria + "</small>";
            link.addEventListener("click", function (evento) {
                evento.preventDefault();
                irParaResultado(item);
                caixaResultados.classList.remove("aberto");
                campo.value = "";
                campo.blur();
            });
            caixaResultados.appendChild(link);
        });

        caixaResultados.classList.add("aberto");
    }

    function irParaResultado(item) {
        if (item.tipo === "pilar" && typeof window.irParaPilar === "function") {
            window.irParaPilar(item.id);
            return;
        }
        const alvo = document.getElementById(item.id);
        if (!alvo) return;
        alvo.scrollIntoView({ behavior: "smooth", block: "start" });
        alvo.classList.add("destaque-secao");
        setTimeout(() => alvo.classList.remove("destaque-secao"), 1600);
    }

    let temporizador = null;
    campo.addEventListener("input", function () {
        clearTimeout(temporizador);
        const valor = campo.value;
        temporizador = setTimeout(() => {
            renderizarResultados(buscar(valor), valor);
        }, 120);
    });

    campo.addEventListener("focus", function () {
        if (campo.value.trim()) {
            renderizarResultados(buscar(campo.value), campo.value);
        }
    });

    document.addEventListener("click", function (evento) {
        if (!caixaResultados.contains(evento.target) && evento.target !== campo) {
            caixaResultados.classList.remove("aberto");
        }
    });
});
