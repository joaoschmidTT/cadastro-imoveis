<?php
session_start();
if (!isset($_SESSION['logado'])) {
    header("Location: login.php");
    exit();                                           //session usando pela primeira vez devo LEMBRAR de copiar isso e colocar nas outras paginas
}
include 'config.php';
?>




<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    
    <meta name="viewport" content="width=device-width, initial-scale=1.0"> <!-- se lembrar de coloar isso nas outras paginas pra ficar responsivo -->
    <title>Cadastro de Imóveis</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="index.css">
</head>
<body class="centralizacao">
<div class="prefeitura">
    <a href="https://www.saoleopoldo.rs.gov.br" target="_blank">                         <!-- botao pro site original -->
        <img src="image/brasao.png" alt="Brasão de São Leopoldo" class="brasao">
    </a>
    <h2>Prefeitura São Leopoldo</h2>
</div>


    <div class="container_tela_pricnipal mt-5 text-center">
        <h1 class="mb-4">🏠 Bem-vindo ao Sistema de Cadastro de Imóveis</h1>
        <br>
        <br>           <!-- kakakakakkaka o jeito mais preguisoso de separar os itens -->
        <br>
        <div class="w-50 mx-auto d-grid gap-5">

            <a href="pessoas/listar.php" class="botao_pessoas w-100">Lista contribuintes</a>
            <a href="imoveis/listar.php" class="botao_imoveis w-100">lista propriedades</a>
        </div>
    </div>

    <div id="cards">
        <a href="https://www.google.com/maps/place/S%C3%A3o+Leopoldo,+RS/@-29.7458593,-51.1115483,11z
        /data=!4m6!3m5!1s0x951968315942f59b:0x1b4734205177f47c!8m2!3d-29.7607417!4d-51.1480174!16zL20vMDRidjRr?entry=ttu&g_
        ep=EgoyMDI1MDQwMi4xIKXMDSoJLDEwMjExNDUzSAFQAw%3D%3D" class="card-opcao">
            <img src="image/mapa2.png" alt="Mapa">
            <span>Mapa</span>
        </a>

        <a href="cards/regras_iptu.php" class="card-opcao">
            <img src="image/casa2.png" alt="Regras do IPTU">
            <span>Regras do IPTU</span>
        </a>

        <a href="https://www.instagram.com/prefasaoleo/" class="card-opcao">
            <img src="image/instagram3.png" alt="Instagram da Prefeitura">
            <span>Instagram</span>
        </a>
    </div>
</body>
</html>
