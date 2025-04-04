<?php

include '../config.php';

if($_SERVER["REQUEST_METHOD"] == "POST"){
    $nome = $_POST["nome"];
    $data_nascimento = $_POST["data_nascimento"];
    $cpf = $_POST["cpf"]; 
    $sexo = $_POST["sexo"];
    $telefone = $_POST["telefone"];
    $email = $_POST["email"];

   
    $sql = "INSERT INTO pessoas(nome, nascimento, cpf, sexo, telefone, email)
    VALUES ('$nome', '$data_nascimento', '$cpf', '$sexo', '$telefone','$email')";
    

    if($conn->query($sql) === TRUE){
        echo "Cadastro realizado com sucesso!";
    } else {
        echo "Erro: " . $conn->error;
    }
}
?>

<form method="post">
    Nome: <input type="text" name="nome" required>
    <br>
    Data de Nascimento: <input type="date" name="data_nascimento" required>
    <br>
    CPF: <input type="text" name="cpf" required>  
    Sexo:
    <select name="sexo" required>
        <option value="M">Masculino</option>
        <option value="F">Feminino</option>
    </select>
    <br>
    Telefone: <input type="text" name="telefone" required>
    <br>
    E-mail: <input type="email" name="email"><br>
    <button type="submit">Cadastrar</button>
</form>
