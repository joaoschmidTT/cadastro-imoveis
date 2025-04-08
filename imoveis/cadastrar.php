<?php
session_start();
if (!isset($_SESSION['logado'])) {
    header("Location: login.php");
    exit();
}
include '../config.php';

$pessoas = $conn->query("SELECT id, nome FROM pessoas");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $cep = $_POST["cep"];
    $logradouro = $_POST["logradouro"];
    $numero = $_POST["numero"];
    $bairro = $_POST["bairro"];
    $complemento = $_POST["complemento"];
    $id_contribuinte = $_POST["id_contribuinte"];

    $sql = "INSERT INTO imoveis (cep, logradouro, numero, bairro, complemento, id_contribuinte) 
            VALUES ('$cep', '$logradouro', '$numero', '$bairro', '$complemento', '$id_contribuinte')";

    if ($conn->query($sql) === TRUE) {
        header("Location: listar.php");
        exit;
    } else {
        echo "Erro: " . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastrar Imóvel</title>
    <link rel="stylesheet" href="cadastrar.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container_cadastar_imovies mt-5 p-4 form-box">
        <h2 class="text-center mb-4">🏠 Cadastro de Imóvel</h2>
        
        <form method="post">
            <div class="mb-3">
                <label class="form-label">CEP:</label>
                <input type="text" name="cep" id="cep" class="form-control" placeholder="00000-000" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Logradouro:</label>
                <input type="text" name="logradouro" id="logradouro" class="form-control" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Número:</label>
                <input type="text" name="numero" class="form-control" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Bairro:</label>
                <input type="text" name="bairro" id="bairro" class="form-control" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Complemento:</label>
                <input type="text" name="complemento" id="complemento" class="form-control">
            </div>

            <div class="mb-3">
                <label class="form-label">Proprietário:</label>
                <select name="id_contribuinte" class="form-select" required>
                    <option value="">Selecione...</option>
                    <?php while ($pessoa = $pessoas->fetch_assoc()): ?>
                        <option value="<?= $pessoa['id'] ?>"><?= $pessoa['nome'] ?></option>
                    <?php endwhile; ?>
                </select>
            </div>

            <button class="botao_salvar" type="submit">Salvar Imóvel</button>

            <button type="button" onclick="window.location.href='listar.php'" class="botao_voltar">
                📋 Voltar para Lista
            </button>
        </form>
    </div>
    <script src="https://unpkg.com/imask"></script>
    <script>
    document.getElementById('cep').addEventListener('blur', function () {
        const cep = this.value.replace(/\D/g, '');

        if (cep.length !== 8) {
            alert("CEP inválido. Digite 8 números.");
            return;
        }

        fetch(`https://viacep.com.br/ws/${cep}/json/`)
            .then(res => res.json())
            .then(dados => {
                if (dados.erro) {
                    alert("CEP não encontrado!");                //javascript amigo
                    return;
                }

                document.getElementById('logradouro').value = dados.logradouro || ''; 
                document.getElementById('bairro').value = dados.bairro || '';
                document.getElementById('complemento').value = dados.complemento || '';
            })
            .catch(() => {
                alert("Erro ao buscar o CEP!");
            });
    });

  const cepElement =  document.getElementById('cep');
  if (cepElement) {
    IMask(cepElement,{
        mask:[
            { mask: '00000-000' },  
        ] 
    
    })

}
    </script>
</body>
</html>
