<?php
// Iniciar a sessão
session_start();

// Verificar se o usuário está autenticado
if (!isset($_SESSION['nomecliente'])) {
    header('Location: Login.php'); // Redirecionar para a página de login se não estiver autenticado
    exit();
}

// Para logout

if (isset($_POST['logout'])) {
    // Limpar a sessão e redirecionar para a página de login
    session_unset();
    session_destroy();
    header('Location: Login.php');
    exit();
}
?>

<?php
        require_once '../controllers/ClienteControllers.php';

        $clientecontroller = new ClienteControllers();
        $listaClientes = $clientecontroller->listarClientes();
        $total = count($listaClientes);

        $codCliente = $_SESSION['coduser'];

        $clienteEncontrado = null;

        for ($i = 0; $i < $total; $i++) {
            if ($listaClientes[$i]['coduser'] == $codCliente) {
                $clienteEncontrado = $listaClientes[$i];
                break;
            }
        }
        
        

        ?>

<!-- Favicon -->
    <link href="../content/images/ico/logo.ico" rel="icon">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;600&family=Roboto:wght@500;700&display=swap" rel="stylesheet"> 
    
    <!-- Icon Font Stylesheet -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="../scripts/pages-admin-customer-manager/lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">
    <link href="../scripts/pages-admin-customer-manager/lib/tempusdominus/css/tempusdominus-bootstrap-4.min.css" rel="stylesheet" />

    <!-- Customized Bootstrap Stylesheet -->
    <link href="../content/pages-admin-customer-manager/css/bootstrap.min.css" rel="stylesheet">

    <!-- Template Stylesheet -->
    <link href="../content/pages-admin-customer-manager/css/style.css" rel="stylesheet">
</head>

<body>
    <div class="container-fluid position-relative d-flex p-0">
        <!-- Spinner Start 
        <div id="spinner" class="show bg-dark position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
            <div class="spinner-border text-primary" style="width: 3rem; height: 3rem;" role="status">
                <span class="sr-only">Loading...</span>
            </div>
        </div>
        <!-- Spinner End -->


        <!-- Sidebar Start -->
        <div class="sidebar pe-4 pb-3">
            <nav class="navbar bg-secondary navbar-dark">
                <a href="index.html" class="navbar-brand mx-4 mb-3">
                    <h6 class="text-primary"><img class="rounded-circle" src="../content/pages-admin-customer-manager/img/logo.webp" alt="" style="width: 40px; height: 40px;"> XPTO SOLUTIONS</h6>
                </a>
                <div class="d-flex align-items-center ms-4 mb-4">
                    <div class="position-relative">
                        <img class="rounded-circle" src=<?php echo $clienteEncontrado['fotografia'];  ?> alt="" style="width: 40px; height: 40px;">
                        <div class="bg-success rounded-circle border border-2 border-white position-absolute end-0 bottom-0 p-1"></div>
                    </div>
                    <div class="ms-3">
                        <h6 class="mb-0"><?php echo $clienteEncontrado['nomeCompleto']; ?></h6>
                        <span>Cliente</span>
                    </div>
                </div>
                <div class="navbar-nav w-100">
                    <a href="HomeCliente.php" class="nav-item nav-link"><i class="fa fa-home me-2"></i>Home</a>
                    
                    <a href="AtualizarDadosCliente.php" class="nav-item nav-link"><i class="fa fa-user-edit me-2"></i>Atualizar dados</a>
                    <a href="#" class="nav-item nav-link"><i class="fa fa-file me-2"></i>Comprovativo</a>
                    <div class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown"><i class="fa fa-bullhorn me-2"></i>Outdoors</a>
                        <div class="dropdown-menu bg-transparent border-0">
                            <a href="#" class="dropdown-item">Solicitar aluguer</a>
                            <a href="#" class="dropdown-item">Listar solicitações</a>
                        </div>
                    </div>
                </div>
            </nav>
        </div>
        <!-- Sidebar End -->


        <!-- Content Start -->
        <div class="content">
            <!-- Navbar Start -->
            <nav class="navbar navbar-expand bg-secondary navbar-dark sticky-top px-4 py-0">
                <a href="index.html" class="navbar-brand d-flex d-lg-none me-4">
                    <h2 class="text-primary mb-0"><i class="fa fa-user-edit"></i></h2>
                </a>
                <a href="#" class="sidebar-toggler flex-shrink-0">
                    <i class="fa fa-bars"></i>
                </a>
                <form class="d-none d-md-flex ms-4">
                    <input class="form-control bg-dark border-0" type="search" placeholder="Pesquisar">
                </form>
                <div class="navbar-nav align-items-center ms-auto">
                    <div class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">
                            <i class="fa fa-envelope me-lg-2"></i>
                            <span class="d-none d-lg-inline-flex">Mensagens</span>
                        </a>
                        <div class="dropdown-menu dropdown-menu-end bg-secondary border-0 rounded-0 rounded-bottom m-0">
                            <a href="#" class="dropdown-item">
                                <div class="d-flex align-items-center">
                                    <img class="rounded-circle" src="../content/pages-admin-customer-manager/img/user.jpg" alt="" style="width: 40px; height: 40px;">
                                    <div class="ms-2">
                                        <h6 class="fw-normal mb-0">Jhon send you a message</h6>
                                        <small>15 minutes ago</small>
                                    </div>
                                </div>
                            </a>
                            <hr class="dropdown-divider">
                            <a href="#" class="dropdown-item">
                                <div class="d-flex align-items-center">
                                    <img class="rounded-circle" src="../content/pages-admin-customer-manager/img/user.jpg" alt="" style="width: 40px; height: 40px;">
                                    <div class="ms-2">
                                        <h6 class="fw-normal mb-0">Jhon send you a message</h6>
                                        <small>15 minutes ago</small>
                                    </div>
                                </div>
                            </a>
                            <hr class="dropdown-divider">
                            <a href="#" class="dropdown-item">
                                <div class="d-flex align-items-center">
                                    <img class="rounded-circle" src="../content/pages-admin-customer-manager/img/user.jpg" alt="" style="width: 40px; height: 40px;">
                                    <div class="ms-2">
                                        <h6 class="fw-normal mb-0">Jhon send you a message</h6>
                                        <small>15 minutes ago</small>
                                    </div>
                                </div>
                            </a>
                            <hr class="dropdown-divider">
                            <a href="#" class="dropdown-item text-center">Ver todas mensagens</a>
                        </div>
                    </div>
                    
                    <div class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">
                            <img class="rounded-circle me-lg-2" src=<?php echo $clienteEncontrado['fotografia'];  ?> alt="" style="width: 40px; height: 40px;">
                            <span class="d-none d-lg-inline-flex"><?php echo $clienteEncontrado['nomeCompleto']; ?></span>
                        </a>
                        <div class="dropdown-menu dropdown-menu-end bg-secondary border-0 rounded-0 rounded-bottom m-0">
                            <a href="AtualizarDadosCliente.php" class="dropdown-item">Meu perfil</a>
                            <form action="HomeCliente.php" method="post">
                                <a href="#" class="dropdown-item"><button class="btn btn-primary" type="submit" name="logout">Terminar sessão</button></a>
                            </form>
                        </div>
                    </div>
                </div>
            </nav>
            <!-- Navbar End -->
