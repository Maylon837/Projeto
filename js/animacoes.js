// ============================================================
// CM.ESG — Animações compartilhadas do site
// Sombra no cabeçalho ao rolar + animação de entrada dos blocos
// ============================================================

document.addEventListener("DOMContentLoaded", function () {

    // ---------- Sombra no cabeçalho ao rolar a página ----------
    const cabecalho = document.getElementById("cabecalho-site");
    if (cabecalho) {
        const aplicarSombra = () => {
            if (window.scrollY > 8) {
                cabecalho.classList.add("com-sombra");
            } else {
                cabecalho.classList.remove("com-sombra");
            }
        };
        aplicarSombra();
        window.addEventListener("scroll", aplicarSombra);
    }

    // ---------- Menu mobile (hambúrguer) ----------
    const btnMenuMobile = document.getElementById("btn-menu-mobile");
    const navMobile = document.getElementById("cabecalho-nav");
    if (btnMenuMobile && navMobile) {
        btnMenuMobile.addEventListener("click", function () {
            navMobile.classList.toggle("aberto");
        });
    }

    // ---------- Animação de entrada ao rolar (fade + sobe) ----------
    const alvos = document.querySelectorAll(
        "main h2, main p, main ul, main img, main .container-objetivo, main .pilar, .cartao-central"
    );

    alvos.forEach((el) => el.classList.add("reveal"));

    if ("IntersectionObserver" in window) {
        const observador = new IntersectionObserver(
            (entradas) => {
                entradas.forEach((entrada) => {
                    if (entrada.isIntersecting) {
                        entrada.target.classList.add("visivel");
                        observador.unobserve(entrada.target);
                    }
                });
            },
            { threshold: 0.12, rootMargin: "0px 0px -40px 0px" }
        );
        alvos.forEach((el) => observador.observe(el));
    } else {
        alvos.forEach((el) => el.classList.add("visivel"));
    }
});
