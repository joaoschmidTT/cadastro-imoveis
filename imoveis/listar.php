<?php
include '../config.php';

$sql = "SELECT imoveis.*, pessoas.nome AS nome_contribuinte
        FROM imoveis
        JOIN pessoas ON imoveis.id_contribuinte = pessoas.id";

$result = $conn->query($sql);
?>

<h2>Lista de Imóveis</h2>
<a href="cadastro.php">Cadastrar Novo Imóvel</a>

<table border="1" cellpadding="10">
    <tr>
        <th>ID</th>
        <th>Logradouro</th>
        <th>Número</th>
        <th>Bairro</th>
        <th>Complemento</th>
        <th>Proprietário</th>
        <th>Ações</th>
    </tr>

    <?php while ($row = $result->fetch_assoc()): ?>
        <tr>
            <td><?= $row['id'] ?></td>
            <td><?= $row['logradouro'] ?></td>
            <td><?= $row['numero'] ?></td>
            <td><?= $row['bairro'] ?></td>
            <td><?= $row['complemento'] ?></td>
            <td><?= $row['nome_contribuinte'] ?></td>
            <td>
                <a href="editar.php?id=<?= $row['id'] ?>">Editar</a>
                <a href="excluir.php?id=<?= $row['id'] ?>" onclick="return confirm('Tem certeza que deseja excluir este imóvel?')">Excluir</a>

            </td>
        </tr>
    <?php endwhile; ?>
</table>
