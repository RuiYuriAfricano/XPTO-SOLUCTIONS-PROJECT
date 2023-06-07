// Função para rolar até o topo da página
function scrollToTop() {
    window.scrollTo({
        top: 0,
        behavior: 'smooth'
    });
}

// Exibir ou ocultar o botão de rolar ao topo com base na posição da página
window.addEventListener('scroll', function () {
    var button = document.getElementById('btnScrollToTop');
    if (window.pageYOffset > 100) {
        button.style.display = 'block';
    } else {
        button.style.display = 'none';
    }
});