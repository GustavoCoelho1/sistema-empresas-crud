<?php
    class Conexao
    {
        protected mysqli | false $conexao;

        function __construct()
        {
            $this -> conexao = $this -> conectar();
        }

        function conectar()
        {
            try {
                //Altere com os seus dados
                $hostname = "localhost";
                $username = "root";
                $password = "";
                $database = "db_empresa";  

                $conexao = mysqli_connect($hostname, $username, $password, $database);

                return $conexao;
            }
            catch (mysqli_sql_exception $exception) {
                return false;
            }
        }

        function validarConexao()
        {
            if ($this -> conexao != false && $this -> conexao != null)
            {
                return true;
            }
            else
            {
                return false;
            }
        }
    }
?>