<?php
    class Conexao
    {
        protected mysqli $conexao;

        function __construct()
        {
            $this -> conexao = $this -> conectar();
        }

        function conectar()
        {
            //Altere com os seus dados
            $hostname = "localhost";
            $username = "root";
            $password = "";
            $database = "db_empresa";  

            $conexao = mysqli_connect($hostname, $username, $password, $database);

            return $conexao;
        }
    }
?>