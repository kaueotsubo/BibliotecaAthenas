<?php

    //Classe ClienteGateway
    class ClienteGateway {
        private static $conn;

        //Método setConnection()
        public static function setConnection (PDO $conn) {
            self::$conn = $conn; 
        }//Fim do método setConnection()

        //Método find()
        public function find ($id, $class = 'stdClass') {
            $sql = "SELECT * FROM usuario WHERE id = '$codusuario'";
            print "$sql <br>\n";
            $result = self::$conn->query($sql);
            return $result->fetchObject($class);
        }//Fim do método find()

        //Método all()
        public function all ($filter, $class = 'stdClass') {
            $sql = "SELECT * FROM usuario ";
            if ($filter) {
                $sql .= "WHERE $filter";
            }
            print "$sql <br>\n";
            $result = self::$conn->query($sql);
            return $result->fetchAll(PDO::FETCH_CLASS, $class);
        }//Fim do método all()

        //Método delete()
        public function delete ($codusuario) {
            $sql = "DELETE FROM usuario WHERE id = '$codusuario'";
            print "$sql <br>\n";
            return self::$conn->query($sql);
        }//Fim do método delete()

        //Método save()
        public function save ($data) {
            if (empty($data->codusuario)) { //Id não localizado - Insere
                $codusuario = $this->getLastId() + 1;
                $sql = "INSERT INTO usuario (codusuario, nome, nickname, dataNascimento, 
                email, senha, confSenha) VALUES ('{$codusario}', '{$data->nome}', '{$data->dataNascimento}', 
                '{$data->email}', '{$data->senha}', '{$data->confSenha}')"; 
            }
            else { //Id localizado - Atualiza
                $sql = "UPDATE usuario SET 
                nome = '{$data->nome}', 
                dataNascimento = '{$data->dataNascimento}',
                email = '{$data->email}',
                senha = '{$data->senha}'
                confSenha = '{$data->confSenha}' WHERE 
                codusuario = '{$data->codusuario}'";
            }
            print "$sql <br>\n";
            return self::$conn->exec($sql); //executa a instrução SQL
        }//Fim do método save()

        //Método getLastId()
        public function getLastId() {
            $sql = "SELECT max(id) as max FROM usuario";
            $result = self::$conn->query($sql);
            $data = $result->fetch(PDO::FETCH_OBJ);
            return $data->max;
        }//Fim do método getLastId()
    }//Fim da classe ClienteGateway
?>