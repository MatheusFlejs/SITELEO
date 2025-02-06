<?php
// Conectar ao banco de dados
$servername = "localhost"; // ou o endereço do seu servidor MySQL
$username = "root"; // seu nome de usuário do MySQL
$password = "adminroot"; // sua senha do MySQL
$dbname = "leo_clube"; // nome do seu banco de dados

// Criar conexão
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar conexão
if ($conn->connect_error) {
    die("Conexão falhou: " . $conn->connect_error);
}

// Obter dados do formulário
$email = $_POST['email'];
$senha = password_hash($_POST['senha'], PASSWORD_DEFAULT); // Hash da senha

// Inserir dados no banco de dados
$sql = "INSERT INTO usuarios (email, senha) VALUES ('$email', '$senha')";

if ($conn->query($sql) === TRUE) {
    echo "Novo registro criado com sucesso";
} else {
    echo "Erro: " . $sql . "<br>" . $conn->error;
}

// Fechar conexão
$conn->close();
?>