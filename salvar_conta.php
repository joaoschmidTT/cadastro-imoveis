<?php
include 'config.php';

$email = $_POST['email'];
$senha = $_POST['senha'];

$verificar = $conn->prepare("SELECT * FROM sistema_login WHERE email = ?");
$verificar->bind_param("s", $email);
$verificar->execute();                                                 //pribindo duas contas com o mesmo gmails
$result = $verificar->get_result();

if ($result->num_rows > 0) {
    header("Location: criar_conta.php?erro=1");             
    exit();
}

$sql = "INSERT INTO sistema_login (email, senha) VALUES (?, ?)";
$stmt = $conn->prepare($sql);                
$stmt->bind_param("ss", $email, $senha);

if ($stmt->execute()) {
    header("Location: criar_conta.php?sucesso=1");
} else {                                                                                      
    header("Location: criar_conta.php?erro=1");
}
?>
