$(document).ready(function() {
    // Manipulador de evento para a seleção da província
    $('#provincia').on('change', function() {
        var provinciaId = $(this).val();
        
        // Requisição AJAX para obter os municípios correspondentes à província selecionada
        $.ajax({
            url: 'http://localhost/GestOutdoorProject/view/obter_municipios.php', // Arquivo PHP que retorna os municípios com base na província
            type: 'POST',
            data: { provinciaId: provinciaId },
            dataType: 'json',
            success: function(response) {
                // Limpar a lista de municípios
                $('#municipio').empty();
                
                // Adicionar as opções de municípios ao <select>
                $.each(response, function(index, municipio) {
                    $('#municipio').append($('<option>').val(municipio.codmunicipio).text(municipio.nome));
                });
                
                // Limpar a lista de comunas
                $('#comuna').empty();
            }
        });
    });
    
    // Manipulador de evento para a seleção do município
    $('#municipio').on('change', function() {
        var municipioId = $(this).val();
        
        // Requisição AJAX para obter as comunas correspondentes ao município selecionado
        $.ajax({
            url: 'http://localhost/GestOutdoorProject/view/obter_comunas.php', // Arquivo PHP que retorna as comunas com base no município
            type: 'POST',
            data: { municipioId: municipioId },
            dataType: 'json',
            success: function(response) {
                // Limpar a lista de comunas
                $('#comuna').empty();
                
                // Adicionar as opções de comunas ao <select>
                $.each(response, function(index, comuna) {
                    $('#comuna').append($('<option>').val(comuna.codcomuna).text(comuna.nome));
                });
            }
        });
    });
});
