<?php
include '../config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $logradouro = $_POST["logradouro"];
    $numero = $_POST["numero"];
    $bairro = $_POST["bairro"];
    $complemento = $_POST["complemento"];
    $id_contribuinte = $_POST["id_contribuinte"];

    $sql = "INSERT INTO imoveis (logradouro, numero, bairro, complemento, id_contribuinte) 
            VALUES ('$logradouro', '$numero', '$bairro', '$complemento', '$id_contribuinte')";

    if ($conn->query($sql) === TRUE) {
        echo "Imóvel cadastrado com sucesso!";
    } else {
        echo "Erro: " . $conn->error;
    }
}
?>

<form method="post">
    Logradouro: <input type="text" name="logradouro" required><br>
    Número: <input type="text" name="numero" required><br>
    Bairro: <input type="text" name="bairro" required><br>
    Complemento: <input type="text" name="complemento"><br>
    Proprietário (ID): <input type="number" name="id_contribuinte" required><br>
    <button type="submit">Cadastrar</button>
</form>
