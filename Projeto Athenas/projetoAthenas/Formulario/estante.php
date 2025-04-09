<?php
session_start(); // Inicia a sessão

// Verifica se o usuário está autenticado
if (!isset($_SESSION['codUsuario']) || !isset($_SESSION['email'])) {
    // Redireciona para a página de login se o usuário não estiver autenticado
    header("Location: login.html");
    exit();
}

// Credenciais do banco de dados
$username = 'root';
$password = '';

try {
    // Conexão com o banco de dados usando PDO
    $conn = new PDO('mysql:host=localhost;dbname=dbathenas', $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Consulta preparada para buscar o nome do usuário usando codUsuario e email
    $stmt = $conn->prepare("SELECT nome FROM usuario WHERE codUsuario = :codUsuario AND email = :email LIMIT 1");
    $stmt->bindParam(':codUsuario', $_SESSION['codUsuario'], PDO::PARAM_INT);
    $stmt->bindParam(':email', $_SESSION['email'], PDO::PARAM_STR);
    $stmt->execute();
    $row = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($row) {
        $nome = $row['nome'];
    } else {
        $nome = "Usuário"; // Valor padrão caso o nome não seja encontrado
    }
} catch (PDOException $e) {
    echo "Erro de conexão com o banco de dados: " . $e->getMessage();
    exit();
}

$conn = null;
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <title> Estante </title>
    <meta name="viewport" content="width=device-width, initial-scale=1"><link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/meyer-reset/2.0/reset.min.css">
    <link rel="shortcut icon" href="logo2.png" type="image/x-icon">
    <link rel="stylesheet" href="estante.css">
    <link rel = "stylesheet" href = "https://fonts.googleapis.com/icon?family=Material+Icons">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
  </head>
  <body>
    <!-- partial:index.partial.html -->
    <div class = "menu_lateral"> <!--Começa HTML do Menu-->
      <div class="header__logo"> <!-- DIV LOGO -->
        <a href = "index1.php">
          <img src = "logo.png">
        </a>
      </div> <!-- FIM DIV LOGO -->
      <div class = "catego"> <!-- DIV DO ICONE DO INICIO-->
          <a href = "index1.php">
                <i class="bi bi-house-door-fill" style="font-size: 26px"></i> Início <br><br><br>
          </a>
      </div> <!-- FIM DA DIV DO ICONE DO INICIO-->
      <div class = "catego"> <!-- DIV DO ICONE DA ESTANTE-->
        <a href = "estante.php">
              <i class="bi bi-bookshelf" style="font-size: 26px"></i> Estante <br><br><br>
        </a>
      </div> <!-- FIM DA DIV DO ICONE DA ESTANTE-->
      <div class = "catego"> <!-- DIV DO ICONE DA LOJA-->
        <a href = "library.php">
              <i class="bi bi-bag-fill" style="font-size: 26px"></i> Biblioteca
        </a>
      </div> <!-- FIM DA DIV DO ICONE DA LOJA-->
      <br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
      <div class = "catego-baixo"> <!-- DIV DO "SAIR"-->
        <a href = "inicial.html">
              <i class="bi bi-box-arrow-right" style="font-size: 30px"></i> Sair
        </a>
      </div> <!-- FIM DA DIV DO "SAIR"-->
    </div> <!-- FIM DO HTML DO MENU-->

    <div class = "pesquisar"> <!-- COMEÇO DA BARRA DE PESQUISA-->
      <input type = "placebarra" id = "barra" name="buscar" placeholder = "Pesquise seus livros favoritos">
          <label for = "" class = "lupa">
              <i class="bi bi-search" style="font-size:16px"></i>
          </label>
    </div> <!-- FIM DA BARRA DE PESQUISA-->

    <div class = "fav"> <!-- COMEÇO DIV FAVORITOS -->
      <a href = "favoritos.php"> 
          <i class="bi bi-heart" style="font-size:25px"></i>
      </a>
  </div> <!-- FIM DA DIV FAVORITOS -->

  <div class = "person"> <!-- COMEÇO DIV PESSOA LOGADA -->
        <i class="bi bi-person" style="font-size:30px"></i>
         Olá, <?php echo htmlspecialchars($nome, ENT_QUOTES, 'UTF-8'); ?>!
    </div> <!-- FIM DA DIV PESSOA LOGADA -->

    <!-- COMEÇO DA PAG PRINCIPAL -->

    <div class = "text"> <!-- TEXTO "ESTANTE"-->
      Estante
    </div> <!-- FIM DO TEXTO-->

    <a href = "estante.php"> <!-- COMEÇO DIV BOTAO TODOS OS LIVROS -->
      <div class = "all-books"> 
        <div class = "components">
          <p> Todos os livros </p>
        </div>  
      </div>
    </a>   <!-- FIM DA DIV BOTAO "TODOS OS LIVROS" -->

    <a href = "lidos.php"> <!-- COMEÇO DIV BOTAO LIDOS -->
      <div class = "read"> 
        <div class = "components">
          <p> Lidos </p>
        </div>  
      </div>
    </a>   <!-- FIM DA DIV BOTAO LIDOS -->

    <a href = "queroler.php"> <!-- COMEÇO DIV BOTAO QUERO LER -->
      <div class = "want-read"> 
        <div class = "components">
          <p> Quero Ler </p>
        </div>  
      </div>
    </a>   <!-- FIM DA DIV BOTAO QUERO LER -->

    <a href = "favoritos.php"> <!-- COMEÇO DIV BOTAO FAVORITOS -->
      <div class = "favoritos"> 
        <div class = "components">
          <p> Favoritos </p>
        </div>  
      </div>
    </a>   <!-- FIM DA DIV BOTAO FAVORITOS -->

    <a href = "addlivro.php"> <!-- COMEÇO DIV BOTAO ADICIONAR LIVRO + -->
      <div class = "add-book"> 
        <div class = "components">
          <p> Adicionar livro </p>
        </div>  
      </div>
    </a>   <!-- FIM DA DIV BOTAO ADICIONAR LIVRO + -->
    
    <!-- <div class = "principal"> COMEÇO DA DIV DA PAG PRINCIPAL

    </div> FIM DA DIV DA PAG PRINCIPAL -->

    <!-- partial -->
      <script src='https://unpkg.com/feather-icons'></script><script  src="./script.js"></script>
  </body>
</html>
