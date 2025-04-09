<?php
session_start(); // Inicia a sessão no início do script

    $username = 'root';
    $password = '';

    try {
        // Conexão com o banco de dados usando PDO
        $conn = new PDO('mysql:host=localhost; dbname=dbathenas', $username, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        if (isset($_POST["Entrar"])) {
            // Recebe os dados do formulário
            $email = ($_POST['email']);
            $senha = ($_POST['senha']);
        
        // Consulta preparada para evitar injeção de SQL
        $stmt = $conn->prepare("SELECT codUsuario, email, senha FROM usuario WHERE email = :email LIMIT 1");
        $stmt->bindParam(':email', $email, PDO::PARAM_STR);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($row) {
            // Compara a senha inserida com a senha no banco de dados usando password_verify
            if (password_verify($senha, $row['senha'])) {
                // Credenciais corretas, redireciona para a página autenticada ou realiza alguma ação
                $_SESSION['codUsuario'] = $row['codUsuario'];
                $_SESSION['email'] = $row['email'];

                echo "login feito com sucesso";
                //header("Location: home.html");
                exit(); // Encerra a execução após o redirecionamento
            } else {
                // Senha incorreta
                echo "Senha ou usuario incorreta. Por favor, tente novamente.";
            }
        } else {
            // Usuário não encontrado
            echo "Senha ou usuario incorreta. Por favor, tente novamente.";
        }
    } 
    // Fecha a conexão com o banco de dados
    $conn = null;
}
    catch (PDOException $e) {
        // Trata qualquer exceção relacionada ao banco de dados
        echo "Erro de conexão com o banco de dados: " . $e->getMessage();
    }
?>