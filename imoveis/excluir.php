<?php
include '../config.php';

if (!isset($_GET['id'])) {
    echo "ID do imóvel não informado!";
    exit;
}

$id = $_GET['id'];


$sqlCheck = "SELECT * FROM imoveis WHERE id = $id";
$resultCheck = $conn->query($sqlCheck);

if ($resultCheck->num_rows === 0) {
    echo "Imóvel não encontrado!";
    exit;
}


$sqlDelete = "DELETE FROM imoveis WHERE id = $id";

if ($conn->query($sqlDelete) === TRUE) {
    header("Location: listar.php");
    exit;
} else {
    echo "Erro ao excluir imóvel: " . $conn->error;
}
?>
