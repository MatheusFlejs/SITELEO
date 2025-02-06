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
$senha = $_POST['senha'];

// Consultar o banco de dados
$sql = "SELECT senha FROM usuarios WHERE email = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $email);
$stmt->execute();
$stmt->store_result();

if ($stmt->num_rows > 0) {
    $stmt->bind_result($hashedPassword);
    $stmt->fetch();

    // Verificar a senha
    if (password_verify($senha, $hashedPassword)) {
        // Iniciar a sessão e redirecionar o usuário
        session_start();
        $_SESSION['email'] = $email; // Armazenar o e-mail na sessão
        header("Location: dashboard.php"); // Redirecionar para a página do usuário
        exit();
    } else {
        echo "Senha incorreta.";
    }
} else {
    echo "E-mail não encontrado.";
}

// Fechar conexão
$stmt->close();
$conn->close();
?>