<!DOCTYPE html>
<html>
    <head>
        <meta name="description" content="pagina contact">
        <meta name="keywords" content="outdoor, xpto soluctions">
        <meta name="author" content="Rui Malemba">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Contact</title>

        <!-- Cabecalho -->
        <?php include_once'includes/header.php'; ?>

    <div class="slideshow">
        <div class="container">
            <div class="row">

                <div class="col-md-12 slideshow-text">
                    <h1>Conecte-se a nós</h1>
                    <p>Através do facebook, twitter, linkedin e outras redes.</p>
                </div>
            </div>
        </div>
    </div>

    <div class="section">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <div class="formulario-contacto">
                        <form>
                            <div class="form-group">
                                <input type="text" class="form-control" id="nome" placeholder="Digite seu nome">
                            </div>
                            <div class="form-group">
                                <input type="email" class="form-control" id="email" placeholder="Digite seu email">
                            </div>
                            <div class="form-group">
                                <input type="tel" class="form-control" id="telefone" placeholder="Digite seu telefone">
                            </div>
                            <div class="form-group">
                                <textarea class="form-control" id="mensagem" rows="4" placeholder="Digite sua mensagem"></textarea>
                            </div>
                            <br>
                            <button type="submit" class="btn btn-primary">Enviar</button>
                        </form>
                    </div>

                </div>
                <div class="col-md-6">
                    <div class="row">
                        <div class="col-md-2"></div>
                        <div class="col-md-8">
                            <div class="texto-contacto mt-3">
                                <h4 >Vamos conversar.</h4>
                                <p>
                                   Olá! Obrigado por entrar em contato conosco. Estamos ansiosos para ouvir 
                                   de você e ajudar com qualquer dúvida, solicitação ou consulta relacionada à nossa plataforma de gestão de outdoors.</p>
                            </div>
                        </div>
                        <div class="col-md-2"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>



    <!-- Rodapé -->
    <?php
    include_once 'includes/footer.php';

    