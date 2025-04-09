<?php

    //Superclasse Entidade
    class Entidade {
        //Atributos;
        protected $data;
        private static $conn;

        //Método __set()
        function __set($prop, $value) {
            $this->data[$prop] = $value;
        }//Fim do método __set()

        //Método __get()
        function __get($prop) {
            return $this->data[$prop];
        }//Fim do método __get()

    }//Fim da classe Entidade

?>