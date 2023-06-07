<?php

// Recupere o ID do município enviado pela requisição AJAX
$municipioId = $_POST['municipioId'];

// Faça a consulta no banco de dados para obter as comunas com base no município selecionado
// ...
//Comuna
require_once '../controllers/ComunaControllers.php';

$comunaController = new ComunaControllers();

$listaComuna = $comunaController->listarComunas();

$total = count($listaComuna);
$comunas = Array();
$count = 0;
for ($i = 0; $i < $total; $i++) {
            if ($listaComuna[$i]['fkmunicipio'] == $municipioId) {
                //adicionar $listaMunicpio[$i] no array
                $comunas[$count] = $listaComuna[$i];
                $count++;
            }
        }

// Formate os dados das comunas como um array associativo


// Retorne os dados como JSON
echo json_encode($comunas);

