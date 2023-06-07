<!DOCTYPE html>
<html>
    <head>
        <meta name="description" content="pagina about">
        <meta name="keywords" content="outdoor, xpto soluctions">
        <meta name="author" content="Rui Malemba">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Login</title>

        <!-- Cabecalho -->
        <?php include_once'includes/header.php'; ?>

        
      
    <!--Spinner End -->
    <div class="slideshow">
        <div class="container">
            <div class="row">
                <div class="col-md-12 slideshow-text">
                    <h1>Iniciar sessão</h1>
                    <p>Se não possui uma conta
                        <a href="Adesao.php" class="btn btn-dark slideshow-button">
                            Clique aqui para aderir</a>
                    </p>
                </div>
            </div>
        </div>
    </div>

    <div class="section">
        <div class="container">
            <div class="row">
                <div class="col-md-3">
                    <!-- Espaço reservado -->
                </div>
                <div class="col-md-6">
                    <?php if(isset($_SESSION['erro'])) {?>
                    <div id="mensagemErro" class="alert alert-danger mt-1" >
                        <?php   echo $_SESSION['erro']; ?> 
                    </div> <?php unset($_SESSION['erro']);  session_destroy();} ?>
                    <div class="formulario-contacto">
                        <form method="post" action="../controllers/UserControllers.php" id="login">
                            <div class="form-group">
                                <label for="username" class="mb-3">Username:</label>
                                <input type="text" name="username" class="form-control" id="username" placeholder="Insira o seu username"
                                       required>
                            </div>
                            <div class="form-group">
                                <label for="password" class="mb-3">Password:</label>
                                <input type="password" name="password" class="form-control" id="password" placeholder="Sua password"
                                       required>
                            </div>
                            <br>
                            <button type="submit" class="btn btn-primary" name="loginbtn">Entrar no sistema</button>
                        </form>
                    </div>
                    
                </div>
                <div class="col-md-3">
                    <!-- Espaço reservado -->
                </div>
            </div>
        </div>
    </div>



    <!-- Rodapé -->
    <?php
    include_once 'includes/footer.php';

    