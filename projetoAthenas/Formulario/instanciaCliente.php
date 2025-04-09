<?php
    session_start(); // Inicia a sessão no início do script
    
    // Incluindo as classes necessárias
    require_once 'C:\xampp\htdocs\projetoAthenas\Classes\Cliente.php';
    require_once 'C:\xampp\htdocs\projetoAthenas\Classes\entidade.php';
    require_once 'C:\xampp\htdocs\projetoAthenas\Classes\Gateway\ClienteGateway.php';

    // Definindo credenciais de banco de dados
    $username = 'root';
    $password = '';

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
                echo "Este email já está em uso. Por favor, escolha outro.";
            } else {
                // Incluindo a classe Config
                require_once 'C:\xampp\htdocs\projetoAthenas\Classes\Config.php';

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
                //header("Location: login.html");
            }
        }
    } catch (Exception $e) {
        // Capturando e exibindo erros
        print "Erro: ". $e->getMessage();
    }
?>
