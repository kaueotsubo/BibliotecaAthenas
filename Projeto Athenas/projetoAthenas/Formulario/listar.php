<?php
session_start(); // Inicia a sessão

// Verifica se o ADM está autenticado
if (!isset($_SESSION['codAdm']) || !isset($_SESSION['email'])) {
    // Redireciona para a página de login se o ADM não estiver autenticado
    header("Location: login-adm.html");
    exit();
}

// Credenciais do banco de dados
$username = 'root';
$password = '';

// Fecha a conexão com o banco de dados
$conn = null;
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestão de Usuários</title>
    <link rel="stylesheet" href="listar.css">
</head>
<body>
    <div class="container">
        <?php
        // Configurações do banco de dados
        $host = 'localhost'; // Host do banco de dados
        $dbName = 'dbathenas'; 
        $username = 'root'; // Nome de usuário do banco de dados
        $password = ''; // Senha do banco de dados

        try {
            // Conexão com o banco de dados usando PDO
            $conn = new PDO("mysql:host=$host;dbname=$dbName;charset=utf8mb4", $username, $password);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            // Verifica se um código de usuário foi enviado para exclusão
            if (isset($_POST['delete'])) {
                $codUsuario = intval($_POST['codUsuario']);
                
                // Preparar e executar a consulta de exclusão
                $deleteSql = "DELETE FROM usuario WHERE codUsuario = :codUsuario";
                $stmt = $conn->prepare($deleteSql);
                $stmt->bindParam(':codUsuario', $codUsuario, PDO::PARAM_INT);
                
                if ($stmt->execute()) {
                    echo "<p class='success'>Usuário excluído com sucesso.</p>";
                } else {
                    echo "<p class='error'>Erro ao excluir o usuário.</p>";
                }
            }

            // Verifica se um formulário de edição foi enviado
            if (isset($_POST['edit'])) {
                $codUsuario = intval($_POST['codUsuario']);
                $nome = htmlspecialchars($_POST['nome']);
                $email = htmlspecialchars($_POST['email']);
                $dataNascimento = htmlspecialchars($_POST['dataNascimento']);
                
                // Preparar e executar a consulta de atualização
                $updateSql = "UPDATE usuario SET nome = :nome, email = :email, dataNascimento = :dataNascimento WHERE codUsuario = :codUsuario";
                $stmt = $conn->prepare($updateSql);
                $stmt->bindParam(':codUsuario', $codUsuario, PDO::PARAM_INT);
                $stmt->bindParam(':nome', $nome, PDO::PARAM_STR);
                $stmt->bindParam(':email', $email, PDO::PARAM_STR);
                $stmt->bindParam(':dataNascimento', $dataNascimento, PDO::PARAM_STR);
                
                if ($stmt->execute()) {
                    echo "<p class='success'>Informações do usuário atualizadas com sucesso.</p>";
                } else {
                    echo "<p class='error'>Erro ao atualizar as informações do usuário.</p>";
                }
            }

            // Consulta para contar o número total de usuários
            $countSql = "SELECT COUNT(*) as total FROM usuario";
            $stmt = $conn->query($countSql);
            $countResult = $stmt->fetch(PDO::FETCH_ASSOC);
            $totalUsuarios = $countResult['total'];

            // Consulta SQL para selecionar todas as informações da tabela usuario
            $sql = "SELECT codUsuario, nome, email, dataNascimento FROM usuario";
            $stmt = $conn->query($sql);

            // Array para armazenar os resultados
            $usuarios = $stmt->fetchAll(PDO::FETCH_ASSOC);

            // Verifica se há usuários para mostrar
            if (count($usuarios) > 0) {
                echo "<h2>Lista de Usuários:</h2>";
                foreach ($usuarios as $usuario) {
                    echo "<div class='user'>";
                    echo "<p><strong>Nome:</strong> {$usuario['nome']}</p>";
                    echo "<p><strong>Email:</strong> {$usuario['email']}</p>";
                    echo "<p><strong>Data de Nascimento:</strong> {$usuario['dataNascimento']}</p>";
                    
                    // Formulário para excluir o usuário
                    echo "<form method='post' action='' class='form-inline'>";
                    echo "<input type='hidden' name='codUsuario' value='{$usuario['codUsuario']}'>";
                    echo "<input type='submit' name='delete' value='Excluir' class='btn btn-danger'>";
                    echo "</form>";
                    
                    // Formulário para editar o usuário
                    echo "<form method='post' action='' class='form-inline'>";
                    echo "<input type='hidden' name='codUsuario' value='{$usuario['codUsuario']}'>";
                    echo "<input type='submit' name='edit_form' value='Editar' class='btn btn-primary'>";
                    echo "</form>";
                    
                    echo "</div>";
                }
            } else {
                echo "<p>Nenhum usuário encontrado na tabela.</p>";
            }

            // Exibe a contagem de usuários
            echo "<h2>Total de Usuários no sistema: $totalUsuarios</h2>";


            // Verifica se o formulário de edição foi acionado
            if (isset($_POST['edit_form'])) {
                $codUsuario = intval($_POST['codUsuario']);
                
                // Consulta para obter as informações do usuário para o formulário de edição
                $editSql = "SELECT nome, email, dataNascimento FROM usuario WHERE codUsuario = :codUsuario";
                $stmt = $conn->prepare($editSql);
                $stmt->bindParam(':codUsuario', $codUsuario, PDO::PARAM_INT);
                $stmt->execute();
                $usuario = $stmt->fetch(PDO::FETCH_ASSOC);
                
                if ($usuario) {
                    echo "<h2>Editar Usuário:</h2>";
                    echo "<form method='post' action=''>";
                    echo "<input type='hidden' name='codUsuario' value='{$codUsuario}'>";
                    echo "<p><label for='nome'>Nome:</label> <input type='text' id='nome' name='nome' value='{$usuario['nome']}' required></p>";
                    echo "<p><label for='email'>Email:</label> <input type='email' id='email' name='email' value='{$usuario['email']}' required></p>";
                    echo "<p><label for='dataNascimento'>Data de Nascimento:</label> <input type='date' id='dataNascimento' name='dataNascimento' value='{$usuario['dataNascimento']}' required></p>";
                    echo "<input type='submit' name='edit' value='Salvar Alterações' class='btn btn-success'>";
                    echo "</form>";
                } else {
                    echo "<p>Usuário não encontrado.</p>";
                }
            }

        } catch (PDOException $e) {
            echo "<p class='error'>Erro ao conectar com o banco de dados: " . $e->getMessage() . "</p>";
        }
        ?>
    </div>

    <div class="catego-baixo"> <!-- DIV DO "SAIR" -->
            <a href="logout.php">
                <i class="bi bi-box-arrow-right" style="font-size: 30px"></i> Sair
            </a>
        </div>
</body>
</html>