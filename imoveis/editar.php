<?php
include '../config.php';

if (!isset($_GET['id'])) {
    echo "ID do imóvel não informado!";
    exit;
}

$id = $_GET['id'];


$sql = "SELECT * FROM imoveis WHERE id = $id";
$result = $conn->query($sql);
$imovel = $result->fetch_assoc();

if (!$imovel) {
    echo "Imóvel não encontrado!";
    exit;
}


$pessoas = $conn->query("SELECT id, nome FROM pessoas");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $logradouro = $_POST["logradouro"];
    $numero = $_POST["numero"];
    $bairro = $_POST["bairro"];
    $complemento = $_POST["complemento"];
    $id_contribuinte = $_POST["id_contribuinte"];

    $sqlUpdate = "UPDATE imoveis SET
        logradouro = '$logradouro',
        numero = '$numero',
        bairro = '$bairro',
        complemento = '$complemento',
        id_contribuinte = '$id_contribuinte'
        WHERE id = $id";

    if ($conn->query($sqlUpdate) === TRUE) {
        header("Location: listar.php");
        exit;
    } else {
        echo "Erro ao atualizar: " . $conn->error;
    }
}
?>

<h2>Editar Imóvel</h2>
<form method="post">
    Logradouro: <input type="text" name="logradouro" value="<?= $imovel['logradouro'] ?>" required><br>
    Número: <input type="text" name="numero" value="<?= $imovel['numero'] ?>" required><br>
    Bairro: <input type="text" name="bairro" value="<?= $imovel['bairro'] ?>" required><br>
    Complemento: <input type="text" name="complemento" value="<?= $imovel['complemento'] ?>"><br>

    Proprietário (Contribuinte):
    <select name="id_contribuinte" required>
        <?php while ($pessoa = $pessoas->fetch_assoc()): ?>
            <option value="<?= $pessoa['id'] ?>" <?= $pessoa['id'] == $imovel['id_contribuinte'] ? 'selected' : '' ?>>
                <?= $pessoa['nome'] ?>
            </option>
        <?php endwhile; ?>
    </select><br>

    <button type="submit">Salvar Alterações</button>
</form>
