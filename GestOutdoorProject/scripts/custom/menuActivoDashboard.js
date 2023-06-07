// Obtém o caminho do arquivo atual
var path = window.location.pathname;

// Verifica cada link do menu e adiciona a classe "active" ao link correspondente
var menuLinks = document.querySelectorAll('.navbar-nav .nav-link');
for (var i = 0; i < menuLinks.length; i++) {
    var link = menuLinks[i];
    //alert('olá '+path+'=='+' '+link.getAttribute('href'));
    if (path.endsWith(link.getAttribute('href'))) {
        link.classList.add('active');
        
        if (link.getAttribute('href').indexOf("Gestor") !== -1) {
            var e = document.getElementById("GestorDPDW");
            e.classList.add('active');
        } 
        
        if (link.getAttribute('href').indexOf("ListarGestorAdmin") !== -1 || link.getAttribute('href').indexOf("InserirGestorAdmin") !== -1) {
            var dropdownLink = document.getElementById("GestorDPDW");
            dropdownLink.classList.add('active');
            var dropdownMenu = dropdownLink.nextElementSibling;
            dropdownMenu.classList.add('show');
        }
        
        break;
    }
}

