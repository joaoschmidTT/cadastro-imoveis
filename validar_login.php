<?php
session_start();
include 'config.php'; 

$email = $_POST['email'];
$senha = $_POST['senha'];


$sql = "SELECT * FROM sistema_login WHERE email = ? AND senha = ?"; //pegando os dados do usario
$stmt = $conn->prepare($sql);
$stmt->bind_param("ss", $email, $senha);
$stmt->execute();
$resultado = $stmt->get_result();

if ($resultado->num_rows > 0) {
    $_SESSION['logado'] = true;
    header("Location: index.php");
    exit();
} else {
    header("Location: login.php?erro=1");   // probindo quem nao tem registro de acessar o banco // $SESSION enquanto o usario estiver usando
    exit();
}
?>


