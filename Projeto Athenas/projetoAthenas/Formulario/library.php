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
    <title> Biblioteca </title>
    <meta name="viewport" content="width=device-width, initial-scale=1"><link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/meyer-reset/2.0/reset.min.css">
    <link rel="shortcut icon" href="logo2.png" type="image/x-icon">
    <link rel="stylesheet" href="library.css">
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
        <a href = "logout.php">
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

    <div class = "text"> <!-- TEXTO "LOJA GRATUITA"-->
      Biblioteca
    </div> <!-- FIM DO TEXTO-->
    
    <div class = "principal"> <!-- COMEÇO DA DIV DA PAG PRINCIPAL -->

        <div class="book-wrapper"> <!-- COMEÇO DA COLUNA 1 DOS LIVROS-->
  
          <div class="book-items"> <!-- POR LUGARES INCRIVEIS-->
            <div class="main-book-wrap">
              <div class="book-cover">
                <div class="book-inside"></div>
                <div class="book-image">
                  <img src="https://m.media-amazon.com/images/I/918Maoi6OML._AC_UF1000,1000_QL80_.jpg" />
                  <div class="effect"></div>
                  <div class="light"></div>
                </div>
              </div>
            </div>
          </div>
  
          <div class="book-items"> <!-- ONDE ESTÁ DAISY MASON? -->
            <div class="main-book-wrap">
              <div class="book-cover">
                <div class="book-inside"></div>
                <div class="book-image">
                  <img src="https://m.media-amazon.com/images/I/51Kvg6RZ0gL.jpg" />
                    <div class="effect"></div>
                    <div class="light"></div>
                  </div>
                </div>
              </div>
            </div>
  
          <div class="book-items"> <!-- UM DIA -->
            <div class="main-book-wrap">
              <div class="book-cover">
                <div class="book-inside"></div>
                <div class="book-image">
                  <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSLDdSsAV3vMFNoLM5_FyJTyBNN8-hXLuyqtw&s" />
                  <div class="effect"></div>
                  <div class="light"></div>
                </div>
              </div>
            </div>
          </div>
  
          <div class="book-items"> <!-- HP E O PRISIONEIRO DE AZKABAN-->
            <div class="main-book-wrap">
              <div class="book-cover">
                <div class="book-inside"></div>
                <div class="book-image">
                  <img src="https://a-static.mlcdn.com.br/450x450/livro-harry-potter-e-o-prisioneiro-de-azkaban/magazineluiza/225550200/0c04ae41f82f8055f6fc5e52a14ab335.jpg" />
                  <div class="effect"></div>
                  <div class="light"></div>
                </div>
              </div>
            </div>
          </div>
  
          <div class="book-items"> <!-- DOM QUIXOTE-->
            <div class="main-book-wrap">
              <div class="book-cover">
                <div class="book-inside"></div>
                <div class="book-image">
                  <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQZPGwL70Z6ePbbHkFtANy2I3JEMQIHyfioXA&s" />
                  <div class="effect"></div>
                  <div class="light"></div>
                </div>
              </div>
            </div>
          </div>
  
          <div class="book-items"> <!-- A NOITE DAS BRUXAS-->
            <div class="main-book-wrap">
              <div class="book-cover">
                <div class="book-inside"></div>
                <div class="book-image">
                  <img src="https://m.media-amazon.com/images/I/81eOzHxJGSL._AC_UF894,1000_QL80_.jpg" />
                  <div class="effect"></div>
                  <div class="light"></div>
                </div>
              </div>
            </div>
          </div>
  
          <div class="book-items"> <!-- KEN FOLLETT -->
            <div class="main-book-wrap">
              <div class="book-cover">
                <div class="book-inside"></div>
                <div class="book-image">
                  <img src="https://m.media-amazon.com/images/I/81UDURxVJqL._AC_UF1000,1000_QL80_.jpg" />
                  <div class="effect"></div>
                  <div class="light"></div>
                </div>
              </div>
            </div>
          </div>
  
        </div> <!-- FIM DA DIV DOS LIVROS -->

    <div class = "banner"> <!-- COMEÇO DO BANNER -->
        <img src = "banner1.png">
    </div> <!-- FIM DO BANNER-->

    <div class="book-wrapper2"> <!-- COMEÇO DA COLUNA 2 DOS LIVROS-->
  
          <div class="book-items"> <!-- FIVE NIGHT AT FREDDY'S OLHOS PRATEADOS-->
            <div class="main-book-wrap">
              <div class="book-cover">
                <div class="book-inside"></div>
                <div class="book-image">
                  <img src="https://images.tcdn.com.br/img/img_prod/1222279/olhos_prateados_five_nights_at_freddy_s_livro_1_autor_scott_cawthon_ed_intrinseca_p91_5703_1_a4e901ec29a393e66dd75ccff8a502ee.jpg" />
                  <div class="effect"></div>
                  <div class="light"></div>
                </div>
              </div>
            </div>
          </div>
  
          <div class="book-items"> <!-- FIVE NIGHT AT FREDDY'S OS DISTORCIDOS-->
            <div class="main-book-wrap">
              <div class="book-cover">
                <div class="book-inside"></div>
                <div class="book-image">
                  <img src="https://m.media-amazon.com/images/I/610N3EZhJlL.jpg" />
                    <div class="effect"></div>
                    <div class="light"></div>
                  </div>
                </div>
              </div>
            </div>
  
          <div class="book-items"> <!-- FIVE NIGHT AT FREDDY'S A ULTIMA PORTA-->
            <div class="main-book-wrap">
              <div class="book-cover">
                <div class="book-inside"></div>
                <div class="book-image">
                  <img src="https://m.media-amazon.com/images/I/510hiVEXq6L.jpg" />
                  <div class="effect"></div>
                  <div class="light"></div>
                </div>
              </div>
            </div>
          </div>
  
          <div class="book-items"> <!-- FIVE NIGHT AT FREDDY'S MERGULHO NA ESCURIDÃO-->
            <div class="main-book-wrap">
              <div class="book-cover">
                <div class="book-inside"></div>
                <div class="book-image">
                  <img src="https://m.media-amazon.com/images/I/414Lyk-1FjL.jpg" />
                  <div class="effect"></div>
                  <div class="light"></div>
                </div>
              </div>
            </div>
          </div>
  
          <div class="book-items"> <!-- FIVE NIGHT AT FREDDY'S CAÇADOR-->
            <div class="main-book-wrap">
              <div class="book-cover">
                <div class="book-inside"></div>
                <div class="book-image">
                  <img src="https://m.media-amazon.com/images/I/818dpgoUvVL._AC_UF1000,1000_QL80_.jpg" />
                  <div class="effect"></div>
                  <div class="light"></div>
                </div>
              </div>
            </div>
          </div>
  
          <div class="book-items"> <!-- FIVE NIGHT AT FREDDY'S HORA DE ACORDAR-->
            <div class="main-book-wrap">
              <div class="book-cover">
                <div class="book-inside"></div>
                <div class="book-image">
                  <img src="https://m.media-amazon.com/images/I/61F-7eY4BkL._AC_UF1000,1000_QL80_.jpg" />
                  <div class="effect"></div>
                  <div class="light"></div>
                </div>
              </div>
            </div>
          </div>
  
          <div class="book-items"> <!-- FIVE NIGHT AT FREDDY'S CHEGUE MAIS PERTO-->
            <div class="main-book-wrap">
              <div class="book-cover">
                <div class="book-inside"></div>
                <div class="book-image">
                  <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSnHCKplp8SVkYZDUAtNmSWUrKAHdH18UV-dg&s" />
                  <div class="effect"></div>
                  <div class="light"></div>
                </div>
              </div>
            </div>
          </div>
  
        </div> <!-- FIM DA DIV "COLUNA 2" DOS LIVROS -->

        <div class="book-wrapper3"> <!-- COMEÇO DA COLUNA 3 DOS LIVROS-->
  
          <div class="book-items"> <!-- GAROTA EXEMPLAR-->
            <div class="main-book-wrap">
              <div class="book-cover">
                <div class="book-inside"></div>
                <div class="book-image">
                  <img src="https://m.media-amazon.com/images/I/510k5EkYuWL._AC_UF1000,1000_QL80_.jpg" />
                  <div class="effect"></div>
                  <div class="light"></div>
                </div>
              </div>
            </div>
          </div>
  
          <div class="book-items"> <!-- CYBERPUNK TRAUMAR TEAM -->
            <div class="main-book-wrap">
              <div class="book-cover">
                <div class="book-inside"></div>
                <div class="book-image">
                  <img src="https://a-static.mlcdn.com.br/350x350/livro-cyberpunk-2077-trauma-team/quintaldascoisas/isbn9786587435107/1e52cf4e8105092d1ec6f4268cc2d518.jpg" />
                    <div class="effect"></div>
                    <div class="light"></div>
                  </div>
                </div>
              </div>
            </div>
  
          <div class="book-items"> <!-- TAZERCRAFT HEROBRINE A LENDA-->
            <div class="main-book-wrap">
              <div class="book-cover">
                <div class="book-inside"></div>
                <div class="book-image">
                  <img src="https://m.media-amazon.com/images/I/814YwXI7YML._AC_UF1000,1000_QL80_.jpg" />
                  <div class="effect"></div>
                  <div class="light"></div>
                </div>
              </div>
            </div>
          </div>
  
          <div class="book-items"> <!-- DIARIO DE UM BANANA-->
            <div class="main-book-wrap">
              <div class="book-cover">
                <div class="book-inside"></div>
                <div class="book-image">
                  <img src="https://m.media-amazon.com/images/I/71vpmzbWXkS._AC_UF1000,1000_QL80_.jpg" />
                  <div class="effect"></div>
                  <div class="light"></div>
                </div>
              </div>
            </div>
          </div>
  
          <div class="book-items"> <!-- HORA DA ESTRELA -->
            <div class="main-book-wrap">
              <div class="book-cover">
                <div class="book-inside"></div>
                <div class="book-image">
                  <img src="https://m.media-amazon.com/images/I/810Vj9zyi-L._AC_UF1000,1000_QL80_.jpg" />
                  <div class="effect"></div>
                  <div class="light"></div>
                </div>
              </div>
            </div>
          </div>
  
          <div class="book-items"> <!-- A NOITE DAS BRUXAS-->
            <div class="main-book-wrap">
              <div class="book-cover">
                <div class="book-inside"></div>
                <div class="book-image">
                  <img src="https://upload.wikimedia.org/wikipedia/pt/f/f6/Ghost_-_Rite_Here_Rite_Now.jpeg" />
                  <div class="effect"></div>
                  <div class="light"></div>
                </div>
              </div>
            </div>
          </div>
  
          <div class="book-items"> <!-- CORALINE -->
            <div class="main-book-wrap">
              <div class="book-cover">
                <div class="book-inside"></div>
                <div class="book-image">
                  <img src="https://m.media-amazon.com/images/I/91DZobBc1BL._AC_UF1000,1000_QL80_.jpg" />
                  <div class="effect"></div>
                  <div class="light"></div>
                </div>
              </div>
            </div>
          </div>
  
        </div> <!-- FIM DA DIV "COLUNA 3" DOS LIVROS -->

        <div class="book-wrapper4"> <!-- COMEÇO DA COLUNA 4 DOS LIVROS-->
  
          <div class="book-items"> <!-- memoria postumas de brás cubas -->
            <div class="main-book-wrap">
              <div class="book-cover">
                <div class="book-inside"></div>
                <div class="book-image">
                  <img src="https://m.media-amazon.com/images/I/815u+SBDpJL._AC_UF1000,1000_QL80_.jpg" />
                  <div class="effect"></div>
                  <div class="light"></div>
                </div>
              </div>
            </div>
          </div>
  
          <div class="book-items"> <!-- TRÊS ESPIÔES DEMAIS -->
            <div class="main-book-wrap">
              <div class="book-cover">
                <div class="book-inside"></div>
                <div class="book-image">
                  <img src="https://m.media-amazon.com/images/I/511wVj0swkL._AC_UF1000,1000_QL80_.jpg" />
                    <div class="effect"></div>
                    <div class="light"></div>
                  </div>
                </div>
              </div>
            </div>
  
          <div class="book-items"> <!-- BORDELANDS -->
            <div class="main-book-wrap">
              <div class="book-cover">
                <div class="book-inside"></div>
                <div class="book-image">
                  <img src="https://m.media-amazon.com/images/I/91xSrn4lUML._AC_UF1000,1000_QL80_.jpg" />
                  <div class="effect"></div>
                  <div class="light"></div>
                </div>
              </div>
            </div>
          </div>
  
          <div class="book-items"> <!-- MINECRAFT-->
            <div class="main-book-wrap">
              <div class="book-cover">
                <div class="book-inside"></div>
                <div class="book-image">
                  <img src="https://m.media-amazon.com/images/I/81CiAC6o7kL._AC_UF1000,1000_QL80_.jpg" />
                  <div class="effect"></div>
                  <div class="light"></div>
                </div>
              </div>
            </div>
          </div>
  
          <div class="book-items"> <!-- ponte para terabitia-->
            <div class="main-book-wrap">
              <div class="book-cover">
                <div class="book-inside"></div>
                <div class="book-image">
                  <img src="https://www.moderna.com.br/lumis/portal/file/fileDownload.jsp?fileId=8A8A8A8241E61EAB0141E65D0DDE27E9" />
                  <div class="effect"></div>
                  <div class="light"></div>
                </div>
              </div>
            </div>
          </div>
  
          <div class="book-items"> <!-- percy jackson-->
            <div class="main-book-wrap">
              <div class="book-cover">
                <div class="book-inside"></div>
                <div class="book-image">
                  <img src="https://m.media-amazon.com/images/I/A1UjcPz4gZL._AC_UF1000,1000_QL80_.jpg" />
                  <div class="effect"></div>
                  <div class="light"></div>
                </div>
              </div>
            </div>
          </div>
  
          <div class="book-items"> <!-- KEN FOLLETT -->
            <div class="main-book-wrap">
              <div class="book-cover">
                <div class="book-inside"></div>
                <div class="book-image">
                  <img src="https://m.media-amazon.com/images/I/61J4Zqv7SlL._AC_UF1000,1000_QL80_.jpg" />
                  <div class="effect"></div>
                  <div class="light"></div>
                </div>
              </div>
            </div>
          </div>
  
        </div> <!-- FIM DA DIV "COLUNA 4" DOS LIVROS -->

    </div> <!-- FIM DIV PAG PRINCIPAL-->
    
    <!-- partial -->
      <script src='https://unpkg.com/feather-icons'></script><script  src="./script.js"></script>
  </body>
</html>
