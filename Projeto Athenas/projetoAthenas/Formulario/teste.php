<?php
session_start(); // Inicia a sessão

// Verifica se o usuário está autenticado
if (!isset($_SESSION['codUsuario'])) {
    // Redireciona para a página de login se o usuário não estiver autenticado
    header("Location: login.php");
    exit();
}

// Credenciais do banco de dados
$username = 'root';
$password = '';

try {
    // Conexão com o banco de dados usando PDO
    $conn = new PDO('mysql:host=localhost;dbname=dbathenas', $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Consulta preparada para buscar o nome do usuário
    $stmt = $conn->prepare("SELECT nome FROM usuario WHERE codUsuario = :codUsuario LIMIT 1");
    $stmt->bindParam(':codUsuario', $_SESSION['codUsuario'], PDO::PARAM_INT);
    $stmt->execute();
    $row = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($row) {
        $nome = $row['nome'];
    } else {
        echo "Não foi possível encontrar o nome do usuário.";
        exit();
    }
} catch (PDOException $e) {
    // Trata qualquer exceção relacionada ao banco de dados
    echo "Erro de conexão com o banco de dados: " . $e->getMessage();
    exit();
}

// Fecha a conexão com o banco de dados
$conn = null;
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Página de Teste</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            text-align: center;
            margin: 50px;
        }
        button {
            padding: 10px 20px;
            font-size: 16px;
            cursor: pointer;
            border: none;
            border-radius: 5px;
            background-color: #007bff;
            color: #fff;
        }
        button:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <h1>Bem-vindo, <?php echo htmlspecialchars($nome); ?>!</h1>
    <p>Você está autenticado e os seus dados foram carregados corretamente.</p>
    <form action="logout.php" method="post">
        <button type="submit">Sair</button>
    </form>
</body>
</html>
