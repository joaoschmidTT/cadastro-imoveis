<?php
session_start();
if (!isset($_SESSION['logado'])) {
    header("Location: login.php");
    exit();
}

include '../config.php';

$busca = $_GET['busca'] ?? '';
$sql = $busca
    ? "SELECT * FROM pessoas WHERE nome LIKE '%$busca%'"
    : "SELECT * FROM pessoas";

$result = $conn->query($sql);
$total_pessoas = $result->num_rows;
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Pessoas</title>
    <link rel="stylesheet" href="listar.css">
</head>
<body>
    <div class="container_listagem">
        <header class="topo">
            <h2>👥 Lista de Pessoas</h2>
            <a href="cadastrar.php" class="botao">+ Nova Pessoa</a>
        </header>

        <form method="GET" class="lupa">
            <input type="text" name="busca" placeholder="Buscar por nome" value="<?= htmlspecialchars($busca) ?>">
            <button type="submit">🔍</button>
        </form>

        <p><strong>Total de pessoas cadastradas:</strong> <?= $total_pessoas ?></p>

        <table class="tabela">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nome</th>
                    <th>Nascimento</th>
                    <th>CPF</th>
                    <th>Sexo</th>
                    <th>Telefone</th>
                    <th>E-mail</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = $result->fetch_assoc()): ?> <!-- retornado os dados-->
                <tr>
                    <td><?= $row['id'] ?></td>
                    <td><?= $row['nome'] ?></td>
                    <td><?= $row['nascimento'] ?></td>
                    <td><?= $row['cpf'] ?></td>
                    <td><?= $row['sexo'] ?></td>
                    <td><?= $row['telefone'] ?></td>  
                    <td><?= $row['email'] ?></td>
                    <td class="acoes">
                                        <a href="editar.php?id=<?= $row['id'] ?>" class="botao_editar">✏️</a>
                                     <a href="excluir.php?id=<?= $row['id'] ?>" class="botao_excluir" 
                       onclick="return confirm('Tem certeza que deseja excluir esta pessoa?')">🗑️</a>
                    </td>
                </tr>                                         
                <?php endwhile; ?>
            </tbody>
        </table>

        <div class="voltar-container">
            <button onclick="location.href='../index.php'" class="voltar">🏠 Voltar para Início</button>
        </div>
    </div>
</body>
</html>

