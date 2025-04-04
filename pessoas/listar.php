<?php
include '../config.php';

$sql = "SELECT * FROM pessoas";
$result = $conn->query($sql);
?>

<h2>Lista de Pessoas</h2>
<a href="cadastro.php">Cadastrar Nova Pessoa</a>
<table border="1" cellpadding="10">
    <tr>
        <th>ID</th>
        <th>Nome</th>
        <th>Data de Nascimento</th>
        <th>CPF</th>
        <th>Sexo</th>
        <th>Telefone</th>
        <th>E-mail</th>
        <th>Ações</th>
    </tr>

    <?php while ($row = $result->fetch_assoc()): ?>
        <tr>
            <td><?= $row['id'] ?></td>
            <td><?= $row['nome'] ?></td>
            <td><?= $row['nascimento'] ?></td>
            <td><?= $row['cpf'] ?></td>
            <td><?= $row['sexo'] ?></td>
            <td><?= $row['telefone'] ?></td>
            <td><?= $row['email'] ?></td>
            <td>
                <a href="editar.php?id=<?= $row['id'] ?>">Editar</a>
                <a href="excluir.php?id=<?= $row['id'] ?>" onclick="return confirm('Tem certeza que deseja excluir esta pessoa?')">Excluir</a>


            </td>
        </tr>
    <?php endwhile; ?>
</table>
