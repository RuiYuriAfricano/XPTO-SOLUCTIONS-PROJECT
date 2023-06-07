// Obtém o caminho da URL atual
var path = window.location.pathname;

// Verifica qual é a página atual e adiciona a classe 'active' ao item do menu correspondente
if (path.includes("Home")) {
    document.getElementById("Home").classList.add("activo");
} else if (path.includes("Services")) {
    document.getElementById("servicos").classList.add("activo");
} else if (path.includes("About")) {
    document.getElementById("sobre").classList.add("activo");
} else if (path.includes("Login")) {
    document.getElementById("login").classList.add("activo");
} else if (path.includes("Contact")) {
    document.getElementById("contacto").classList.add("activo");
}
