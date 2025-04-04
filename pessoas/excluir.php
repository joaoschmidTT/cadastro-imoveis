<?php
include '../config.php';

if (!isset($_GET['id'])) {
    echo "ID da pessoa não informado!";
    exit;
}

$id = $_GET['id'];


$sql = "SELECT * FROM pessoas WHERE id = $id";
$result = $conn->query($sql);

if ($result->num_rows === 0) {
    echo "Pessoa não encontrada!";
    exit;
}

$sqlCheck = "SELECT * FROM imoveis WHERE id_contribuinte = $id";
$resultCheck = $conn->query($sqlCheck);

if ($resultCheck->num_rows > 0) {
    echo "Não é possível excluir esta pessoa, pois ela possui imóveis cadastrados!";
    exit;
}


$sqlDelete = "DELETE FROM pessoas WHERE id = $id";

if ($conn->query($sqlDelete) === TRUE) {
    header("Location: listar.php");
    exit;
} else {
    echo "Erro ao excluir: " . $conn->error;
}
?>
