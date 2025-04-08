<?php
include '../config.php';

if (!isset($_GET['id'])) {
    echo "<script>alert('ID da pessoa não informado!'); window.location.href='listar.php';</script>";
    exit;
}

$id = $_GET['id'];

$sql = "SELECT * FROM pessoas WHERE id = $id";
$result = $conn->query($sql);

if ($result->num_rows === 0) {
    echo "<script>alert('Pessoa não encontrada!'); window.location.href='listar.php';</script>";
    exit;
}

$sqlCheck = "SELECT * FROM imoveis WHERE id_contribuinte = $id";
$resultCheck = $conn->query($sqlCheck);

if ($resultCheck->num_rows > 0) {

    echo "<script>alert('Não é possível excluir esta pessoa, pois ela possui imóveis cadastrados!'); window.location.href='listar.php';</script>";
    exit;
}

$sqlDelete = "DELETE FROM pessoas WHERE id = $id";

if ($conn->query($sqlDelete) === TRUE) {
  
    header("Location: listar.php");
    exit;
} else {
    echo "<script>alert('Erro ao excluir: " . $conn->error . "'); window.location.href='listar.php';</script>";
    exit;
}
?>
