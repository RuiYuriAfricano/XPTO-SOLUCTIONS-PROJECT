<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="utf-8">
        <title>Listar Clientes - Administrador</title>
        <meta content="width=device-width, initial-scale=1.0" name="viewport">
        <meta content="" name="keywords">
        <meta content="" name="description">

        <?php include_once 'admin/includes/header.php'; ?>
        <!-- Navbar End -->


    
    <!-- Recent Sales Start -->
    <div class="container-fluid pt-4 px-4">
        <div class="bg-secondary text-center rounded p-4">
            <div class="d-flex align-items-center justify-content-between mb-4">
                <h6 class="mb-0">Clientes activados</h6>
                <a href="HomeAdmin.php">Ver clientes não activados</a>
            </div>
            <div class="table-responsive">
                <table class="table text-start align-middle table-bordered table-hover mb-0">
                    <thead>
                        <tr class="text-white">
                            <th scope="col">Foto</th>
                            <th scope="col">Nome</th>
                            <th scope="col">Tipo de cliente</th>
                            <th scope="col">Actividade empresa</th>
                            <th scope="col">Nacionalidade</th>
                            <th scope="col">Endereço de email</th>
                            <th scope="col">Username</th>
                            <th scope="col">Telefone</th>
                            <th scope="col">Morada</th>
                            <th scope="col">Distrito/Comuna</th>
                            <th scope="col">Activado por</th>
                            <th scope="col">Acção</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        require_once '../controllers/ClienteControllers.php';

                        $clientecontroller = new ClienteControllers();
                        $listaClientes = $clientecontroller->listarClientes();
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
                            $linkDelete = '../controllers/ClienteControllers.php?eliminar=' . $parametro;
                            ?>
                            <tr>
                                <?php if($total == 1 && empty($listaClientes[$i]['nomeCompleto'])) { ?>
                                <td colspan="12">
                                    Total de Clientes Activados: 0
                                </td>
                        <?php } else{ ?>
                                <td><img class="rounded-circle flex-shrink-0" src=<?php echo $listaClientes[$i]['fotografia']; ?> alt="" style="width: 40px; height: 40px;"></td>
                                <td><?php echo $listaClientes[$i]['nomeCompleto']; ?></td>
                                <td><?php echo $listaClientes[$i]['tipodecliente']; ?></td>
                                <td><?php echo $listaClientes[$i]['actividadedaempresa']; ?></td>
                                <td><?php echo $listaClientes[$i]['nacionalidade']; ?></td>
                                <td><?php echo $listaClientes[$i]['email']; ?></td>
                                <td><?php echo $listaClientes[$i]['username']; ?></td>
                                <td><?php echo $listaClientes[$i]['telemovel']; ?></td>
                                <td><?php echo $listaClientes[$i]['morada']; ?></td>
                                <td><?php echo $listaClientes[$i]['nomeComuna']; ?></td>
                                <td><?php echo $listaClientes[$i]['nomeAdmin']; ?></td>
                                <td>
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



    <?php
    include_once 'admin/includes/footer.php';
    