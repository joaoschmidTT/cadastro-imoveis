<?php
session_start();
if (!isset($_SESSION['logado'])) {
    header("Location: login.php");
    exit();
}

include '../config.php';

$id = $_GET['id'] ?? null;

if (!$id) {
    echo "ID do imóvel não fornecido.";
    exit;
}

$sql = "SELECT * FROM imoveis WHERE id = $id";
$result = $conn->query($sql);

if ($result->num_rows !== 1) {
    echo "Imóvel não encontrado.";
    exit;
}

$imovel = $result->fetch_assoc();
$contribuintes = $conn->query("SELECT id, nome FROM pessoas");

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $cep = $_POST["cep"];
    $logradouro = $_POST["logradouro"];
    $numero = $_POST["numero"];
    $bairro = $_POST["bairro"];
    $complemento = $_POST["complemento"];
    $id_contribuinte = $_POST["id_contribuinte"];

    $sql = "UPDATE imoveis 
            SET  
            cep = '$cep',
            logradouro = '$logradouro', 
            numero = '$numero', 
            bairro = '$bairro', 
            complemento = '$complemento', 
            id_contribuinte = '$id_contribuinte' 
            WHERE id = $id";

    if ($conn->query($sql) === TRUE) {
        echo "<p style='text-align: center; color: green;'>Imóvel atualizado com sucesso!</p>";
    } else {
        echo "<p style='text-align: center; color: red;'>Erro ao atualizar: " . $conn->error . "</p>";
    }
}
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Imóvel</title>
    <link rel="stylesheet" href="editar.css">
</head>
<body>
    <div class="container_editar mt-5 p-4 form-box">
        <h2 class="text-center mb-4">✏️ Editar Imóvel</h2>
        
        <form method="post">

            <div class="mb-3">
                <label class="form-label">CEP:</label>
                <input type="text" name="cep" id="cep" class="form-control" value="<?= $imovel['cep'] ?>" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Logradouro:</label>
                <input type="text" name="logradouro" id="logradouro" class="form-control" value="<?= $imovel['logradouro'] ?>" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Número:</label>
                <input type="text" name="numero" id="numero" class="form-control" value="<?= $imovel['numero'] ?>" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Bairro:</label>
                <input type="text" name="bairro" id="bairro" class="form-control" value="<?= $imovel['bairro'] ?>" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Complemento:</label>
                <input type="text" name="complemento" id="complemento" class="form-control" value="<?= $imovel['complemento'] ?>">
            </div>

            <div class="mb-3">
                <label class="form-label">Proprietário:</label>
                <select name="id_contribuinte" class="form-select" required>
                    <?php while ($pessoa = $contribuintes->fetch_assoc()): ?>
                        <option value="<?= $pessoa['id'] ?>" <?= $pessoa['id'] == $imovel['id_contribuinte'] ? 'selected' : '' ?>>
                            <?= $pessoa['nome'] ?>
                        </option>
                    <?php endwhile; ?>
                </select>
            </div>

            <div style="text-align: center; margin-top: 30px;">
                <button class="botao_salvar" type="submit">💾 Salvar Alterações</button>
                <button type="button" onclick="window.location.href='listar.php'" class="botao_voltar">
                    📋 Voltar para Lista
                </button>
            </div>
        </form>
    </div>

    <script src="https://unpkg.com/imask"></script>
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const cepElement = document.getElementById('cep');
            if (cepElement) {
                IMask(cepElement, { mask: '00000-000' });

                cepElement.addEventListener('blur', function () {
                    const cep = this.value.replace(/\D/g, '');
                    if (cep.length !== 8) {
                        alert("CEP inválido. Digite 8 números.");
                        return;
                    }

                    fetch(`https://viacep.com.br/ws/${cep}/json/`)
                        .then(res => res.json())
                        .then(dados => {
                            if (dados.erro) {
                                alert("CEP não encontrado!");
                                return;
                            }

                            document.getElementById('logradouro').value = dados.logradouro || '';
                            document.getElementById('bairro').value = dados.bairro || '';
                            document.getElementById('complemento').value = dados.complemento || '';
                            document.getElementById('numero').focus();
                        })
                        .catch(() => {
                            alert("Erro ao buscar o CEP!");
                        });
                });
            }
        });
    </script>
</body>
</html>
