<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="utf-8">
        <title>Visulizar gestores- Administrador</title>
        <meta content="width=device-width, initial-scale=1.0" name="viewport">
        <meta content="" name="keywords">
        <meta content="" name="description">

        <?php include_once 'admin/includes/header.php'; ?>
        <!-- Navbar End -->

        <!-- Recent Sales Start -->
    <div class="container-fluid pt-4 px-4">
        <div class="bg-secondary text-center rounded p-4">
            <div class="d-flex align-items-center justify-content-between mb-4">
                <h6 class="mb-0">Lista dos gestores</h6>
                <a href="InserirGestorAdmin.php">Inserir novo</a>
            </div>
            <div class="table-responsive">
                <table class="table text-start align-middle table-bordered table-hover mb-0">
                    <thead>
                        <tr class="text-white">
                            <th scope="col">Foto</th>
                            <th scope="col">Nome</th>
                            <th scope="col">Username</th>
                            <th scope="col">Telemóvel</th>
                            <th scope="col">Endereço de email</th>
                            <th scope="col">Morada</th>
                            <th scope="col">Distrito/Comuna</th>
                            <th scope="col">Registrado por</th>
                            <th scope="col">Acção</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        require_once '../controllers/GestorControllers.php';

                        $gestorcontroller = new GestorControllers();
                        $listaGestores = $gestorcontroller->listarGestores();
                        $total = count($listaGestores);//default é 1
                        
                        for ($i = 0; $i < $total; $i++) {
                            
                            $objectoGestor = new stdClass();
                            $arrayGestor = $listaGestores[$i];

                            $objectoGestor->username = $arrayGestor['username'];
                            $objectoGestor->password_ = $arrayGestor['password_'];
                            $objectoGestor->email = $arrayGestor['email'];
                            $objectoGestor->telemovel = $arrayGestor['telemovel'];
                            $objectoGestor->fkcomuna = $arrayGestor['fkcomuna'];
                            $objectoGestor->morada = $arrayGestor['morada'];
                            $objectoGestor->fotografia = $arrayGestor['fotografia'];
                            $objectoGestor->nomeCompleto = $arrayGestor['nomeCompleto'];
                            $objectoGestor->fkadmin = $arrayGestor['fkadmin'];

                            // Serializa o objeto como JSON
                            $jsonObjeto = json_encode($objectoGestor);

                            // Codifica o JSON para URL-safe
                            $parametro = urlencode($jsonObjeto);

                            // Cria o link com o parâmetro na URL
                            $link = '../controllers/GestorControllers.php?atualizarGestor=' . $parametro;
                            $linkDelete = '../controllers/GestorControllers.php?eliminarGestor=' . $parametro;
                            ?>
                            <tr>
                        <?php if($total == 1 && empty($listaGestores[$i]['nomeCompleto'])) { ?>
                                <td colspan="9">
                                    Total de Gestores: 0
                                </td>
                        <?php } else{ ?>
                                <td><img class="rounded-circle flex-shrink-0" src=<?php echo $listaGestores[$i]['fotografia']; ?> alt="" style="width: 40px; height: 40px;"></td>                                
                                <td><?php echo $listaGestores[$i]['nomeCompleto']; ?></td>
                                <td><?php echo $listaGestores[$i]['username']; ?></td>
                                <td><?php echo $listaGestores[$i]['telemovel']; ?></td>
                                <td><?php echo $listaGestores[$i]['email']; ?></td>
                                <td><?php echo $listaGestores[$i]['morada']; ?></td>
                                <td><?php echo $listaGestores[$i]['nomeComuna']; ?></td>
                                <td><?php echo $listaGestores[$i]['nomeAdmin']; ?></td>
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
    