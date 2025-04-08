<?php
session_start();
if (!isset($_SESSION['logado'])) {
    header("Location: login.php");
    exit();
}
include '../config.php';

$busca = isset($_GET['busca']) ? trim($_GET['busca']) : '';        // vou me matarrrrrrrrrrrrrrrr 4 horas aqui mas deu eu acho

if (!empty($busca)) {
    $sql = "SELECT imoveis.*, pessoas.nome AS nome_contribuinte
            FROM imoveis
            JOIN pessoas ON imoveis.id_contribuinte = pessoas.id                 
            WHERE logradouro LIKE '%$busca%'";
    $result = $conn->query($sql);
} else {
    $sql = "SELECT imoveis.*, pessoas.nome AS nome_contribuinte
            FROM imoveis
            JOIN pessoas ON imoveis.id_contribuinte = pessoas.id";
    $result = $conn->query($sql);
}

$total_imoveis = $result->num_rows;  // sauve
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Imóveis</title>
    <link rel="stylesheet" href="listar.css">
</head>

<body>
    <div class="container_listagem_imovies">
        <div class="topo">
            <h2>🏠 Lista de Imóveis</h2>
            <a class="botao_cadastro" href="cadastrar.php">+ Novo Imóvel</a>
        </div>

        <form method="GET" class="form-busca">
            <input type="text" name="busca" placeholder="Buscar por logradouro..." value="<?= $busca ?>">
            <button type="submit">🔍</button>
        </form>

        <p><strong>Total de imóveis cadastrados:</strong> <?= $total_imoveis ?></p>

        <table>
            <tr>
                <th>ID</th>
                <th>cep</th>
                <th>Logradouro</th>
                <th>Número</th>
                <th>Bairro</th>
                <th>Complemento</th>
                <th>Proprietário</th>
                <th>Ações</th>
            </tr>

            <?php if ($result->num_rows > 0): ?>
                <?php while ($row = $result->fetch_assoc()): ?>
                    <tr>
                        <td><?= $row['id'] ?></td>
                        <td><?= $row['cep'] ?></td>
                        <td><?= $row['logradouro'] ?></td>
                        <td><?= $row['numero'] ?></td>
                        <td><?= $row['bairro'] ?></td>
                        <td><?= $row['complemento'] ?></td>
                        <td><?= $row['nome_contribuinte'] ?></td>
                        <td>
                            <div class="botoes-acoes">
                                <a href="editar.php?id=<?= $row['id']; ?>" class="editar" title="Editar">✏️</a>
                                <a href="excluir.php?id=<?= $row['id']; ?>" class="excluir" title="Excluir" onclick="return confirm('Tem certeza que deseja excluir este imóvel?')">🗑️</a>
                            </div>
                        </td>
                    </tr>
                <?php endwhile; ?>
            <?php else: ?>
                <tr><td colspan="8">Nenhum imóvel encontrado.</td></tr>
            <?php endif; ?>
        </table>

        <div class="voltar-container">
            <button onclick="window.location.href='../index.php'" class="voltar_inicio">
                🏠 Voltar para Início
            </button>
        </div>
    </div>
</body>
</html>
