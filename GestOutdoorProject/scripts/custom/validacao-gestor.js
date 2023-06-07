
// Função para validar o formulário
function validarFormulario() {
    var nome = document.getElementById('nome').value;
    
    var provincia = document.getElementById('provincia').value;
    var municipio = document.getElementById('municipio').value;
    var comuna = document.getElementById('comuna').value;
    var morada = document.getElementById('morada').value;
    var email = document.getElementById('email').value;
    var telemovel = document.getElementById('telemovel').value;
    var username = document.getElementById('username').value;
    var password = document.getElementById('password').value;
    var confirmaPassword = document.getElementById('confirmapassword').value;

    // Expressão regular para validar o telefone em Angola (9xx-xxx-xxx)
    var telefoneRegex = /^[9][0-9]{8}$/;

    // Expressão regular para validar o email
    var emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

    // Expressão regular para validar apenas letras
    var letrasRegex = /^[\p{L}\s]+$/u;

    // Validar cada campo individualmente
    if (nome === '') {
        alert('Por favor, preencha o campo "Nome completo/Nome da empresa".');
        return false;
    } else if (!letrasRegex.test(nome)) {
        alert('Por favor, insira apenas nomes válidos "Nome completo/Nome da empresa".');
        return false;
    }

    if (provincia === '') {
        alert('Por favor, selecione uma província.');
        return false;
    }

    if (municipio === '') {
        alert('Por favor, selecione um município.');
        return false;
    }

    if (comuna === '') {
        alert('Por favor, selecione uma comuna.');
        return false;
    }

    if (morada === '') {
        alert('Por favor, preencha o campo "Morada".');
        return false;
    }

    if (email === '') {
        alert('Por favor, preencha o campo "Endereço de email".');
        return false;
    } else if (!emailRegex.test(email)) {
        alert('Por favor, insira um endereço de email válido.');
        return false;
    }

    if (telemovel === '') {
        alert('Por favor, preencha o campo "Telemóvel".');
        return false;
    } else if (!telefoneRegex.test(telemovel)) {
        alert('Por favor, insira um número de telefone válido no formato 9xx-xxx-xxx.');
        return false;
    }

    if (username === '') {
        alert('Por favor, preencha o campo "Username".');
        return false;
    }

    if (password === '') {
        alert('Por favor, preencha o campo "Password".');
        return false;
    }

    if (confirmaPassword === '') {
        alert('Por favor, preencha o campo "Confirmação da Password".');
        return false;
    }

    if (password !== confirmaPassword) {
        alert('A senha e a confirmação da senha não correspondem.');
        return false;
    }

    return true; // Retornar true se todos os campos estiverem válidos
}

// Associar a função de validação ao evento de envio do formulário
var formulario = document.getElementById('form-gestor');
var botaoEnviar = document.querySelector('button[name="submitInserir"]');

botaoEnviar.addEventListener('click', function (event) {
    event.preventDefault(); // Impedir o envio do formulário se a validação falhar
    if (validarFormulario()) {
        formulario.submit(); // Enviar o formulário se todos os campos estiverem válidos
    }
});


