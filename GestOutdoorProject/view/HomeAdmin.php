<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="utf-8">
        <title>Home - Administrador</title>
        <meta content="width=device-width, initial-scale=1.0" name="viewport">
        <meta content="" name="keywords">
        <meta content="" name="description">

        <?php include_once 'admin/includes/header.php'; ?>
        <!-- Navbar End -->

        <?php
        require_once '../controllers/ClienteControllers.php';
        require_once '../controllers/GestorControllers.php';

        //clientes não ativados
        $clientecontroller = new ClienteControllers();
        $listaClientesNaoAtivados = $clientecontroller->listarClientesNaoAtivados();
        $totalNaoAtivados = count($listaClientesNaoAtivados);
        
        //cliente activados
        $listaClientes = $clientecontroller->listarClientes();
        $total = count($listaClientes);
        
        $gestorcontroller = new GestorControllers();
        $listaGestores = $gestorcontroller->listarGestores();
        $totalGest = count($listaGestores);
        ?>
        <!-- Sale & Revenue Start -->
    <div class="container-fluid pt-4 px-4">
        <div class="row g-4">
            <div class="col-sm-6 col-xl-3">
                <div class="bg-secondary rounded d-flex align-items-center justify-content-between p-4">
                    <i class="fa fa-bullhorn fa-3x text-primary"></i>
                    <div class="ms-3">
                        <p class="mb-2">Outdoors</p>
                        <h6 class="mb-0">1234</h6>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-xl-3">
                <div class="bg-secondary rounded d-flex align-items-center justify-content-between p-4">
                    <i class="fa fa-users fa-3x text-primary"></i>
                    <div class="ms-3">
                        <p class="mb-2">Clientes</p>
                        <h6 class="mb-0"><?php echo $total; ?></h6>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-xl-3">
                <div class="bg-secondary rounded d-flex align-items-center justify-content-between p-4">
                    <i class="fa fa-user-edit fa-3x text-primary"></i>
                    <div class="ms-3">
                        <p class="mb-2">Contas por activar</p>
                        <h6 class="mb-0"><?php echo $totalNaoAtivados; ?></h6>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-xl-3">
                <div class="bg-secondary rounded d-flex align-items-center justify-content-between p-4">
                    <i class="fa fa-user fa-3x text-primary"></i>
                    <div class="ms-3">
                        <p class="mb-2">Gestores</p>
                        <h6 class="mb-0"><?php echo $totalGest; ?></h6>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Sale & Revenue End -->




    <!-- Recent Sales Start -->
    <div class="container-fluid pt-4 px-4">
        <div class="bg-secondary text-center rounded p-4">
            <div class="d-flex align-items-center justify-content-between mb-4">
                <h6 class="mb-0">Solicitação de activação de contas</h6>
                <a href="ListarClientesActivosAdmin.php">Ver clientes activados</a>
            </div>
            <div class="table-responsive">
                <?php 
                        
                        if(isset($_SESSION['sucesso-ativado'])) {?>
                    <div id="mensagemErro" class="alert alert-success mt-1" >
                        <?php   echo $_SESSION['sucesso-ativado']; ?> 
                    </div> <?php  unset($_SESSION['sucesso-ativado']); } ?>
                     
                        <!-- Erro -->
                     <?php if(isset($_SESSION['erro-ativado'])) {?>
                    <div id="mensagemErro" class="alert alert-danger mt-1" >
                        <?php   echo $_SESSION['erro-ativado']; ?> 
                    </div> <?php  unset($_SESSION['erro-ativado']);  } ?>
                <table class="table text-start align-middle table-bordered table-hover mb-0">
                    <thead>
                        <tr class="text-white">
                            <th scope="col">Foto</th>
                            <th scope="col">Nome</th>
                            <th scope="col">Tipo de cliente</th>
                            <th scope="col">Actividade empresa</th>
                            <th scope="col">Nacionalidade</th>
                            <th scope="col">Endereço de email</th>
                            <th scope="col">Acção</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        require_once '../controllers/ClienteControllers.php';

                        $clientecontroller = new ClienteControllers();
                        $listaClientes = $clientecontroller->listarClientesNaoAtivados();
                        $total = count($listaClientes);

                        for ($i = 0; $i < $total; $i++) {
                            $listaClientes[$i]['estado'] = "activado";
                            $listaClientes[$i]['fkadmin'] = $_SESSION['codadmin'];
                            $objectoCliente = new stdClass();
                            $arrayCliente = $listaClientes[$i];

                            $objectoCliente->username = $arrayCliente['username'];
                            $objectoCliente->password_ = $arrayCliente['password_'];
                            $objectoCliente->telemovel = $arrayCliente['telemovel'];
                            $objectoCliente->email = $arrayCliente['email'];
                            $objectoCliente->fkcomuna = $arrayCliente['fkcomuna'];
                            $objectoCliente->morada = $arrayCliente['morada'];
                            $objectoCliente->fotografia = $arrayCliente['fotografia'];
                            $objectoCliente->nomeCompleto = $arrayCliente['nomeCompleto'];
                            $objectoCliente->tipodecliente = $arrayCliente['tipodecliente'];
                            $objectoCliente->actividadedaempresa = $arrayCliente['actividadedaempresa'];
                            $objectoCliente->fknacionalidade = $arrayCliente['fknacionalidade'];
                            $objectoCliente->estado = $arrayCliente['estado'];
                            $objectoCliente->fkadmin = $arrayCliente['fkadmin'];

                            // Serializa o objeto como JSON
                            $jsonObjeto = json_encode($objectoCliente);

                            // Codifica o JSON para URL-safe
                            $parametro = urlencode($jsonObjeto);

                            // Cria o link com o parâmetro na URL
                            $link = '../controllers/ClienteControllers.php?atualizaEstado=' . $parametro;
                            $linkDelete = '../controllers/ClienteControllers.php?eliminar=' . $parametro;
                            ?>
                            <tr>
                                <?php if($total == 1 && empty($listaClientes[$i]['nomeCompleto'])) { ?>
                                <td colspan="7">
                                    Total de Clientes Por activar: 0
                                </td>
                        <?php } else{ ?>
                                <td><img class="rounded-circle flex-shrink-0" src=<?php echo $listaClientes[$i]['fotografia']; ?> alt="" style="width: 40px; height: 40px;"></td>                                
                                <td><?php echo $listaClientes[$i]['nomeCompleto']; ?></td>
                                <td><?php echo $listaClientes[$i]['tipodecliente']; ?></td>
                                <td><?php echo $listaClientes[$i]['actividadedaempresa']; ?></td>
                                <td><?php echo $listaClientes[$i]['nacionalidade']; ?></td>
                                <td><?php echo $listaClientes[$i]['email']; ?></td>
                                <td><a class="btn btn-sm btn-primary" href=<?php echo $link; ?>
                                       >Ativar</a>
                                    <a class="btn btn-sm btn-danger" href=<?php echo $linkDelete; ?>
                                       >Excluir</a>
                                </td>
                            </tr>
                        <?php }} ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <!-- Recent Sales End -->


    <!-- Widgets Start -->
    <div class="container-fluid pt-4 px-4">
        <div class="row g-4">
            <div class="col-sm-12 col-md-6 col-xl-1">

            </div>
            <div class="col-sm-12 col-md-6 col-xl-5">
                <div class="h-100 bg-secondary rounded p-4">
                    <div class="d-flex align-items-center justify-content-between mb-2">
                        <h6 class="mb-0">Mensagens</h6>
                        <a href="">Ver todas</a>
                    </div>
                    <div class="d-flex align-items-center border-bottom py-3">
                        <img class="rounded-circle flex-shrink-0" src="../content/pages-admin-customer-manager/img/user.jpg" alt="" style="width: 40px; height: 40px;">
                        <div class="w-100 ms-3">
                            <div class="d-flex w-100 justify-content-between">
                                <h6 class="mb-0">Jhon Doe</h6>
                                <small>15 minutes ago</small>
                            </div>
                            <span>Short message goes here...</span>
                        </div>
                    </div>
                    <div class="d-flex align-items-center border-bottom py-3">
                        <img class="rounded-circle flex-shrink-0" src="../content/pages-admin-customer-manager/img/user.jpg" alt="" style="width: 40px; height: 40px;">
                        <div class="w-100 ms-3">
                            <div class="d-flex w-100 justify-content-between">
                                <h6 class="mb-0">Jhon Doe</h6>
                                <small>15 minutes ago</small>
                            </div>
                            <span>Short message goes here...</span>
                        </div>
                    </div>
                    <div class="d-flex align-items-center border-bottom py-3">
                        <img class="rounded-circle flex-shrink-0" src="../content/pages-admin-customer-manager/img/user.jpg" alt="" style="width: 40px; height: 40px;">
                        <div class="w-100 ms-3">
                            <div class="d-flex w-100 justify-content-between">
                                <h6 class="mb-0">Jhon Doe</h6>
                                <small>15 minutes ago</small>
                            </div>
                            <span>Short message goes here...</span>
                        </div>
                    </div>
                    <div class="d-flex align-items-center pt-3">
                        <img class="rounded-circle flex-shrink-0" src="../content/pages-admin-customer-manager/img/user.jpg" alt="" style="width: 40px; height: 40px;">
                        <div class="w-100 ms-3">
                            <div class="d-flex w-100 justify-content-between">
                                <h6 class="mb-0">Jhon Doe</h6>
                                <small>15 minutes ago</small>
                            </div>
                            <span>Short message goes here...</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-12 col-md-6 col-xl-5">
                <div class="h-100 bg-secondary rounded p-4">
                    <div class="d-flex align-items-center justify-content-between mb-4">
                        <h6 class="mb-0">Calendário</h6>
                        <a href="">Ver todo</a>
                    </div>
                    <div id="calender"></div>
                </div>
            </div>
            <div class="col-sm-12 col-md-6 col-xl-1">

            </div>

        </div>
    </div>
    <!-- Widgets End -->

    <?php
    include_once 'admin/includes/footer.php';
    