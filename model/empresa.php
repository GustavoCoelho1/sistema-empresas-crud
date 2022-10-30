<?php
    include_once('conexao.php');

    class Empresa extends Conexao
    {
        function get_conexao() {
            return $this -> conexao;
        }

        function psqEmpresaNome()
        {            
            if (isset($_POST['txt_Pesquisa']))
            {
                $conexao = $this -> get_conexao();

                $pesquisa = $_POST['txt_Pesquisa'];

                $resultado = $conexao -> query(
                    "SELECT 
                        cod_empresa as 'Código',
                        nome_empresa as 'Nome',
                        email_empresa as 'Email',
                        telefone_empresa as 'Telefone',
                        descricao_empresa as 'Descrição',
                        cod_user_fk as 'Proprietário'
                    FROM tb_empresa WHERE nome_empresa LIKE '%{$pesquisa}%'
                ");

                $empresas = array();

                foreach($resultado as $info)
                {
                    $empresas[] = array(
                        "Código" => $info["Código"],
                        "Nome" => $info["Nome"],
                        "Email" => $info["Email"],
                        "Telefone" => $info["Telefone"],
                        "Descrição" => $info["Descrição"],
                        "Proprietário" => $info["Proprietário"]
                    );
                };

                echo json_encode($empresas);
            }
            else 
            {
                echo false;
            }
        }

        function psqEmpresaCod()
        {            
            if (isset($_POST['cod_empresa']))
            {
                $conexao = $this -> get_conexao();

                $pesquisa = $_POST['cod_empresa'];

                $resultado = $conexao -> query(
                    "SELECT 
                        cod_empresa as 'Código',
                        nome_empresa as 'Nome',
                        email_empresa as 'Email',
                        telefone_empresa as 'Telefone',
                        descricao_empresa as 'Descrição',
                        cod_user_fk as 'Proprietário'
                    FROM tb_empresa WHERE cod_empresa = {$pesquisa}
                ");

                $resultado = mysqli_fetch_assoc($resultado);

                echo json_encode($resultado);
            }
            else 
            {
                echo false;
            }
        }

        function cadastrarEmpresa() {
            $conexao = $this -> get_conexao();

            $conexao -> autocommit(false);
            $conexao -> begin_transaction();
            mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

            try {
                //Empresa
                $nomeEmpresa = $_POST['txt_NomeEmpresa'];
                $emailEmpresa = $_POST['txt_EmailEmpresa'];
                $telefone = $_POST['txt_Telefone'];
                $desc = $_POST['txt_Descricao'];
                $codUser = $_POST['codUser'];

                $query = $conexao -> query(
                    "INSERT INTO tb_empresa(nome_empresa, email_empresa, telefone_empresa, descricao_empresa, cod_user_fk)
                    VALUES(
                        '{$nomeEmpresa}',
                        '{$emailEmpresa}',
                        '{$telefone}',
                        '{$desc}',
                        '{$codUser}'
                    )"
                );

                $resultado = ($query) ? $conexao -> commit() : false;

                $resposta = array("resultado" => $resultado);

                echo json_encode($resposta);
            }
            catch (mysqli_sql_exception $exception)
            {
                $conexao -> rollback();
                throw $exception;
            }
        }

        function alterarEmpresa()
        {
            if (
                isset($_POST['txt_Codigo']) &&
                isset($_POST['txt_NomeEmpresa']) &&
                isset($_POST['txt_EmailEmpresa']) &&
                isset($_POST['txt_Telefone']) &&
                isset($_POST['txt_Descricao'])
            )
            {
                $conexao = $this -> get_conexao();

                $conexao -> autocommit(false);
                $conexao -> begin_transaction();
                mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

                try
                {
                    $codEmp = $_POST['txt_Codigo'];
                    $nome = $_POST['txt_NomeEmpresa'];
                    $email = $_POST['txt_EmailEmpresa'];
                    $telefone = $_POST['txt_Telefone'];
                    $descricao = $_POST['txt_Descricao'];

                    $resultado = $conexao -> query(
                        "UPDATE tb_empresa SET 
                            nome_empresa = '{$nome}',
                            email_empresa = '{$email}',
                            telefone_empresa = '{$telefone}',
                            descricao_empresa = '{$descricao}'
                        WHERE cod_empresa = '{$codEmp}';
                    ");

                    $resultado = ($resultado == true) ? $conexao -> commit() : false;

                    echo json_encode(array('resultado' => $resultado));
                }
                catch (mysqli_sql_exception $exception)
                {
                    $conexao -> rollback();
                    throw $exception;
                }
            }
            else
            {
                echo false;
            }
        }

        function deletarEmpresa()
        {
            if (isset($_POST['spn_CodEmpresa']))
            {
                $conexao = $this -> get_conexao();

                $conexao -> autocommit(false);
                $conexao -> begin_transaction();
                mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

                try
                {
                    $codEmp = $_POST['spn_CodEmpresa'];

                    $resultado = $conexao -> query("DELETE FROM tb_empresa WHERE cod_empresa = {$codEmp};");

                    $resultado = ($resultado == true) ? $conexao -> commit() : false;

                    echo json_encode(array('resultado' => $resultado));
                }
                catch (mysqli_sql_exception $exception)
                {
                    $conexao -> rollback();
                    throw $exception;
                }
            }
            else
            {
                echo false;
            }
        }
    }
?>