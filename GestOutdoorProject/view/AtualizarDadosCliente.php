<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="utf-8">
        <title>Perfil - Cliente</title>
        <meta content="width=device-width, initial-scale=1.0" name="viewport">
        <meta content="" name="keywords">
        <meta content="" name="description">

        <?php include_once 'cliente/includes/header.php'; ?>

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
    <div class="container-fluid pt-4 px-4">
        <div class="bg-secondary rounded p-4">
            <div class="d-flex align-items-center justify-content-between mb-4">
                <h6 class="mb-0">Meu Perfil</h6>
                <a href="#">Atualize os seus dados</a>
            </div>
            <div class="col-sm-12 col-xl-6">
                <div class="bg-secondary rounded h-100 p-4">
                    <?php 
                        
                        if(isset($_SESSION['sucesso-atualizacao'])) {?>
                    <div id="mensagemErro" class="alert alert-success mt-1" >
                        <?php   echo $_SESSION['sucesso-atualizacao']; ?> 
                    </div> <?php   unset($_SESSION['sucesso-atualizacao']);}  ?>
                     
                        <!-- Erro -->
                     <?php if(isset($_SESSION['erro-atualizacao'])) {?>
                    <div id="mensagemErro" class="alert alert-danger mt-1" >
                        <?php   echo $_SESSION['erro-atualizacao']; ?> 
                    </div> <?php   unset($_SESSION['erro-atualizacao']);} ?>
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
                    <form method="post" action="../controllers/ClienteControllers.php" enctype="multipart/form-data" id="meu-form">
                        <div class="tab-content pt-3" id="nav-tabContent">
                            <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
                                <div class="form-group">
                                    <label>Foto:</label>
                                    <input type="file" class="form-select" id="foto" name="foto" accept="image/jpeg, image/png">

                                </div>
                                <div class="form-group">
                                    <label for="nome">Nome completo/Nome da empresa:</label>
                                    <input type="text" class="form-control" id="nome" name="nome" 
                                           placeholder="Nome completo ou da empresa"
                                           value="<?php echo htmlspecialchars($clienteEncontrado['nomeCompleto']); ?>" />

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
                                           placeholder="Atividade principal da sua empresa"
                                           value="<?php echo htmlspecialchars($clienteEncontrado['actividadedaempresa']); ?>">
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
                                        <!-- O conteúdo do select de municípios será preenchido dinamicamente usando AJAX -->
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="comuna">Comuna:</label>
                                    <select class="form-select" id="comuna" name="comuna">
                                        <!-- O conteúdo do select de comunas será preenchido dinamicamente usando AJAX -->
                                    </select>
                                </div>

                                <div class = "form-group">
                                    <label for = "morada">Morada:</label>
                                    <input type = "text" class = "form-control" id = "morada" name = "morada"
                                           placeholder = "Descrição do bairro, rua etc."
                                           value = "<?php echo htmlspecialchars($clienteEncontrado['morada']); ?>">
                                </div>
                            </div>
                            <div class = "tab-pane fade" id = "nav-contact" role = "tabpanel" aria-labelledby = "nav-contact-tab">
                                <div class = "form-group">
                                    <label for = "email">Endereço de email:</label>
                                    <input type = "email" class = "form-control" id = "email" name = "email" placeholder = "Seu email"
                                           value = "<?php echo htmlspecialchars($clienteEncontrado['email']); ?>">
                                </div>
                                <div class = "form-group">
                                    <label for = "telemovel">Telemóvel:</label>
                                    <input type = "tel" class = "form-control" id = "telemovel" name = "telemovel"
                                           placeholder = "Insira o número de telefone"
                                           value = "<?php echo htmlspecialchars($clienteEncontrado['telemovel']); ?>">
                                </div>
                                <div class = "form-group">
                                    <label for = "username">Username:</label>
                                    <input type = "text" class = "form-control" id = "username" name = "username"
                                           placeholder = "Crie um username"
                                           value = "<?php echo htmlspecialchars($clienteEncontrado['username']); ?>">
                                </div>
                                <div class = "form-group">
                                    <label for = "password">Password:</label>
                                    <input type = "password" class = "form-control" id = "password" name = "password"
                                           placeholder = "Crie uma password"
                                           value = "<?php echo htmlspecialchars($clienteEncontrado['password_']); ?>">
                                </div>
                                <div class = "form-group">
                                    <label for = "confirmapassword">Confirmação da Password:</label>
                                    <input type = "password" class = "form-control" id = "confirmapassword" name = "confirmapassword"
                                           placeholder = "Insira a password criada"
                                           value = "<?php echo htmlspecialchars($clienteEncontrado['password_']); ?>">
                                </div>
                                <!--para enviar o cod do admin logado. -->
                                <input type = "hidden" class = "form-control" id = "fkadmin" name = "fkadmin"
                                       value = <?php echo $clienteEncontrado['fkadmin'];
                                        ?> >
                                <input type="hidden" class="form-control" id="estado" name="estado" 
                                       value= <?php echo $clienteEncontrado['estado']; ?> >
                                <input type="hidden" class="form-control" id="fotoantiga" name="fotoantiga" 
                                       value= <?php echo $clienteEncontrado['fotografia']; ?> >
                                <button type="submit" class="btn btn-primary mt-2" name="atualizarCliente">Salvar</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    
        <?php
        include_once 'cliente/includes/footer.php';
        