<?php

    //Subclasse livros
    require_once 'C:\xampp\htdocs\projetoAthenas\Classes\entidade.php';
    class livros extends Entidade {
        private static $conn;

        //Método setConnection()
        public static function setConnection (PDO $conn) {
            self::$conn = $conn;
            Livrosgateway::setConnection($conn);
        }//Fim do método setConnection

        //Método find()
        public static function find($codjogo) {
            $livrosgateway = new Livrosgateway;
            return $livrosgateway->find($codjogo, 'livros');
        }//Método find()

        //Método all()
        public static function all ($filter = '') {
            $livrosgateway = new Livrosgateway;
            return $livrosgateway->all($filter, 'livros');
        }//Fim do método all()

        //Método delete()
        public function delete () {
            $livrosgateway = new Livrosgateway;
            return $livrosgateway->delete ($this->codLivro);
        }//Fim do método delete()

        //Método save()
        public function save () {
            $livrosgateway = new Livrosgateway;
            return $livrosgateway->save((object)$this->data);
        }//Fim do método save()

        

    }//Fim da classe livros
?>