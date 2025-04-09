<?php
session_start(); // Inicia a sessão no início do script

// Incluindo as classes necessárias
require_once 'C:\xampp\htdocs\Projeto Athenas\projetoAthenas\Classes\Cliente.php';
require_once 'C:\xampp\htdocs\Projeto Athenas\projetoAthenas\Classes\entidade.php';
require_once 'C:\xampp\htdocs\Projeto Athenas\projetoAthenas\Classes\Gateway\ClienteGateway.php';

// Definindo credenciais de banco de dados
$username = 'root';
$password = '';

$errorMessage = ""; // Variável para armazenar a mensagem de erro

try {
    // Estabelecendo a conexão com o banco de dados usando PDO
    $conn = new PDO('mysql:host=localhost; dbname=dbathenas', $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Configurando a classe ClienteGateway com a conexão estabelecida
    ClienteGateway::setConnection($conn);

    // Criando uma instância da classe ClienteGateway
    $clienteGateway = new ClienteGateway;

    // Recebendo as informações do formulário cadastro.html
    if (isset($_POST["enviar"])) {
        $nome = ($_POST["nome"]);
        $nascimento = ($_POST["nascimento"]);
        $email = ($_POST["email"]);
        $senha = password_hash($_POST["senha"], PASSWORD_DEFAULT);
        $confSenha = password_hash($_POST["confirme"], PASSWORD_DEFAULT);
         
        // Consulta SQL para verificar se o email já existe
        $stmt = $conn->prepare("SELECT * FROM usuario WHERE email = :email");
        $stmt->bindParam(':email', $email);
        $stmt->execute();

        // Verificando se a consulta retornou alguma linha
        $rowCount = $stmt->rowCount();
        if ($rowCount > 0) {
            // Mensagem de aviso se o email já estiver em uso
            $errorMessage = "Este e-mail já está em uso. Por favor, escolha outro.";
        } else {
            // Incluindo a classe Config
            require_once 'C:\xampp\htdocs\Projeto Athenas\projetoAthenas\Classes\Config.php';

            // Inserindo os dados no banco de dados
            $sql = "INSERT INTO usuario(nome, dataNascimento, email, senha, confSenha)
                    VALUES (:nome, :dataNascimento, :email, :senha, :confSenha)";
                
            // Preparando a consulta para execução
            $stmt = $conn->prepare($sql);

            // Bind dos valores
            $stmt->bindValue(':nome', $nome, PDO::PARAM_STR);
            $stmt->bindValue(':dataNascimento', $nascimento, PDO::PARAM_STR);
            $stmt->bindValue(':email', $email, PDO::PARAM_STR);
            $stmt->bindValue(':senha', $senha, PDO::PARAM_STR);
            $stmt->bindValue(':confSenha', $confSenha, PDO::PARAM_STR);

            // Executando a consulta
            $stmt->execute();

            // Redirecionando o usuário para a página de login
            header("Location: login.html");
        }
    }
} catch (Exception $e) {
    // Capturando e exibindo erros
    print "Erro: ". $e->getMessage();
}
?>


<html>
    <!--Incio do HEAD-->
    <head>
        <meta charset="UTF-8">
        <title> Cadastro </title>
        <link rel="shortcut icon" href="logo2.png" type="image/x-icon">
        <link rel="stylesheet" href="cad-instancia.css">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
        <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    </head>
    <!--Fim do Head-->
    <!--Inicio do Body-->
    <body>
        <!--Fundo do Cadastro-->
        <div class="fundo-cadastro">
            <div id="itens-cadastro">
                <div class="text-cadastro">
                    CADASTRO
                </div>
                <!--Inicio do Form InstanciaCliente.php-->
                <form action="instanciaCliente.php" method="POST">

                    <!--Mensagem de erro-->
                    <?php if (!empty($errorMessage)): ?>
                        <div class="error-message"><?php echo $errorMessage; ?></div>
                    <?php endif; ?>
                    <!--Fim da mensagem de erro-->

                    <div class = "p-input-box">
                    <!--Inicio da Caixa Nome-->
                        <div class="input-box">
                            <input type="text" id="nome" name="nome" placeholder="Nome" required>
                        </div>
                        <!--Fim da Caixa Nome-->

                        <!--Inicio da caixa E-mail-->
                        <div class="input-box">
                            <input type="email" id="email" name="email" placeholder="E-mail" required>
                        </div>
                        <!--Fim da caixa E-mail-->
                
                        <!--Inicio da caixa data De Nascimento-->
                        <div class="input-box">
                            <input type="date" style="color:#d39c249a" id="nascimento" name="nascimento" placeholder="Data de Nascimento" required>
                        </div>
                        <!--Fim da caixa Data De Nascimento-->
                
                        <!--Inicio da caixa Senha-->
                        <div class="input-box">
                            <input type="password" id="senha" name="senha" onchange='confereSenha();' placeholder="Senha" required>
                        </div>
                        <!--Fim da caixa Senha-->
                
                        <!--Inicio da caixa Confirma Senha-->
                        <div class="input-box">
                            <input type="password" id="confirme" name="confirme" onchange='confereSenha();' placeholder="Confirme sua senha" required>
                        </div>
                        <!--Fim da caixa Confirma Senha-->
                    </div>
            
                    <!--Inicio do Botão para pagina de login-->
                    <div class="possui-cad">
                        Já possui uma conta? Clique
                        <a href="login.html">
                            aqui.
                        </a>
                    </div>

                    <!--Inicio do Botão da InstanciaCliente.php-->
                    <div class="input-button">
                        <input type="submit" name="enviar" value="Cadastrar">
                    </div>
                    <!--Fim do botão-->
                </form>
                <!--Fim do form-->
            </div>
            <!--Fim do Botão-->
            
            <!--Fundo do login-->
            <div class="fundo-login">
                <!--Logo do site-->
                <div class="logo">
                    <a href="index.html">
                        <img src="logo.png" width="240"> <br>
                    </a>
                </div>
        
                <!--Div Classes redes socias-->
                <div class="redes">
                    <div class="facebook">
                        <a href="https://www.facebook.com/people/Biblioteca-Athena/pfbid0rVYsS8E3FWrJfbjCu6fYysDitAvbM1k3wFoNcoVPnXyk1tqjAhQdJu4d3vEQC5tml/?mibextid=ZbWKwL">
                            <i class="bi bi-facebook" style="font-size:30px"></i></a>
                    </div>
                    <div class="twitter">
                        <a href="https://x.com/b__athena">
                            <i class="bi bi-twitter" style="font-size:30px"></i></a>
                    </div>
                    <div class="insta">
                        <a href="https://www.instagram.com/athena_biblioteca?igsh=aGp4c3Z1YzJ1ZzZq&utm_source=qr">
                            <i class="bi bi-instagram" style="font-size:30px"></i></a>
                    </div>
                    <div class="tiktok">
                        <a href="https://www.tiktok.com/@biblioteca.athena">
                            <i class="bi bi-tiktok" style="font-size:30px"></i></a>
                    </div>
                </div>
                <!--Fim da div classes redes socias-->
            </div>
        </div>
    </body>
</html>