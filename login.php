<?php session_start(); ?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
<link rel="stylesheet" href="login.css">

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light d-flex justify-content-center align-items-center vh-100">

<div class="formulario_de_login">

    <h4 class="mb-3 text-center">Login</h4>

    <?php if (isset($_GET['erro'])): ?>  
        <div class="alert alert-danger p-2 text-center">Credenciais inválidas</div>      <!-- exibindo o erro do validar conta  -->     
    <?php endif; ?>

    <form action="validar_login.php" method="POST">
    <input type="email" name="email" placeholder="Email" required>
    <input type="password" name="senha" placeholder="Senha" required>
    <button type="submit" class="botao_entrar">Entrar</button>
</form>

<a href="criar_conta.php" class="botao_criar">Criar Conta</a>

    </form>
</div>

</body>
</html>
