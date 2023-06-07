<?php

// Recupere o ID da província enviado pela requisição AJAX
$provinciaId = $_POST['provinciaId'];

// Faça a consulta no banco de dados para obter os municípios com base na província selecionada
// ...
require_once '../controllers/MunicipioControllers.php';

$municipioController = new MunicipioControllers();

$listaMunicipio = $municipioController->listarMunicipio();
// Formate os dados dos municípios como um array associativo
$total = count($listaMunicipio);
$municipios = Array();
$count = 0;
for ($i = 0; $i < $total; $i++) {
            if ($listaMunicipio[$i]['fkprovincia'] == $provinciaId) {
                //adicionar $listaMunicpio[$i] no array
                $municipios[$count] = $listaMunicipio[$i];
                $count++;
            }
        }

// Retorne os dados como JSON
echo json_encode($municipios);

