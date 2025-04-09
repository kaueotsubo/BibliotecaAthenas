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
    // Trata qualquer exceção relacionada ao banco de dados
    echo "Erro de conexão com o banco de dados: " . $e->getMessage();
    exit();
}

// Fecha a conexão com o banco de dados
$conn = null;
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Biblioteca Athena</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/meyer-reset/2.0/reset.min.css">
    <link rel="shortcut icon" href="logo2.png" type="image/x-icon">
    <link rel="stylesheet" href="estilo.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
</head>
<body>
    <!-- partial:index.partial.html -->
    <div class="menu_lateral"> <!-- Começa HTML do Menu -->
        <div class="header__logo"> <!-- DIV LOGO -->
            <a href="index1.php">
                <img src="logo.png" alt="Logo">
            </a>
        </div> <!-- FIM DIV LOGO -->
        <div class="catego"> <!-- DIV DO ICONE DO INICIO -->
            <a href="index1.php">
                <i class="bi bi-house-door-fill" style="font-size: 26px"></i> Início <br><br><br>
            </a>
        </div> <!-- FIM DA DIV DO ICONE DO INICIO -->
        <div class="catego"> <!-- DIV DO ICONE DA ESTANTE -->
            <a href="estante.php">
                <i class="bi bi-bookshelf" style="font-size: 26px"></i> Estante <br><br><br>
            </a>
        </div> <!-- FIM DA DIV DO ICONE DA ESTANTE -->
        <div class="catego"> <!-- DIV DO ICONE DA LOJA -->
            <a href="library.php">
                <i class="bi bi-bag-fill" style="font-size: 26px"></i> Biblioteca
            </a>
        </div> <!-- FIM DA DIV DO ICONE DA LOJA -->
        <br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
        <div class="catego-baixo"> <!-- DIV DO "SAIR" -->
            <a href="logout.php">
                <i class="bi bi-box-arrow-right" style="font-size: 30px"></i> Sair
            </a>
        </div> <!-- FIM DA DIV DO "SAIR" -->
    </div> <!-- FIM DO HTML DO MENU -->

    <div class="pesquisar"> <!-- COMEÇO DA BARRA DE PESQUISA -->
        <input type="text" id="barra" name="buscar" placeholder="Pesquise seus livros favoritos">
        <label for="barra" class="lupa">
            <i class="bi bi-search" style="font-size:16px"></i>
        </label>
    </div> <!-- FIM DA BARRA DE PESQUISA -->

    <div class="fav"> <!-- COMEÇO DIV FAVORITOS -->
        <a href="favoritos.html">
            <i class="bi bi-heart" style="font-size:25px"></i>
        </a>
    </div> <!-- FIM DA DIV FAVORITOS -->

    <div class = "person"> <!-- COMEÇO DIV PESSOA LOGADA -->
        <i class="bi bi-person" style="font-size:30px"></i>
         Olá, <?php echo htmlspecialchars($nome, ENT_QUOTES, 'UTF-8'); ?>!
    </div> <!-- FIM DA DIV PESSOA LOGADA -->

    <!-- COMEÇO DA PAG PRINCIPAL -->
    <div class="banner"> <!-- COMEÇO DO BANNER -->
        <img src="banner2.png" alt="Banner">
    </div> <!-- FIM DO BANNER -->

    <div class="text"> <!-- TEXTO "LIVROS RECOMENDADOS" -->
        Livros Recomendados
    </div> <!-- FIM DO TEXTO -->

    <div class="principal"> <!-- COMEÇO DA DIV DA PAG PRINCIPAL -->
        <div class="book-wrapper"> <!-- COMEÇO DA COLUNA 1 DOS LIVROS -->
            <div class="book-items"> <!-- JOGOS VOZARES -->
                <div class="main-book-wrap">
                    <div class="book-cover">
                        <div class="book-inside"></div>
                        <div class="book-image">
                            <img src="https://m.media-amazon.com/images/I/41pbZcXFYkL.jpg" alt="Livro 1">
                            <div class="effect"></div>
                            <div class="light"></div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="book-items"> <!-- JOGOS VOZARES EM CHAMAS -->
                <div class="main-book-wrap">
                    <div class="book-cover">
                        <div class="book-inside"></div>
                        <div class="book-image">
                            <img src="https://m.media-amazon.com/images/I/41qHtQr4lkL.jpg" alt="Livro 2">
                            <div class="effect"></div>
                            <div class="light"></div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="book-items"> <!-- JOGOS VOZARES A ESPERANÇA -->
                <div class="main-book-wrap">
                    <div class="book-cover">
                        <div class="book-inside"></div>
                        <div class="book-image">
                            <img src="https://m.media-amazon.com/images/I/41L0kEv3yZL.jpg" alt="Livro 3">
                            <div class="effect"></div>
                            <div class="light"></div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="book-items"> <!-- a cantiga dos pássaros e das serpentes -->
                <div class="main-book-wrap">
                    <div class="book-cover">
                        <div class="book-inside"></div>
                        <div class="book-image">
                            <img src="https://m.media-amazon.com/images/I/61MCf2k-MgS._AC_UF1000,1000_QL80_.jpg" alt="Livro 4">
                            <div class="effect"></div>
                            <div class="light"></div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="book-items"> <!-- IT A COISA -->
                <div class="main-book-wrap">
                    <div class="book-cover">
                        <div class="book-inside"></div>
                        <div class="book-image">
                            <img src="https://m.media-amazon.com/images/I/91g9Dvtf+jL._AC_UF1000,1000_QL80_.jpg" alt="Livro 5">
                            <div class="effect"></div>
                            <div class="light"></div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="book-items"> <!-- Fogo e sangue -->
                <div class="main-book-wrap">
                    <div class="book-cover">
                        <div class="book-inside"></div>
                        <div class="book-image">
                            <img src="https://m.media-amazon.com/images/I/818yNY0mMZL._AC_UF1000,1000_QL80_.jpg" alt="Livro 6">
                            <div class="effect"></div>
                            <div class="light"></div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="book-items"> <!-- A GUERRA DOS TRONOS -->
                <div class="main-book-wrap">
                    <div class="book-cover">
                        <div class="book-inside"></div>
                        <div class="book-image">
                            <img src="https://m.media-amazon.com/images/I/91+1SUO3vUL._AC_UF1000,1000_QL80_.jpg" alt="Livro 7">
                            <div class="effect"></div>
                            <div class="light"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div> <!-- FIM DA DIV DOS LIVROS -->

        <!-- <div class="text2">  TEXTO "LIVROS GRATUITOS" 
            Livros Gratuitos
        </div> FIM DO TEXTO -->

        <!-- COMEÇO DA COLUNA 2 DOS LIVROS -->

        <div class="book-wrapper2"> <!-- COMEÇO DA COLUNA 2 DOS LIVROS -->
            <div class="book-items"> <!-- POR LUGARES INCRIVEIS -->
                <div class="main-book-wrap">
                    <div class="book-cover">
                        <div class="book-inside"></div>
                        <div class="book-image">
                            <img src="https://m.media-amazon.com/images/I/510HCDDGb3L.jpg" />
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

            <div class="book-items"> <!-- HP E O PRISIONEIRO DE AZKABAN -->
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

            <div class="book-items"> <!-- MIL BEIJOS DE UM GAROTO -->
                <div class="main-book-wrap">
                    <div class="book-cover">
                        <div class="book-inside"></div>
                        <div class="book-image">
                            <img src="https://m.media-amazon.com/images/I/81hK-E1S3lL._AC_UF1000,1000_QL80_.jpg" />
                            <div class="effect"></div>
                            <div class="light"></div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="book-items"> <!-- A NOITE DAS BRUXAS -->
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
        </div> <!-- FIM DA DIV "COLUNA 2" DOS LIVROS -->

        <div class="banner2"> <!-- COMEÇO DO BANNER -->
            <img src="banner1.png" alt="Banner">
        </div> <!-- FIM DO BANNER -->

        <div class="text2"> <!-- TEXTO "LIVROS RECOMENDADOS" -->
            Livros Recomendados
        </div> <!-- FIM DO TEXTO -->

        <div class="book-wrapper3"> <!-- COMEÇO DA COLUNA 3 DOS LIVROS -->
            <div class="book-items"> <!-- tudo é rio -->
                <div class="main-book-wrap">
                    <div class="book-cover">
                        <div class="book-inside"></div>
                        <div class="book-image">
                            <img src="https://m.media-amazon.com/images/I/816Udvs9O7L._AC_UF1000,1000_QL80_.jpg" />
                            <div class="effect"></div>
                            <div class="light"></div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="book-items"> <!-- a natureza da mordida -->
                <div class="main-book-wrap">
                    <div class="book-cover">
                        <div class="book-inside"></div>
                        <div class="book-image">
                            <img src="https://m.media-amazon.com/images/I/91B5NWWKuzL._AC_UF350,350_QL80_.jpg" />
                            <div class="effect"></div>
                            <div class="light"></div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="book-items"> <!-- vespera -->
                <div class="main-book-wrap">
                    <div class="book-cover">
                        <div class="book-inside"></div>
                        <div class="book-image">
                            <img src="https://m.media-amazon.com/images/I/91ADwCpigxL._AC_UF1000,1000_QL80_.jpg" />
                            <div class="effect"></div>
                            <div class="light"></div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="book-items"> <!-- anna O -->
                <div class="main-book-wrap">
                    <div class="book-cover">
                        <div class="book-inside"></div>
                        <div class="book-image">
                            <img src="https://m.media-amazon.com/images/I/61c-o2xndCL._AC_UF1000,1000_QL80_.jpg" />
                            <div class="effect"></div>
                            <div class="light"></div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="book-items"> <!-- Ensaio sobre a cegueira -->
                <div class="main-book-wrap">
                    <div class="book-cover">
                        <div class="book-inside"></div>
                        <div class="book-image">
                            <img src="https://m.media-amazon.com/images/I/71Hr1-by3UL._AC_UF1000,1000_QL80_.jpg" />
                            <div class="effect"></div>
                            <div class="light"></div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="book-items"> <!-- blackout  -->
                <div class="main-book-wrap">
                    <div class="book-cover">
                        <div class="book-inside"></div>
                        <div class="book-image">
                            <img src="https://m.media-amazon.com/images/I/81OrFPMD-VS._AC_UF1000,1000_QL80_.jpg" />
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
                            <img src="https://br.web.img2.acsta.net/img/a4/5e/a45ef1856c1533932156e4cfeeefa0d7.png" />
                            <div class="effect"></div>
                            <div class="light"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div> <!-- FIM DA DIV "COLUNA 3" DOS LIVROS -->

        <div class="book-wrapper4"> <!-- COMEÇO DA COLUNA 4 DOS LIVROS -->
            <div class="book-items"> <!-- O fabricante de lagrimas -->
                <div class="main-book-wrap">
                    <div class="book-cover">
                        <div class="book-inside"></div>
                        <div class="book-image">
                            <img src="https://m.media-amazon.com/images/I/81mJDtLZRvL._AC_UF1000,1000_QL80_.jpg" />
                            <div class="effect"></div>
                            <div class="light"></div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="book-items"> <!-- O iluminado -->
                <div class="main-book-wrap">
                    <div class="book-cover">
                        <div class="book-inside"></div>
                        <div class="book-image">
                            <img src="https://m.media-amazon.com/images/I/8147kKLLvOL._AC_UF1000,1000_QL80_.jpg" />
                            <div class="effect"></div>
                            <div class="light"></div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="book-items"> <!-- Ghost book -->
                <div class="main-book-wrap">
                    <div class="book-cover">
                        <div class="book-inside"></div>
                        <div class="book-image">
                            <img src="https://m.media-amazon.com/images/I/71BydGcGvZL._AC_UF1000,1000_QL80_.jpg" />
                            <div class="effect"></div>
                            <div class="light"></div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="book-items"> <!-- Assim que acaba -->
                <div class="main-book-wrap">
                    <div class="book-cover">
                        <div class="book-inside"></div>
                        <div class="book-image">
                            <img src="https://m.media-amazon.com/images/I/8196PzdCGiL._AC_UF1000,1000_QL80_.jpg" />
                            <div class="effect"></div>
                            <div class="light"></div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="book-items"> <!-- The walinkig dead-->
                <div class="main-book-wrap">
                    <div class="book-cover">
                        <div class="book-inside"></div>
                        <div class="book-image">
                            <img src="https://m.media-amazon.com/images/I/916GafPtQaL._AC_UF1000,1000_QL80_.jpg" />
                            <div class="effect"></div>
                            <div class="light"></div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="book-items"> <!-- A NOITE DAS BRUXAS -->
                <div class="main-book-wrap">
                    <div class="book-cover">
                        <div class="book-inside"></div>
                        <div class="book-image">
                            <img src="https://m.media-amazon.com/images/I/91Yi9uiB6yL._AC_UF1000,1000_QL80_.jpg" />
                            <div class="effect"></div>
                            <div class="light"></div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="book-items"> <!-- O exorcista-->
                <div class="main-book-wrap">
                    <div class="book-cover">
                        <div class="book-inside"></div>
                        <div class="book-image">
                            <img src="https://m.media-amazon.com/images/I/91fQ51I4TRL._AC_UF1000,1000_QL80_.jpg" />
                            <div class="effect"></div>
                            <div class="light"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div> <!-- FIM DA DIV "COLUNA 4" DOS LIVROS -->

    </div> <!-- FIM DA DIV DA PAG PRINCIPAL -->

    <!-- partial -->
    <script src='https://unpkg.com/feather-icons'></script>
    <script src="./script.js"></script>
</body>
</html>
