<?php
include '../config.php';

if (!isset($_GET['id']) || empty($_GET['id'])) {
    echo "Erro: ID da pessoa não informado!";
    exit;
}

$id = $_GET['id'];

// Buscar dados da pessoa
$sql = "SELECT * FROM pessoas WHERE id = $id";
$result = $conn->query($sql);
$pessoa = $result->fetch_assoc();

if (!$pessoa) {
    echo "Erro: Pessoa não encontrada!";
    exit;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nome = $_POST["nome"];
    $telefone = $_POST["telefone"];
    $email = $_POST["email"];

    $sqlUpdate = "UPDATE pessoas SET
        nome = '$nome',
        telefone = '$telefone',
        email = '$email'
        WHERE id = $id";

    if ($conn->query($sqlUpdate) === TRUE) {
        header("Location: listar.php");
        exit;
    } else {
        echo "Erro ao atualizar: " . $conn->error;
    }
}
?>

<h2>Editar Pessoa</h2>
<form method="post">
    Nome: <input type="text" name="nome" value="<?= $pessoa['nome'] ?>" required><br>
    
    Data de Nascimento: 
    <input type="date" name="nascimento" value="<?= $pessoa['nascimento'] ?>" readonly><br>
    
    CPF: 
    <input type="text" name="cpf" value="<?= $pessoa['cpf'] ?>" readonly><br>
    
    Sexo:
    <select name="sexo" disabled>
        <option value="M" <?= $pessoa['sexo'] == 'M' ? 'selected' : '' ?>>Masculino</option>
        <option value="F" <?= $pessoa['sexo'] == 'F' ? 'selected' : '' ?>>Feminino</option>
        <option value="Outro" <?= $pessoa['sexo'] == 'Outro' ? 'selected' : '' ?>>Outro</option>
    </select><br>

    Telefone: <input type="text" name="telefone" value="<?= $pessoa['telefone'] ?>"><br>
    E-mail: <input type="email" name="email" value="<?= $pessoa['email'] ?>"><br>

    <button type="submit">Salvar Alterações</button>
</form>
