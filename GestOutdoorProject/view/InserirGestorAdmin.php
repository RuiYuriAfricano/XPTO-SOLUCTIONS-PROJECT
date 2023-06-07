<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="utf-8">
        <title>Visualizar gestor - Administrador</title>
        <meta content="width=device-width, initial-scale=1.0" name="viewport">
        <meta content="" name="keywords">
        <meta content="" name="description">

        <?php include_once 'admin/includes/header.php'; ?>
        <!-- Navbar End -->
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
        <!-- Recent Sales Start -->
    <div class="container-fluid pt-4 px-4">
        <div class="bg-secondary rounded p-4">
            <?php if (isset($_SESSION['sucesso-inserir'])) { ?>
                <div id="mensagemErro" class="alert alert-success mt-1" >
                <?php echo $_SESSION['sucesso-inserir']; ?> 
                </div> <?php unset($_SESSION['sucesso-inserir']);
        } ?>

            <!-- Erro -->
            <?php if (isset($_SESSION['erro-inserir'])) { ?>
                <div id="mensagemErro" class="alert alert-danger mt-1" >
                    <?php echo $_SESSION['erro-inserir']; ?> 
                </div> <?php unset($_SESSION['erro-inserir']);
                } ?>
            <div class="d-flex align-items-center justify-content-between mb-4">
                <h6 class="mb-0">Inserir novo gestor</h6>
                <a href="ListarGestorAdmin.php">Ver os registrados</a>
            </div>
            <div class="col-sm-12 col-xl-6">
                <div class="bg-secondary rounded h-100 p-4">
                    <nav>
                        <div class="nav nav-tabs" id="nav-tab" role="tablist">
                            <button class="nav-link active" id="nav-home-tab" data-bs-toggle="tab"
                                    data-bs-target="#nav-home" type="button" role="tab" aria-controls="nav-home"
                                    aria-selected="true">Dados pessoais</button>
                            <button class="nav-link" id="nav-profile-tab" data-bs-toggle="tab"
                                    data-bs-target="#nav-profile" type="button" role="tab"
                                    aria-controls="nav-profile" aria-selected="false">Endereço</button>
                            <button class="nav-link" id="nav-contact-tab" data-bs-toggle="tab"
                                    data-bs-target="#nav-contact" type="button" role="tab"
                                    aria-controls="nav-contact" aria-selected="false">Conta XPTO</button>
                        </div>
                    </nav>
                    <form method="post" action="../controllers/GestorControllers.php" enctype="multipart/form-data" id="form-gestor">
                        <div class="tab-content pt-3" id="nav-tabContent">
                            <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
                                <div class="form-group">
                                    <label>Foto:</label>
                                    <input type="file" class="form-select" id="foto" name="foto" accept="image/jpeg, image/png">

                                </div>
                                <div class="form-group">
                                    <label for="nome">Nome completo/Nome da empresa:</label>
                                    <input type="text" class="form-control" id="nome" name="nome" placeholder="Nome completo ou da empresa">
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
                                <!-- para enviar o cod do admin logado. -->
                                <input type="hidden" class="form-control" id="fkadmin" name="fkadmin" value= <?php echo $_SESSION['codadmin']; ?> >
                                <input type = "hidden" name="inserirGestor" value="222" />
                                <button type="submit" class="btn btn-primary mt-2" name="submitInserir">Salvar</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- Recent Sales End -->




    <?php
    include_once 'admin/includes/footer.php';
    