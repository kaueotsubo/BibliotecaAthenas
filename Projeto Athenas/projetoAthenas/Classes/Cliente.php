<?php

    //Subclasse cliente
    require_once 'C:\xampp\htdocs\Projeto Athenas\projetoAthenas\Classes\entidade.php';
    class Cliente extends Entidade {
        private static $conn;

        //Método setConnection()
        public static function setConnection (PDO $conn) {
            self::$conn = $conn;
            ClienteGateway::setConnection($conn);
        }//Fim do método setConnection

        //Método find()
        public static function find($codUsuario) {
            $clienteGateway = new ClienteGateway;
            return $clienteGateway->find($codUsuario, 'cliente');
        }//Método find()

        //Método all()
        public static function all ($filter = '') {
            $clienteGateway = new ClienteGateway;
            return $clienteGateway->all($filter, 'cliente');
        }//Fim do método all()

        //Método delete()
        public function delete () {
            $clienteGateway = new ClienteGateway;
            return $clienteGateway->delete ($this->codUsuario);
        }//Fim do método delete()

        //Método save()
        public function save () {
            $clienteGateway = new ClienteGateway;
            return $clienteGateway->save((object)$this->data);
        }//Fim do método save()

        

    }//Fim da classe cliente
?>