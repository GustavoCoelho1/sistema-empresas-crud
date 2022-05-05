<?php
    include_once('conexao.php');

    (session_status() === PHP_SESSION_NONE) ? session_start() : '';

    class Usuario extends Conexao
    {
        function get_conexao()
        {
            return $this -> conexao;
        }

        function login() 
        {
            $conexao = $this -> get_conexao();

            $email = $_POST["txt_Email"];
            $senha = $_POST["txt_Senha"];

            $usuarios = $conexao -> query(
                "SELECT 
                    cod_user AS 'Código',
                    email_user AS 'Email',
                    senha_user AS 'Senha'
                FROM tb_usuario");

            $emailValido = false;
            $senhaValida = false;

            $codUser = '';

            foreach($usuarios as $usuario)
            {
                if ($usuario['Email'] == $email)
                {
                    $codUser = $usuario['Código'];
                    $emailValido = true;
                }

                if (password_verify($senha, $usuario['Senha']))
                {
                    $senhaValida = true;
                }
            }

            if (isset($_SESSION['login'])) 
            {
                unset($_SESSION['login']);
            }

            $resultado = false;

            if ($emailValido == true && $senhaValida == true)
            {
                $_SESSION['login'] = true;
                $_SESSION['cod_user'] = $codUser;

                $resultado = true;
            }
            else
            {
                $_SESSION['login'] = false;
                $resultado = false;
            }

            $resposta = array("resultado" => $resultado);

            echo json_encode($resposta);
        }   

        function logout()
        {
            session_unset();
            session_destroy();

            header('Location: ../view/login.php');
        }

        function cadastrar()
        {
            $conexao = $this -> get_conexao();

            $conexao -> autocommit(false);
            $conexao -> begin_transaction();
            mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

            try
            {
                //Empresa
                $nomeEmpresa = $_POST['txt_NomeEmpresa'];
                $emailEmpresa = $_POST['txt_EmailEmpresa'];
                $telefone = $_POST['txt_Telefone'];
                $desc = $_POST['txt_Descricao'];

                //Usuário
                $nomeUser = $_POST['txt_NomeUser'];
                $emailUser = $_POST['txt_EmailUser'];
                $senha = $_POST['txt_Senha'];

                $opcao = ['cos' => 8];
                $senhaC = password_hash($senha, PASSWORD_BCRYPT, $opcao);

                $resultado1 = $conexao -> query(
                    "INSERT INTO tb_usuario(nome_user, email_user, senha_user)
                    VALUES(
                        '{$nomeUser}',
                        '{$emailUser}',
                        '{$senhaC}'
                    )"
                );

                $codUser = $conexao -> insert_id;

                $resultado2 = $conexao -> query(
                    "INSERT INTO tb_empresa(nome_empresa, email_empresa, telefone_empresa, descricao_empresa, cod_user_fk)
                    VALUES(
                        '{$nomeEmpresa}',
                        '{$emailEmpresa}',
                        '{$telefone}',
                        '{$desc}',
                        '{$codUser}'
                    )"
                );

                $resultado = ($resultado1 && $resultado2) ? $conexao -> commit() : false;

                $resposta = array("resultado" => $resultado);

                echo json_encode($resposta);
            }
            catch (mysqli_sql_exception $exception)
            {
                $conexao -> rollback();
                throw $exception;
            }
        }

        function pesquisarCodigo($codigo)
        {            
            if (isset($codigo) && $codigo != 0)
            {
                $conexao = $this -> get_conexao();

                $pesquisa = $codigo;

                $resultado = $conexao -> query(
                    "SELECT 
                            cod_user AS 'Código',
                            nome_user AS 'Nome',
                            email_user AS 'Email'
                    FROM tb_usuario WHERE cod_user = '{$pesquisa}'
                ");

                $resultado = mysqli_fetch_assoc($resultado);

                return $resultado;
            }
            else 
            {
                echo false;
            }
        }
    }
?>