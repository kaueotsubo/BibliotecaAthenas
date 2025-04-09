<?php

    //Classe LivrosGateway
    class LivrosGateway {
        private static $conn;

        //Método setConnection()
        public static function setConnection (PDO $conn) {
            self::$conn = $conn; 
        }//Fim do método setConnection()

        //Método find()
        public function find ($id, $class = 'stdClass') {
            $sql = "SELECT * FROM livros WHERE id = '$codLivro'";
            print "$sql <br>\n";
            $result = self::$conn->query($sql);
            return $result->fetchObject($class);
        }//Fim do método find()

        //Método all()
        public function all ($filter, $class = 'stdClass') {
            $sql = "SELECT * FROM livros ";
            if ($filter) {
                $sql .= "WHERE $filter";
            }
            print "$sql <br>\n";
            $result = self::$conn->query($sql);
            return $result->fetchAll(PDO::FETCH_CLASS, $class);
        }//Fim do método all()

        //Método delete()
        public function delete ($codLivro) {
            $sql = "DELETE FROM livros WHERE id = '$codLivro'";
            print "$sql <br>\n";
            return self::$conn->query($sql);
        }//Fim do método delete()

        //Método save()
        public function save ($data) {
            if (empty($data->codLivro)) { //Id não localizado - Insere
                $codLivro = $this->getLastId() + 1;
                $sql = "INSERT INTO livros (codLivro, nomeLivros, autor, decricao, genero, 
                classificaoIndicativa) VALUES ('{$codLivro}', '{$data->nomeLivros}', 
                '{$data->genero}', '{$data->autor}', 
                '{$data->descricao}', '{$data->classificaoIndicativa}')"; 
            }
            else { //Id localizado - Atualiza
                $sql = "UPDATE livros SET 
                nomeLivros = '{$data->nomeLivros}', 
                genero = '{$data->genero}',
                autor = '{$data->autor}',
                descricao = '{$data->descricao}',
                classificaoIndicativa = '{$data->classificaoIndicativa}' WHERE 
                codLivro = '{$data->codLivro}'";
            }
            print "$sql <br>\n";
            return self::$conn->exec($sql); //executa a instrução SQL
        }//Fim do método save()

        //Método getLastId()
        public function getLastId() {
            $sql = "SELECT max(id) as max FROM livros";
            $result = self::$conn->query($sql);
            $data = $result->fetch(PDO::FETCH_OBJ);
            return $data->max;
        }//Fim do método getLastId()
    }//Fim da classe LivrosGateway
?>