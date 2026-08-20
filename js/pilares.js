// ============================================================
// CM.ESG — Acordeão dos 3 pilares (Ambiental, Social, Governança)
// ============================================================

function abrirPilar(pilarEl) {
    const conteudo = pilarEl.querySelector(".pilar-conteudo");
    pilarEl.classList.add("aberto");
    conteudo.style.maxHeight = conteudo.scrollHeight + "px";
}

function fecharPilar(pilarEl) {
    const conteudo = pilarEl.querySelector(".pilar-conteudo");
    pilarEl.classList.remove("aberto");
    conteudo.style.maxHeight = 0;
}

document.addEventListener("DOMContentLoaded", function () {
    document.querySelectorAll(".pilar").forEach((pilarEl) => {
        const botao = pilarEl.querySelector(".pilar-cabecalho");
        botao.addEventListener("click", function () {
            const jaAberto = pilarEl.classList.contains("aberto");
            if (jaAberto) {
                fecharPilar(pilarEl);
            } else {
                abrirPilar(pilarEl);
            }
        });
    });
});

// Usado pela busca por tópicos: abre o pilar certo e rola até ele.
window.irParaPilar = function (id) {
    const pilarEl = document.getElementById(id);
    if (!pilarEl) return;
    abrirPilar(pilarEl);
    setTimeout(() => {
        pilarEl.scrollIntoView({ behavior: "smooth", block: "center" });
    }, 60);
};
