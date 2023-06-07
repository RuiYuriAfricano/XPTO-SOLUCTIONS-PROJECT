<?php
// Iniciar a sessão
session_start();

// Verificar se o usuário está autenticado
if (isset($_SESSION['nomeadmin'])) {
    header('Location: admin/HomeAdmin.php'); // Redirecionar para a página de login se não estiver autenticado
    exit();
}
else if (isset($_SESSION['nomecliente'])) {
    header('Location: cliente/HomeCliente.php'); // Redirecionar para a página de login se não estiver autenticado
    exit();
}
?>
        <!-- Incluindo os arquivos CSS do Bootstrap -->
        <link href="../content/images/ico/logo.ico" rel="icon">
        <link rel="stylesheet" href="../content/bootstrap/css/bootstrap.min.css">
        <link rel="stylesheet" href="../content/bootstrap/fonts/bootstrap-icons-1.10.5/font/bootstrap-icons.css">
        <link rel="stylesheet" type="text/css" href="../content/css/style.css">
        
    </head>
    <body>
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark p-4">
            <div class="container">
                <!-- Logotipo -->
                <a class="navbar-brand" href="Home.php">
                    <img src="../content/images/logo.webp" alt="Logotipo" width="30" height="30" class="d-inline-block align-text-top">
                    XPTO SOLUCTIONS
                </a>

                <!-- Botão de menu para telas pequenas -->
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <!-- Opções do menu -->
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav">
                        <li class="nav-item" >
                            <a class="nav-link" id = "Home" href="Home.php">Página Inicial</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id = "sobre" href="About.php">Sobre</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="servicos" href="Services.php">Serviços</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="contacto" href="Contact.php">Contacto</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="login" href="Login.php">Entrar</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>