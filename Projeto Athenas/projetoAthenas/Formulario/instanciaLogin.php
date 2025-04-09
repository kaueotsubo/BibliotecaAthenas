<?php
session_start(); // Inicia a sessão no início do script

// Credenciais do banco de dados
$username = 'root';
$password = '';

try {
    // Conexão com o banco de dados usando PDO
    $conn = new PDO('mysql:host=localhost;dbname=dbathenas', $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $errorMessage = ""; // Variável para armazenar a mensagem de erro

    if (isset($_POST["Entrar"])) {
        // Recebe os dados do formulário e faz a sanitização
        $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
        $senha = $_POST['senha'];

        // Valida o email
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $errorMessage = "Senha ou usuário incorretos. Por favor, tente novamente.";
        } else {
            // Consulta preparada para evitar injeção de SQL
            $stmt = $conn->prepare("SELECT codUsuario, email, senha FROM usuario WHERE email = :email LIMIT 1");
            $stmt->bindParam(':email', $email, PDO::PARAM_STR);
            $stmt->execute();
            $row = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($row) {
                // Compara a senha inserida com a senha no banco de dados usando password_verify
                if (password_verify($senha, $row['senha'])) {
                    // Credenciais corretas, armazena as informações na sessão
                    $_SESSION['codUsuario'] = $row['codUsuario'];
                    $_SESSION['email'] = $row['email'];

                    // Redireciona para a página autenticada
                    header("Location: index1.php");
                    exit(); // Encerra a execução após o redirecionamento
                } else {
                    // Senha incorreta
                    $errorMessage = "Senha ou usuário incorretos. Por favor, tente novamente.";
                }
            } else {
                // Usuário não encontrado
                $errorMessage = "Senha ou usuário incorretos. Por favor, tente novamente.";        
            }
        }
    }
} catch (PDOException $e) {
    // Trata qualquer exceção relacionada ao banco de dados
    echo "Erro de conexão com o banco de dados: " . $e->getMessage();
}

// Fecha a conexão com o banco de dados
$conn = null;
?>

<html>
    <!--Início do HEAD-->
    <head>
        <meta charset = "UTF-8">
        <title> Login </title>
        <link rel="shortcut icon" href="logo2.png" type="image/x-icon">
        <link rel = "stylesheet" href = "login-instancia.css">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
        <link rel = "stylesheet" href = "https://fonts.googleapis.com/icon?family=Material+Icons">
    </head>
    <!--Fim do Head-->
    <!--Início do Body-->
    <body>
        <!--Fundo do Login-->
        <div class = "fundo-cadastro">
            <div id = "itens-cadastro">
                <div class = "text-login">
                    LOGIN
                </div>
                <!--Início do Form InstanciaCliente.php-->
                <form action = "instanciaLogin.php" method = "POST">


                    <!--Mensagem de erro-->
                    <?php if (!empty($errorMessage)): ?>
                        <div class="error-message"><?php echo $errorMessage; ?></div>
                    <?php endif; ?>
                    <!--Fim da mensagem de erro-->

                    <!--Início da caixa E-mail-->
                    <div class = "p-input-box">
                        <div class = "input-box">
                            <input type = "email" id = "email" name = "email" placeholder = "E-mail" required>
                        </div>
                        <!--Fim da caixa E-mail-->
                        <!--Início da caixa Senha-->
                        <div class = "input-box">
                            <input type = "password" id = "senha" name = "senha" placeholder = "Senha" required>
                        </div>
                        <!--Fim da caixa Senha-->
                    </div>

                    <!--Início do botão para lembrar do dispositivo-->
                    <div class = "recup-senha">
                        Esqueceu sua senha?
                        <br>
                        Clique
                        <a href = "recupsenha1.html">
                            aqui.
                        </a>
                    </div>
                    <!--Fim do Botão-->

                    <!--Início do Botão para página de login-->
                    <div class = "possui-cad">
                        Não possui uma conta? 
                        <br>
                        Clique
                        <a href = "cadastro.html">
                            aqui.
                        </a>
                    </div>

                    <!--Início do Botão da InstanciaCliente.php-->
                    <div class = "input-button">
                        <input type = "submit" name="Entrar" value = "Entrar">
                    </div>
                    <!--Fim do botão-->
                </form>
                <!--Fim do form-->
            </div>
            <!--Fim do Botão-->

            <!--Fundo do cadastro-->
            <div class = "fundo-login">
                <!--Logo do site-->
                <div class = "logo">
                    <a href = "index.html">
                        <img src = "logo.png" width="240"> <br>
                    </a>
                </div>

                <!--Div Classes redes sociais-->
                <div class = "redes">
                    <div class = "facebook">
                        <a href = "https://www.facebook.com/people/Biblioteca-Athena/pfbid0rVYsS8E3FWrJfbjCu6fYysDitAvbM1k3wFoNcoVPnXyk1tqjAhQdJu4d3vEQC5tml/?mibextid=ZbWKwL">
                            <i class="bi bi-facebook" style="font-size:30px"></i></a>
                    </div>
                    <div class = "twitter">
                        <a href = "https://x.com/b__athena">
                            <i class="bi bi-twitter" style="font-size:30px"></i></a>
                    </div>
                    <div class = "insta">
                        <a href = "https://www.instagram.com/athena_biblioteca?igsh=aGp4c3Z1YzJ1ZzZq&utm_source=qr">
                            <i class="bi bi-instagram" style="font-size:30px"></i></a>
                    </div>
                    <div class = "tiktok">
                        <a href = "https://www.tiktok.com/@biblioteca.athena">
                            <i class="bi bi-tiktok" style="font-size:30px"></i></a>
                    </div>
                </div>
                <!--Fim da div classes redes sociais-->
            </div>
        </div>
    </body>
</html>