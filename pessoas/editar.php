<?php
session_start();
if (!isset($_SESSION['logado'])) {
    header("Location: login.php");
    exit();
}

include '../config.php';

$mensagem = '';
$id = $_GET['id'] ?? null;

if (!$id) {
    header("Location: listar.php");
    exit();
}

$sql = $conn->prepare("SELECT nome, nascimento, cpf, sexo, telefone, email FROM pessoas WHERE id = ?");  //preparando
$sql->bind_param("i", $id);
$sql->execute();
$sql->bind_result($nome, $nascimento, $cpf, $sexo, $telefone, $email); 
$sql->fetch();
$sql->close();

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $nome = $_POST["nome"];
    $telefone = $_POST["telefone"];
    $email = $_POST["email"];

    $update = $conn->prepare("UPDATE pessoas SET nome = ?, telefone = ?, email = ? WHERE id = ?");
    $update->bind_param("sssi", $nome, $telefone, $email, $id);

    if ($update->execute()) {
        $mensagem = "✅ Dados atualizados com sucesso!";
    } else {                                                                                                   
        $mensagem = "❌ Erro ao atualizar: " . $conn->error;                                                     // atualizando
    }

    $update->close();
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Pessoa</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="editar.css">
</head>
<body class="bg-light">
    <div class="container_tela_ediçao mt-5 p-4 form-box">
        <h2 class="text-center mb-4">✏️ Editar Pessoa</h2>

        <?php if ($mensagem): ?>
            <div class="alert alert-info text-center"><?php echo $mensagem; ?></div>
        <?php endif; ?>

        <form method="post">
            <div class="mb-3">
                <label for="nome" class="form-label">Nome:</label>
                <input type="text" class="form-control" id="nome" name="nome" value="<?= htmlspecialchars($nome) ?>" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Data de Nascimento:</label>
                <input type="date" class="form-control" value="<?= $nascimento ?>" disabled>
            </div>

            <div class="mb-3">
                <label class="form-label">CPF:</label>
                <input type="text" class="form-control" value="<?= $cpf ?>" disabled>
            </div>

            <div class="mb-3">
                <label class="form-label">Sexo:</label>
                <input type="text" class="form-control" value="<?= $sexo ?>" disabled>
            </div>

            <div class="mb-3">
                <label for="telefone" class="form-label">Telefone:</label>
                <input type="text" class="form-control" id="telefone" name="telefone" value="<?= $telefone ?>" required>
            </div>

            <div class="mb-3">
                <label for="email" class="form-label">E-mail:</label>
                <input type="email" class="form-control" id="email" name="email" value="<?= $email ?>" required>
            </div>

            <button type="submit" class="btn btn-primary w-100">Salvar Alterações</button>
        </form>

        <div class="mt-3 text-center">
            <a href="listar.php" class="btn btn-secondary">📋 Voltar para Lista</a>
        </div>
    </div>

    <script src="https://unpkg.com/imask"></script>
    <script>
        const telefone = document.getElementById('telefone');
        if (telefone) {
            IMask(telefone, {
                mask: [
                    { mask: '(00) 0000-0000' },
                    { mask: '(00) 00000-0000' }
                ]
            });
        }
    </script>
</body>
</html>
