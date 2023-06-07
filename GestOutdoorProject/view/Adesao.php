<!DOCTYPE html>
<html>
    <head>
        <meta name="description" content="pagina about">
        <meta name="keywords" content="outdoor, xpto soluctions">
        <meta name="author" content="Rui Malemba">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Adesão</title>

        <!-- Cabecalho -->
        <?php include_once'includes/header.php'; ?>

        <?php
        //Provincia
        require_once '../controllers/ProvinciaControllers.php';

        $provinciacontroller = new ProvinciaControllers();

        $listaProvincia = $provinciacontroller->listarProvincias();
        $total = count($listaProvincia);

        //nacionalidade
        require_once '../controllers/NacionalidadeControllers.php';

        $nacionalidadeController = new NacionalidadeControllers();

        $listaNacionalidade = $nacionalidadeController->listarNacionalidades();
        $totalNacionalidades = count($listaNacionalidade);
        ?>
    <div class="slideshow">
        <div class="container">
            <div class="row">
                <div class="col-md-12 slideshow-text">
                    <h1>Faça a sua adesão</h1>
                    <p>Se já possui uma conta
                        <a href="Login.php" class="btn btn-dark slideshow-button">
                            Clique aqui para logar</a>
                    </p>
                </div>
            </div>
        </div>
    </div>

    <div class="section">
        <div class="container">
            <div class="row">
                <div class="col-md-3"></div>
                <div class="col-sm-12 col-xl-6">
                    <div class="bg-white rounded h-100 p-4 formulario-contacto" style="border: solid 1px #FFA500">
                        <h6 class="mb-4">Criar conta cliente</h6>
                        <?php 
                        
                        if(isset($_SESSION['sucesso-adesao'])) {?>
                    <div id="mensagemErro" class="alert alert-success mt-1" >
                        <?php   echo $_SESSION['sucesso-adesao']; ?> 
                    </div> <?php   } ?>
                     
                        <!-- Erro -->
                     <?php if(isset($_SESSION['erro-adesao'])) {?>
                    <div id="mensagemErro" class="alert alert-danger mt-1" >
                        <?php   echo $_SESSION['erro-adesao']; ?> 
                    </div> <?php   } session_destroy();?>
                        <nav>
                            <div class="nav nav-tabs" id="nav-tab" role="tablist">
                                <button class="nav-link active tabadesao" style="color: #FFA500;" id="nav-home-tab" data-bs-toggle="tab"
                                        data-bs-target="#nav-home" type="button" role="tab" aria-controls="nav-home"
                                        aria-selected="true">Dados pessoais</button>
                                <button class="nav-link tabadesao" style="color: #FFA500;" id="nav-profile-tab" data-bs-toggle="tab"
                                        data-bs-target="#nav-profile" type="button" role="tab"
                                        aria-controls="nav-profile" aria-selected="false">Endereço</button>
                                <button class="nav-link tabadesao" style="color: #FFA500;" id="nav-contact-tab" data-bs-toggle="tab"
                                        data-bs-target="#nav-contact" type="button" role="tab"
                                        aria-controls="nav-contact" aria-selected="false">Conta XPTO</button>
                            </div>
                        </nav>
                        <form method="post" action="../controllers/ClienteControllers.php" id="meu-form" enctype="multipart/form-data">
                            <div class="tab-content pt-3" id="nav-tabContent">
                                <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">

                                    <div class="form-group">
                                        <label for="foto">Foto:</label>
                                        <input type="file" id="foto" name="foto" accept="image/jpeg, image/png">

                                    </div>
                                    <div class="form-group">
                                        <label for="nome">Nome completo/Nome da empresa:</label>
                                        <input type="text" class="form-control" id="nome" name="nome" placeholder="Nome completo ou da empresa">
                                    </div>
                                    <div class="form-group">
                                        <label for="nacionalidade">Nacionalidade:</label>
                                        <select class="form-select custom-select" id="nacionalidade" name="nacionalidade">
                                            <?php for ($i = 0; $i < $totalNacionalidades; $i++) { ?>
                                            <option value="<?php echo $listaNacionalidade[$i]['codnacionalidade']; ?>"><?php echo $listaNacionalidade[$i]['nacionalidade']; ?></option>
                                        <?php } ?>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="tipocliente">Tipo de cliente:</label>
                                        <select class="form-select custom-select" id="tipocliente" name="tipocliente">
                                            <option>Empresa</option>
                                            <option>Particular</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="atividade">Atividade da empresa:</label>
                                        <input type="text" class="form-control" id="atividade" name="atividade" 
                                               placeholder="Atividade principal da sua empresa">
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">
                                    <div class="form-group">
                                        <label for="provincia">Província:</label>
                                        <select class="form-select" id="provincia" name="provincia">
                                            <?php for ($i = 0; $i < $total; $i++) { ?>
                                            <option value="<?php echo $listaProvincia[$i]['codprovincia']; ?>"><?php echo $listaProvincia[$i]['nome']; ?></option>
                                        <?php } ?>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="municipio">Município:</label>
                                        <select class="form-select" id="municipio" name="municipio">
                                            
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="comuna">Comuna:</label>
                                        <select class="form-select" id="comuna" name="comuna">
                                            
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="morada">Morada:</label>
                                        <input type="text" class="form-control" id="morada" name="morada" placeholder="Descrição do bairro, rua etc.">
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="nav-contact" role="tabpanel" aria-labelledby="nav-contact-tab">
                                    <div class="form-group">
                                        <label for="email">Endereço de email:</label>
                                        <input type="email" class="form-control" id="email" name="email" placeholder="Seu email">
                                    </div>
                                    <div class="form-group">
                                        <label for="telemovel">Telemóvel:</label>
                                        <input type="tel" class="form-control" id="telemovel" name="telemovel" placeholder="Insira o número de telefone">
                                    </div>
                                    <div class="form-group">
                                        <label for="username">Username:</label>
                                        <input type="text" class="form-control" id="username" name="username" placeholder="Crie um username">
                                    </div>
                                    <div class="form-group">
                                        <label for="password">Password:</label>
                                        <input type="password" class="form-control" id="password" name="password" placeholder="Crie uma password">
                                    </div>
                                    <div class="form-group">
                                        <label for="confirmapassword">Confirmação da Password:</label>
                                        <input type="password" class="form-control" id="confirmapassword" name="confirmapassword" placeholder="Insira a password criada">
                                    </div>
                                    <input type="hidden" name = "inserirCliente" value="1234"/>
                                    <button type="submit" class="btn btn-primary mt-2" name="submitAdesao" id="loginID">Salvar</button>
                                </div>
                            </div>
                        </form>

                    </div>
                </div>
                <div class="col-md3"></div>
            </div>
        </div>

    </div>




    <!-- Rodapé -->
    <?php
    include_once 'includes/footer.php';

    