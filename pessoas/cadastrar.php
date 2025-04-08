<?php
session_start();
if (!isset($_SESSION['logado'])) {
    header("Location: login.php");
    exit();
}

include '../config.php';

$mensagem = '';

function validarCPF($cpf) {
    return preg_match('/^\d{3}\.\d{3}\.\d{3}-\d{2}$/', $cpf);
}
                                                                                                 
function validarTelefone($telefone) {
    return preg_match('/^\(\d{2}\) \d{4,5}-\d{4}$/', $telefone);
}

function validarEmail($email) {
    return filter_var($email, FILTER_VALIDATE_EMAIL);                                 // validadndo os dados de uma forma bem basiquinha
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nome = $_POST["nome"];
    $data_nascimento = $_POST["data_nascimento"];
    $cpf = $_POST["cpf"];
    $sexo = $_POST["sexo"];
    $telefone = $_POST["telefone"];
    $email = $_POST["email"];                                       //dados dos formulario pos apagar senha 

    if (!validarCPF($cpf)) {
        $mensagem = "❌ CPF inválido. Use o formato 000.000.000-00";
    } elseif (!validarTelefone($telefone)) {
        $mensagem = "❌ Telefone inválido. Use o formato (00) 00000-0000";
    } elseif (!validarEmail($email)) {
        $mensagem = "❌ E-mail inválido";
    } else {                                                         
                                                       
        $verificarCPF = $conn->prepare("SELECT id FROM pessoas WHERE cpf = ?");
        $verificarCPF->bind_param("s", $cpf);
        $verificarCPF->execute();                                
        $verificarCPF->store_result();

        $verificarEmail = $conn->prepare("SELECT id FROM pessoas WHERE email = ?");
        $verificarEmail->bind_param("s", $email);
        $verificarEmail->execute();                                        //LEMBRAR de usar isso no futuro validar_login.php
        $verificarEmail->store_result(); 

        if ($verificarCPF->num_rows > 0) {
            $mensagem = "⚠️ Este CPF já está cadastrado.";
        } elseif ($verificarEmail->num_rows > 0) {
            $mensagem = "⚠️ Este e-mail já está cadastrado.";
        } else {
            $sql = $conn->prepare("INSERT INTO pessoas (nome, nascimento, cpf, sexo, telefone, email) VALUES (?, ?, ?, ?, ?, ?)");
            $sql->bind_param("ssssss", $nome, $data_nascimento, $cpf, $sexo, $telefone, $email);                 //insert INTCHUUU

            if ($sql->execute()) {
                $mensagem = "✅ Cadastro realizado com sucesso!";
            } else {
                $mensagem = "❌ Erro ao cadastrar: " . $conn->error;
            }
        }

        $verificarCPF->close();
        $verificarEmail->close();
    }
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro de Pessoa</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="cadastrar.css">
</head>
<body class="bg-light">
    <div class="container_tela_cadastro mt-5 p-4 form-box">
        <h2 class="text-center mb-4">👤 Cadastro de Pessoa</h2>

        <?php if ($mensagem): ?>
            <div class="alert alert-info text-center"><?php echo $mensagem; ?></div>
        <?php endif; ?>

        <form method="post">
            <div class="mb-3">
                <label for="nome" class="form-label">Nome:</label>
                <input type="text" class="form-control" id="nome" name="nome" required>
            </div>

            <div class="mb-3">
                <label for="data_nascimento" class="form-label">Data de Nascimento:</label>
                <input type="date" class="form-control" id="data_nascimento" name="data_nascimento" required>
            </div>

            <div class="mb-3">
                <label for="cpf" class="form-label">CPF:</label>
                <input type="text" class="form-control" id="cpf" name="cpf" required 
                       pattern="\d{3}\.\d{3}\.\d{3}-\d{2}" placeholder="000.000.000-00">
            </div>

            <div class="mb-3">
                <label for="sexo" class="form-label">Sexo:</label>
                <select class="form-select" id="sexo" name="sexo" required>
                    <option value="">Selecione</option>
                    <option value="M">Masculino</option>
                    <option value="F">Feminino</option>   
                </select>
            </div>

            <div class="mb-3">
                <label for="telefone" class="form-label">Telefone:</label>
                <input type="text" class="form-control" id="telefone" name="telefone" required 
                       placeholder="(00) 00000-0000" inputmode="numeric">
            </div>

            <div class="mb-3">
                <label for="email" class="form-label">E-mail:</label>
                <input type="email" class="form-control" id="email" name="email" required>
            </div>

            <button type="submit" class="btn btn-primary w-100">Salvar</button>
        </form>

        <div class="mt-3 text-center">
            <button onclick="window.location.href='listar.php'" class="btn btn-secondary">
                📋 Voltar para Lista
            </button>
        </div>
    </div>

    <script src="https://unpkg.com/imask"></script>               <!-- biblioteca salvadora -->
    <script>
       document.addEventListener('DOMContentLoaded', function () {
    const cpfInput = document.getElementById('cpf');
    if (cpfInput) {
        IMask(cpfInput, {
            mask: '000.000.000-00'
        });
    }
                                                                                   
    const telefoneElement = document.getElementById('telefone');
    if (telefoneElement) {
        IMask(telefoneElement, {
            mask: [
                { mask: '(00) 0000-0000' },
                { mask: '(00) 00000-0000' }
            ]
        });
    }
});

    </script>
</body>
</html>
