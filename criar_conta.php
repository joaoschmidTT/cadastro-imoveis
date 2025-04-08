<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Criar Conta</title>
    <link rel="stylesheet" href="criar_conta.css">
</head>

<body>

<div class="formulario_criar_conta">
    <h4>Criar Conta</h4>

    <?php if (isset($_GET['erro'])): ?>
        <div class="mensagem erro">Erro ao criar conta. E-mail já existe.</div>             <!-- informando o erro da pagina salvar graças a varivael 
                                                                                                        superglbal e na div de baixo o contrario-->       
    <?php endif; ?>
    <?php if (isset($_GET['sucesso'])): ?>
        <div class="mensagem sucesso">Conta criada com sucesso! <a href="login.php">Entrar</a></div>
    <?php endif; ?>

    <form action="salvar_conta.php" method="POST">
        <input type="email" name="email" placeholder="Email" required>
        <input type="password" name="senha" placeholder="Senha" required>

        <button type="submit" class="botao_cadastrar">Cadastrar</button>
        <a href="login.php" class="botao_voltar">Voltar para o Login</a>
    </form>
</div>

</body>
</html>